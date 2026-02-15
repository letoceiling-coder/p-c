# Быстрая настройка Git на сервере BeGet

## Выполните эти команды на сервере (SSH):

```bash
# 1. Подключиться к серверу
ssh dsc23ytp@dragon.beget.ru

# 2. Перейти в директорию проекта
cd ~/proffi-center.ru/public_html

# 3. Проверить Git
git --version

# 4. Инициализировать Git (если еще не инициализирован)
git init

# 5. Настроить удаленный репозиторий
git remote add origin https://github.com/letoceiling-coder/p-c.git
# Или обновить, если уже есть:
# git remote set-url origin https://github.com/letoceiling-coder/p-c.git

# 6. Проверить настройки
git remote -v

# 7. Получить код с GitHub
git fetch origin

# 8. Переключиться на ветку main
git checkout -b main origin/main
# Или если ветка называется master:
# git checkout -b master origin/master

# 9. Если нужно, обновить код
git pull origin main
```

## Автоматическая настройка (скрипт):

```bash
# 1. Загрузить скрипт на сервер
# С вашего Windows компьютера:
scp C:\OSPanel\domains\p-c\server_setup.sh dsc23ytp@dragon.beget.ru:~/server_setup.sh

# 2. На сервере выполнить:
ssh dsc23ytp@dragon.beget.ru
bash ~/server_setup.sh
```

## Или выполните команды вручную:

```bash
ssh dsc23ytp@dragon.beget.ru
cd ~/proffi-center.ru/public_html
git init
git remote add origin https://github.com/letoceiling-coder/p-c.git
git fetch origin
git checkout -b main origin/main
git pull origin main
```

## Для обновления проекта на сервере:

```bash
cd ~/proffi-center.ru/public_html
git pull origin main
```

## Если нужна аутентификация GitHub:

1. Создайте Personal Access Token на GitHub:
   - Settings → Developer settings → Personal access tokens → Tokens (classic)
   - Создайте токен с правами `repo`

2. При первом push/pull используйте токен вместо пароля:
   ```bash
   git pull origin main
   # Username: letoceiling-coder
   # Password: ваш_токен
   ```

3. Или настройте SSH ключ для GitHub (рекомендуется)

---

**Полная инструкция:** см. файл `DEPLOY_TO_SERVER.md`
