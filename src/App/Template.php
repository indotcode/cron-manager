<?php
namespace Indotcode\CronManager\App;

use Illuminate\Contracts\View\View;

class Template
{
    public static function get(): View
    {
        return view('cron-manager::index');
    }

    public static function css(): View
    {
        return view('cron-manager::css');
    }

    public static function js(): View
    {
        return view('cron-manager::js');
    }
}
