# pay54ru
api pay54.ru service
https://pay54.ru/documentation

## Требования
PHP 5.3.2 (и выше)

## Установка
### В консоли с помощью Composer

1. Установите менеджер пакетов Composer.
2. В консоли выполните команду
```bash
composer require sdi68/pay54
```

### В файле composer.json своего проекта
1. Добавьте строку `"sdi68/pay54": "^1.0"` в список зависимостей вашего проекта в файле composer.json
```
...
    "require": {
        "php": ">=5.3.2",
        "sdi68/pay54": "^1.0"
...
```
2. Обновите зависимости проекта. В консоли перейдите в каталог, где лежит composer.json, и выполните команду:
```bash
composer update
```
3. В коде вашего проекта подключите автозагрузку файлов нашего клиента:
```php
require __DIR__ . '/vendor/autoload.php';
```

## Начало работы

