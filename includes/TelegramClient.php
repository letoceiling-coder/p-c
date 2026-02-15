<?php
/**
 * Telegram Bot API Client (PHP 5.6 compatible)
 * Без зависимостей, использует только cURL
 */
class TelegramClient
{
    private $token;
    private $apiUrl = 'https://api.telegram.org/bot';
    private $logFile;
    
    public function __construct($token, $logFile = null)
    {
        $this->token = $token;
        $this->logFile = $logFile ? $logFile : __DIR__ . '/../log/telegram.log';
    }
    
    /**
     * Выполнить запрос к Telegram API
     */
    public function request($method, array $params = array())
    {
        $url = $this->apiUrl . $this->token . '/' . $method;
        
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 12,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            )
        ));
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        // Логирование (без токена)
        $this->log($method, $httpCode, $error, $params);
        
        if ($error) {
            return array('ok' => false, 'error' => $error);
        }
        
        $data = json_decode($response, true);
        if (!$data) {
            return array('ok' => false, 'error' => 'Invalid JSON response');
        }
        
        return $data;
    }
    
    /**
     * Отправить сообщение
     */
    public function sendMessage($chatId, $text, $opts = array())
    {
        $params = array_merge(array(
            'chat_id' => $chatId,
            'text' => $text,
            'parse_mode' => 'HTML'
        ), $opts);
        
        return $this->request('sendMessage', $params);
    }
    
    /**
     * Установить webhook
     */
    public function setWebhook($url, $secretToken = null)
    {
        $params = array('url' => $url);
        if ($secretToken) {
            $params['secret_token'] = $secretToken;
        }
        
        return $this->request('setWebhook', $params);
    }
    
    /**
     * Получить информацию о webhook
     */
    public function getWebhookInfo()
    {
        return $this->request('getWebhookInfo');
    }
    
    /**
     * Логирование (без токена)
     */
    private function log($method, $httpCode, $error, $params = array())
    {
        $logDir = dirname($this->logFile);
        if (!is_dir($logDir)) {
            @mkdir($logDir, 0755, true);
        }
        
        $logData = array(
            'timestamp' => date('Y-m-d H:i:s'),
            'method' => $method,
            'http_code' => $httpCode,
            'error' => $error ? $error : 'none'
        );
        
        // Логируем параметры, но без токена
        $safeParams = $params;
        if (isset($safeParams['chat_id'])) {
            $safeParams['chat_id'] = '***';
        }
        $logData['params'] = $safeParams;
        
        $logLine = date('Y-m-d H:i:s') . ' | ' . $method . ' | HTTP ' . $httpCode;
        if ($error) {
            $logLine .= ' | ERROR: ' . $error;
        }
        $logLine .= PHP_EOL;
        
        @file_put_contents($this->logFile, $logLine, FILE_APPEND);
    }
}
