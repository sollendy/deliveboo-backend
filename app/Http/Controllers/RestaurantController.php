<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Type;
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
        $restaurant = Restaurant::where("user_id", $user_id)->with(["dishes" => function ($query) {
            $query->orderBy("name", "asc");
        }])->get();
        return view("admin.restaurant.index", compact("restaurant"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view("admin.restaurant.create", compact("types"));
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
        $newRestaurant->types()->attach($request->types);
        Auth::login($newUser);
        return redirect()->route('admin.restaurant.index');







    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user_id = Auth::user()->id;
        $restaurants = Restaurant::where("user_id", $user_id)->with("types")->get();
        return view('admin.restaurant.dashboard', compact("user_id","restaurants"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $restaurants = Restaurant::where("user_id", $user_id)->with("types")->get();
        // dd($restaurants[0]->types());
        $list_types = Type::all();
        return view('admin.restaurant.editAccount', compact("user_id","restaurants","list_types"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
            $request->validate([
                'name' => 'required|min:5|max:100',
                'address' => 'required',
                'piva' => 'required|min:20',
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'types' => 'array',
            ]);

            $restaurant = Restaurant::findOrFail($id);

            $restaurant->name = $request->input('name');
            $restaurant->address = $request->input('address');
            $restaurant->piva = $request->input('piva');

            if ($request->hasFile('photo')) {
                $photoPath = asset('storage') . '/' . Storage::disk('public')->put('uploads', $request->file('photo'));
                $restaurant->photo = $photoPath;
            }

            $restaurant->save();

            $restaurant->types()->sync($request->input('types', []));

            return redirect()->route('admin.restaurant.show', $id)->with('success', 'Profilo aggiornato con successo!');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

    }
}
