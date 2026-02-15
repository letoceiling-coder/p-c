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
        } catch (Exception $e) {
            error_log('TelegramNotifier: Error loading chat_ids from DB: ' . $e->getMessage());
        }
    }
    
    /**
     * Отправить заявку в Telegram
     */
    public function sendLead(array $lead, array $meta = array())
    {
        if (!$this->enabled) {
            return false;
        }
        
        try {
            $message = $this->formatMessage($lead, $meta);
            
            $success = false;
            foreach ($this->chatIds as $chatId) {
                $chatId = trim($chatId);
                if (empty($chatId)) continue;
                
                $result = $this->client->sendMessage($chatId, $message);
                if (isset($result['ok']) && $result['ok']) {
                    $success = true;
                }
            }
            
            return $success;
        } catch (Exception $e) {
            // Логируем ошибку, но не ломаем форму
            error_log('Telegram send error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Форматировать сообщение
     */
    private function formatMessage(array $lead, array $meta)
    {
        $msg = "🟣 <b>Новая заявка</b>\n\n";
        
        // Сайт
        $host = isset($meta['host']) ? htmlspecialchars($meta['host']) : $_SERVER['HTTP_HOST'];
        $msg .= "📍 <b>Сайт:</b> " . $host . "\n";
        
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
