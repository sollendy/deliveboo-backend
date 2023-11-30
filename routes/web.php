<?php

use App\Http\Controllers\RestaurantController;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');
    Route::get('/create', [RestaurantController::class, 'create'])->name('restaurant.create');
    Route::post('/create', [RestaurantController::class, 'store'])->name('restaurant.store');
    Route::get('/edit/{id}', [RestaurantController::class, 'edit'])->name('restaurant.edit');
    Route::put('/update/{id}', [RestaurantController::class, 'update'])->name('restaurant.update');
    Route::delete('/{id}', [RestaurantController::class, 'destroy'])->name('restaurant.destroy');
});