<div>
    <x-layout.header title="Construir" />
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-buttons.big>
            <div class="flex-none p-4">
                <x-mary-icon name="fas.object-group" class="h-20"/>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold">Preparar área para plantio</h3>
            </div>
        </x-buttons.big>
        @foreach ($productions as $production)
        <x-buttons.big>
            <div class="flex-none p-4">
                <img src="{{ $production->images[0] }}" alt="{{ $production->name }}"
                                class="w-20 object-cover">
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold">{{ $production->name }}</h3>
            </div>
        </x-buttons.big> 
        @endforeach
    </div>
</div>
