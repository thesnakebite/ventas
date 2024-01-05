<x-modal modalId="modalProduct" modalTitle="Productos" modalSize="modal-lg"  >
    <form wire:submit={{ $Id==0 ? "store" : "update($Id)" }}>
        <div class="form-row">
            {{-- Input name --}}
            <div class="form-group col-md-7">
                <label for="name">Nombre:</label>
                <input wire:model="name"
                       type="text" 
                       id="name"
                       class="form-control" 
                       placeholder="Nombre producto" 
                />
                @error('name')
                    <div class="alert alert-danger w-100 mt-3 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Select category  --}}
            <div class="form-group col-md-5">
                <label for="category_id">Categoría:</label>
                <select wire:model="category_id"
                        id="category_id"
                        class="form-control"
                >
                    <option value="0">Seleccione</option>
                        @foreach ($this->categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                </select>
                @error('category_id')
                    <div class="alert alert-danger w-100 mt-3 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Textarea description --}}
            <div class="form-group col-md-12">
                <label for="description">Descripción:</label>
                <textarea wire:model="description"
                          rows="3"
                          type="text" 
                          id="description"
                          class="form-control" 
                          placeholder="Escriba algo" 
                >
                </textarea>
                @error('description')
                    <div class="alert alert-danger w-100 mt-3 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input purchase price --}}
            <div class="form-group col-md-4">
                <label for="purchase_price">Precio compra:</label>
                <input wire:model="purchase_price"
                       min="0"
                       step="any"
                       type="number" 
                       id="purchase_price"
                       class="form-control" 
                       placeholder="Precio de compra" 
                />
                @error('purchase_price')
                    <div class="alert alert-danger w-100 mt-3 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input sale price --}}
            <div class="form-group col-md-4">
                <label for="sale_price">Precio venta:</label>
                <input wire:model="sale_price"
                       min="0"
                       step="any"
                       type="number" 
                       id="sale_price"
                       class="form-control" 
                       placeholder="Precio de venta" 
                />
                @error('sale_price')
                    <div class="alert alert-danger w-100 mt-3 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input barcode --}}
            <div class="form-group col-md-4">
                <label for="barcode">Código de barras:</label>
                <input wire:model="barcode"
                       type="text" 
                       id="barcode"
                       class="form-control" 
                       placeholder="Código de barras" 
                />
                @error('barcode')
                    <div class="alert alert-danger w-100 mt-3 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input stock --}}
            <div class="form-group col-md-4">
                <label for="stock">Stock:</label>
                <input wire:model="stock"
                       min="0"
                       type="number" 
                       id="stock"
                       class="form-control" 
                       placeholder="Stock del producto" 
                />
                @error('stock')
                    <div class="alert alert-danger w-100 mt-3 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input stock minimum --}}
            <div class="form-group col-md-4">
                <label for="minimum_stock">Stock minimo:</label>
                <input wire:model="minimum_stock"
                       type="number" 
                       id="minimum_stock"
                       class="form-control" 
                       placeholder="Stock minimo" 
                />
                @error('minimum_stock')
                    <div class="alert alert-danger w-100 mt-3 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input date expired --}}
            <div class="form-group col-md-4">
                <label for="date_expired">Fecha de vencimiento:</label>
                <input wire:model="date_expired"
                       type="date" 
                       id="date_expired"
                       class="form-control"
                />
                @error('date_expired')
                    <div class="alert alert-danger w-100 mt-3 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Active checked --}}
            <div class="form-group col-md-3">
                <div class="icheck-primary">
                    <input wire:model="active"
                           type="checkbox" 
                           id="active" 
                           checked
                    />
                    <label for="active">¿Esta activo?</label>
                </div>
                @error('active')
                    <div class="alert alert-danger w-100 mt-3 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input image --}}
            <div class="form-group col-md-3">
                <label for="image">Imagen:</label>
                <input wire:model="image"
                       type="file" 
                       id="image"
                       accept="image/*"
                />
                @error('image')
                    <div class="alert alert-danger w-100 mt-3 text-sm">{{ $message }}</div>
                @enderror
            </div>

            {{-- Image preview --}}
            <div class="form-group col-md-6 float-rigth">
                @if ($this->image)
                    <img src="{{ $image->temporaryUrl() }}" 
                         width="100"
                         class="rounded float-right"     
                    />
                @endif
            </div>
        </div>

            <button
                wire:loading.attr='disabled'
                class="btn btn-primary float-right mt-3">
                    {{ $Id==0 ? 'Guardar' : 'Editar' }}
            </button>
    </form>
</x-modal>