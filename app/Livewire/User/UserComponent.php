<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
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
    public $re_password;
    // Por defecto establecemos el valor true al Administrador y Activo
    public $admin = true;
    public $active = true;
    public $image;
    public $imageModel;

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

    // Crear usuario
    public function store()
    {
        $rules = [
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
            're_password' => 'required|same:password',
            'image' => 'image|max:1024|nullable',
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos 5 caracteres',
            'name.max' => 'El nombre debe tener máximo 255 caracteres',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email debe ser válido',
            'email.unique' => 'El email ya existe',
            'password.required' => 'La contraseña es requerida',
            'password.same' => 'Las contraseñas no coinciden',
            're_password.required' => 'La confirmación de contraseña es requerida',
            're_password.min' => 'La confirmación de contraseña debe tener al menos 5 caracteres',
            're_password.same' => 'Las contraseñas no coinciden',
            'image.image' => 'El archivo debe ser una imagen',
            'image.max' => 'El archivo debe tener máximo 1MB',
        ];

        $this->validate($rules, $messages);

        $user = new User();
        $user->name= $this->name;
        $user->email= $this->email;
        $user->password= bcrypt($this->password);
        // $user->re_password= bcrypt($this->re_password);
        $user->admin= $this->admin;
        $user->active= $this->active;
        $user->save();

        if($this->image) {
            $customImage = 'users/' . uniqid() . '.' . $this->image->extension();
            $this->image->storeAs('public', $customImage);
            $user->image()->create(['url' => $customImage]);
        }

        $this->dispatch('close-modal', 'modalUser');
        $this->dispatch('msg', 'Usuario creado correctamente');
        $this->clean();
    }

    public function edit(User $user)
    {
        $this->clean();

        $this->Id= $user->id;
        $this->name= $user->name;
        $this->email= $user->email;
        $this->admin= $user->admin ? true : false;
        $this->active= $user->active ? true : false;
        $this->imageModel= $user->image ? $user->image->url : null;

        $this->dispatch('open-modal', 'modalUser');
    }

    public function update(User $user)
    {
        $rules = [
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|unique:users,id,'. $this->Id,
            'password' => 'min:5|nullable',
            're_password' => 'same:password|nullable',
            'image' => 'image|max:1024|nullable',
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos 5 caracteres',
            'name.max' => 'El nombre debe tener máximo 255 caracteres',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email debe ser válido',
            'email.unique' => 'El email ya existe',
            'password.required' => 'La contraseña es requerida',
            'password.same' => 'Las contraseñas no coinciden',
            're_password.required' => 'La confirmación de contraseña es requerida',
            're_password.min' => 'La confirmación de contraseña debe tener al menos 5 caracteres',
            're_password.same' => 'Las contraseñas no coinciden',
            'image.image' => 'El archivo debe ser una imagen',
            'image.max' => 'El archivo debe tener máximo 1MB',
        ];

        $this->validate($rules, $messages);

        $user->name= $this->name;
        $user->email= $this->email;
        $user->admin = $this->admin;
        $user->active = $this->active;

        $user->update();

        if($this->image) {
            if($user->image!= null) {
                Storage::delete('public/' . $user->image->url);
                $user->image()->delete();
            }

            $customImage = 'users/' . uniqid() . '.' . $this->image->extension();
            $this->image->storeAs('public', $customImage);
            $user->image()->create(['url' => $customImage]);
        }

        $this->dispatch('close-modal', 'modalUser');
        $this->dispatch('msg', 'Usuario actualizado correctamente');

        $this->clean();
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
