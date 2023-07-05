<?php

namespace App\Repositories\Traits;

use Illuminate\Database\Eloquent\Model;

trait ModelTrait
{
    private Model $model;

    private function setModel(Model $model) : void
    {
        $this->model = $model;
    }
}
