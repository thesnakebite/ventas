<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Productos')]
class ProductComponent extends Component
{
     // Propiedades clase
    public $search = '';
    public $totalRegistros= 0;
    public $cant= 5;

    // Propiedades modelo
    public $Id= 0;
    public $name;
    public $category_id;
    public $description;
    public $purchase_price;
    public $sale_price;
    public $barcode;
    public $stock= 10;
    public $minimum_stock;
    public $date_expired;
    public $active= 1;
    public $image;


    public function render()
    {
        $this->totalRegistros= Product::count();

        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate( $this->cant );

        return view('livewire.product.product-component', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $this->Id = 0;

        $this->reset(['name']);
        $this->resetErrorBag();
        $this->dispatch('open-modal', 'modalProduct');
    }

    // Crea productos
    public function store()
    {
        // dump('Crear pelicanos');
        $rules = [
            'name' => 'required|min:5|max:255|unique:products',
            'description' => 'max:255',
            'purchase_price' => 'numeric|nullable',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric',
            'minimum_stock' => 'numeric|nullable',
            'image' => 'image|max:1024|nullable',
            'category_id' => 'required|numeric',
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos 5 caracteres',
            'name.max' => 'El nombre debe tener máximo 255 caracteres',
            'name.unique' => 'El nombre ya existe',
            'sale_price.required' => 'El precio de venta es requerido',
            'sale_price.numeric' => 'El precio de venta debe ser numérico',
            'category_id.required' => 'La categoría es requerida',
            'category_id.numeric' => 'La categoría debe ser numérica',
        ];

        $this->validate($rules, $messages);
    }
}
