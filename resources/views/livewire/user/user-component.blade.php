<div>
    <div>
        <x-card cardTitle="Listado categorias ({{ $this->totalRegistros }})">
           <x-slot:cardTools>
              <a href="#" class="btn btn-primary" wire:click='create'>
                <i class="fas fa-plus-circle"></i> Crear 
              </a>
           </x-slot>
    
           <x-table>
              <x-slot:thead>
                 <th>ID</th>
                 <th>Nombre</th>
                 <th width="3%">...</th>
                 <th width="3%">...</th>
                 <th width="3%">...</th>
     
              </x-slot>
    
              @forelse ($users as $user)
                  
                 <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <a href="#" class="btn btn-success btn-sm" title="Ver">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm" title="Editar">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-danger btn-sm" title="Eliminar">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                 </tr>
    
                 @empty
    
                 <tr class="text-center">
                    <td colspan="5">Sin registros</td>
                 </tr>
                  
                 @endforelse
     
           </x-table>
     
           <x-slot:cardFooter>

           {{ $users->links() }}
    
           </x-slot>
        </x-card>
    
    
     <x-modal modalId="modalItem" modalTitle="Items">
        <form wire:submit={{$Id==0 ? "store" : "update($Id)"}}>
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Nombre:</label>
                    <input wire:model='name' type="text" class="form-control" placeholder="Nombre" id="name">
                    @error('name')
                        <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <hr>
            <button class="btn btn-primary float-right">{{ $Id==0 ? 'Guardar' : 'Editar' }}</button>    
        </form>
     </x-modal>
    
    </div>
    
</div>
