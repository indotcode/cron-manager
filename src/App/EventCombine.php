<?php

namespace Indotcode\CronManager\App;

use App\Console\CronManager\Event;
use Illuminate\Console\Scheduling\Schedule;
use Indotcode\CronManager\Models\CronManagerEvent;

class EventCombine
{
    public function launch(Schedule $schedule) : void
    {

        $events = CronManagerEvent::where('active', 1)->get();
        foreach ($events as $event){
            $event_method = $event['methods'];
            $eventF = new EventFactories($schedule);
            $eventF->setCall(function () use ($event, $event_method) {
                $log = new LogFactories();
                try {
                    $eventCl = new Event();
                    $eventCl->$event_method($event);
                    $log->setLog($event, 'Задание успешно завершено.');
                } catch (\Exception $e){
                    $log->setLog($event, $e->getMessage());
                }
            });
            $eventF->setId($event->id);
            $eventF->get();
        }
    }
}
