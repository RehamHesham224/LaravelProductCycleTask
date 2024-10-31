<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\OrderItem;

class OrderService
{
    public function createOrder($orderData){
        \DB::transaction(function () use ($orderData) {
            $order = Order::create([
                //TODO: auth()->id()
                'user_id' => 1,
                'total_price'=>0,
                'discount_code' => $orderData['discount_code'] ?? null,
                'order_status' => OrderStatusEnum::Pending->value,
            ]);
            $this->createOrderItems($orderData['items'],$order);
            $this->updateOrderTotal($order);
        });
    }
    public function createOrderItems($items,$order){
        foreach ($items as $itemData) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $itemData['product_id'],
                'unit_price' => $itemData['unit_price'],
            ]);
        }
    }
    public function updateOrderTotal($order)
    {
        $order->update(['total_price' =>$order->service()->calculateTotalPrice()]);
    }
}
