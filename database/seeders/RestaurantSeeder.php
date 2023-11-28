<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = config("restaurantsDB");

        foreach ($restaurants as $index => $restaurant) {
            $newRestaurant = new Restaurant();
            $newRestaurant->user_id = $index + 1;
            $newRestaurant->name = $restaurant['name'];
            $newRestaurant->address = $restaurant['address'];
            $newRestaurant->photo = $restaurant['photo'];
            $newRestaurant->save();
        }
    }
}
