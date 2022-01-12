<?php

namespace Indotcode\CronManager\Models;

use Illuminate\Database\Eloquent\Model;

class CronManagerLog extends Model
{
    protected $table = 'cron_manager_log';

    protected $fillable = ['id_event', 'message'];
}
