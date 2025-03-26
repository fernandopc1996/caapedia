<div class="text-gray-900">
    <h2 class="text-3xl font-bold text-gray-900 mb-3">{{ $productionSetting->name }}</h2>

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

    @if (!$id)
        {{-- Construir --}}
        <h3 class="text-2xl font-semibold text-gray-900 mb-2">Construir</h3>
        <div class="mt-2 flex justify-between items-start gap-6 max-w-5xl mx-auto">
            <div class="grid md:grid-cols-2 gap-4 mx-auto">
                <div class="grid md:grid-cols-2 gap-2 text-gray-900">
                    <div class="flex flex-row md:inline-flex md:flex-col gap-1 sm:gap-0">
                        <div class="flex items-center gap-2">
                            <x-mary-icon name="fas.clock" class="h-5 text-gray-600" title="Tempo necessário" />
                            <strong>Tempo:</strong>
                        </div>
                        <span class="sm:ml-7">{{ $productionSetting->build['time'] }}h</span>
                    </div>
                    <div class="flex flex-row md:inline-flex md:flex-col gap-1 sm:gap-0">
                        <div class="flex items-center gap-2">
                            <x-mary-icon name="fas.coins" class="h-5 text-yellow-600" title="Custo total" />
                            <strong>Custo:</strong>
                        </div>
                        <span class="sm:ml-7">R$ {{ number_format($productionSetting->build['cost'], 2, ',', '.') }}</span>
                    </div>
                
                    <div class="flex flex-row md:inline-flex md:flex-col gap-1 sm:gap-0">
                        <div class="flex items-center gap-2">
                            <x-mary-icon name="fas.object-group" class="h-5 text-green-600" title="Área utilizada" />
                            <strong>Área:</strong>
                        </div>
                        <span class="sm:ml-7">{{ $productionSetting->build['area'] }} ha</span>
                    </div>
                
                    <div class="flex flex-row md:inline-flex md:flex-col gap-1 sm:gap-0">
                        <div class="flex items-center gap-2">
                            <x-mary-icon name="fas.tint" class="h-5 text-blue-600" title="Consumo de água" />
                            <strong>Água:</strong>
                        </div>
                        <span class="sm:ml-7">{{ $productionSetting->build['water'] }} m³</span>
                    </div>
                    @if (!empty($productionSetting->build['products']))
                        <div class="md:col-span-2">
                            <h4 class="text-md font-medium text-gray-900 mb-1">Necessário:</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                @foreach ($productionSetting->build['products'] as $product)
                                    <div class="p-2 flex items-center rounded shadow gap-2 bg-gray-200/80">
                                        <img src="{{ $product->product->images[0] }}" alt="{{ $product->product->name }}"
                                            class="h-6 object-cover rounded">
                                        <div class="font-bold text-gray-900">{{ $product->product->name }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                </div>
                <div >
                    <x-selects.character-selector :characters="$availableCharacters" wire:model="selectedCharacter" button-label="Construir" />
                </div>
            </div>
        </div>
    @else
        {{-- Produzir --}}
        <h3 class="mt-6 text-2xl font-semibold text-gray-900 mb-2">Produzir</h3>
        <div class="flex justify-between items-start gap-6 max-w-2xl mx-auto">
            <div class="flex-1">
                <div class="grid md:grid-cols-2 gap-2 text-sm text-gray-800">
                    <div class="flex items-center gap-2">
                        <x-mary-icon name="fas.clock" class="h-5 text-gray-600" title="Tempo de produção" />
                        <strong>Tempo:</strong> {{ $productionSetting->production['time'] }}h
                    </div>
                    <div class="flex items-center gap-2">
                        <x-mary-icon name="fas.coins" class="h-5 text-yellow-600" title="Custo de produção" />
                        <strong>Custo:</strong> R$
                        {{ number_format($productionSetting->production['cost'], 2, ',', '.') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <x-mary-icon name="fas.tint" class="h-5 text-blue-600" title="Água necessária" />
                        <strong>Água:</strong> {{ $productionSetting->production['water'] }} m³
                    </div>
                </div>
            </div>
            <div class="flex-none">
                <x-selects.character-selector :characters="[
                    ['id' => 1, 'name' => 'João'],
                    ['id' => 2, 'name' => 'Maria'],
                    ['id' => 3, 'name' => 'Carlos'],
                    ['id' => 4, 'name' => 'Ana'],
                ]" wire:model="selectedCharacter" button-label="Produzir"/>
            </div>
        </div>

        @if (!empty($productionSetting->production['products']))
            <div class="mt-4">
                <h4 class="text-md font-medium text-gray-900 mb-1">Produtos:</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                    @foreach ($productionSetting->production['products'] as $product)
                        <div class="p-2 flex items-center rounded shadow gap-2 bg-gray-200/80">
                            <img src="{{ $product->product->images[0] }}" alt="{{ $product->product->name }}"
                                class="h-6 object-cover rounded">
                            <div class="font-bold text-gray-900">{{ $product->product->name }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
</div>