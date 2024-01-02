<?php

namespace App\Livewire\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Categorias')]

class CategoryComponent extends Component
{
    public $totalRegistros= 0;

    public function render()
    {
        return view('livewire.category.category-component');
    }

    public function mount()
    {
        $this->totalRegistros = Category::count();
    }

    // Crear la categoría
    public function store()
    {
        dump('Crear categoria');
    }
}
