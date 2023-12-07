<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\Type;

class GuestController extends Controller
{
    public function index(Request $request) {
        if ($request->has('search')){
            $restaurants = Restaurant::with('types')->where('name', 'LIKE', '%' . $request->search . '%')->paginate(20);
        }
        else{
            $restaurants = Restaurant::with(['types'])->paginate(20);
        }

        foreach ($restaurants as $restaurant) {
            $restaurant->makeHidden(['created_at', 'updated_at', 'user_id']);
        }
        return response()->json([
            'success'=>true,
            'results'=>$restaurants,
        ]);
    }

    public function typologies(){

        $typologies = Type::all();
        $typologies->makeHidden(['created_at', 'updated_at']);
        return response()->json([
            'success' => true,
            'types' => $typologies,
        ]);
    }

    public function dishesRestaurant($restaurantId) {
     $restaurant = Restaurant::find($restaurantId);
     $dishes = Dish::where('restaurant_id', $restaurantId)->where('visible', 1)->get();
     foreach ($dishes as $dish) {
        $dish->makeHidden(['created_at', 'updated_at']);
     }
     return response()->json([
        'success' => true,
        'restaurant' => $restaurant->name,
        'dishes' => $dishes,
    ]);



    }

    public function infoRestaurant($restaurantId) {
        $restaurant = Restaurant::with('types')->find( $restaurantId );
        return response()->json([
            'success' => true,
            'restaurant' => $restaurant
        ]);
    }
}
