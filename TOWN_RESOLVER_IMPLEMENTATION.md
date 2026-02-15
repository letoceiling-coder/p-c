# Реализация TownResolver - единый механизм определения города по поддомену

## Выполненные шаги

### ШАГ 0: Исследование структуры
- ✅ Изучена структура таблицы `town`:
  - `id`, `rayon`, `domen_city`, `city_rus`, `city-rus-rod`, `city-rus-is`, `adress`, `phone`, `gerb_city`, `addresslocality`, `streetaddress`, `postalcode`, `cords`
  - Поле `domen_city` используется для связи с поддоменом (например, 'msk', 'vityazevo', 'anapa')
- ✅ Найдены хардкоды телефонов/адресов в шаблонах

### ШАГ 1: Создан TownResolver
**Файл:** `includes/TownResolver.php`
- `getHost()` - получение HTTP_HOST
- `getSubdomainFromHost($host)` - извлечение поддомена (msk из msk.proffi-center.ru)
- `resolveTownBySubdomain($subdomain, $db)` - получение town из БД по поддомену
- `resolveDefaultTown($db)` - fallback на default town (anapa)
- `resolve($db)` - основной метод определения текущего town

### ШАГ 2: Созданы helpers
**Файл:** `includes/town_helpers.php`
- `town()` - получить текущий town (массив)
- `town_phone()` - основной телефон
- `town_phones()` - массив телефонов
- `town_address()` - адрес
- `town_city()` - город
- `town_region()` - регион
- `town_id()` - ID town
- `town_subdomain()` - поддомен
- `town_phone_clean()` - телефон для tel: ссылки
- `town_city_rod()` - город в родительном падеже
- `town_city_is()` - город в предложном падеже

### ШАГ 3: Интеграция в Route
**Файл:** `classed/Route.php`
- TownResolver вызывается ДО getRoute()
- Town устанавливается в `$this->town` и `$GLOBALS['APP_TOWN']`
- Загружаются все towns для совместимости

### ШАГ 4: Замена хардкодов
**Заменены телефоны в:**
- `template/globalTemplate/user/header.php` (2 места)
- `template/simpleText/s_contacts.php`
- `template/simpleText/s25.php`

**Использованы функции:**
- `town_phone()` - для отображения
- `town_phone_clean()` - для tel: ссылок

### ШАГ 5: Обновлены Telegram уведомления
**Файл:** `includes/TelegramNotifier.php`
- Добавлен метод `enrichMetaWithTown()` - обогащает meta данными town
- В сообщения добавлены:
  - Город (town_city)
  - Регион (town_region)
  - Адрес (town_address)
  - Телефон сайта (town_phone)
  - Host и subdomain

### ШАГ 6: Исправлена ошибка template//shop.php
**Файл:** `classed/BaseController.php`
- Исправлен метод `render()` - убирает двойные слеши в пути
- Исправлен `inputData()` - правильное формирование пути к шаблону
- Добавлена проверка существования файла перед include

## Используемые поля таблицы town

- `id` - ID записи
- `domen_city` - поддомен (msk, vityazevo, anapa и т.д.)
- `city_rus` - название города
- `city-rus-rod` - город в родительном падеже
- `city-rus-is` - город в предложном падеже
- `rayon` - район
- `adress` - адрес
- `phone` - телефон
- `addresslocality` - адрес (локалитет)
- `streetaddress` - адрес (улица)
- `postalcode` - почтовый индекс
- `cords` - координаты

## Измененные файлы

1. `includes/TownResolver.php` - новый файл
2. `includes/town_helpers.php` - новый файл
3. `classed/Route.php` - добавлена инициализация TownResolver
4. `classed/BaseController.php` - исправлен render(), обновлена обработка town
5. `template/globalTemplate/user/header.php` - заменены TEL на town_phone()
6. `template/simpleText/s_contacts.php` - заменен TEL на town_phone()
7. `template/simpleText/s25.php` - заменен TEL на town_phone()
8. `includes/TelegramNotifier.php` - добавлены данные town в уведомления

## Команды для проверки

### Проверка на разных поддоменах:
```bash
# Основной домен (должен показать anapa)
curl -I https://proffi-center.ru/

# Поддомен msk (если есть в БД)
curl -I https://msk.proffi-center.ru/

# Поддомен vityazevo
curl -I https://vityazevo.proffi-center.ru/
```

### Проверка страницы gotovye-potolki:
```bash
curl -I https://proffi-center.ru/gotovye-potolki
```

### Проверка Telegram уведомлений:
1. Отправить форму на сайте
2. Проверить сообщение в Telegram - должно содержать город, регион, адрес, телефон

## Критерии готовности

- ✅ Town определяется по поддомену из HTTP_HOST
- ✅ Fallback на default town работает
- ✅ Телефоны/адреса берутся из town (не хардкод)
- ✅ Telegram уведомления содержат данные town
- ✅ Исправлена ошибка template//shop.php
- ✅ PHP 5.6 совместимость соблюдена

## Примечания

- Константа `TEL` в `config/config.php` оставлена для обратной совместимости, но в шаблонах используется `town_phone()`
- Старый механизм определения town через PluginsController::town() может переопределить town из URL, но TownResolver имеет приоритет
- Если town не найден по поддомену - используется default (anapa)
