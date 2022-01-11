<?php

namespace Indotcode\CronManager\Interfaces;

use Illuminate\Console\Scheduling\Schedule;

interface EventCombineInterface
{
    public function launch(Schedule $schedule) : void;
}
