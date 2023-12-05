<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        return response()->json([
            'success'=>true,
            'results'=>$restaurants,
        ]);
    }

    public function typologies(){
        
        $typologies = Type::all();

        return response()->json([
            'success' => true,
            'results' => $typologies,
        ]);
    }
}
