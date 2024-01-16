<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

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

    public function store()
    {
        $rules = [
            'name' => 'required|min:5|max:255',
            'identification' => 'required|max:15|unique:clients',
            'email' => 'required|email|nullable',
            'phone' => 'required|numeric',

        ];

        $message = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos 5 caracteres',
            'name.max' => 'El nombre debe tener como máximo 255 caracteres',
            'identification.required' => 'La identificación es requerida',
            'identification.max' => 'La identificación debe tener como máximo 15 caracteres',
            'identification.unique' => 'El identificador ya existe',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es válido',
            'phone.required' => 'El teléfono es requerido',
            'phone.number' => 'El teléfono no es válido',
        ];

        $this->validate($rules, $message);

        $client = new Client;
        $client->name = $this->name;
        $client->identification = $this->identification;
        $client->phone = $this->phone;
        $client->email = $this->email;
        $client->company = $this->company;
        $client->cif = $this->cif;

        $client->save();

        $this->dispatch('close-modal', 'modalClient');
        $this->dispatch('msg', 'Cliente creado correctamente');

        $this->clean();
    }

    public function edit(Client $client)
    {
        $this->clean();

        $this->Id= $client->id;
        $this->name= $client->name;
        $this->identification= $client->identification;
        $this->phone= $client->phone;
        $this->email= $client->email;
        $this->company= $client->company;
        $this->cif= $client->cif;

        $this->dispatch('open-modal', 'modalClient');
    }


    public function update(Client $client)
    {
        $rules = [
            'name' => 'required|min:5|max:255',
            'identification' => 'required|max:15|unique:clients,id,' . $this->Id,
            'email' => 'required|email|nullable',
            'phone' => 'required|numeric',

        ];

        $message = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos 5 caracteres',
            'name.max' => 'El nombre debe tener como máximo 255 caracteres',
            'identification.required' => 'La identificación es requerida',
            'identification.max' => 'La identificación debe tener como máximo 15 caracteres',
            'identification.unique' => 'El identificador ya existe',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es válido',
            'phone.required' => 'El teléfono es requerido',
            'phone.number' => 'El teléfono no es válido',
        ];

        $this->validate($rules, $message);

        $client->name = $this->name;
        $client->identification = $this->identification;
        $client->phone = $this->phone;
        $client->email = $this->email;
        $client->company = $this->company;
        $client->cif = $this->cif; 
        $client->update();

        $this->dispatch('close-modal', 'modalClient');
        $this->dispatch('msg', 'Cliente actualizado correctamente');

        $this->clean();
    }

    #[On('destroyClient')]
    public function destroy($id)
    {
        $client= Client::findOrFail($id);
        $client->delete();

        $this->dispatch('msg', 'Cliente eliminado correctamente');
    }

    public function clean()
    {
        $this->reset([
            'Id',
            'name', 
            'identification', 
            'phone', 
            'email', 
            'company', 
            'cif'
        ]);

        $this->resetErrorBag();
    }
}
