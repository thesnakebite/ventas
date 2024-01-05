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
    public $name;
    public $Id;

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
}
