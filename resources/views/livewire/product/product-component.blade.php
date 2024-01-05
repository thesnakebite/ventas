<div>
    <x-card cardTitle="Listado productos {{ $this->totalRegistros }}" 
    >
        <x-slot:cardTools>
            <a 
                wire:click='create'
                href="#" 
                class="btn btn-success"
            >
                <i class="fas fa-plus-circle mr-1"></i>
                Crear producto
            </a>
        </x-slot>

            <x-table>
                <x-slot:thead>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio venta</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th width="3%">....</th>
                    <th width="3%">....</th>
                    <th width="3%">....</th>

                </x-slot>
                    @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->image }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sale_price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->category_id }}</td>
                        <td>Active</td>

                        <td>{{ $product->name }}</td>
                        <td>
                            <a href="{{ route('products.show', $product) }}" 
                               class="btn btn-outline-light btn-sm" 
                               title="Ver"
                            >
                            <i class="fas fa-solid fa-eye"></i>
                            </a>
                        </td>
                        <td>
                            <a wire:click='edit( {{ $product->id }} )' 
                               href="#"
                               class="btn btn-outline-primary btn-sm" 
                               title="Editar"
                            >
                            <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a wire:click="$dispatch('delete', {id: {{ $product->id }}, 
                                eventName:'destroyProduct'})"
                               class="btn btn-outline-danger btn-sm"
                               title="Eliminar"
                            >
                            <i class="fas fa-trash-alt"></i>
                                
                            </a>
                        </td>
                    </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="10" class="text-warning">Sin registros !!</td>
                        </tr>
                    @endforelse
            </x-table>
            <x-slot:cardFooter>
                {{ $products->links() }}
            </x-slot>
    </x-card>

    {{-- <x-modal modalId="modalCategory" modalTitle="Categorías"  >
        <form wire:submit={{ $Id==0 ? "store" : "update($Id)" }}>
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Nombre:</label>
                    <input 
                        wire:model="name"
                        type="text" 
                        id="name"
                        class="form-control" 
                        placeholder="Nombre categoría" 
                    />
                    @error('name')
                        <div class="alert alert-danger w-100 mt-3 text-sm">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button class="btn btn-primary float-right mt-3">{{ $Id==0 ? 'Guardar' : 'Editar' }}</button>
        </form>
    </x-modal> --}}
</div>
