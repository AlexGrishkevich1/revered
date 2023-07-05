<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\JsonResponse;

interface LinkRepositoryInterface
{
    public function get();

    public function create(array $data);
}
