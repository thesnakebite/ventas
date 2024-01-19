<?php

namespace App\Livewire\Sale;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

class SaleCreate extends Component
{

    // Propiedades clase
    public $search= '';
    public $cant= 5;
    public $totalRegistros= 0;

    #[Title('Ventas')]
    public function render()
    {
        if($this->search!= ''){
            $this->resetPage();
        }

        $this->totalRegistros = Product::count();

        $products= Product::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);

        return view('livewire.sale.sale-create', [
            'products' => $products
        ]);
    }


}
