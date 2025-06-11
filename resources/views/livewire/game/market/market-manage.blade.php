<div>
    <x-layout.header title="Comércio" />
    <p class="text-sm text-gray-800 mb-4">
        No comércio você pode adquirir recursos e insumos necessários para sua produção e desenvolvimento no jogo.
    </p>
    <div class="flex justify-end mb-5">
        <x-mary-input wire:model.live="search" icon="s-magnifying-glass" placeholder="Procurar" clearable
            class="w-full lg:w-64" />
    </div>
    <x-mary-table :headers="$headers" :rows="$products" :sort-by="$sortBy" with-pagination wire:model="expanded"
        @row-click="$wire.call('openModal', $event.detail.id)">
        @scope('cell_name', $product)
            <div class="flex gap-2">
                <img src="{{ $product->images[0] }}" alt="{{ $product->name }}" class="h-6 object-cover rounded">
                <div class="font-bold text-gray-900">{{ $product->name }}</div>
            </div>
        @endscope
        @scope('cell_buy', $product)
            <x-mary-button icon="fas.arrow-right-to-bracket" label="Comprar" spinner
                class="btn-primary btn-outline btn-sm" />
        @endscope
    </x-mary-table>

    <livewire:game.market.water-purchase />

    <x-mary-modal wire:model="showModal" title="{{ $modalProduct->name ?? '' }}">
        @if ($modalProduct)
            <div class="flex flex-col gap-4 p-4">
                <div class="flex flex-col justify-center md:flex-row gap-4 items-center">
                    <img src="{{ $modalProduct->images[0] }}" alt="{{ $modalProduct->name }}"
                        class="h-32 w-32 object-cover rounded">
                    <div class="text-center md:text-justify">
                        <div class="text-sm text-gray-600 mt-1">{{ $modalProduct->description }}</div>
                    </div>
                </div>

                <div class="w-full mt-4">
                    <x-game.market.buy-input :product="$modalProduct" :player="$player" />
                </div>
            </div>
        @endif
    </x-mary-modal>

</div>
