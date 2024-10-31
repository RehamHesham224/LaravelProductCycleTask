<?php

namespace App\Http\Controllers;

use App\Support\Api\ApiResponse;

abstract class Controller
{
    use ApiResponse;

    public static array $orderBy = ['id' => 'desc'];

    public static ?string $model = null;

    protected ?int $perPage = 10;
}
