@props(['production'])

<div class="grid md:grid-cols-2 gap-2 text-gray-900">
    <x-game.production.build-item icon="fas.clock" label="Tempo" :value="" . $production['time'] . 'h'" color="gray-600" />
    <x-game.production.build-item icon="fas.coins" label="Custo" :value="'R$ ' . number_format($production['cost'], 2, ',', '.')" color="yellow-600" />
    <x-game.production.build-item icon="fas.tint" label="Água" :value="$production['water'] . ' m³'" color="blue-600" />

    @if (!empty($production['products']))
        <div class="md:col-span-2">
            <h4 class="text-md font-medium text-gray-900 mb-1">Produzir:</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                @foreach ($production['products'] as $product)
                    <x-game.production.product-item :product="$product->product" />
                @endforeach
            </div>
        </div>
    @endif
</div>