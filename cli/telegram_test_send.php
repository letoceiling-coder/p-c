<?php
/**
 * CLI скрипт для тестовой отправки сообщения в Telegram
 * PHP 5.6 compatible
 */
define('VG_ACCESS', true);

if (php_sapi_name() !== 'cli') {
    die('This script can only be run from command line');
}

$secretsFile = $_SERVER['HOME'] . '/_secrets/proffi-center/telegram.php';
if (!file_exists($secretsFile)) {
    die("ERROR: Secrets file not found: {$secretsFile}\n");
}

$config = include $secretsFile;

if (empty($config['token'])) {
    die("ERROR: Token not found in config\n");
}

require_once __DIR__ . '/../includes/TelegramNotifier.php';

$notifier = new TelegramNotifier();

$testLead = array(
    'name' => 'Тестовый пользователь',
    'phone' => '+79991234567',
    'email' => 'test@example.com',
    'message' => 'Это тестовое сообщение для проверки работы Telegram бота',
    'service' => 'Тестовая услуга'
);

$testMeta = array(
    'host' => 'proffi-center.ru',
    'url' => 'https://proffi-center.ru/test',
    'datetime' => date('Y-m-d H:i:s')
);

echo "Sending test message...\n";

$result = $notifier->sendLead($testLead, $testMeta);

if ($result) {
    echo "✓ Test message sent successfully\n";
} else {
    echo "✗ Failed to send test message\n";
    exit(1);
}
