<div>
    <x-layout.header title="Comércio"/>
    <div class="flex justify-end mb-5">
        <x-mary-input wire:model.live="search" icon="s-magnifying-glass" 
        placeholder="Procurar" clearable class="w-full lg:w-64"/>
    </div>
    <x-mary-table :headers="$headers" :rows="$products" :sort-by="$sortBy"
    with-pagination wire:model="expanded" expandable>
        @scope('cell_name', $product)
            <div class="flex gap-2">
                <img src="{{ $product->images[0] }}" alt="{{ $product->name }}"
                    class="h-6 object-cover rounded">
                <div class="font-bold text-gray-900">{{ $product->name }}</div>
            </div>
        @endscope
        @scope('cell_buy', $product)
            <x-mary-button icon="fas.arrow-right-to-bracket" x-on:click="toggleExpand({{$product->id}})" 
                label="Comprar" spinner class="btn-sm" />
        @endscope
        @scope('expansion', $product, $player)
        <div class="flex justify-center">
            <x-game.market.buy-input :product="$product" :player="$player"/>
        </div>
        @endscope
    </x-mary-table>

    <livewire:game.market.water-purchase />
</div>
