<?php

namespace App\Livewire\Client;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\Title;

class ClientShow extends Component
{
    public Client $client;

    #[Title('Ver cliente')]
    public function render()
    {
        return view('livewire.client.client-show');
    }
}
