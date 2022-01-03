<?php

namespace Indotcode\CronManager\Controller\Api;

use Indotcode\CronManager\Models\CronManagerOption;

class CronManagerResourceController
{
    public function eventList(){
        $path_schedule = CronManagerOption::where('key', 'path_schedule')->first();
    }
}
