<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RestaurantRequest;
use App\Http\Requests\UpdateDishValidation;

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
    public function store(RestaurantRequest $request)
    {

        //Creo prima l'user
        $newUser = new User();
        $newUser->name = $request->validated('username');
        $newUser->email = $request->validated('email');
        $newUser->password = Hash::make($request->validated('password'));
        $newUser->save();

        //Ristorante collegato all'utente
        $photoPath = asset('storage') . '/' . Storage::disk('public')->put('uploads', $request->validated('photo'));

        $newRestaurant = new Restaurant();
        $newRestaurant->user_id = $newUser->id;
        $newRestaurant->name = $request->validated('restaurant-name');
        $newRestaurant->address = $request->validated('address');
        $newRestaurant->piva = $request->validated('piva');
        $newRestaurant->photo = $photoPath;
        $newRestaurant->save();
        Auth::login($newUser);
        return redirect()->route('admin.restaurant.index');







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
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishValidation $request, $id)
    {

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

    }
}
