<?php

namespace Indotcode\CronManager\App;

use Indotcode\CronManager\Models\CronManagerEvent;

class DeActiveFactories
{

    protected CronManagerEvent $model;

    public function __construct($id_event)
    {
        $this->model = CronManagerEvent::find($id_event);
    }

    public function setError()
    {
        $model = $this->model;
        if($model->de_active_attempts > 0){
            $model->de_active_check = $model->de_active_check + 1;
            $model->save();
            if($model->de_active_check >= $model->de_active_attempts){
                $model2 = $this->model;
                $model2->active = false;
                $model2->de_active_check = 0;
                $model2->save();
            }
        } else {
            if($model->de_active_check >= 1){
                $model3 = $this->model;
                $model3->de_active_check = 0;
                $model3->save();
            }
        }
    }
    public function setStart()
    {
        $model = $this->model;
        if($model->de_active_check !== 0){
            $model->de_active_check = 0;
            $model->save();
        }
    }
}
