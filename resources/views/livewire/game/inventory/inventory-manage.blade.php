<div>
    <x-layout.header title="Estoque" />
    <p class="text-sm text-gray-800 mb-4">
        No estoque você pode visualizar, gerenciar e vender os produtos armazenados para obter outros recursos.
    </p>
    <div class="flex justify-end mb-5">
        <x-mary-input wire:model.live="search" icon="s-magnifying-glass" 
        placeholder="Procurar" clearable class="w-full lg:w-64"/>
    </div>
    <x-mary-table :headers="$headers" :rows="$products" :sort-by="$sortBy" wire:model="expanded" 
    with-pagination @row-click="$wire.call('openModal', $event.detail.coid)">
        @scope('cell_product', $product)
            <div class="flex gap-2">
                <img src="{{ $product->game_data->images[0] }}" alt="{{ $product->game_data->name }}"
                    class="h-6 object-cover rounded">
                <div class="font-bold text-gray-900">{{ $product->game_data->name }}</div>
            </div>
        @endscope
        @scope('cell_sell', $product)
            <x-mary-button icon="fas.arrow-right-from-bracket" 
                label="Vender" spinner class="btn-primary btn-outline btn-sm" />
        @endscope

        <x-slot:empty>
            <x-mary-icon name="o-cube" label="Você não possui nenhum produto em estoque. Dê uma olhada em Produção, Explorar ou Comércio!" />
        </x-slot:empty>
    </x-mary-table>

    <x-mary-modal wire:model="showModal" title="{{ $modalProduct->game_data->name ?? '' }}">
    @if ($modalProduct)
        <div class="flex flex-col gap-4 p-4">
            <div class="flex flex-col justify-center md:flex-row gap-4 items-center">
                <img src="{{ $modalProduct->game_data->images[0] ?? '' }}" alt="{{ $modalProduct->game_data->name }}"
                    class="h-32 w-32 object-cover rounded">
                <div class="text-center md:text-justify">
                    <div class="text-sm text-gray-600 mt-1">{{ $modalProduct->game_data->description }}</div>
                </div>
            </div>

            <div class="w-full mt-4">
                <x-game.inventory.sell-input :product="$modalProduct" />
            </div>
        </div>
    @endif
</x-mary-modal>
</div>
