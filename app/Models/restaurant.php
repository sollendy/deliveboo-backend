<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    public function dishes() {
        return $this->hasMany(Dish::class);
    }
    public function types() {
        return $this->belongsToMany(Type::class);
    }
}
