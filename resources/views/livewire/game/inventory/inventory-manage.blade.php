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
    with-pagination expandable expandable-key="coid">
        @scope('cell_product', $product)
            <div class="flex gap-2">
                <img src="{{ $product->game_data->images[0] }}" alt="{{ $product->game_data->name }}"
                    class="h-6 object-cover rounded">
                <div class="font-bold text-gray-900">{{ $product->game_data->name }}</div>
            </div>
        @endscope
        @scope('cell_sell', $product)
            <x-mary-button icon="fas.arrow-right-from-bracket" x-on:click="toggleExpand({{$product->coid}})" 
                label="Vender" spinner class="btn-primary btn-outline btn-sm" />
        @endscope
        @scope('expansion', $product)
        <div class="flex justify-center">
            <x-game.inventory.sell-input :product="$product" />
        </div>
        @endscope
        <x-slot:empty>
            <x-mary-icon name="o-cube" label="Você não possui nenhum produto em estoque. Dê uma olhada em Produção, Explorar ou Comércio!" />
        </x-slot:empty>
    </x-mary-table>
</div>
