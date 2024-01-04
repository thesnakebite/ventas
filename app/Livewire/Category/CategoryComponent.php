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
    public $search = '';
    public $totalRegistros= 0;
    public $cant= 5;

    // Propiedades modelo
    public $name;
    public $Id;

    public function render()
    {
        if($this->search != ''){
            $this->resetPage();
        }
        
        $this->totalRegistros = Category::count();

        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate( $this->cant );

        return view('livewire.category.category-component', [
            'categories' => $categories
        ]);
    }

    public function mount()
    {

    }

    public function create()
    {
        $this->reset(['name']);
        $this->resetErrorBag();
        $this->dispatch('open-modal', 'modalCategory');
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

    public function edit(Category $category)
    {
        $this->Id = $category->id;
        $this->name = $category->name;

        $this->dispatch('open-modal', 'modalCategory');

        // dump($category);
    }

    public function update(Category $category)
    {
        // dump($category);
        $rules = [
            'name' => 'required|min:5|max:255|unique:categories,id,'. $this->Id
        ];

        $message = [
            'name.required' => 'El nombre de la categoría es requerido',
            'name.min' => 'El nombre de la categoría debe tener al menos 5 caracteres',
            'name.max' => 'El nombre de la categoría debe tener máximo 255 caracteres',
            'name.unique' => 'El nombre de la categoría ya existe'
        ];

        $this->validate($rules, $message);

        $category->name = $this->name;
        $category->update();

        $this->dispatch('close-modal', 'modalCategory');
        $this->dispatch('msg', 'Categoría actualizada con éxito');

        $this->reset(['name']);
    }
}
