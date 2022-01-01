<?php
namespace Indotcode\CronManager;

class View
{
    public static function get()
    {
        return view('cron-manager::index');
    }

    public static function css()
    {
        return view('cron-manager::css');
    }

    public static function js()
    {
        return view('cron-manager::js');
    }
}
