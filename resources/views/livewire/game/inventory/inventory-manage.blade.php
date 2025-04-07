<div>
    <x-layout.header title="Estoque" />
    <div class="flex justify-end mb-5">
        <x-mary-input wire:model.live="search" icon="s-magnifying-glass" 
        placeholder="Procurar" clearable class="w-full lg:w-64"/>
    </div>
    <x-mary-table :headers="$headers" :rows="$products" :sort-by="$sortBy" wire:model="expanded" 
    with-pagination expandable expandable-key="coid" >
        @scope('cell_product', $product)
            <div class="flex gap-2">
                <img src="{{ $product->game_data->images[0] }}" alt="{{ $product->game_data->name }}"
                    class="h-6 object-cover rounded">
                <div class="font-bold text-gray-900">{{ $product->game_data->name }}</div>
            </div>
        @endscope
        @scope('actions', $product)
            <x-mary-button icon="fas.arrow-right-from-bracket" x-on:click="toggleExpand({{$product->coid}})" 
                label="Vender" spinner class="btn-sm" />
        @endscope
        @scope('expansion', $product)
        <x-game.inventory.sell-input :product="$product" />
        @endscope
    </x-mary-table>
</div>
