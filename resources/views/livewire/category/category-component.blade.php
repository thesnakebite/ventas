<div>
    <x-card cardTitle="Listado categorías {{ $this->totalRegistros }}" 
    >
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalCategory">Crear categoría</a>
                </x-slot>

            <x-table>
                <x-slot:thead>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th width="3%">....</th>
                    <th width="3%">....</th>
                    <th width="3%">....</th>

                </x-slot>
                    @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="#" class="btn btn-outline-light btn-xs" title="Ver">
                                <i class="fas fa-solid fa-eye"></i>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-outline-primary btn-xs" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-outline-danger btn-xs" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="5" class="text-warning">Sin registros !!</td>
                        </tr>
                    @endforelse
            </x-table>
            <x-slot:cardFooter>
                {{ $categories->links() }}
            </x-slot>
    </x-card>

    <x-modal modalId="modalCategory" modalTitle="Categorías"  >
        <form wire:submit="store">
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

            <button class="btn btn-primary float-right mt-3">Guardar cambios</button>
        </form>
    </x-modal>
</div>
