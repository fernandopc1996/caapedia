<div>
    <div class="overflow-x-auto">
        <div class="flex gap-4 pb-4" style="scroll-snap-type: x mandatory;">
            @foreach ($explorations as $exploration)
                <div class="min-w-[300px] max-w-xs flex-shrink-0 border rounded-lg p-4 shadow-sm relative"
                    style="scroll-snap-align: start;">
    
                    <img src="{{ $exploration->images[0] ?? '/placeholder.jpg' }}" alt="{{ $exploration->name }}"
                        class="w-full h-40 object-cover rounded mb-3">
    
                    <h3 class="text-xl font-semibold mb-1">{{ $exploration->name }}</h3>
                    <p class="text-sm text-gray-900 mb-2 text-justify">{{ $exploration->description }}</p>
    
                    @if ($exploration->source)
                        <a href="{{ $exploration->source }}" target="_blank"
                            class="block text-center w-full bg-black text-white py-1.5 rounded mb-2 text-sm font-semibold">
                            Clique aqui para detalhes
                        </a>
                    @endif
    
                    <div class="grid grid-cols-2 gap-2 text-sm mb-3">
                        <x-game.production.build-item icon="fas.clock" label="Tempo"
                            value="{{ $exploration->exploration['time'] }}h" color="gray-600" />
    
                        <x-game.production.build-item icon="fas.coins" label="Custo"
                            value="R$ {{ number_format($exploration->exploration['cost'], 2, ',', '.') }}"
                            color="yellow-600" />
    
                        <x-game.production.build-item icon="fas.tint" label="Água"
                            value="{{ $exploration->exploration['water'] }} m³" color="blue-600" />
                    </div>
    
          
                        <x-selects.character-selector-params :characters="$availableCharacters"
                            wire:model="selectedCharacter"
                            :params="['selectedExplore' => $exploration->id]" button-label="Explorar" />
      
                </div>
            @endforeach
        </div>
    </div>
</div>
