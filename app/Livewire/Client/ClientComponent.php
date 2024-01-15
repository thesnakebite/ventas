<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Clientes')]
class ClientComponent extends Component
{
    use WithPagination;

    // Propiedades clase
    public $search= '';
    public $totalRegistros= 0;
    public $cant= 5;

    // Propiedades modelo
    public $Id;
    public $name;
    public $identification;
    public $phone;
    public $email;
    public $company;
    public $cif;

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

    public function create()
    {
        $this->Id= 0;
        $this->clean();
        
        $this->dispatch('open-modal', 'modalClient');
    }

    public function clean()
    {
        $this->reset(['name']);
        $this->resetErrorBag();
    }
}
