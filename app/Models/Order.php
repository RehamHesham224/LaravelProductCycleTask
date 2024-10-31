<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use App\Support\ModelServices\HasModelService;
use App\ModelServices\OrderService;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasModelService;

    protected string $serviceClass = OrderService::class;

    protected $fillable = ['user_id', 'order_status', 'total_price', 'discount_code'];

    protected $casts=[
        'order_status'=>OrderStatusEnum::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function discountCoupon()
    {
        return $this->belongsTo(DiscountCoupon::class, 'discount_code');
    }

}
