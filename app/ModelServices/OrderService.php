<?php

namespace App\ModelServices;

use App\Support\ModelServices\ModelService;

class OrderService extends ModelService
{
    public function calculateTotalPrice()
    {
        $total = $this->model?->items->sum(function ($item) {
            return $item->unit_price;
        });
        if ($this->model?->discountCoupon && $this->model?->discountCoupon->isValid()) {
            $discount = $this->calculateDiscount($total, $this->model->discountCoupon->discount_percentage);
            $total -= $discount;
        }
        return $total;
    }
    public function calculateDiscount($total, $discount_percentage){
        return $total * ($discount_percentage / 100);
    }

}
