<?php

namespace App\Livewire\Sale;

use Livewire\Component;
use Livewire\Attributes\Title;

class SaleCreate extends Component
{
    #[Title('Ventas')]
    public function render()
    {
        return view('livewire.sale.sale-create');
    }
}
