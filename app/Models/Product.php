<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;

    // Relación polimórficas image
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    // Atributos
    protected function stockLabel() : Attribute
    {
        return Attribute::make(
            get: function() {
                return $this->attributes['stock'] >= $this->attributes['minimum_stock']
                ?
                '<span class="badge badge-success">' . $this->attributes['stock'] . '</span>'
                :
                '<span class="badge badge-danger">' . $this->attributes['stock'] . '</span>'
                ;
            }
        );
    }
}
