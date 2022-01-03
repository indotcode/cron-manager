<?php

namespace Indotcode\CronManager\Models;

use Illuminate\Database\Eloquent\Model;

class CronManagerOption extends Model
{
    protected $table = 'cron_manager_option';

    protected $fillable = ['key', 'value'];

}
