# 🔍 ПОЛНЫЙ АНАЛИЗ АВТОРИЗАЦИИ

## 1. КАК РАБОТАЕТ РАБОЧАЯ АВТОРИЗАЦИЯ КЛИЕНТА (autz_client)

### JavaScript (template/calc/js/authorization.js):
```javascript
jQuery.ajax({
    url: "/",
    async: false,  // ⚠️ СИНХРОННЫЙ запрос!
    data: {name:name,password:password,success:'autz_client'},
    dataType: 'json',
    type:"post",
    // ⚠️ НЕТ заголовка X-Requested-With!
    
    success: function(data) {
        if (data == null){  // ⚠️ Проверяет на null, не на false
            // Показать ошибку
        }else{
            location.reload();  // ✅ Перезагрузка при успехе
        }
    }
});
```

### PHP (AjaxController::autz_client):
```php
protected function autz_client(){
    $login = $_POST['name'];
    $password = $_POST['password'];
    $login = strip_tags(addslashes($login));
    $password = md5(strip_tags(addslashes($password)));
    
    if (empty($login) && empty($password)){
        echo false;  // ⚠️ Возвращает НЕ JSON!
    }else{
        $sql = "SELECT * FROM `users` WHERE `login` = '".$login."' AND `password` = '".$password."'";
        $res = $this->sql->query($sql ,'assoc');
        if (!$res) echo false;  // ⚠️ Возвращает НЕ JSON!
        
        $sess = md5(microtime());
        $this->sql->query("UPDATE `users` SET `sess` = '".$sess."' WHERE `login` = '".$login."' AND `password` = '".$password."'");
        
        if ($res){
            setcookie("client", $sess, time()+3600*24);
            $_SESSION['client'] = $sess;
            echo true;  // ⚠️ Возвращает НЕ JSON!
        }
    }
}
```

**Ключевые моменты:**
- ✅ НЕ использует заголовок `X-Requested-With`
- ✅ Возвращает `true`/`false` (НЕ JSON!)
- ✅ JavaScript с `dataType: 'json'` как-то это обрабатывает

---

## 2. КАК РАБОТАЕТ НЕ РАБОТАЮЩАЯ АВТОРИЗАЦИЯ АДМИНА (autz_admin)

### JavaScript (template/globalTemplate/admin/js/script.js):
```javascript
$.ajax({
    type: "POST",
    url: "/",
    data: {password: password, name: name, success: 'autz_admin'},
    dataType: 'json',
    headers: {
        'X-Requested-With': 'XMLHttpRequest'  // ⚠️ ЕСТЬ заголовок!
    },
    // ⚠️ НЕТ async: false!
    
    success: function (data) {
        if (data == null || data === false || data === 'false'){
            // Показать ошибку
        }else{
            location.reload();
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        // Показать "Ошибка передачи данных"
    }
});
```

### PHP (AjaxController::autz_admin):
```php
protected function autz_admin(){
    header('Content-Type: application/json');  // ⚠️ Устанавливает заголовок
    
    // ... логирование ...
    
    echo json_encode(false);  // ✅ Возвращает JSON
    // или
    echo json_encode(true);   // ✅ Возвращает JSON
}
```

**Ключевые моменты:**
- ⚠️ Использует заголовок `X-Requested-With`
- ✅ Возвращает JSON
- ⚠️ НЕТ `async: false`

---

## 3. КАК ОБРАБАТЫВАЕТСЯ ЗАПРОС

### index.php:
```php
header("Content-Type:text/html;charset-UTF-8");  // ⚠️ Устанавливает заголовок ДО всего!
session_start();
$route = new Route();
```

### Route.php:
```php
public function __construct()
{
    // Проверка GD
    if (! extension_loaded('gd')) {
        echo 'GD не установлено.';
        exit;
    }
    
    // ⚠️ AJAX обработка ПЕРЕД всем остальным
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        BaseController::writeLog('AJAX request detected', 'admin_auth.log', 'AUTH');
        try {
            $this->ajax = new AjaxController();  // ⚠️ Создается здесь
        } catch (Exception $e) {
            // Обработка ошибок
        }
    }elseif(!empty($_POST['success'])){
        BaseController::writeLog('POST success detected without header', 'admin_auth.log', 'AUTH');
        try {
            $this->ajax = new AjaxController();  // ⚠️ Или здесь
        } catch (Exception $e) {
            // Обработка ошибок
        }
    }
    
    // ⚠️ ПРОДОЛЖАЕТ выполнение дальше!
    $this->sql = new Db();
    $this->getRoute();
    $this->inputData();
}
```

### AjaxController.php:
```php
public function __construct()
{
    try {
        BaseController::writeLog('AjaxController construct START', 'admin_auth.log', 'AUTH');
        $this->sql = new Db();  // ⚠️ Создает новое подключение к БД
        BaseController::writeLog('Db created successfully', 'admin_auth.log', 'AUTH');
        
        $method = $_POST['success'] ?? '';
        if (method_exists($this,$method)){
            $this->$method();  // Вызывает autz_admin()
        }
    } catch (Exception $e) {
        // Обработка ошибок
    }
    
    exit();  // ⚠️ Выходит здесь
}
```

---

## 4. ПРОБЛЕМА

### Из логов видно:
```
AUTH: 15-02-2026 15:42:08 - AJAX request detected - POST: {"password":"admin","name":"Admin","success":"autz_admin"}
```

**НО НЕТ логов:**
- ❌ "AjaxController construct START"
- ❌ "Db created successfully"
- ❌ "Method to call: autz_admin"
- ❌ "=== autz_admin START ==="

**Это означает:**
1. Запрос доходит до Route.php ✅
2. Условие `HTTP_X_REQUESTED_WITH == 'xmlhttprequest'` выполняется ✅
3. НО конструктор `AjaxController` НЕ вызывается или падает ДО первой строки ❌

### Возможные причины:

#### 1. Проблема с Singleton trait
- `AjaxController` использует `use Singleton;`
- `BaseController` тоже использует `use Singleton;`
- Может быть конфликт при наследовании

#### 2. Проблема с BaseController::writeLog()
- Вызывается ДО того, как конструктор BaseController выполнится
- Может быть проблема с доступом к статическому методу

#### 3. Проблема с заголовками
- `index.php` устанавливает `Content-Type:text/html;charset-UTF-8`
- `autz_admin()` пытается установить `Content-Type: application/json`
- Может быть конфликт заголовков

#### 4. Проблема с исключениями
- `Db` может выбрасывать `DbException`
- Но исключение не ловится в Route.php правильно

---

## 5. РЕШЕНИЕ

### Вариант 1: Сделать autz_admin идентичным autz_client
- Убрать заголовок `X-Requested-With` из JavaScript
- Убрать `header('Content-Type: application/json')` из PHP
- Возвращать `true`/`false` вместо JSON
- Добавить `async: false` в JavaScript

### Вариант 2: Исправить обработку в Route.php
- Убедиться, что исключения ловятся правильно
- Проверить, что конструктор BaseController выполняется

### Вариант 3: Проверить Singleton
- Убедиться, что нет конфликта при наследовании

---

## 6. РЕКОМЕНДАЦИЯ

**Сделать autz_admin максимально похожим на рабочий autz_client:**

1. Убрать заголовок `X-Requested-With` из JavaScript
2. Убрать `header('Content-Type: application/json')` из PHP
3. Возвращать `true`/`false` вместо JSON
4. Добавить `async: false` в JavaScript
5. Убрать все логирование (или оставить минимальное)

Это должно работать, так как autz_client работает именно так.
