<?php

namespace Indotcode\CronManager\App;

use App\Console\CronManager\Event;

abstract class EventList
{
    protected string $type = 'methods';

    protected array $title = [];


    protected function setTitle($title)
    {
        $this->title[] = $title;
    }

    protected function getTitle(): array
    {
        return $this->title;
    }

    public function setType($type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getClassList(): array
    {
        $class_name = get_class_methods($this);
        $result = [];
        foreach ($class_name as $val){
            $arr = explode("_", $val);
            if(end($arr) === $this->type){
                unset($arr[count($arr) - 1]);
                $title = implode("_", $arr);
                $result[] = [
                    'title' => $title,
                    'method' => $val
                ];
            }
        }
        return $result;
    }
}
