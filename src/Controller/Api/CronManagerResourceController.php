<?php

namespace Indotcode\CronManager\Controller\Api;

use Indotcode\CronManager\App\Resource;
use Indotcode\CronManager\Interfaces\CronManagerResourceInterfaces;
use Illuminate\Http\JsonResponse;

class CronManagerResourceController implements CronManagerResourceInterfaces
{
    public function eventList(): JsonResponse
    {
        return response()->json(Resource::getEventMethods(),200);
    }

    public function planning(): JsonResponse
    {
        return response()->json(Resource::getPlanning(),200);
    }

    public  function restrictionsDay() : JsonResponse
    {
        return response()->json(Resource::getRestrictionsDay(),200);
    }
}
