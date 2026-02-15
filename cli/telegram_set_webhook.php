<?php
/**
 * CLI скрипт для установки Telegram webhook
 * PHP 5.6 compatible
 * 
 * Использование:
 * php cli/telegram_set_webhook.php [webhook_url]
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

// URL webhook из аргумента или по умолчанию
$webhookUrl = isset($argv[1]) ? $argv[1] : 'https://proffi-center.ru/telegram/webhook.php';

require_once __DIR__ . '/../includes/TelegramClient.php';

$client = new TelegramClient($config['token']);

echo "Setting webhook to: {$webhookUrl}\n";

$secretToken = isset($config['secret']) && !empty($config['secret']) ? $config['secret'] : null;
if ($secretToken) {
    echo "Using secret token for webhook security\n";
} else {
    echo "WARNING: No secret token configured. Webhook is not protected!\n";
}
$result = $client->setWebhook($webhookUrl, $secretToken);

if (isset($result['ok']) && $result['ok']) {
    echo "✓ Webhook set successfully\n";
    if (isset($result['description'])) {
        echo "Description: " . $result['description'] . "\n";
    }
} else {
    echo "✗ Error setting webhook\n";
    if (isset($result['description'])) {
        echo "Error: " . $result['description'] . "\n";
    }
    exit(1);
}

// Проверяем информацию о webhook
echo "\nChecking webhook info...\n";
$info = $client->getWebhookInfo();

if (isset($info['ok']) && $info['ok']) {
    $wh = $info['result'];
    echo "URL: " . (isset($wh['url']) ? $wh['url'] : 'not set') . "\n";
    echo "Pending updates: " . (isset($wh['pending_update_count']) ? $wh['pending_update_count'] : 0) . "\n";
    if (isset($wh['last_error_date'])) {
        echo "⚠ Last error date: " . date('Y-m-d H:i:s', $wh['last_error_date']) . "\n";
        echo "Last error message: " . (isset($wh['last_error_message']) ? $wh['last_error_message'] : 'unknown') . "\n";
    } else {
        echo "✓ No errors\n";
    }
}
