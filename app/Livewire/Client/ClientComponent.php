<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Clientes')]
class ClientComponent extends Component
{
    // Propiedades clase
    public $search= '';
    public $totalRegistros= 0;
    public $cant= 5;

    // Propiedades modelo
    public $name;
    public $Id;

    public function render()
    {
        if($this->search!= '') {
            $this->resetPage();
        }

        $this->totalRegistros = Client::count();

        $clients = Client::where('name', 'like', '%' . $this->search. '%')
            ->orderBy('id', 'desc')
            ->paginate($this->cant);

        return view('livewire.client.client-component', [
            'clients' => $clients
        ]);
    }
}
