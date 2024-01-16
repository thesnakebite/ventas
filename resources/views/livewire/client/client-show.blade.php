<div>
    <x-card cardTitle="Detalles cliente" 
    >
        <x-slot:cardTools>
            <a href="{{ route('clients') }}" class="btn btn-primary">
                <i class="fas fa-arrow-circle-left mr-1"></i>
                Regresar
            </a>
        </x-slot>
        <div class="row">
            <div class="col-md-4">
                {{-- Imasgen --}}
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        
                        <h2 class="profile-username text-center">
                            {{ $client->name }}
                        </h2>
                       
                        <ul class="list-group mb-3">
                            <li class="list-group-item">
                                <b>Identificación</b>
                                <a class="float-right">
                                    {{ $client->identification }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>E-mail</b>
                                <a class="float-right">
                                    {{ $client->email }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>Teléfono</b>
                                <a class="float-right">
                                    {{ $client->phone }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>Empresa</b>
                                <a class="float-right">
                                    {{ $client->company }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>NIF</b>
                                <a class="float-right">
                                    {{ $client->nif }}
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>Creado</b>
                                <a class="float-right">
                                    {{ $client->created_at }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Precio venta</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($user as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <x-image :item="$item" />
                                </td>
                                <td>{{ $item->name }}</td>
                                <td class="font-weight-bold">{{  $item->price  }}</td>
                                <td>{!! $item->stockLabel !!}</td>
                            </tr>
                        @endforeach --}}
                        
                    </tbody>
                </table>
            </div>
        </div>
    </x-card>
</div>
