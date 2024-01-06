<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

#[Title('Productos')]
class ProductComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
     // Propiedades clase
    public $search = '';
    public $totalRegistros= 0;
    public $cant= 5;

    // Propiedades modelo
    public $Id= 0;
    public $name;
    public $category_id;
    public $description;
    public $purchase_price;
    public $sale_price;
    public $barcode;
    public $stock= 0;
    public $minimum_stock= 10;
    public $date_expired;
    public $active= 1;
    public $image;
    public $imageModel;

    public function render()
    {
        $this->totalRegistros= Product::count();

        $products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate( $this->cant );

        return view('livewire.product.product-component', [
            'products' => $products
        ]);
    }

    #[Computed('products')]
    public function categories()
    {
        return Category::all();
    }

    public function create()
    {
        $this->Id= 0;

        $this->clean();
        $this->dispatch('open-modal', 'modalProduct');
    }

    // Crea productos
    public function store()
    {
        // dump('Crear pelicanos');
        $rules = [
            'name' => 'required|min:5|max:255|unique:products',
            'description' => 'max:255',
            'purchase_price' => 'numeric|nullable',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric',
            'minimum_stock' => 'numeric|nullable',
            'image' => 'image|max:1024|nullable',
            'category_id' => 'required|numeric',
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos 5 caracteres',
            'name.max' => 'El nombre debe tener máximo 255 caracteres',
            'name.unique' => 'El nombre ya existe',
            'sale_price.required' => 'El precio de venta es requerido',
            'sale_price.numeric' => 'El precio de venta debe ser numérico',
            'category_id.required' => 'La categoría es requerida',
            'category_id.numeric' => 'La categoría debe ser numérica',
        ];

        $this->validate($rules, $messages);

        $product= new Product();

        $product->name = $this->name;
        $product->description = $this->description;
        $product->purchase_price = $this->purchase_price;
        $product->sale_price = $this->sale_price;
        $product->stock = $this->stock;
        $product->minimum_stock = $this->minimum_stock;
        $product->barcode = $this->barcode;
        $product->date_expired = $this->date_expired;
        $product->category_id = $this->category_id;
        $product->active = $this->active;
        $product->save();

        if ($this->image) {
            $customImage = 'products/' . uniqid() . '.' . $this->image->extension();
            $this->image->storeAs('public', $customImage);
            $product->image()->create([
                'url' => $customImage,
            ]);
        }

        $this->dispatch('close-modal', 'modalProduct');
        $this->dispatch('msg', 'Producto creado con éxito');

        $this->clean();
    }

    public function edit(Product $product)
    {
        $this->clean();

        $this->Id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->purchase_price = $product->purchase_price;
        $this->sale_price = $product->sale_price;
        $this->stock = $product->stock;
        $this->minimum_stock = $product->minimum_stock;
        $this->imageModel = $product->image;
        $this->barcode = $product->barcode;
        $this->date_expired = $product->date_expired;
        $this->active = $product->active;
        $this->category_id = $product->category_id;

        $this->dispatch('open-modal', 'modalProduct');

        // dump($category);
    }

    public function update(Product $product)
    {
        // dump('Actualizar pelicanos');

        $rules = [
            'name' => 'required|min:5|max:255|unique:products,id,'. $this->Id,
            'description' => 'max:255',
            'purchase_price' => 'numeric|nullable',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric',
            'minimum_stock' => 'numeric|nullable',
            'image' => 'image|max:1024|nullable',
            'category_id' => 'required|numeric',
        ];

        $messages = [
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener al menos 5 caracteres',
            'name.max' => 'El nombre debe tener máximo 255 caracteres',
            'name.unique' => 'El nombre ya existe',
            'description.max' => 'La descripción debe tener máximo 255 caracteres',
            'purchase_price.numeric' => 'El precio de compra debe ser numérico',
            'sale_price.required' => 'El precio de venta es requerido',
            'sale_price.numeric' => 'El precio de venta debe ser numérico',
            'stock.required' => 'El stock es requerido',
            'stock.numeric' => 'El stock debe ser numérico',
            'minimum_stock.numeric' => 'El stock mínimo debe ser numérico',
            'image.image' => 'La imagen debe ser de tipo imagen',
            'image.max' => 'La imagen debe tener máximo 1024 KB',
            'category_id.required' => 'La categoría es requerida',
            'category_id.numeric' => 'La categoría debe ser numérica',
        ];

        $this->validate($rules, $messages);

        $product->name = $this->name;
        $product->description = $this->description;
        $product->purchase_price = $this->purchase_price;
        $product->sale_price = $this->sale_price;
        $product->stock = $this->stock;
        $product->minimum_stock = $this->minimum_stock;
        // $product->image = $this->imageModel;
        $product->barcode = $this->barcode;
        $product->date_expired = $this->date_expired;
        $product->active= $this->active;
        $product->category_id = $this->category_id;

        $product->update();

        $this->dispatch('close-modal', 'modalProduct');
        $this->dispatch('msg', 'Producto actualizado con éxito');

        $this->clean();
    }

    public function clean()
    {
        $this->reset([
            'Id',
            'name',
            'description',
            'purchase_price',
            'sale_price',
            'stock',
            'minimum_stock',
            'barcode',
            'date_expired',
            'category_id',
            'active',
            'image',
        ]);
        $this->resetErrorBag();
    }
}
