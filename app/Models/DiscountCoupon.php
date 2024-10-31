<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCoupon extends Model
{
    protected $fillable = ['code', 'discount_percentage', 'start_date', 'end_date'];

    public function isValid()
    {
        $today = now();
        return $this->start_date <= $today && $this->end_date >= $today;
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'discount_code');
    }
}
