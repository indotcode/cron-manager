<?php

namespace Indotcode\CronManager\Controller\Api;

use Indotcode\CronManager\Controller\CronManagerController;
use Indotcode\CronManager\Models\CronManagerEvent;

class CronManagerEventController extends CronManagerController
{
    public function __construct()
    {
        $this->model = new CronManagerEvent();
    }
}
