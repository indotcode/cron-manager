<?php

namespace Indotcode\CronManager\App;

use Indotcode\CronManager\Models\CronManagerEvent;
use Indotcode\CronManager\Models\CronManagerLog;

class LogFactories
{
    public function setLog(CronManagerEvent $event, $message)
    {
        $model = new CronManagerLog();
        $model->id_event = $event['id'];
        $model->message = $message;
        $model->save();
    }
}
