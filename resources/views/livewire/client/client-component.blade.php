<div>
    <x-card cardTitle="Listado clientes ({{ $this->totalRegistros }})">
       <x-slot:cardTools>
          <a href="#" class="btn btn-primary" wire:click='create'>
            <i class="fas fa-plus-circle"></i> Crear cliente
          </a>
       </x-slot>

       <x-table>
          <x-slot:thead>
             <th>ID</th>
             <th>Nombre</th>
             <th>Identificación</th>
             <th>E-Mail</th>
             <th>Teléfono</th>
             <th width="3%">...</th>
             <th width="3%">...</th>
             <th width="3%">...</th>
 
          </x-slot>

          @forelse ($clients as $client)
              
             <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->identification }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->email }}</td>

                <td>
                    <a href="{{ route('clients.show', $client) }}" class="btn btn-outline-light btn-sm" title="Ver">
                        <i class="far fa-eye"></i>
                    </a>
                </td>
                <td>
                    <a href="#" wire:click='edit({{ $client->id }})' class="btn btn-outline-primary btn-sm" title="Editar">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                <td>
                    <a wire:click="$dispatch('delete',{id: {{$client->id}}, eventName:'destroyClient'})" class="btn btn-outline-danger btn-sm" title="Eliminar">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
             </tr>

             @empty

             <tr class="text-center">
                <td colspan="8">Sin registros</td>
             </tr>
              
             @endforelse
 
       </x-table>
 
       <x-slot:cardFooter>
            {{ $clients->links() }}

       </x-slot>
    </x-card>

    {{-- Modal --}}
    @include('clients.form')
</div>
