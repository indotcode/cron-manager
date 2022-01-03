<?php

namespace Indotcode\CronManager\Interfaces;

use Illuminate\Http\JsonResponse;

interface CronManagerResourceInterfaces
{
    public function eventList() : JsonResponse;
}
