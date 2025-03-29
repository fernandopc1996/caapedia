@props(['build'])

<div class="grid md:grid-cols-2 gap-2 text-gray-900">
    <x-game.production.build-item icon="fas.clock" label="Tempo" :value="" . $build['time'] . 'h'" color="gray-600" />
    <x-game.production.build-item icon="fas.coins" label="Custo" :value="'R$ ' . number_format($build['cost'], 2, ',', '.')" color="yellow-600" />
    <x-game.production.build-item icon="fas.object-group" label="Área" :value="$build['area'] . ' ha'" color="green-600" />
    <x-game.production.build-item icon="fas.tint" label="Água" :value="$build['water'] . ' m³'" color="blue-600" />

    @if (!empty($build['products']))
        <div class="md:col-span-2">
            <h4 class="text-md font-medium text-gray-900 mb-1">Necessário:</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                @foreach ($build['products'] as $product)
                    <x-game.production.product-item :product="$product->product" />
                @endforeach
            </div>
        </div>
    @endif
</div>