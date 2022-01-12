<?php

namespace App\Console\CronManager;

use Indotcode\CronManager\App\EventList;
use Indotcode\CronManager\Models\CronManagerEvent;

class Event extends EventList
{
    public function start_methods(CronManagerEvent $event)
    {

    }
}
