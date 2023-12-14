<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $restaurants = Restaurant::where("user_id", $user_id)->with(["types", "dishes"])->get();
        $orders = [];
        $idAdded = [];
       //Non avendo implementato ID del ristorante da cui si ordina in front-end,
       //recupero tutti i piatti del mio ristorante
       //e di loro gli ordini associati
       //salvo quell'ordine nell'array degli ordini, se non l'ho già aggiunto precedentemente per altri piatti
        foreach ($restaurants[0]->dishes as $dish) {
            $ordersOfDish = $dish->orders()->with('dishes')->orderBy('created_at', 'desc')->get();
            foreach($ordersOfDish as $orderOfDish) {
                if (!in_array($orderOfDish->id, $idAdded)) {
                array_push($orders, $orderOfDish);
                array_push($idAdded, $orderOfDish->id);
                }
            }
        }


        return view('admin.restaurant.orders', compact('restaurants', 'orders'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        //
    }
}
