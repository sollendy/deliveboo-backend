<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = config("ordersData");

        foreach ($orders as $order) {
            $newOrder = new Order();
            $newOrder->name = $order['name'];
            $newOrder->last_name = $order['last_name'];
            $newOrder->address = $order['address'];
            $newOrder->phone = $order['phone'];
            $newOrder->status = rand(0,1);
            $newOrder->total_price = $order['total_price'];
            $newOrder->save();




        }
    }
}
