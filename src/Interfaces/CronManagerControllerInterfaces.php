<?php

namespace Indotcode\CronManager\Interfaces;

use Illuminate\Http\Request;

interface CronManagerControllerInterfaces
{
    public function select(): object;

    public function insert(Request $request): object;

    public function update(Request $request, int $id): object;

    public function delete(Request $request, int $id): object;
}
