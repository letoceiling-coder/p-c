# Инструкция по настройке Telegram Bot на сервере

## ШАГ 0: Безопасность

⚠️ **ВАЖНО**: Токены и секреты НИКОГДА не должны попадать в git!

1. Если был старый токен - отзовите его в @BotFather
2. Создайте новый бот через @BotFather и получите новый токен

## ШАГ 1: Создание файла секретов на сервере

```bash
# На сервере по SSH:
mkdir -p ~/_secrets/proffi-center
chmod 700 ~/_secrets/proffi-center

# Создайте файл конфигурации:
nano ~/_secrets/proffi-center/telegram.php
```

Содержимое файла `telegram.php`:
```php
<?php
return array(
    'token' => 'ВАШ_ТОКЕН_ОТ_BOTFATHER',
    'chat_id' => 'ВАШ_CHAT_ID',  // или 'id1,id2' для нескольких
    'secret' => 'ДЛИННЫЙ_СЛУЧАЙНЫЙ_СЕКРЕТ',
    'parse_mode' => 'HTML',
);
```

Установите права:
```bash
chmod 600 ~/_secrets/proffi-center/telegram.php
```

## ШАГ 2: Получение Chat ID

1. Найдите бота в Telegram: @your_bot_name
2. Отправьте команду `/start`
3. Откройте в браузере: `https://api.telegram.org/botВАШ_ТОКЕН/getUpdates`
4. Найдите `"chat":{"id":123456789}` - это ваш chat_id

## ШАГ 3: Установка webhook

```bash
cd ~/proffi-center.ru/public_html
php cli/telegram_set_webhook.php https://proffi-center.ru/telegram/webhook.php
```

Проверка:
```bash
php cli/telegram_set_webhook.php
# Должен показать информацию о webhook без ошибок
```

## ШАГ 4: Тестовая отправка

```bash
php cli/telegram_test_send.php
```

Должно прийти тестовое сообщение в Telegram.

## ШАГ 5: Проверка работы

1. Откройте форму на сайте
2. Заполните и отправьте
3. Проверьте, что сообщение пришло в Telegram

## ШАГ 6: Логи

Логи находятся в:
- `log/telegram.log` - логи отправки сообщений
- `log/telegram_webhook.log` - логи webhook

Просмотр:
```bash
tail -f log/telegram.log
tail -f log/telegram_webhook.log
```

## ШАГ 7: Отключение Telegram

Если нужно временно отключить:
```bash
# Переименуйте или удалите файл секретов:
mv ~/_secrets/proffi-center/telegram.php ~/_secrets/proffi-center/telegram.php.disabled
```

## Интегрированные формы

Telegram уведомления отправляются из:
1. `ajax/Ajax.php` - обработчик `$_POST["sub"] == 'getAjax'`
2. `classed/AjaxController.php` - метод `getAjax()`
3. `classed/AjaxController.php` - метод обработки монтажа

## Команды бота

- `/start` - приветствие с именем пользователя

## Структура файлов

```
~/proffi-center.ru/public_html/
├── includes/
│   ├── TelegramClient.php      # API клиент
│   └── TelegramNotifier.php    # Отправка уведомлений
├── telegram/
│   └── webhook.php             # Webhook endpoint
├── cli/
│   ├── telegram_set_webhook.php    # Установка webhook
│   └── telegram_test_send.php     # Тестовая отправка
└── log/
    ├── telegram.log            # Логи отправки
    └── telegram_webhook.log   # Логи webhook

~/_secrets/proffi-center/
└── telegram.php                # Секреты (НЕ в git!)
```

## Безопасность

✅ Секреты хранятся вне репозитория  
✅ Токены не логируются  
✅ Webhook защищен secret token  
✅ Ошибки Telegram не ломают формы  
