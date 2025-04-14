<div>
    <x-layout.header title="Produção" />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-buttons.big href="{{ route('production.create') }}" wire:navigate>
            <div class="flex-none p-4">
                <x-mary-icon name="o-plus" class="h-20" />
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold">Adicionar</h3>
            </div>
        </x-buttons.big>
        <x-game.production.pending :pending="$pending" :player="$player" />
        
        @foreach ($completed as $item)
            @php
                $isCultivation = $item->type_area === \App\Enums\TypeAreaProduction::Cultivation;
                $hasCrop = isset($item->crop_data->name);
                $data = $isCultivation
                    ? ($hasCrop
                        ? $item->crop_data
                        : $item->native_cleaning_data)
                    : $item->game_data;

                $route = $isCultivation ? route('production.area', $item->uuid) : route('production.item', $item->uuid); // ou outra rota específica
            @endphp

            <x-buttons.big href="{{ $route }}" wire:navigate>
                <div class="flex-none p-4">
                    <img src="{{ $data->images[0] ?? '/placeholder.png' }}" alt="{{ $data->name }}"
                        class="h-20 w-20 rounded-lg object-cover">
                </div>
                <div class="flex-1">
                    <div class="items-center gap-2 mb-1">
                        <span class="text-xs font-bold border border-black px-2 py-0.5 rounded-md">{{ $item->name }}</span>
                        <h3 class="text-lg font-bold">{{ $data->name }}</h3>
                    </div>
                </div>
            </x-buttons.big>
        @endforeach

    </div>
</div>
