<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $table = 'dishes';
    protected $fillable = ['restaurant_id','name','description','ingredients', 'price'];

    use HasFactory;
    public function restaurant() {
        return $this->belongsTo(Restaurant::class);
    }
    public function orders() {
        return $this->belongsToMany(Order::class);
    }
}