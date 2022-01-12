<?php

namespace Indotcode\CronManager\Seeders;

use Illuminate\Database\Seeder;
use Indotcode\CronManager\Models\CronManagerOption;

class OptionSeeder extends Seeder
{
    private array $default_option = [
        [
            'key' => 'timezone',
            'value' => ''
        ]
    ];

    public function run()
    {
        foreach ($this->default_option as $val){
            if(!CronManagerOption::where('key', $val['key'])->exists()){
                $option = new CronManagerOption();
                $option->key = $val['key'];
                $option->value = $val['value'];
                $option->save();
            }
        }
    }
}
