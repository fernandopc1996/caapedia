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

    {{-- Construir --}}

    <h3 class="text-2xl font-semibold text-gray-900 mb-2">Construir</h3>
    <div class="mt-2 flex justify-between items-start gap-6">
        <div class="flex-1">
            <div class="grid md:grid-cols-2 gap-2 text-sm text-gray-800">
                <div><strong>Tempo:</strong> {{ $productionSetting->build['time'] }}h</div>
                <div><strong>Custo:</strong> R$ {{ number_format($productionSetting->build['cost'], 2, ',', '.') }}
                </div>
                <div><strong>Área:</strong> {{ $productionSetting->build['area'] }} ha</div>
                <div><strong>Água:</strong> {{ $productionSetting->build['water'] }} m³</div>
            </div>
        </div>
        <div class="flex-none">
            <x-selects.character-selector :characters="[
                ['id' => 1, 'name' => 'João'],
                ['id' => 2, 'name' => 'Maria'],
                ['id' => 3, 'name' => 'Carlos'],
                ['id' => 4, 'name' => 'Ana'],
            ]" wire:model="selectedCharacter" button-label="Construir" />
        </div>
    </div>
    @if(!empty($productionSetting->build['products']))
    {{-- Produtos possíveis --}}
    <div>
        <h4 class="text-md font-medium text-gray-900 mb-1">Necessário:</h4>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
            @foreach ($productionSetting->build['products'] as $product)
                <div class="bg-gray-100 p-2 rounded shadow text-center">
                    <div class="font-bold text-gray-900">ID: {{ $product->id }}</div>
                    <div class="text-gray-700">Qtd: {{ $product->qnt[0] }} - {{ $product->qnt[1] }}</div>
                    <div class="text-gray-500">Chance: {{ $product->lottery }}%</div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Produzir --}}
    <h3 class="mt-6 text-2xl font-semibold text-gray-900 mb-2">Produzir</h3>
    <div class="flex justify-between items-start gap-6">
        <div class="flex-1">
            <div class="grid grid-cols-2 gap-2 text-sm text-gray-800">
                <div><strong>Tempo:</strong> {{ $productionSetting->production['time'] }}h</div>
                <div><strong>Custo:</strong> R$
                    {{ number_format($productionSetting->production['cost'], 2, ',', '.') }}</div>
                <div><strong>Água:</strong> {{ $productionSetting->production['water'] }} m³</div>
            </div>
        </div>
        <div class="flex-none">
            <x-selects.character-selector :characters="[
                ['id' => 1, 'name' => 'João'],
                ['id' => 2, 'name' => 'Maria'],
                ['id' => 3, 'name' => 'Carlos'],
                ['id' => 4, 'name' => 'Ana'],
            ]" wire:model="selectedCharacter" button-label="Produzir" />
        </div>
    </div>
    @if(!empty($productionSetting->production['products']))
    {{-- Produtos possíveis --}}
    <div>
        <h4 class="text-md font-medium text-gray-900 mb-1">Produtos</h4>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
            @foreach ($productionSetting->production['products'] as $product)
            <div class="p-2 flex rounded shadow text-center gap-1">
                <img src="{{ $product->product->images[0] }}" alt="{{ $product->product->name }}"
                                class="h-5 object-cover">
                <div class="font-bold text-gray-900">{{ $product->product->name }}</div>

            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
