<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DishValidation;
use App\Http\Requests\UpdateDishValidation;

class DishController extends Controller
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
        if ($request->has('visible')) {
            $newDish->visible = 1;
        }
        else {
            $newDish->visible = 0;
        }
        $user_id = Auth::user()->id;
        $restaurant = Restaurant::where("user_id", $user_id)->first();
        $newDish->restaurant_id = $restaurant->id;

        $newDish->save();

        return redirect()->route('admin.restaurant.index')->with('created',$newDish->name);

    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $restaurant_id = Auth::user()->id;
        $dish = Dish::where('id', $id)->where('restaurant_id', $restaurant_id)->firstOrFail();
        return view("admin.restaurant.edit", compact("dish", "restaurant_id"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishValidation $request, $id)
    {
        $data = $request->all();
        $dish = Dish::findOrFail($id);

        if ($request->has('visible')) {
            $dish->visible = 1;
        }
        else {
            $dish->visible = 0;
        }

        $dish->update($data);
        return redirect()->route('admin.restaurant.index')->with('update',  $dish->name);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dish = Dish::findOrFail($id);
        $dish->delete();

        return redirect()->route('admin.restaurant.index')->with('delete', $dish->name);
    }
}
