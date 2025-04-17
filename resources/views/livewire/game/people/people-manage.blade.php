<div>
    <x-layout.header title="Pessoas" />

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($characters as $character)
            <div class="border rounded shadow hover:bg-gray-200/80 hover:duration-300 hover:ease-in hover:z-10 p-4 overflow-x-auto">
                <div class="flex">
                    <div class="flex-none mr-4">
                        @if ($character->game_data->front_full)
                            <img src="{{ $character->game_data->front_full }}" alt="{{ $character->game_data->name }}"
                                 class="h-72 object-cover rounded">
                        @else
                            <div class="flex items-center justify-center h-30 w-30 bg-gray-100 text-gray-400 rounded">
                                Sem imagem
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 flex flex-col">
                        <div>
                            <h3 class="text-lg font-bold">{{ $character->game_data->name }}</h3>
                            <p class="text-sm text-gray-700">
                                {{ $character->game_data->description ?? 'Descrição não disponível.' }}
                            </p>
                            <p class="text-sm text-gray-700">
                                Idade: {{ $character->game_data->age ?? 'Idade não informada.' }}
                            </p>
                        </div>

                        <div class="mt-4">
                            <h4 class="text-base font-semibold">Preparando/Construindo</h4>
                            @php
                                $activeProductions = $character->playerProductions->where('completed', false);
                            @endphp

                            @if ($activeProductions->isNotEmpty())
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2">
                                    @foreach ($activeProductions as $production)
                                        @php
                                            $isCultivation = $production->type_area === \App\Enums\TypeAreaProduction::Cultivation;
                                            if ($isCultivation) {
                                                $hasCrop = isset($production->crop_data->name);
                                                $data = $hasCrop ? $production->crop_data : $production->native_cleaning_data;
                                            } else {
                                                $data = $production->game_data;
                                            }
                                        @endphp

                                        <div class="flex items-center border rounded p-2">
                                            <div class="flex-none mr-2">
                                                <img src="{{ $data->images[0] ?? '/placeholder.png' }}"
                                                     alt="{{ $data->name }}"
                                                     class="h-10 w-10 rounded object-cover">
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium">{{ $data->name }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 mt-2">Nenhuma produção ativa para este personagem.</p>
                            @endif
                        </div>

                        <div class="mt-4">
                            <h4 class="text-base font-semibold">Cuidando/Produzindo/Explorando</h4>
                            @php
                                $activeActions = $character->playerActions->where('completed', false);
                            @endphp

                            @if ($activeActions->isNotEmpty())
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2">
                                    @foreach ($activeActions as $action)
                                        @php
                                            $actionData = $action->game_data;
                                            if ($actionData === null && isset($action->playerProduction)) {
                                                $actionData = $action->playerProduction->game_data;
                                            }
                                        @endphp

                                        <div class="flex items-center border rounded p-2">
                                            <div class="flex-none mr-2">
                                                <img src="{{ $actionData->images[0] ?? '/placeholder.png' }}"
                                                     alt="{{ $actionData->name }}"
                                                     class="h-10 w-10 rounded object-cover">
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium">{{ $actionData->name }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 mt-2">Nenhuma ação ativa para este personagem.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
