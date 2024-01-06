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

    // Un producto pertenece a una categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Atributos
    protected function stockLabel() : Attribute
    {
        return Attribute::make(
            get: function() {
                return $this->attributes['stock'] >= $this->attributes['minimum_stock']
                ?
                '<span class="badge badge-pill badge-success">' . $this->attributes['stock'] . '</span>'
                :
                '<span class="badge badge-pill badge-danger">' . $this->attributes['stock'] . '</span>'
                ;
            }
        );
    }

    protected function price() : Attribute
    {
        return Attribute::make(
            get: function() {
                $formattedPrice = number_format($this->attributes['sale_price'], 0, ',', '.');
                return $formattedPrice . '€';
            }
        );
    }

    protected function activeLabel() : Attribute
    {
        return Attribute::make(
            get: function() {
                return $this->attributes['active']
                ?
                '<span class="badge badge-success">Activo</span>'
                :
                '<span class="badge badge-warning">Inactivo</span>'
                ;
            }
        );
    }
}
