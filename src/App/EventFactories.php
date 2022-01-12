<?php

namespace Indotcode\CronManager\App;

use Illuminate\Console\Scheduling\Schedule;
use Indotcode\CronManager\Models\CronManagerEvent;
use Indotcode\CronManager\Models\CronManagerOption;

class EventFactories
{
    protected Schedule $schedule;

    protected object $callback;

    protected object $event;

    protected $eventResult;

    protected int $id;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function setCall($callback): static
    {
        $this->event = $this->schedule->call($callback);
        return $this;
    }

    public function setId($id): static
    {
        $this->id = $id;
        return $this;
    }

    public function get()
    {
        $this->periodicity();
        $this->timezone();
        $this->restrictionsDays();
        $this->event->sendOutputTo(app()->basePath() . '/app/Console/CronManager/log.txt');
    }

    private function getEvent()
    {
        if($this->eventResult){
            return $this->eventResult;
        }
        $this->eventResult = CronManagerEvent::find($this->id);
        return $this->eventResult;
    }

    private function getEventKey($key)
    {
        return $this->getEvent()[$key];
    }

    private function periodicity()
    {
        $periodicity = $this->getEventKey('periodicity');
        $periodicity_value = json_decode($this->getEventKey('periodicity_value'));
        $count = count($periodicity_value);
        switch ($count){
            case 0:
                $this->event->$periodicity();
                break;
            case 1:
                $this->event->$periodicity($periodicity_value[0]);
                break;
            case 2:
                $this->event->$periodicity($periodicity_value[0], $periodicity_value[1]);
                break;
        }
    }

    private function timezone()
    {
        $timezone = $this->getEventKey('timezone');
        if($timezone){
            $this->event->timezone($timezone);
        } else {
            $timezone_option = CronManagerOption::where('key', 'timezone')->first('value');
            if($timezone_option['value'] !== ''){
                $this->event->timezone($timezone_option['value']);
            }
        }
    }

    private function restrictionsDays()
    {
        $restrictions_days = $this->getEventKey('restrictions_days');
        if($restrictions_days){
            $map_restrictions_days = explode(",", $restrictions_days);
            $days_res = [
                'sundays' => 0,
                'mondays' => 1,
                'tuesdays' => 2,
                'wednesdays' => 3,
                'thursdays' => 4,
                'fridays' => 5,
                'saturdays' => 6,
            ];
            $days_map = [];
            foreach ($map_restrictions_days as $val){
                $days_map[] = $days_res[$val];
            }
            $this->event->days($days_map);
        }
    }
}
