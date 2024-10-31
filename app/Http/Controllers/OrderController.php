<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Jobs\ProcessOrder;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request)
    {
        ProcessOrder::dispatchAfterResponse($request->validated());

        return self::apiCode(201)->apiMessage('data_dispatched_successfully')->apiResponse();
    }
}
