<?php

namespace classed;

class TelegramWebhookController extends BaseController
{
    protected $sql;
    
    public function __construct()
    {
        $this->sql = new Db();
        $this->processWebhook();
    }
    
    /**
     * Обработка входящих обновлений от Telegram
     */
    protected function processWebhook()
    {
        $input = file_get_contents('php://input');
        $update = json_decode($input, true);
        
        if (!$update) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid JSON']);
            exit;
        }
        
        // Получаем настройки бота
        $botSettings = $this->sql->query("SELECT * FROM `telegram_bot` LIMIT 1", 'assoc');
        
        if (!$botSettings || empty($botSettings['bot_token'])) {
            http_response_code(500);
            echo json_encode(['error' => 'Bot not configured']);
            exit;
        }
        
        // Обрабатываем обновление
        if (isset($update['message'])) {
            $this->handleMessage($update['message'], $botSettings['bot_token']);
        } elseif (isset($update['callback_query'])) {
            $this->handleCallbackQuery($update['callback_query'], $botSettings['bot_token']);
        }
        
        http_response_code(200);
        echo json_encode(['ok' => true]);
        exit;
    }
    
    /**
     * Обработка текстовых сообщений
     */
    protected function handleMessage($message, $botToken)
    {
        $chatId = $message['chat']['id'];
        $text = $message['text'] ?? '';
        $firstName = $message['from']['first_name'] ?? 'Пользователь';
        
        // Логируем сообщение
        $this->logMessage($message);
        
        // Простой ответ на команду /start
        if ($text === '/start' || $text === '/start@' . $this->getBotUsername($botToken)) {
            $response = "Привет, {$firstName}! 👋\n\nЯ бот для администрирования сайта.\n\nДоступные команды:\n/help - помощь";
            $this->sendMessage($botToken, $chatId, $response);
        } elseif ($text === '/help' || strpos($text, '/help') === 0) {
            $response = "Доступные команды:\n\n/start - начать работу\n/help - показать эту справку\n/status - статус бота";
            $this->sendMessage($botToken, $chatId, $response);
        } elseif ($text === '/status') {
            $response = "✅ Бот работает корректно!\n\nВремя сервера: " . date('Y-m-d H:i:s');
            $this->sendMessage($botToken, $chatId, $response);
        } else {
            // Ответ на любое другое сообщение
            $response = "Я получил ваше сообщение: {$text}\n\nИспользуйте /help для списка команд.";
            $this->sendMessage($botToken, $chatId, $response);
        }
    }
    
    /**
     * Обработка callback query (нажатия на кнопки)
     */
    protected function handleCallbackQuery($callbackQuery, $botToken)
    {
        $chatId = $callbackQuery['message']['chat']['id'];
        $data = $callbackQuery['data'];
        $queryId = $callbackQuery['id'];
        
        // Отвечаем на callback
        $this->answerCallbackQuery($botToken, $queryId);
        
        // Обрабатываем данные
        if ($data === 'test') {
            $this->sendMessage($botToken, $chatId, "Тестовая кнопка работает!");
        }
    }
    
    /**
     * Отправка сообщения в Telegram
     */
    protected function sendMessage($botToken, $chatId, $text, $replyMarkup = null)
    {
        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'HTML'
        ];
        
        if ($replyMarkup) {
            $data['reply_markup'] = json_encode($replyMarkup);
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($response, true);
    }
    
    /**
     * Ответ на callback query
     */
    protected function answerCallbackQuery($botToken, $queryId, $text = '')
    {
        $url = "https://api.telegram.org/bot{$botToken}/answerCallbackQuery";
        $data = [
            'callback_query_id' => $queryId,
            'text' => $text
        ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        curl_exec($ch);
        curl_close($ch);
    }
    
    /**
     * Получение username бота
     */
    protected function getBotUsername($botToken)
    {
        $botSettings = $this->sql->query("SELECT `bot_username` FROM `telegram_bot` LIMIT 1", 'assoc');
        return $botSettings['bot_username'] ?? '';
    }
    
    /**
     * Логирование сообщений
     */
    protected function logMessage($message)
    {
        $chatId = $message['chat']['id'] ?? 0;
        $text = $message['text'] ?? '';
        $userId = $message['from']['id'] ?? 0;
        $username = $message['from']['username'] ?? '';
        $firstName = $message['from']['first_name'] ?? '';
        
        $logData = [
            'chat_id' => $chatId,
            'user_id' => $userId,
            'username' => $username,
            'first_name' => $firstName,
            'text' => $text,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
        // Сохраняем в БД, если есть таблица
        try {
            $this->sql->query("INSERT INTO `telegram_logs` 
                (`chat_id`, `user_id`, `username`, `first_name`, `text`, `created_at`) 
                VALUES ({$chatId}, {$userId}, '{$username}', '{$firstName}', '" . addslashes($text) . "', NOW())");
        } catch (\Exception $e) {
            // Игнорируем ошибки логирования
        }
    }
}
