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
                    @if (!empty($productionSetting->build['products']['required']))
                        <div class="md:col-span-2">
                            <h4 class="text-md font-medium text-gray-900 mb-1">Necessário:</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                @foreach ($productionSetting->build['products']['required'] as $product)
                                    <x-game.production.product-item :product="$product->product" :qnt="$product->qnt" />
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
        @if ($productionSetting->type === 3)
            @php
                $canProduce = $this->canProduce;
            @endphp

            <div class="mb-4">
                <h4 class="text-lg font-semibold my-4">Materiais Necessários:</h4>

                {{-- Campo do Multiplicador --}}
                <div class="flex justify-center items-center my-4">
                    <div x-data="{
                        quantity: {{ $multiplier_quantity }},
                        min: 1,
                        max: 1000,
                        increment(delta) {
                            let newQty = this.quantity + delta;
                            if (newQty < this.min) {
                                this.quantity = this.min;
                            } else if (newQty > this.max) {
                                this.quantity = this.max;
                            } else {
                                this.quantity = newQty;
                            }
                            $wire.set('multiplier_quantity', this.quantity);
                        }
                    }" class="inline-flex">

                        <button type="button" @click="increment(-10)" :disabled="quantity <= min"
                            class="w-10 h-10 flex items-center justify-center border border-black rounded-l hover:bg-gray-200/80 active:scale-95">
                            &lt;&lt;
                        </button>

                        <button type="button" @click="increment(-1)" :disabled="quantity <= min"
                            class="w-10 h-10 flex items-center justify-center border-t border-b border-r border-black hover:bg-gray-200/80 active:scale-95">
                            &lt;
                        </button>

                        <input type="number" x-model.number="quantity" min="1"
                            class="w-16 h-10 text-center border-t border-b border-r border-black"
                            @input="increment(0)" />

                        <button type="button" @click="increment(1)" :disabled="quantity >= max"
                            class="w-10 h-10 flex items-center justify-center border-t border-b border-r border-black hover:bg-gray-200/80 active:scale-95">
                            &gt;
                        </button>

                        <button type="button" @click="increment(10)" :disabled="quantity >= max"
                            class="w-10 h-10 flex items-center justify-center border-t border-b border-r border-black rounded-r hover:bg-gray-200/80 active:scale-95">
                            &gt;&gt;
                        </button>
                    </div>
                </div>


                {{-- Lista dos inputs necessários --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach ($productionSetting->production['inputs'] as $input)
                        @php
                            $stock = $inputStock[$input->id] ?? [
                                'available' => 0,
                                'required' => 0,
                                'sufficient' => false,
                            ];
                            $product = $input->product;
                        @endphp
                        <div
                            class="flex items-center gap-3 p-2 border rounded {{ !$stock['sufficient'] ? 'border-red-600' : 'border-black' }}">
                            <img src="{{ asset($product->images[0] ?? '') }}" class="w-10 h-10 rounded">
                            <div class="flex-1">
                                <div class="font-medium">{{ $product->name }}</div>
                                <div class="text-sm">
                                    <span class="{{ !$stock['sufficient'] ? 'text-red-600 font-bold' : '' }}">
                                        {{ App\Helpers\Formatter::formatNumber($stock['available'], 0, 6) }} /
                                        {{ App\Helpers\Formatter::formatNumber($stock['required'], 0, 6) }}
                                    </span> disponíveis
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if (!$canProduce)
                <div class="text-red-600 font-medium mt-2">
                    Você não possui materiais suficientes para produzir.
                </div>
            @endif
            {{-- Produtos possíveis de output --}}
            <div class="mb-4">
                <h4 class="text-lg font-semibold my-4">Produtos Possíveis:</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach ($productionSetting->production['outputs'] as $output)
                        <x-game.production.product-item :product="$output->product" />
                    @endforeach
                </div>
            </div>
        @endif
        @if (isset($production) && $production->playerProducts->count() >= 1)
            <h3 class="mt-6 text-2xl font-semibold text-gray-900 mb-2">Produzido por último</h3>
            <div>
                <livewire:game.production.production-produced :production="$production" />
            </div>
        @endif
    @endif
</div>
