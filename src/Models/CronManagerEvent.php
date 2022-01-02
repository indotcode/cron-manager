<?php

namespace Indotcode\CronManager\Models;

use Illuminate\Database\Eloquent\Model;

class CronManagerEvent extends Model
{
    protected $table = 'cron_manager_event';

    protected $fillable = ['name', 'event', 'time'];
}
