<?php

namespace Indotcode\CronManager\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Indotcode\CronManager\Interfaces\CronManagerControllerInterfaces;

abstract class CronManagerController extends Controller implements CronManagerControllerInterfaces
{
    protected object $model;

    public function select(Request $request): JsonResponse
    {
        $event = $this->model;
        $event->orderBy('id', 'desc');
        return response()->json($event->get(),200);
    }

    public function find(Request $request, int $id): JsonResponse
    {
        $event = $this->model->find($id);
        return response()->json($event,200);
    }

    public function insert(Request $request): JsonResponse
    {
        $event = $this->model;
        foreach ($request->post() as $key => $val){
            $event->$key = $val;
        }
        $event->save();
        return response()->json($event,200);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $event = $this->model->find($id);
        foreach ($request->post() as $key => $val){
            $event->$key = $val;
        }
        $event->save();
        return response()->json($event,200);
    }

    public function delete(Request $request, int $id): JsonResponse
    {
        $event = $this->model->find($id);
        if($event !== ''){
            $this->model::destroy($id);
        }
        return response()->json($event,200);
    }
}
