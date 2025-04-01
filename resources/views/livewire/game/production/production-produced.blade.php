<div>
    <x-mary-table :headers="$headers" :rows="$products">
        @scope('cell_product', $product)
            <div class="flex gap-2">
                <img src="{{ $product->game_data->images[0] }}" alt="{{ $product->game_data->name }}" class="h-6 object-cover rounded">
                <div class="font-bold text-gray-900">{{ $product->game_data->name }}</div>
            </div>
        @endscope
    </x-mary-table>
</div>
