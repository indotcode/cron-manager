# Документация (Релиз 1.0.0)

## Подключения

**Файл:** config/app.php
```php
Indotcode\CronManager\CronManagerServiceProvider::class;
```

## Импорт ресурсов
```text
php artisan vendor:publish --provider="Indotcode\CronManager\CronManagerServiceProvider"
```
## Добавить таблицы пакета в БД
```text
php artisan migrate
```
## Загрузим начальные данные настроек
```text
php artisan db:seed --class="Indotcode\CronManager\Seeders\OptionSeeder"
```
