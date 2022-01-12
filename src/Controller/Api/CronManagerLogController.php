<?php

namespace Indotcode\CronManager\Controller\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Indotcode\CronManager\Controller\CronManagerController;
use Indotcode\CronManager\Models\CronManagerLog;

class CronManagerLogController extends CronManagerController
{
    public function __construct()
    {
        $this->model = new CronManagerLog();
    }

    public function selectEventId(Request $request, $id): JsonResponse
    {
        return response()->json($this->model->where('id_event', $id)->orderBy('created_at', 'desc')->get(),200);
    }

    public function deleteEventId(Request $request, $id): JsonResponse
    {
        $this->model->where('id_event', $id)->delete();
        return response()->json($id,200);
    }
}
