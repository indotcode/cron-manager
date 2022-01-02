<?php

namespace Indotcode\CronManager\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Indotcode\CronManager\Interfaces\CronManagerControllerInterfaces;
use Indotcode\CronManager\Models\CronManagerEvent;

abstract class CronManagerController extends Controller implements CronManagerControllerInterfaces
{
    public function select(): object
    {
        $event = CronManagerEvent::orderBy('id', 'desc')->get();
        return response()->json($event,200);
    }

    public function find(Request $request, int $id): object
    {
        $event = CronManagerEvent::find($id);
        return response()->json($event,200);
    }

    public function insert(Request $request): object
    {
        $event = new CronManagerEvent();
        foreach ($request->post() as $key => $val){
            $event->$key = $val;
        }
        $event->save();
        return response($event,200);
    }

    public function update(Request $request, int $id): object
    {
        $event = CronManagerEvent::find($id);
        foreach ($request->post() as $key => $val){
            $event->$key = $val;
        }
        $event->save();
        return response($event,200);
    }

    public function delete(Request $request, int $id): object
    {
        $event = CronManagerEvent::find($id);
        if($event !== ''){
            CronManagerEvent::destroy($id);
        }
        return response($event,200);
    }
}
