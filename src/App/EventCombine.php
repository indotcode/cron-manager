<?php

namespace Indotcode\CronManager\App;


use Illuminate\Console\Scheduling\Schedule;
use Indotcode\CronManager\Interfaces\EventCombineInterface;
use Indotcode\CronManager\Models\CronManagerEvent;
use Indotcode\CronManager\Models\CronManagerOption;

class EventCombine implements EventCombineInterface
{
    protected Schedule $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function launch() : void
    {
        $events = CronManagerEvent::where('active', 1)->get();
        $option_namespace = CronManagerOption::where('key', 'namespace')->first();
        foreach ($events as $event){
            $event_class = explode(".", $event['event'])[0];
            $eventS = $this->schedule->call(new $option_namespace . "\\" . $event_class);
            $eventS->everyMinute();
        }
    }
}
