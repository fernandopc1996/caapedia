<div class="text-gray-900">
    <h2 class="text-3xl font-bold mb-4">Escolha o método de preparo da área</h2>

    <div class="overflow-x-auto">
        <div class="flex gap-4 pb-4" style="scroll-snap-type: x mandatory;">
            @foreach ($nativeCleaning as $method)
                <div class="min-w-[300px] max-w-xs flex-shrink-0 border rounded-lg p-4 shadow-sm relative
                    {{ $method->available ? '' : 'opacity-50 pointer-events-none' }}"
                    style="scroll-snap-align: start;">
                    
                    <img src="{{ $method->images[0] }}" alt="{{ $method->name }}"
                        class="w-full h-40 object-cover rounded mb-3">

                    <h3 class="text-xl font-semibold mb-1">{{ $method->name }}</h3>
                    <p class="text-sm text-gray-900 mb-2 text-justify">{{ $method->description }}</p>
                    <a href="{{ $method->source }}" target="_blank"
                        class="block text-center w-full bg-black text-white py-1.5 rounded mb-2 text-sm font-semibold">
                        Clique aqui para detalhes
                    </a>

                    <div class="grid grid-cols-2 gap-2 text-sm mb-3">
                        <x-game.production.build-item
                            icon="fas.clock"
                            label="Tempo"
                            value="{{ $method->execution['time'] }}h"
                            color="gray-600"
                        />
                        <x-game.production.build-item
                            icon="fas.coins"
                            label="Custo"
                            value="R$ {{ number_format(abs($method->execution['cost']), 2, ',', '.') }}"
                            color="yellow-600"
                        />
                        <x-game.production.build-item
                            icon="fas.object-group"
                            label="Área"
                            value="{{ $method->execution['area'] }} ha"
                            color="green-600"
                        />
                        <x-game.production.build-item
                            icon="fas.tint"
                            label="Água"
                            value="{{ $method->execution['water'] }} m³"
                            color="blue-600"
                        />
                    </div>

                    @if ($method->available)
                        <x-selects.character-selector-params
                            :characters="$availableCharacters"
                            wire:model="selectedCharacter"
                            :params="['native_cleaning_coid' => $method->id]"
                            button-label="Preparar área"
                        />
                    @else
                        <div class="absolute top-2 right-2 bg-gray-600 text-white text-xs px-2 py-1 rounded">
                            Indisponível
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>