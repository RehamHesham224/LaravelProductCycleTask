<?php

namespace App\Support\ModelServices;

use Illuminate\Database\Eloquent\Model;

abstract class ModelService
{
    public function __construct(protected readonly Model $model)
    {
    }
}
