<div>
    <x-card cardTitle="Crear venta">
        <x-slot:cardTools>
            <a href="#" class="btn btn-primary mr-2">
                <i class="fas fa-plus-circle"></i>Ir a ventas 
            </a>
            <a href="#" class="btn btn-danger">
                <i class="fas fa-trash"></i>Cancelar venta 
            </a>
        </x-slot>
        
        <x-slot:cardFooter>            
        </x-slot>

        {{-- Content --}}
        <div class="row">
            {{-- Detalles de la venta --}}
            <div class="col-md-6">

            </div>
            {{-- Listado de productos --}}
            @include('sales.list-products')
        </div>
    </x-card>
</div>
