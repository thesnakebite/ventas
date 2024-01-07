<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Categorías')]
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
        $this->Id = 0;

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

    #[On('destroyCategory')]
    public function destroy($id)
    {
        // dump('Eliminar categoría'). $id;
        $category = Category::findOrfail($id);
        $category->delete();

        $this->dispatch('msg', 'Categoría eliminada con éxito');
    }
}
