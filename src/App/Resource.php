<?php

namespace Indotcode\CronManager\App;

use Illuminate\Filesystem\Filesystem;
use Indotcode\CronManager\Models\CronManagerOption;

class Resource
{
    public static function getFileEvent(): array
    {
        $result = [];
        $option_path_schedule = CronManagerOption::where('key', 'path_schedule')->first();
        $path = app()->basePath() . '/' . $option_path_schedule->value;
        $filesystem = new Filesystem();
        if ($filesystem->exists($path)){
            $file_result = $filesystem->allFiles($path);
            foreach ($file_result as $key => $val){
                $result[$key] = $val->getBasename();
            }
        }
        return $result;
    }


    public static function getRestrictionsDay(): array
    {
        return [
            [
                'name' => 'Понедельник',
                'key' => 'mondays'
            ],
            [
                'name' => 'Вторник',
                'key' => 'tuesdays'
            ],
            [
                'name' => 'Среда',
                'key' => 'wednesdays'
            ],
            [
                'name' => 'Четверг',
                'key' => 'thursdays'
            ],
            [
                'name' => 'Пятница',
                'key' => 'fridays'
            ],
            [
                'name' => 'Суббота',
                'key' => 'saturdays'
            ],
            [
                'name' => 'Воскреснье',
                'key' => 'sundays'
            ]
        ];
    }

    public static function getPlanning(): array
    {
        return [
            [
                'name' => 'Запустить задачу по расписанию с параметрами cron',
                'key' => 'cron'
            ],
            [
                'name' => 'Запускать задачу ежеминутно',
                'key' => 'everyMinute'
            ],
            [
                'name' => 'Запускать каждые 2 минуты',
                'key' => 'everyMinute'
            ],
            [
                'name' => 'Запускать каждые 3 минуты',
                'key' => 'everyThreeMinutes'
            ],
            [
                'name' => 'Запускать каждые 4 минуты',
                'key' => 'everyFourMinutes'
            ],
            [
                'name' => 'Запускать каждые 5 минут',
                'key' => 'everyFiveMinutes'
            ],
            [
                'name' => 'Запускать каждые 10 минут',
                'key' => 'everyTenMinutes'
            ],
            [
                'name' => 'Запускать каждые 15 минут',
                'key' => 'everyFifteenMinutes'
            ],
            [
                'name' => 'Запускать каждые 30 минут',
                'key' => 'everyThirtyMinutes'
            ],
            [
                'name' => 'Запускать каждый час',
                'key' => 'hourly'
            ],
            [
                'name' => 'Запускать в N минут каждого часа',
                'key' => 'hourlyAt'
            ],
            [
                'name' => 'Запускать каждые 2 часа',
                'key' => 'everyTwoHours'
            ],
            [
                'name' => 'Запускать каждые 3 часа',
                'key' => 'everyThreeHours'
            ],
            [
                'name' => 'Запускать каждые 4 часа',
                'key' => 'everyFourHours'
            ],
            [
                'name' => 'Запускать каждые 6 часов',
                'key' => 'everySixHours'
            ],
            [
                'name' => 'Запускать каждый день в полночь',
                'key' => 'daily'
            ],
            [
                'name' => 'Запускать ежедневно в N часов',
                'key' => 'dailyAt'
            ],
            [
                'name' => 'Запускать ежедневно дважды в день в N и N',
                'key' => 'twiceDaily'
            ],
            [
                'name' => 'Запускать еженедельно в воскресенье в 00:00',
                'key' => 'weekly'
            ],
            [
                'name' => 'Запускать ежемесячно N числа в N',
                'key' => 'monthlyOn'
            ]
        ];
    }
}
