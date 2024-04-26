<?php

namespace Database\Seeders\Order;

use App\Models\Orders\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 100 orders
        Order::factory()->count(200)->create();
    }
}
