<?php
/**
 * Telegram Webhook Endpoint
 * PHP 5.6 compatible
 */
define('VG_ACCESS', true);

// Быстрый ответ Telegram
http_response_code(200);
header('Content-Type: application/json');

// Инициализируем логирование СРАЗУ
$logFile = dirname(__DIR__) . '/log/telegram_webhook.log';
$logDir = dirname($logFile);
if (!is_dir($logDir)) {
    @mkdir($logDir, 0755, true);
}

// Читаем входные данные
$input = file_get_contents('php://input');

// Логируем ВСЕ запросы (для отладки)
@file_put_contents($logFile, date('Y-m-d H:i:s') . ' | REQUEST | input_length=' . strlen($input) . ' | method=' . $_SERVER['REQUEST_METHOD'] . PHP_EOL, FILE_APPEND);

// Если входные данные пустые, это может быть проверка от Telegram
if (empty($input)) {
    @file_put_contents($logFile, date('Y-m-d H:i:s') . ' | EMPTY INPUT - returning OK' . PHP_EOL, FILE_APPEND);
    echo json_encode(array('ok' => true));
    exit;
}

$update = json_decode($input, true);

// Проверяем JSON только если есть входные данные
if ($update === null && json_last_error() !== JSON_ERROR_NONE) {
    // Логируем ошибку
    $errorMsg = 'Invalid JSON - ' . json_last_error_msg() . ' | Input: ' . substr($input, 0, 200);
    error_log('Telegram webhook: ' . $errorMsg);
    @file_put_contents($logFile, date('Y-m-d H:i:s') . ' | ERROR: ' . $errorMsg . PHP_EOL, FILE_APPEND);
    echo json_encode(array('ok' => false, 'error' => 'Invalid JSON'));
    exit;
}

// Логируем успешный парсинг JSON
@file_put_contents($logFile, date('Y-m-d H:i:s') . ' | JSON PARSED | update_id=' . (isset($update['update_id']) ? $update['update_id'] : 'none') . PHP_EOL, FILE_APPEND);

// Детальное логирование структуры update
if (isset($update['message'])) {
    @file_put_contents($logFile, date('Y-m-d H:i:s') . ' | UPDATE HAS MESSAGE | message_id=' . (isset($update['message']['message_id']) ? $update['message']['message_id'] : 'none') . PHP_EOL, FILE_APPEND);
    if (isset($update['message']['text'])) {
        @file_put_contents($logFile, date('Y-m-d H:i:s') . ' | MESSAGE HAS TEXT: ' . $update['message']['text'] . PHP_EOL, FILE_APPEND);
    } else {
        @file_put_contents($logFile, date('Y-m-d H:i:s') . ' | MESSAGE HAS NO TEXT FIELD' . PHP_EOL, FILE_APPEND);
    }
} else {
    @file_put_contents($logFile, date('Y-m-d H:i:s') . ' | UPDATE HAS NO MESSAGE FIELD' . PHP_EOL, FILE_APPEND);
}

// Загружаем конфигурацию
$secretsFile = $_SERVER['HOME'] . '/_secrets/proffi-center/telegram.php';
if (!file_exists($secretsFile)) {
    echo json_encode(array('ok' => false, 'error' => 'Config not found'));
    exit;
}

$config = include $secretsFile;

// Проверка секрета (если установлен)
// Telegram отправляет secret в заголовке X-Telegram-Bot-Api-Secret-Token
$secretToken = isset($_SERVER['HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN']) 
    ? $_SERVER['HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN'] 
    : (isset($_GET['secret']) ? $_GET['secret'] : null);

// Проверяем secret только если он установлен в конфиге И пришел в запросе
if (isset($config['secret']) && !empty($config['secret'])) {
    // Если secret не пришел, но установлен в конфиге - это ошибка
    if (empty($secretToken)) {
        // Логируем, но не блокируем (на случай если secret не установлен в webhook)
        error_log('Telegram webhook: secret expected but not received');
    } elseif ($secretToken !== $config['secret']) {
        http_response_code(403);
        echo json_encode(array('ok' => false, 'error' => 'Invalid secret'));
        exit;
    }
}

// Логирование деталей сообщения
$logData = array(
    'timestamp' => date('Y-m-d H:i:s'),
    'update_id' => isset($update['update_id']) ? $update['update_id'] : 'unknown',
    'message_id' => isset($update['message']['message_id']) ? $update['message']['message_id'] : 'none'
);
$logLine = date('Y-m-d H:i:s') . ' | UPDATE | update_id=' . $logData['update_id'] . ' | message_id=' . $logData['message_id'];
if (isset($update['message']['text'])) {
    $logLine .= ' | text=' . substr($update['message']['text'], 0, 50);
}
if (isset($update['message']['chat']['id'])) {
    $logLine .= ' | chat_id=' . $update['message']['chat']['id'];
}
if (isset($update['message']['from']['id'])) {
    $logLine .= ' | user_id=' . $update['message']['from']['id'];
}
$logLine .= PHP_EOL;
@file_put_contents($logFile, $logLine, FILE_APPEND);

// Обработка команды /start
// Логируем текст сообщения для отладки
if (isset($update['message']['text'])) {
    @file_put_contents($logFile, date('Y-m-d H:i:s') . ' | MESSAGE TEXT: ' . $update['message']['text'] . ' | trimmed: ' . trim($update['message']['text']) . PHP_EOL, FILE_APPEND);
}

if (isset($update['message']['text']) && trim($update['message']['text']) == '/start') {
    @file_put_contents($logFile, date('Y-m-d H:i:s') . ' | /start COMMAND DETECTED' . PHP_EOL, FILE_APPEND);
    
    try {
        $clientPath = dirname(__DIR__) . '/includes/TelegramClient.php';
        if (!file_exists($clientPath)) {
            $errorMsg = 'TelegramClient.php not found at: ' . $clientPath;
            error_log('Telegram webhook: ' . $errorMsg);
            @file_put_contents($logFile, date('Y-m-d H:i:s') . ' | ERROR: ' . $errorMsg . PHP_EOL, FILE_APPEND);
        } else {
            require_once $clientPath;
            
            // Подключаем конфиг для БД
            require_once dirname(__DIR__) . '/config/config.php';
            require_once dirname(__DIR__) . '/classed/Db.php';
            
            $client = new TelegramClient($config['token']);
            $chatId = $update['message']['chat']['id'];
            $userId = isset($update['message']['from']['id']) ? $update['message']['from']['id'] : 0;
            $firstName = isset($update['message']['from']['first_name']) 
                ? $update['message']['from']['first_name'] 
                : 'Пользователь';
            $lastName = isset($update['message']['from']['last_name']) 
                ? $update['message']['from']['last_name'] 
                : '';
            $username = isset($update['message']['from']['username']) 
                ? $update['message']['from']['username'] 
                : '';
            
            // Сохраняем chat_id в конфиг файл
            if (empty($config['chat_id']) || $config['chat_id'] != $chatId) {
                $config['chat_id'] = $chatId;
                $configContent = "<?php\nreturn array(\n";
                $configContent .= "    'token' => '" . addslashes($config['token']) . "',\n";
                $configContent .= "    'chat_id' => '" . addslashes($chatId) . "',\n";
                $configContent .= "    'secret' => '" . addslashes($config['secret']) . "',\n";
                $configContent .= "    'parse_mode' => 'HTML',\n";
                $configContent .= ");\n";
                @file_put_contents($secretsFile, $configContent);
                @file_put_contents($logFile, date('Y-m-d H:i:s') . ' | chat_id saved to config: ' . $chatId . PHP_EOL, FILE_APPEND);
            }
            
            // Сохраняем пользователя в БД
            try {
                $db = new \classed\Db();
                $chatIdEscaped = $db->sql->real_escape_string($chatId);
                $userIdEscaped = $db->sql->real_escape_string($userId);
                $firstNameEscaped = $db->sql->real_escape_string($firstName);
                $usernameEscaped = $db->sql->real_escape_string($username);
                
                // Проверяем существует ли таблица telegram_logs
                $tableCheck = $db->query("SHOW TABLES LIKE 'telegram_logs'");
                if ($tableCheck) {
                    // Сохраняем в telegram_logs (используем INSERT ... ON DUPLICATE KEY UPDATE)
                    // Но сначала проверяем есть ли запись с таким chat_id
                    $checkQuery = "SELECT id FROM telegram_logs WHERE chat_id = '{$chatIdEscaped}' LIMIT 1";
                    $existing = $db->query($checkQuery, 'assoc');
                    
                    if ($existing) {
                        // Обновляем существующую запись
                        $updateQuery = "UPDATE telegram_logs SET 
                                        user_id = '{$userIdEscaped}',
                                        username = '{$usernameEscaped}',
                                        first_name = '{$firstNameEscaped}',
                                        text = '/start',
                                        created_at = NOW()
                                        WHERE chat_id = '{$chatIdEscaped}'";
                        $db->query($updateQuery);
                        @file_put_contents($logFile, date('Y-m-d H:i:s') . ' | User updated in DB: chat_id=' . $chatId . ', user_id=' . $userId . PHP_EOL, FILE_APPEND);
                    } else {
                        // Вставляем новую запись
                        $insertQuery = "INSERT INTO telegram_logs (chat_id, user_id, username, first_name, text, created_at) 
                                        VALUES ('{$chatIdEscaped}', '{$userIdEscaped}', '{$usernameEscaped}', '{$firstNameEscaped}', '/start', NOW())";
                        $db->query($insertQuery);
                        @file_put_contents($logFile, date('Y-m-d H:i:s') . ' | User saved to DB: chat_id=' . $chatId . ', user_id=' . $userId . PHP_EOL, FILE_APPEND);
                    }
                } else {
                    // Создаем таблицу если не существует
                    $createTable = "CREATE TABLE IF NOT EXISTS telegram_logs (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        chat_id BIGINT(20) NOT NULL,
                        user_id BIGINT(20) DEFAULT NULL,
                        username VARCHAR(100) DEFAULT NULL,
                        first_name VARCHAR(100) DEFAULT NULL,
                        text TEXT,
                        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                        KEY chat_id (chat_id),
                        KEY created_at (created_at)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
                    $db->query($createTable);
                    // Повторяем вставку
                    $insertQuery = "INSERT INTO telegram_logs (chat_id, user_id, username, first_name, text, created_at) 
                                    VALUES ('{$chatIdEscaped}', '{$userIdEscaped}', '{$usernameEscaped}', '{$firstNameEscaped}', '/start', NOW())";
                    $db->query($insertQuery);
                    @file_put_contents($logFile, date('Y-m-d H:i:s') . ' | Table created and user saved to DB' . PHP_EOL, FILE_APPEND);
                }
            } catch (Exception $dbEx) {
                @file_put_contents($logFile, date('Y-m-d H:i:s') . ' | DB ERROR: ' . $dbEx->getMessage() . PHP_EOL, FILE_APPEND);
            }
            
            // Отправляем приветственное сообщение
            $welcomeMessage = "👋 Привет, <b>{$firstName}</b>!\n\n";
            $welcomeMessage .= "Я бот для получения заявок с сайта proffi-center.ru\n";
            $welcomeMessage .= "Все заявки с форм будут приходить сюда автоматически.";
            
            $result = $client->sendMessage($chatId, $welcomeMessage);
            
            // Логируем результат отправки
            $logLine = date('Y-m-d H:i:s') . ' | /start processed | chat_id=' . $chatId . ' | result=' . (isset($result['ok']) && $result['ok'] ? 'OK' : 'FAIL');
            if (isset($result['error_code'])) {
                $logLine .= ' | error=' . $result['error_code'];
            }
            if (isset($result['description'])) {
                $logLine .= ' | desc=' . substr($result['description'], 0, 50);
            }
            $logLine .= PHP_EOL;
            @file_put_contents($logFile, $logLine, FILE_APPEND);
        }
    } catch (Exception $e) {
        error_log('Telegram webhook: Exception in /start handler: ' . $e->getMessage());
        $logLine = date('Y-m-d H:i:s') . ' | /start ERROR: ' . $e->getMessage() . PHP_EOL;
        @file_put_contents($logFile, $logLine, FILE_APPEND);
    } catch (Error $e) {
        error_log('Telegram webhook: Error in /start handler: ' . $e->getMessage());
        $logLine = date('Y-m-d H:i:s') . ' | /start ERROR: ' . $e->getMessage() . PHP_EOL;
        @file_put_contents($logFile, $logLine, FILE_APPEND);
    }
}

// Отвечаем успешно
echo json_encode(array('ok' => true));
