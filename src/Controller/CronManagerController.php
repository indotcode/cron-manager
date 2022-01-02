<?php

namespace Indotcode\CronManager\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Indotcode\Calendar\App\Data;

class CronManagerController extends Controller
{
    public function list(Request $request): string
    {
        return '123';
//        $data = array();
//        $config = \GuzzleHttp\json_decode($request->post('option'), true);
//        $config = (array)$config;
//        $config['year'] = $request->post('year');
//        $config['months'] = $request->post('months');
//        $calendar = new Data();
//        $result = $calendar->setCurrentDate()->setConfig($config)->get();
//        switch ($name){
//            case 'view':
//                echo view('calendar::item', ['calendar' => $result]);
//                break;
//            case 'params':
//                $data['navigation'] = $result->getNavigation();
//                $data['current_year'] = $result->getConfigKey('year');
//                $data['current_months'] = $result->getMonthsWeekId($result->getConfigKey('months'))['name'];
//                echo \GuzzleHttp\json_encode($data);
//                break;
//        }
    }
}
