<?php

namespace Indotcode\CronManager\Interfaces;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface CronManagerControllerInterfaces
{
    public function select(Request $request): JsonResponse;

    public function find(Request $request, int $id): JsonResponse;

    public function insert(Request $request): JsonResponse;

    public function update(Request $request, int $id): JsonResponse;

    public function delete(Request $request, int $id): JsonResponse;
}
