<?php if ($this->admin): ?>
<div class="admin-container">
    <div class="admin-sidebar">
        <div class="admin-logo">
            <h2>Админ Панель</h2>
        </div>
        <nav class="admin-menu">
            <ul>
                <li><a href="/admin" class="<?= (empty($this->urlArray) || (!isset($this->urlArray[0]) && !isset($this->urlArray[1]))) ? '' : '' ?>">
                    <i class="fa fa-dashboard"></i> Главная
                </a></li>
                <li><a href="/admin/telegram" class="<?= (isset($this->urlArray[0]) && $this->urlArray[0] == 'telegram') ? 'active' : '' ?>">
                    <i class="fa fa-telegram"></i> Telegram Бот
                </a></li>
                <li><a href="/admin/settings" class="<?= (isset($this->urlArray[0]) && $this->urlArray[0] == 'settings') ? 'active' : '' ?>">
                    <i class="fa fa-cog"></i> Настройки
                </a></li>
                <li><a href="/admin/logout">
                    <i class="fa fa-sign-out"></i> Выход
                </a></li>
            </ul>
        </nav>
    </div>
    <div class="admin-content">
        <div class="admin-header">
            <h1>Управление Telegram Ботом</h1>
        </div>
        <div class="admin-main">
            <div class="telegram-form">
                <h2>Настройка Telegram Бота</h2>
                <form id="telegram-bot-form">
                    <div class="form-group">
                        <label for="bot_token">Token бота:</label>
                        <input type="text" id="bot_token" name="bot_token" 
                               value="<?= htmlspecialchars($this->telegram_bot['bot_token'] ?? '') ?>" 
                               placeholder="Введите токен бота от @BotFather">
                        <small>Получите токен у @BotFather в Telegram</small>
                    </div>
                    <div class="form-group">
                        <label for="bot_username">Username бота:</label>
                        <input type="text" id="bot_username" name="bot_username" 
                               value="<?= htmlspecialchars($this->telegram_bot['bot_username'] ?? '') ?>" 
                               placeholder="Например: my_bot">
                    </div>
                    <div class="form-group">
                        <label for="webhook_url">Webhook URL:</label>
                        <input type="text" id="webhook_url" name="webhook_url" 
                               value="<?= htmlspecialchars($this->telegram_bot['webhook_url'] ?? SITE . '/admin/telegram/webhook') ?>" 
                               readonly>
                        <small>URL для получения обновлений от Telegram</small>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="auto_webhook" name="auto_webhook" checked>
                            Автоматически зарегистрировать webhook при сохранении
                        </label>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Сохранить и зарегистрировать Webhook
                        </button>
                        <button type="button" id="test-bot" class="btn btn-secondary">
                            <i class="fa fa-paper-plane"></i> Тест бота
                        </button>
                    </div>
                </form>
                <div id="telegram-status" class="status-message"></div>
            </div>
            <div class="telegram-info">
                <h3>Инструкция по настройке:</h3>
                <ol>
                    <li>Создайте бота через <a href="https://t.me/BotFather" target="_blank">@BotFather</a> в Telegram</li>
                    <li>Получите токен бота от @BotFather</li>
                    <li>Введите токен в форму выше</li>
                    <li>Нажмите "Сохранить и зарегистрировать Webhook"</li>
                    <li>Webhook будет автоматически зарегистрирован</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
    <?php include 'authorization.php'; ?>
<?php endif; ?>
