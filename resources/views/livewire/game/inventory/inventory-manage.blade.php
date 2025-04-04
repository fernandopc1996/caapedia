<div>
    <x-layout.header title="Estoque" />
    <div>
        <x-mary-input wire:model.live="search" placeholder="Clearable field" clearable />
    </div>
    <x-mary-table :headers="$headers" :rows="$products" :sort-by="$sortBy" with-pagination>
        @scope('cell_coid', $product)
            <div class="flex gap-2">
                <img src="{{ $product->game_data->images[0] }}" alt="{{ $product->game_data->name }}"
                    class="h-6 object-cover rounded">
                <div class="font-bold text-gray-900">{{ $product->game_data->name }}</div>
            </div>
        @endscope
        @scope('cell_sell', $product)
        <x-game.inventory.sell-input :product="$product" />
        @endscope

    </x-mary-table>
</div>
