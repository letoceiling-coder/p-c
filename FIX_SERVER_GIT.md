# Исправление ошибки "dubious ownership" на сервере

## Проблема
Git выдает ошибку: `fatal: detected dubious ownership in repository`

## Решение

Выполните эти команды на сервере:

```bash
# 1. Добавить директорию в безопасные
git config --global --add safe.directory /home/d/dsc23ytp/proffi-center.ru/public_html

# 2. Теперь повторите команды:
cd ~/proffi-center.ru/public_html

# 3. Настроить удаленный репозиторий
git remote add origin https://github.com/letoceiling-coder/p-c.git

# 4. Получить код с GitHub
git fetch origin

# 5. Переключиться на ветку main и получить код
git checkout -b main origin/main
git pull origin main
```

## Полная последовательность команд:

```bash
# Исправить проблему с правами
git config --global --add safe.directory /home/d/dsc23ytp/proffi-center.ru/public_html

# Настроить Git
cd ~/proffi-center.ru/public_html
git remote add origin https://github.com/letoceiling-coder/p-c.git
git fetch origin
git checkout -b main origin/main
git pull origin main
```

## Если все еще есть проблемы:

```bash
# Проверить владельца директории
ls -la ~/proffi-center.ru/public_html | head -5

# Если нужно, изменить владельца (осторожно!)
# chown -R dsc23ytp:dsc23ytp ~/proffi-center.ru/public_html
```
