<x-modal modalId="modalClient" modalTitle="Clientes">
    <form wire:submit={{$Id==0 ? "store" : "update($Id)"}}>
        <div class="form-row">
            {{-- Input name --}}
            <div class="form-group col-md-6">
                <label for="name">Nombre:</label>
                <input wire:model='name' 
                       type="text" 
                       class="form-control" 
                       placeholder="Nombre" 
                       id="name"
                >
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Input Identification --}}
            <div class="form-group col-md-6">
                <label for="identification">Identificación:</label>
                <input wire:model="identification" 
                       type="text" 
                       class="form-control" 
                       placeholder="Identificación" 
                       id="identification"
                >
                @error('identification')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group col-md-6">
                <label for="email">E-Mail:</label>
                <input wire:model="email" 
                       type="email" 
                       class="form-control" 
                       placeholder="E-Mail" 
                       id="email"
                >
                @error('email')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Phone --}}
            <div class="form-group col-md-6">
                <label for="phone">Teléfono:</label>
                <input wire:model="phone" 
                       type="text" 
                       class="form-control" 
                       placeholder="Teléfono" 
                       id="phone"
                >
                @error('phone')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- Company --}}
            <div class="form-group col-md-6">
                <label for="company">Empresa:</label>
                <input wire:model="company" 
                       type="text" 
                       class="form-control" 
                       placeholder="Empresa" 
                       id="company"
                >
                @error('company')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>

            {{-- CIF --}}
            <div class="form-group col-md-6">
                <label for="cif">CIF:</label>
                <input wire:model="cif" 
                       type="text" 
                       class="form-control" 
                       placeholder="CIF" 
                       id="cif"
                >
                @error('cif')
                    <div class="alert alert-danger w-100 mt-2">{{$message}}</div>
                @enderror
            </div>


        </div>
        
        <hr>
        <button class="btn btn-primary float-right">{{$Id==0 ? 'Guardar' : 'Editar'}}</button>    
    </form>
 </x-modal>