<div>
    <x-card cardTitle="Detalles categoría" 
    >
        <x-slot:cardTools>
            <a href="{{ route('categories') }}" class="btn btn-primary">
                <i class="fas fa-arrow-circle-left mr-1"></i>
                Regresar
            </a>
        </x-slot>
        
        @dump($category)
    </x-card>
</div>
