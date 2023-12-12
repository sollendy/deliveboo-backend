<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GuestController;
use App\Http\Controllers\PaymentController;
// use App\Models\Dish;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/restaurants", [GuestController::class, 'index'])->name('restaurant.index');
Route::get("/types", [GuestController::class, 'typologies'])->name('typologies.index');
Route::get("/restaurant/{restaurantId}/dishes", [GuestController::class, 'dishesRestaurant'])->name('dishes.show');
Route::get("/restaurant/{restaurantId}", [GuestController::class, 'infoRestaurant'])->name('restaurant.show');

//PAYMENTS

Route::get('/payment/initialize/', [PaymentController::class, 'initialize']);
Route::post('/payment/process/', [PaymentController::class, 'process']);

    // Route::get('/posts', [ApiPostController::class, 'index'])->name('api.posts.index');
    // Route::get('/posts/{post}', [ApiPostController::class, 'show'])->name('api.posts.show');
    // Route::post('/contact-form', [ApiLeadController::class, 'store'])->name('api.contact-form');
// Route::get('/posts', [ ApiPostController::class, 'index' ])->name('api.posts.index');
