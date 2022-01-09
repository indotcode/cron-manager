<?php

namespace Indotcode\CronManager;

use Illuminate\Support\Facades\Facade as BaseFacade;
use Indotcode\CronManager\App\Template;

class Facade extends BaseFacade
{
    protected static function getFacadeAccessor(): string
    {
        return Template::class;
    }
}
