<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;

class DishOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order = Order::find(1);
        $order->dishes()->sync([1, 10]);

         $order = Order::find(2);
        $order->dishes()->sync([6,8]);

        $order = Order::find(3);
        $order->dishes()->sync([7]);

        $order = Order::find(4);
        $order->dishes()->sync([3,4]);

        $order = Order::find(5);
        $order->dishes()->sync([2]);

        $order = Order::find(6);
        $order->dishes()->sync([3,4,5]);
    }
}
