<?php
/**
 * Telegram Webhook Endpoint
 * PHP 5.6 compatible
 */
define('VG_ACCESS', true);

// Быстрый ответ Telegram
http_response_code(200);
header('Content-Type: application/json');

// Читаем входные данные
$input = file_get_contents('php://input');
$update = json_decode($input, true);

if (!$update) {
    echo json_encode(array('ok' => false, 'error' => 'Invalid JSON'));
    exit;
}

// Загружаем конфигурацию
$secretsFile = $_SERVER['HOME'] . '/_secrets/proffi-center/telegram.php';
if (!file_exists($secretsFile)) {
    echo json_encode(array('ok' => false, 'error' => 'Config not found'));
    exit;
}

$config = include $secretsFile;

// Проверка секрета (если установлен)
$secretToken = isset($_SERVER['HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN']) 
    ? $_SERVER['HTTP_X_TELEGRAM_BOT_API_SECRET_TOKEN'] 
    : (isset($_GET['secret']) ? $_GET['secret'] : null);

if (isset($config['secret']) && !empty($config['secret'])) {
    if ($secretToken !== $config['secret']) {
        http_response_code(403);
        echo json_encode(array('ok' => false, 'error' => 'Invalid secret'));
        exit;
    }
}

// Логирование (минимальное)
$logFile = __DIR__ . '/../log/telegram_webhook.log';
$logDir = dirname($logFile);
if (!is_dir($logDir)) {
    @mkdir($logDir, 0755, true);
}

$logData = array(
    'timestamp' => date('Y-m-d H:i:s'),
    'update_id' => isset($update['update_id']) ? $update['update_id'] : 'unknown',
    'message_id' => isset($update['message']['message_id']) ? $update['message']['message_id'] : 'none'
);
$logLine = date('Y-m-d H:i:s') . ' | update_id=' . $logData['update_id'] . ' | message_id=' . $logData['message_id'] . PHP_EOL;
@file_put_contents($logFile, $logLine, FILE_APPEND);

// Обработка команды /start
if (isset($update['message']['text']) && $update['message']['text'] == '/start') {
    require_once __DIR__ . '/../includes/TelegramClient.php';
    
    $client = new TelegramClient($config['token']);
    $chatId = $update['message']['chat']['id'];
    $firstName = isset($update['message']['from']['first_name']) 
        ? $update['message']['from']['first_name'] 
        : 'Пользователь';
    
    $welcomeMessage = "👋 Привет, <b>{$firstName}</b>!\n\n";
    $welcomeMessage .= "Я бот для получения заявок с сайта proffi-center.ru\n";
    $welcomeMessage .= "Все заявки с форм будут приходить сюда автоматически.";
    
    $client->sendMessage($chatId, $welcomeMessage);
}

// Отвечаем успешно
echo json_encode(array('ok' => true));
