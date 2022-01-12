<?php

namespace Indotcode\CronManager\App;

use App\Console\CronManager\Event;
use Illuminate\Console\Scheduling\Schedule;
use Indotcode\CronManager\Models\CronManagerEvent;

class EventCombine
{
    public function launch(Schedule $schedule) : void
    {
        $eventCl = new Event();
        $events = CronManagerEvent::where('active', 1)->get();
        foreach ($events as $event){
            $event_method = $event['methods'];
            $eventF = new EventFactories($schedule);
            $eventF->setCall(function () use ($event, $event_method, $eventCl) {
                $log = new LogFactories();
                $deActive = new DeActiveFactories($event['id']);
                try {
                    $eventCl->$event_method($event);
                    $log->setLog($event, 'Задание успешно завершено.');
                    $deActive->setStart();
                } catch (\Exception $e){
                    $log->setLog($event, $e->getMessage());
                    $deActive->setError();
                }
            });
            $eventF->setId($event->id);
            $eventF->get();
        }
    }
}
