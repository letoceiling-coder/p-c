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

// Если входные данные пустые, это может быть проверка от Telegram
if (empty($input)) {
    echo json_encode(array('ok' => true));
    exit;
}

$update = json_decode($input, true);

// Проверяем JSON только если есть входные данные
if ($update === null && json_last_error() !== JSON_ERROR_NONE) {
    // Логируем ошибку
    error_log('Telegram webhook: Invalid JSON - ' . json_last_error_msg() . ' | Input: ' . substr($input, 0, 200));
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

// Логирование (минимальное)
$logFile = dirname(__DIR__) . '/log/telegram_webhook.log';
$logDir = dirname($logFile);
if (!is_dir($logDir)) {
    @mkdir($logDir, 0755, true);
}

$logData = array(
    'timestamp' => date('Y-m-d H:i:s'),
    'update_id' => isset($update['update_id']) ? $update['update_id'] : 'unknown',
    'message_id' => isset($update['message']['message_id']) ? $update['message']['message_id'] : 'none'
);
$logLine = date('Y-m-d H:i:s') . ' | update_id=' . $logData['update_id'] . ' | message_id=' . $logData['message_id'];
if (isset($update['message']['text'])) {
    $logLine .= ' | text=' . substr($update['message']['text'], 0, 50);
}
if (isset($update['message']['chat']['id'])) {
    $logLine .= ' | chat_id=' . $update['message']['chat']['id'];
}
$logLine .= PHP_EOL;
@file_put_contents($logFile, $logLine, FILE_APPEND);

// Обработка команды /start
if (isset($update['message']['text']) && trim($update['message']['text']) == '/start') {
    require_once dirname(__DIR__) . '/includes/TelegramClient.php';
    
    $client = new TelegramClient($config['token']);
    $chatId = $update['message']['chat']['id'];
    $firstName = isset($update['message']['from']['first_name']) 
        ? $update['message']['from']['first_name'] 
        : 'Пользователь';
    
    $welcomeMessage = "👋 Привет, <b>{$firstName}</b>!\n\n";
    $welcomeMessage .= "Я бот для получения заявок с сайта proffi-center.ru\n";
    $welcomeMessage .= "Все заявки с форм будут приходить сюда автоматически.";
    
    $result = $client->sendMessage($chatId, $welcomeMessage);
    
    // Логируем результат отправки
    $logLine = date('Y-m-d H:i:s') . ' | /start processed | chat_id=' . $chatId . ' | result=' . (isset($result['ok']) && $result['ok'] ? 'OK' : 'FAIL') . PHP_EOL;
    @file_put_contents($logFile, $logLine, FILE_APPEND);
}

// Отвечаем успешно
echo json_encode(array('ok' => true));
