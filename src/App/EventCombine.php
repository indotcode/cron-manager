<?php

namespace Indotcode\CronManager\App;

use App\Console\CronManager\StartEvent;
use Illuminate\Console\Scheduling\Schedule;
use Indotcode\CronManager\Interfaces\EventCombineInterface;
use Indotcode\CronManager\Models\CronManagerEvent;
use Indotcode\CronManager\Models\CronManagerOption;

class EventCombine implements EventCombineInterface
{
    public function launch(Schedule $schedule) : void
    {
        $events = CronManagerEvent::where('active', 1)->get();
//        dd(app()->basePath());
//        $option_namespace = CronManagerOption::where('key', 'namespace')->first();
//        $option_namespace = CronManagerOption::where('key', 'namespace')->first();
        foreach ($events as $event){
            $event_class = explode(".", $event['event'])[0];
//            require_once app()->basePath() . '/app/Console/CronManager/' . $event['event'];
//            $callback = new $option_namespace . "\\" . $event_class;
            dd(new StartEvent());
            $eventF = new EventFactories($schedule);
            $eventF->setCall(new $event_class);
            $eventF->setId($event->id);
            $eventF->get();
        }
    }
}
