<?php

namespace Indotcode\CronManager\Controller\Api;

use Indotcode\CronManager\Controller\CronManagerController;
use Indotcode\CronManager\Models\CronManagerOption;

class CronManagerOptionController extends CronManagerController
{
    public function __construct()
    {
        $this->model = new CronManagerOption();
    }
}
