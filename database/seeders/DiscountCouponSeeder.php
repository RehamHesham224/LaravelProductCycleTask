<?php

namespace Database\Seeders;

use App\Models\DiscountCoupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiscountCouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ramadanCoupon = [
            'code' => 'RAMADAN15',
            'discount_percentage' => 15.00,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
        ];

        DiscountCoupon::firstOrCreate(
            ['code' => $ramadanCoupon['code']],
            $ramadanCoupon
        );
    }
}
