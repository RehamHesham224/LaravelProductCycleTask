<?php

namespace App\Jobs;

use App\Services\OrderService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    protected $orderData;

    public function __construct(array $orderData)
    {
        $this->orderData = $orderData;
        $this->allOnQueue('order');
    }

    public function handle(OrderService $orderService)
    {
        $orderService->createOrder($this->orderData);
    }
}
