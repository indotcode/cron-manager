<?php

namespace Indotcode\CronManager\Controller\Api;

use Illuminate\Filesystem\Filesystem;
use Indotcode\CronManager\Interfaces\CronManagerResourceInterfaces;
use Indotcode\CronManager\Models\CronManagerOption;
use Illuminate\Http\JsonResponse;

class CronManagerResourceController implements CronManagerResourceInterfaces
{
    public function eventList(): JsonResponse
    {
        $result = [];
        $option_path_schedule = CronManagerOption::where('key', 'path_schedule')->first();
        $path = app()->basePath() . '/' . $option_path_schedule->value;
        $filesystem = new Filesystem();
        if ($filesystem->exists($path)){
            $file_result = $filesystem->allFiles($path);
            foreach ($file_result as $key => $val){
                $result[$key] = $val->getBasename();
            }
        }
        return response()->json($result,200);
    }
}
