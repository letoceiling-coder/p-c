# Инструкция: Отправка кода на GitHub с сервера

## Проблема
Git не может запросить имя пользователя и пароль в неинтерактивном режиме SSH.

## Решение 1: Использовать Personal Access Token в URL (Рекомендуется)

### Шаг 1: Создать Personal Access Token на GitHub

1. Перейдите на GitHub: https://github.com/settings/tokens
2. Нажмите "Generate new token (classic)"
3. Выберите права: `repo` (полный доступ к репозиториям)
4. Скопируйте токен (он показывается только один раз!)

### Шаг 2: Обновить URL удаленного репозитория на сервере

Выполните на сервере:

```bash
cd ~/proffi-center.ru/public_html

# Замените YOUR_TOKEN на ваш токен
git remote set-url origin https://YOUR_TOKEN@github.com/letoceiling-coder/p-c.git

# Или с именем пользователя (рекомендуется)
git remote set-url origin https://letoceiling-coder:YOUR_TOKEN@github.com/letoceiling-coder/p-c.git

# Проверить
git remote -v

# Отправить код
git push -u origin main
```

## Решение 2: Настроить SSH ключ для GitHub

### Шаг 1: Создать SSH ключ на сервере

```bash
ssh-keygen -t ed25519 -C "your_email@example.com"
# Нажмите Enter для всех вопросов (или укажите путь)

# Показать публичный ключ
cat ~/.ssh/id_ed25519.pub
```

### Шаг 2: Добавить ключ на GitHub

1. Скопируйте публичный ключ (вывод команды выше)
2. Перейдите на GitHub: https://github.com/settings/keys
3. Нажмите "New SSH key"
4. Вставьте ключ и сохраните

### Шаг 3: Изменить URL на SSH

```bash
cd ~/proffi-center.ru/public_html
git remote set-url origin git@github.com:letoceiling-coder/p-c.git
git push -u origin main
```

## Решение 3: Использовать credential helper

```bash
cd ~/proffi-center.ru/public_html

# Настроить credential helper
git config --global credential.helper store

# При следующем push введите токен как пароль
git push -u origin main
# Username: letoceiling-coder
# Password: ваш_токен
```

## Быстрая команда (с токеном в URL)

```bash
cd ~/proffi-center.ru/public_html
git remote set-url origin https://letoceiling-coder:ВАШ_ТОКЕН@github.com/letoceiling-coder/p-c.git
git push -u origin main
```

---

**Важно:** После успешной отправки, для обновления проекта на сервере используйте:
```bash
cd ~/proffi-center.ru/public_html
git pull origin main
```
