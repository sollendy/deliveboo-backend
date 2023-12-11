<?php

namespace Database\Seeders;

use App\Models\Dish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dishes = config("dataDishes");

        foreach($dishes as $dish) {
            $newDish = new Dish();

            $newDish->restaurant_id = $dish["restaurant_id"];
            $newDish->name = $dish["name"];
            $newDish->description = $dish["description"];
            $newDish->ingredients = $dish["ingredients"];
            $newDish->image = $dish['image'];
            $newDish->visible = 1;
            $newDish->price = $dish["price"];
            $newDish->save();
        }
    }
}
