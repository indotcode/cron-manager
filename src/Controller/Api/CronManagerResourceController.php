<?php

namespace Indotcode\CronManager\Controller\Api;

use Illuminate\Filesystem\Filesystem;
use Indotcode\CronManager\App\Resource;
use Indotcode\CronManager\Interfaces\CronManagerResourceInterfaces;
use Indotcode\CronManager\Models\CronManagerOption;
use Illuminate\Http\JsonResponse;

class CronManagerResourceController implements CronManagerResourceInterfaces
{
    public function eventList(): JsonResponse
    {
        return response()->json(Resource::getFileEvent(),200);
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
