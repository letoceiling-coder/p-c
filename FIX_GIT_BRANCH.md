# Исправление проблемы с веткой на сервере

## Проблема
Ветка `main` не найдена на GitHub. Возможные причины:
1. Репозиторий пустой на GitHub
2. Ветка называется `master` вместо `main`
3. Код еще не был отправлен на GitHub

## Решение

### Вариант 1: Проверить, какие ветки есть на GitHub

Выполните на сервере:

```bash
cd ~/proffi-center.ru/public_html

# Проверить удаленные ветки
git ls-remote --heads origin

# Проверить все удаленные ссылки
git ls-remote origin
```

### Вариант 2: Если ветка называется `master`

```bash
cd ~/proffi-center.ru/public_html
git fetch origin
git checkout -b master origin/master
git pull origin master
```

### Вариант 3: Если репозиторий пустой на GitHub

Нужно сначала отправить код с локального компьютера на GitHub, затем на сервере:

```bash
# На сервере создать локальную ветку main
cd ~/proffi-center.ru/public_html
git checkout -b main

# Добавить все файлы
git add .

# Создать коммит
git commit -m "Initial commit from server"

# Отправить на GitHub
git push -u origin main
```

### Вариант 4: Если нужно использовать существующие файлы на сервере

```bash
cd ~/proffi-center.ru/public_html

# Проверить текущее состояние
git status

# Если есть файлы, которые нужно сохранить
git add .
git commit -m "Server files"

# Создать ветку main локально
git checkout -b main

# Отправить на GitHub
git push -u origin main
```

## Рекомендуемая последовательность

```bash
# 1. Проверить удаленные ветки
cd ~/proffi-center.ru/public_html
git ls-remote --heads origin

# 2. Если веток нет, создать локальную main и отправить
git checkout -b main
git add .
git commit -m "Initial commit from server"
git push -u origin main

# 3. Если ветка master существует
git fetch origin
git checkout -b master origin/master
git pull origin master
```
