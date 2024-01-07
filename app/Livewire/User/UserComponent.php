<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

#[Title('Usuarios')]
class UserComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Propiedades clase
    public $search = '';
    public $totalRegistros= 0;
    public $cant= 5;

    // Propiedades modelo
    public $name;
    public $Id;

    public function render()
    {
        $this->totalRegistros = User::count();

        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate( $this->cant );

        return view('livewire.user.user-component', [
            'users' => $users
        ]);
    }
}
