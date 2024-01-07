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
    public $Id;
    public $name;
    public $email;
    public $password;
    public $admin;
    public $active;
    public $image;
    public $imageModel;
    public $re_password;

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

    public function create()
    {
        $this->Id= 0;
        $this->clean();
        $this->dispatch('open-modal', 'modalUser');

    }

    public function clean()
    {
        $this->reset([
            'Id',
            'name', 
            'email', 
            'password', 
            'admin', 
            'active', 
            'image', 
            'imageModel'
        ]);

        $this->resetErrorBag();
    }
}
