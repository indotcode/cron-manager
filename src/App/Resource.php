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


    public static function getPlanning(): array
    {
        return [
            [
                'name' => 'Запустить задачу по расписанию с параметрами cron',
                'key' => 'cron',
                'fields' => [
                    [
                        'type' => 'text',
                        'view' => 'cron'
                    ]
                ],
            ],
            [
                'name' => 'Запускать задачу ежеминутно',
                'key' => 'everyMinute',
                'fields' => []
            ],
            [
                'name' => 'Запускать каждые 2 минуты',
                'key' => 'everyMinute',
                'fields' => []
            ],
            [
                'name' => 'Запускать каждые 3 минуты',
                'key' => 'everyThreeMinutes',
                'fields' => []
            ],
            [
                'name' => 'Запускать каждые 4 минуты',
                'key' => 'everyFourMinutes',
                'fields' => []
            ],
            [
                'name' => 'Запускать каждые 5 минут',
                'key' => 'everyFiveMinutes',
                'fields' => []
            ],
            [
                'name' => 'Запускать каждые 10 минут',
                'key' => 'everyTenMinutes',
                'fields' => []
            ],
            [
                'name' => 'Запускать каждые 15 минут',
                'key' => 'everyFifteenMinutes',
                'fields' => []
            ],
            [
                'name' => 'Запускать каждые 30 минут',
                'key' => 'everyThirtyMinutes',
                'fields' => []
            ],
            [
                'name' => 'Запускать каждый час',
                'key' => 'hourly',
                'fields' => []
            ],
            [
                'name' => 'Запускать в N минут каждого часа',
                'key' => 'hourlyAt',
                'fields' => [
                    [
                        'type' => 'number',
                        'view' => 'minute'
                    ]
                ]
            ],
            [
                'name' => 'Запускать каждые 2 часа',
                'key' => 'everyTwoHours',
                'fields' => []
            ],
            [
                'name' => 'Запускать каждые 3 часа',
                'key' => 'everyThreeHours',
                'fields' => []
            ],
            [
                'name' => 'Запускать каждые 4 часа',
                'key' => 'everyFourHours',
                'fields' => []
            ],
            [
                'name' => 'Запускать каждые 6 часов',
                'key' => 'everySixHours',
                'fields' => []
            ],
            [
                'name' => 'Запускать каждый день в полночь',
                'key' => 'daily',
                'fields' => []
            ],
            [
                'name' => 'Запускать ежедневно в N часов',
                'key' => 'dailyAt',
                'fields' => [
                    [
                        'type' => 'text',
                        'view' => 'time'
                    ]
                ]
            ],
            [
                'name' => 'Запускать ежедневно дважды в день в N и N',
                'key' => 'twiceDaily',
                'fields' => [
                    [
                        'type' => 'number',
                        'view' => 'hour'
                    ],
                    [
                        'type' => 'number',
                        'view' => 'hour'
                    ]
                ]
            ],
            [
                'name' => 'Запускать еженедельно в воскресенье в 00:00',
                'key' => 'weekly',
                'fields' => []
            ],
            [
                'name' => 'Запускать ежемесячно N числа в N',
                'key' => 'monthlyOn',
                'fields' => [
                    [
                        'type' => 'number',
                        'view' => 'day'
                    ],
                    [
                        'type' => 'text',
                        'view' => 'time'
                    ]
                ]
            ]
        ];
    }
}
