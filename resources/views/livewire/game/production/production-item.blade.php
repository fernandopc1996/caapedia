<div class="text-gray-900">
    @if (!$production)
        <h2 class="text-3xl font-bold text-gray-900 mb-3">{{ $productionSetting->name }}</h2>
    @else
        <x-layout.header title="{{ $productionSetting->name }}" />
    @endif

    <div class="flex items-start gap-4 mb-4">
        <img src="{{ asset($productionSetting->images[0]) }}" alt="{{ $productionSetting->name }}"
            class="w-24 h-24 object-cover rounded-lg border border-gray-700">
        <div class="flex-1">
            <p class="text-sm text-gray-800 mb-2">{{ $productionSetting->description }}</p>
            <a href="{{ $productionSetting->source }}" target="_blank"
                class="text-white bg-black px-3 py-1 rounded text-sm inline-block font-semibold">
                Clique aqui para detalhes
            </a>
        </div>
    </div>

    @if (!$production)
        {{-- Construir --}}
        <h3 class="text-2xl font-semibold text-gray-900 mb-2">Construir</h3>
        <div class="mt-2 flex justify-between items-start gap-6 max-w-5xl mx-auto">
            <div class="grid md:grid-cols-2 gap-4 mx-auto">
                <div class="grid md:grid-cols-2 gap-2 text-gray-900">
                    <x-game.production.build-item icon="fas.clock" label="Tempo"
                        value="{{ $productionSetting->build['time'] }}h" color="gray-600" />
                    <x-game.production.build-item icon="fas.coins" label="Custo"
                        value="R$ {{ number_format($productionSetting->build['cost'], 2, ',', '.') }}"
                        color="yellow-600" />
                    <x-game.production.build-item icon="fas.object-group" label="Área"
                        value="{{ $productionSetting->build['area'] }} ha" color="green-600" />
                    <x-game.production.build-item icon="fas.tint" label="Água"
                        value="{{ $productionSetting->build['water'] }}h" color="blue-600" />

                    @if (!empty($productionSetting->production['products']))
                        <div class="md:col-span-2">
                            <h4 class="text-md font-medium text-gray-900 mb-1">Necessário:</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                @foreach ($productionSetting->production['products'] as $product)
                                    <x-game.production.product-item :product="$product->product" />
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
                <div>
                    <x-selects.character-selector :characters="$availableCharacters" wire:model="selectedCharacter"
                        button-label="Construir" />
                </div>
            </div>
        </div>
    @else
        {{-- Produzir --}}
        <h3 class="mt-6 text-2xl font-semibold text-gray-900 mb-2">Produzir</h3>
        <div class="mt-2 flex justify-between items-start gap-6 max-w-5xl mx-auto">
            <div class="grid md:grid-cols-2 gap-4 mx-auto">
                <div class="grid md:grid-cols-2 gap-2 text-gray-900">
                    <x-game.production.build-item icon="fas.clock" label="Tempo"
                        value="{{ $productionSetting->production['time'] }}h" color="gray-600" />
                    <x-game.production.build-item icon="fas.coins" label="Custo"
                        value="R$ {{ number_format($productionSetting->production['cost'], 2, ',', '.') }}"
                        color="yellow-600" />
                    <x-game.production.build-item icon="fas.tint" label="Água"
                        value="{{ $productionSetting->production['water'] }} m³" color="blue-600" />

                    @if (!empty($productionSetting->production['products']))
                        <div class="md:col-span-2">
                            <h4 class="text-md font-medium text-gray-900 mb-1">Produtos:</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                @foreach ($productionSetting->production['products'] as $product)
                                    <x-game.production.product-item :product="$product->product" />
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
                <div>
                    <x-selects.character-selector :characters="$availableCharacters" wire:model="selectedCharacter"
                        button-label="Produzir" />
                </div>
            </div>
        </div>

    @endif
</div>
