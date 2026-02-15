<?php
/**
 * Telegram Notifier - отправка уведомлений о заявках
 * PHP 5.6 compatible
 */
class TelegramNotifier
{
    private $client;
    private $chatIds;
    private $enabled;
    
    public function __construct()
    {
        // Загружаем конфигурацию из config/config.php
        $configFile = __DIR__ . '/../config/config.php';
        if (file_exists($configFile)) {
            require_once $configFile;
            
            if (defined('TELEGRAM_BOT_TOKEN') && !empty(TELEGRAM_BOT_TOKEN)) {
                $this->enabled = true;
                $logFile = __DIR__ . '/../log/telegram.log';
                $this->client = new TelegramClient(TELEGRAM_BOT_TOKEN);
                
                // Получаем chat_ids из БД (всех пользователей, которые отправили /start)
                $this->loadChatIdsFromDB();
            } else {
                $this->enabled = false;
            }
        } else {
            $this->enabled = false;
        }
    }
    
    /**
     * Загрузить chat_ids из БД
     */
    private function loadChatIdsFromDB()
    {
        $this->chatIds = array();
        
        try {
            require_once __DIR__ . '/../config/config.php';
            require_once __DIR__ . '/../classed/Db.php';
            
            $db = new \classed\Db();
            $result = $db->query("SELECT DISTINCT chat_id FROM telegram_logs WHERE chat_id IS NOT NULL AND chat_id != ''");
            
            if ($result) {
                foreach ($result as $row) {
                    if (!empty($row['chat_id'])) {
                        $this->chatIds[] = $row['chat_id'];
                    }
                }
            }
            
            $count = count($this->chatIds);
            $this->log("TelegramNotifier: Loaded {$count} chat_id(s) from DB", 'TelegramNotifier');
            
            if ($count == 0) {
                $this->log("TelegramNotifier: WARNING - No chat_ids found in database! Users need to send /start to bot first.", 'TelegramNotifier');
            }
        } catch (Exception $e) {
            $this->log('TelegramNotifier: Error loading chat_ids from DB: ' . $e->getMessage(), 'TelegramNotifier');
            error_log('TelegramNotifier: Error loading chat_ids from DB: ' . $e->getMessage());
        }
    }
    
    /**
     * Отправить заявку в Telegram
     */
    public function sendLead(array $lead, array $meta = array())
    {
        if (!$this->enabled) {
            $this->log("TelegramNotifier: Notifier disabled. Lead not sent.", 'TelegramNotifier');
            return false;
        }
        
        if (empty($this->chatIds)) {
            $this->log("TelegramNotifier: No chat_ids found. Lead not sent.", 'TelegramNotifier');
            return false;
        }
        
        try {
            // Добавляем данные town в meta (ШАГ 6)
            $meta = $this->enrichMetaWithTown($meta);
            
            $message = $this->formatMessage($lead, $meta);
            
            $success = false;
            $sentCount = 0;
            foreach ($this->chatIds as $chatId) {
                $chatId = trim($chatId);
                if (empty($chatId)) continue;
                
                $result = $this->client->sendMessage($chatId, $message);
                if (isset($result['ok']) && $result['ok']) {
                    $success = true;
                    $sentCount++;
                } else {
                    $this->log("TelegramNotifier: Failed to send to chat_id={$chatId}, result=" . json_encode($result), 'TelegramNotifier');
                }
            }
            
            $this->log("TelegramNotifier: Lead sent to {$sentCount} chat(s). Success: " . ($success ? 'YES' : 'NO'), 'TelegramNotifier');
            return $success;
        } catch (Exception $e) {
            // Логируем ошибку, но не ломаем форму
            $this->log('TelegramNotifier: Exception: ' . $e->getMessage(), 'TelegramNotifier');
            error_log('Telegram send error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Логирование
     */
    private function log($message, $prefix = 'TelegramNotifier')
    {
        $logFile = __DIR__ . '/../log/telegram.log';
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "{$timestamp} | {$prefix} | {$message}\n";
        @file_put_contents($logFile, $logMessage, FILE_APPEND);
    }
    
    /**
     * Обогатить meta данными town
     */
    private function enrichMetaWithTown(array $meta)
    {
        require_once __DIR__ . '/town_helpers.php';
        
        $town = town();
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
        $subdomain = TownResolver::getSubdomainFromHost($host);
        
        $meta['host'] = $host;
        $meta['subdomain'] = $subdomain;
        $meta['town_id'] = town_id();
        $meta['town_city'] = town_city();
        $meta['town_region'] = town_region();
        $meta['town_address'] = town_address();
        $meta['town_phone'] = town_phone();
        $meta['town_subdomain'] = town_subdomain();
        
        return $meta;
    }
    
    /**
     * Форматировать сообщение
     */
    private function formatMessage(array $lead, array $meta)
    {
        $msg = "🟣 <b>Новая заявка</b>\n\n";
        
        // Город/Регион (ШАГ 6)
        if (!empty($meta['town_city'])) {
            $msg .= "📍 <b>Город:</b> " . htmlspecialchars($meta['town_city']) . "\n";
        }
        if (!empty($meta['town_region'])) {
            $msg .= "🗺 <b>Регион:</b> " . htmlspecialchars($meta['town_region']) . "\n";
        }
        if (!empty($meta['town_address'])) {
            $msg .= "🏢 <b>Адрес:</b> " . htmlspecialchars($meta['town_address']) . "\n";
        }
        if (!empty($meta['town_phone'])) {
            $msg .= "📞 <b>Телефон сайта:</b> " . htmlspecialchars($meta['town_phone']) . "\n";
        }
        
        // Сайт/Host
        $host = isset($meta['host']) ? htmlspecialchars($meta['host']) : (isset($_SERVER['HTTP_HOST']) ? htmlspecialchars($_SERVER['HTTP_HOST']) : '');
        $msg .= "🌐 <b>Host:</b> " . $host . "\n";
        
        // URL страницы
        if (isset($meta['url']) && !empty($meta['url'])) {
            $url = htmlspecialchars($meta['url']);
            $msg .= "🔗 <b>Страница:</b> <a href=\"{$url}\">{$url}</a>\n";
        }
        
        // Имя
        if (isset($lead['name']) && !empty($lead['name'])) {
            $name = htmlspecialchars($lead['name']);
            $msg .= "👤 <b>Имя:</b> {$name}\n";
        }
        
        // Телефон
        if (isset($lead['phone']) && !empty($lead['phone'])) {
            $phone = $this->normalizePhone($lead['phone']);
            $phoneEscaped = htmlspecialchars($phone);
            $msg .= "📞 <b>Телефон:</b> <a href=\"tel:{$phone}\">{$phoneEscaped}</a>\n";
        }
        
        // Email
        if (isset($lead['email']) && !empty($lead['email'])) {
            $email = htmlspecialchars($lead['email']);
            $msg .= "✉️ <b>Email:</b> {$email}\n";
        }
        
        // Сообщение
        if (isset($lead['message']) && !empty($lead['message'])) {
            $message = htmlspecialchars($lead['message']);
            $msg .= "🧾 <b>Сообщение:</b> {$message}\n";
        }
        
        // Услуга/Тип
        if (isset($lead['service']) && !empty($lead['service'])) {
            $service = htmlspecialchars($lead['service']);
            $msg .= "🔧 <b>Услуга:</b> {$service}\n";
        }
        
        // Регион/Город
        if (isset($lead['region']) && !empty($lead['region'])) {
            $region = htmlspecialchars($lead['region']);
            $msg .= "🌍 <b>Регион:</b> {$region}\n";
        }
        
        // UTM метки
        $utmParts = array();
        if (isset($meta['utm_source']) && !empty($meta['utm_source'])) {
            $utmParts[] = 'source=' . htmlspecialchars($meta['utm_source']);
        }
        if (isset($meta['utm_medium']) && !empty($meta['utm_medium'])) {
            $utmParts[] = 'medium=' . htmlspecialchars($meta['utm_medium']);
        }
        if (isset($meta['utm_campaign']) && !empty($meta['utm_campaign'])) {
            $utmParts[] = 'campaign=' . htmlspecialchars($meta['utm_campaign']);
        }
        if (!empty($utmParts)) {
            $msg .= "🧷 <b>UTM:</b> " . implode(', ', $utmParts) . "\n";
        }
        
        // Время
        $datetime = isset($meta['datetime']) 
            ? $meta['datetime'] 
            : date('Y-m-d H:i:s');
        $msg .= "🕒 <b>Время:</b> {$datetime}\n";
        
        return $msg;
    }
    
    /**
     * Нормализовать телефон (привести к +7...)
     */
    private function normalizePhone($phone)
    {
        // Удаляем все нецифровые символы
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Если начинается с 8, заменяем на +7
        if (substr($phone, 0, 1) == '8' && strlen($phone) == 11) {
            $phone = '7' . substr($phone, 1);
        }
        
        // Если начинается с 7 и длина 11, добавляем +
        if (substr($phone, 0, 1) == '7' && strlen($phone) == 11) {
            $phone = '+' . $phone;
        }
        
        return $phone;
    }
}
