<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use App\Models\Restaurant;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurant = Restaurant::find(1);
        $restaurant->types()->sync([1]);

        $restaurant = Restaurant::find(2);
        $restaurant->types()->sync([2,12]);

        $restaurant = Restaurant::find(3);
        $restaurant->types()->sync([3,6]);

        $restaurant = Restaurant::find(4);
        $restaurant->types()->sync([4,5]);

        $restaurant = Restaurant::find(5);
        $restaurant->types()->sync([1,11]);
    }
}
