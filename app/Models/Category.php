<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded= [];

    // Una categoría pertenece a muchos productos
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
