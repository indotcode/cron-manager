# Документация (Релиз 1.0.0)

## Установка Composer

```text
composer require indotcode/cron-manager
```

## Подключения

**Файл:** config/app.php массив providers 
```php
Indotcode\CronManager\CronManagerServiceProvider::class;
```

**Файл:** config/app.php массив aliases
```php
'CronManager' => Indotcode\CronManager\Facade::class,
```

### Импорт ресурсов
```text
php artisan vendor:publish --provider="Indotcode\CronManager\CronManagerServiceProvider"
```
### Добавить таблицы пакета в БД
```text
php artisan migrate
```
### Загрузим начальные данные настроек
```text
php artisan db:seed --class="Indotcode\CronManager\Seeders\OptionSeeder"
```


### Запуск планировщика на сервере
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

## Скриншоты


![Главная страница](https://github.com/indotcode/cron-manager/blob/main/screenshots/scrin1.png?raw=true "Орк")

![Журнал ошибок](https://github.com/indotcode/cron-manager/blob/main/screenshots/scrin2.png?raw=true "Орк")

![Редактирование задания](https://github.com/indotcode/cron-manager/blob/main/screenshots/scrin3.png?raw=true "Орк")

![Страница глобальных настроек](https://github.com/indotcode/cron-manager/blob/main/screenshots/scrin4.png?raw=true "Орк")
