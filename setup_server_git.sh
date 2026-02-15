#!/bin/bash
# Быстрая настройка Git на сервере BeGet
# Скопируйте этот скрипт на сервер и выполните: bash setup_server_git.sh

cd ~/proffi-center.ru/public_html || exit 1

echo "=== Настройка Git на сервере ==="
echo "Директория: $(pwd)"
echo ""

# Инициализация Git
if [ ! -d ".git" ]; then
    echo "Инициализация Git репозитория..."
    git init
fi

# Настройка удаленного репозитория
echo "Настройка удаленного репозитория..."
git remote remove origin 2>/dev/null
git remote add origin https://github.com/letoceiling-coder/p-c.git

# Получение кода
echo "Получение кода с GitHub..."
git fetch origin

# Переключение на main
if git show-ref --verify --quiet refs/remotes/origin/main; then
    echo "Переключение на ветку main..."
    git checkout -b main origin/main 2>/dev/null || git checkout main
    git pull origin main
    echo "✓ Код обновлен с GitHub"
elif git show-ref --verify --quiet refs/remotes/origin/master; then
    echo "Переключение на ветку master..."
    git checkout -b master origin/master 2>/dev/null || git checkout master
    git pull origin master
    echo "✓ Код обновлен с GitHub"
else
    echo "⚠ Ветка main/master не найдена на GitHub"
    echo "Создайте ветку на GitHub или выполните:"
    echo "  git checkout -b main"
fi

echo ""
echo "=== Готово ==="
echo "Статус:"
git status
echo ""
echo "Для обновления проекта выполните:"
echo "  cd ~/proffi-center.ru/public_html"
echo "  git pull origin main"
