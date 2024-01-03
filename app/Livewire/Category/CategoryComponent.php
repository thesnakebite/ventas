<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Categorias')]

class CategoryComponent extends Component
{
    use WithPagination;

    // Propiedades clase
    public $totalRegistros= 0;

    // Propiedades modelo
    public $name;

    public function render()
    {
        $this->totalRegistros = Category::count();

        $categories = Category::orderBy('id', 'desc')
            ->paginate(5);

        return view('livewire.category.category-component', [
            'categories' => $categories
        ]);
    }

    public function mount()
    {

    }

    // Crear la categoría
    public function store()
    {
        // dump('Crear categoria');
        $rules = [
            'name' => 'required|min:5|max:255|unique:categories'
        ];

        $message = [
            'name.required' => 'El nombre de la categoría es requerido',
            'name.min' => 'El nombre de la categoría debe tener al menos 5 caracteres',
            'name.max' => 'El nombre de la categoría debe tener máximo 255 caracteres',
            'name.unique' => 'El nombre de la categoría ya existe'
        ];

        $this->validate($rules, $message);

        $category = new Category();
        $category->name = $this->name;
        $category->save();

        $this->dispatch('close-modal', 'modalCategory');
        $this->dispatch('msg', 'Categoría creada con éxito');

        $this->reset(['name']);
    }
}
