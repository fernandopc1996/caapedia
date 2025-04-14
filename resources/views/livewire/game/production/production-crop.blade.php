<div class="">
    @if (!$production)
        <h2 class="text-2xl font-bold mb-4">Escolha o cultivo</h2>
        <select wire:model.live="selectedCrop" class="w-full border p-2 rounded mb-6">
            <option value="">-- Selecione um cultivo --</option>
            @foreach ($crops as $crop)
                <option value="{{ $crop->id }}">{{ $crop->name }}</option>
            @endforeach
        </select>
    @endif
    @if ($selectedCropData)
        @php
            $cycleNumber = $cyclo ?? 1;
            $production = (array) $selectedCropData->production ?? [];
            $startCycle = (array) ($production['start_cycle'] ?? []);
            $continueCycle = (array) ($production['continue_cycle'] ?? []);
            $maxCycles = $continueCycle['max_cycles'] ?? 1;
            $phases = [];

            if ($cycleNumber === 1 && !empty($startCycle['phases'])) {
                $phases = $startCycle['phases'];
            }

            if ($cycleNumber > 1 && !empty($continueCycle['phases'])) {
                $phases = $continueCycle['phases'];
            }

            $expectedProducts = $production['products'] ?? [];
        @endphp

        <div class="">
            <div class="flex items-start gap-4 mb-4">
                <img src="{{ $selectedCropData->images[0] ?? '/placeholder.png' }}" alt="{{ $selectedCropData->name }}"
                    class="w-24 h-24 object-cover rounded-lg">
                <div class="flex-1">
                    <h3 class="text-xl font-semibold mb-1">{{ $selectedCropData->name }}</h3>
                    <p class="text-sm text-gray-700 mb-2">{{ $selectedCropData->description ?? 'Sem descrição.' }}</p>
                    <a href="{{ $selectedCropData->source }}" target="_blank"
                        class="text-white bg-black px-3 py-1 rounded text-sm inline-block font-semibold">
                        Clique aqui para detalhes
                    </a>
                </div>
            </div>
            @if ($cycle > $maxCycles)

            <x-mary-icon name="s-envelope" class="w-9 h-9 text-2xl m-5" label="Você já atingiu o máximo de ciclos para esse cultivo." />

            @else
                @if ($cycle > 1 && $maxCycles)
                    <div class="text-sm font-semibold text-gray-700 mb-2">
                        Ciclo {{ $cycle }} / {{ $maxCycles }}
                    </div>
                @endif

                <div class="grid md:grid-cols-4 gap-4">
                    <x-game.production.build-item icon="fas.clock" label="Tempo"
                        value="{{ ($cycleNumber === 1 ? $startCycle['time'] : $continueCycle['time']) ?? 'N/A' }}h"
                        color="gray-600" />
                    <x-game.production.build-item icon="fas.object-group" label="Área"
                        value="{{ $startCycle['area'] }} ha" color="green-600" />
                    <x-game.production.build-item icon="fas.coins" label="Custo"
                        value="R$ {{ number_format($cycleNumber === 1 ? $startCycle['cost'] : $continueCycle['cost'], 2, ',', '.') }}"
                        color="yellow-600" />
                    <x-game.production.build-item icon="fas.tint" label="Água"
                        value="{{ ($cycleNumber === 1 ? $startCycle['water'] : $continueCycle['water']) ?? 'N/A' }} m³"
                        color="blue-600" />
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                    @if (!empty($phases))
                        <div>
                            <h4 class="text-md font-semibold mb-2">Fases:</h4>
                            <div class="mb-4 border-t pt-3"></div>
                            @foreach ($phases as $phaseIndex => $phase)
                                <div class="mb-4">
                                    <h5 class="text-sm font-bold text-gray-800 mb-1">
                                        - {{ $phase['name'] ?? 'Fase ' . ($phaseIndex + 1) }}
                                    </h5>
                                    @if (!empty($phase['products']['required'] ?? []))
                                        <div class="ml-4">
                                            @foreach ($phase['products']['required'] as $product)
                                                <div class="ml-4 flex items-center gap-2">
                                                    <x-game.production.product-item :product="$product->product"
                                                        :qnt="$product->qnt" />
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif


                                    @if (!empty($phase['products']['optional'] ?? []))
                                        <div class="ml-4 mt-1">
                                            @foreach ($phase['products']['optional'] as $product)
                                                @php
                                                    $checkboxId = "{$phaseIndex}_{$product->product->id}";
                                                @endphp
                                                <div class="flex items-center gap-2 ml-4 mt-2">
                                                    <input type="checkbox"
                                                        class="h-6 w-6 bg-transparent border-2 border-black text-black focus:ring-black rounded-sm"
                                                        id="{{ $checkboxId }}" wire:model="optionalSelected"
                                                        value='@json(['id' => $product->id, 'qnt' => $product->qnt, 'control' => $checkboxId])'
                                                        class="form-checkbox text-green-600">
                                                    <label for="{{ $checkboxId }}" class="flex items-center gap-2">
                                                        <x-game.production.product-item :product="$product->product"
                                                            :qnt="$product->qnt" />
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="flex flex-col mb-2">
                        <h4 class="text-md font-semibold mb-2">Parâmetros:</h4>
                        <div class="mb-4 border-t pt-3"></div>
                        @foreach ([
        'Gestão Hídrica' => 'Indisponível',
        'Controle de Pragas' => 'Indisponível',
        'Análise de Solo' => 'Indisponível',
        'Análise Vegetal' => 'Indisponível',
        'Análise do Fruto' => 'Indisponível',
        'Análise da Água' => 'Indisponível',
    ] as $label => $value)
                            <div class="m-2">
                                <label
                                    class="text-sm font-semibold text-gray-700 block mb-1">{{ $label }}</label>
                                <select disabled
                                    class="w-full border border-gray-400 rounded px-2 py-1 bg-transparent text-gray-700">
                                    <option>{{ $value }}</option>
                                </select>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-6 md:flex md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <x-selects.character-selector :characters="$availableCharacters" wire:model="selectedCharacter"
                            button-label="Produzir" />
                    </div>
                </div>

                @if (!empty($expectedProducts))
                    <div class="mt-6">
                        <h4 class="text-md font-semibold mb-2">Produção Esperada:</h4>
                        @foreach ($expectedProducts as $product)
                            <div class="ml-4 text-sm flex items-center gap-2">
                                <x-game.production.product-item :product="$product->product" />
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    @endif
</div>
