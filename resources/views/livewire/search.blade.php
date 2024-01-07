<div>
    <form action="simple-results.html">
        <div class="input-group">
            <input 
                wire:model.live='search'
                type="search" 
                class="form-control" 
                placeholder="Buscar Producto..."
            />
            <div class="input-group-append">
                <button wire:click.prevent  class="btn btn-default">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <ul class="list-group" id="list-search">
        @foreach ($products as $product)
        <li class="list-group-item">
            <h5>
                Imagen
                Nombre producto
            </h5>
            <div class="d-flex justify-content-between">
                <div>
                    Precio venta:
                    <span class="badge badge-pill badge-info ">
                        $ 9.00
                    </span>
                </div>
                <div>
                    Stock: 10
                </div>
            </div>
        </li>
        @endforeach
        
    </ul>
</div>
