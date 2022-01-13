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


## Вызов в шаблоне

### Модуль

```blade
{!! CronManager::get() !!}
```
### Стили

```blade
{!! CronManager::css() !!}
```

### Скрипты

```blade
{!! CronManager::js() !!}
```


## Методы задач

**Методы задач определяются в классе:** app/Console/CronManager/Event.php

**Формат метода задачи:**
```php
# start - Название метода (можно изменить)
# methods - уникальный ключ (нельзя изменять)
# $event - Данные крон задачи (Класс модели)
public function start_methods(CronManagerEvent $event)
{
    # Ход выполнения задания
}
```
