# Документация (Релиз 1.0.0)

## Подключения

**Файл:** config/app.php массив providers 
```php
Indotcode\CronManager\CronManagerServiceProvider::class;
```

**Файл:** config/app.php массив aliases
```php
'CronManager' => Indotcode\CronManager\Facade::class,
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


## Запуск планировщика на сервере
```text
# добавить записи cron на свой сервер
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```
