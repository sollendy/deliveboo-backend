<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DishValidation;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $restaurant = Restaurant::where("user_id", $user_id)->with("dishes")->get();
        return view("admin.restaurant.index", compact("restaurant"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.restaurant.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DishValidation $request)
    {

        $newDish = new Dish ();

        $data = $request->validated();
        $newDish->fill($data);

        $newDish->restaurant_id = $request->input('restaurant_id');

        $newDish->save();

        return redirect()->route('admin.restaurant.index')->with('Success','Dish created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(restaurant $restaurant)
    {
        //
    }
}
