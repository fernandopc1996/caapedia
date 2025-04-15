<div>
    <x-layout.header title="Exploração" />

    @if ($pending->isNotEmpty())
        <x-game.exploration.pending :pending="$pending" :player="$player" />
    @else
        <livewire:game.explore.explore-action />
    @endif

    @if ($completed->isNotEmpty())
        <h3 class="mt-6 text-2xl font-semibold text-gray-900 mb-2">Últimas explorações</h3>

        @foreach ($completed as $item)
            @php
                $data = $item->game_data;
                $products = $item->playerProducts()->where('op', 'C')->get();
                $start = \Carbon\Carbon::parse($item->start)->format('d/m/Y H:i');
                $end = \Carbon\Carbon::parse($item->end)->format('d/m/Y H:i');
            @endphp

            <div class="grid md:grid-cols-2 gap-4 border border-black rounded-md p-4 mb-4 bg-transparent">
                {{-- Dados da exploração --}}
                <div class="flex gap-4 items-center">
                    <img src="{{ $data->images[0] ?? '/placeholder.png' }}" alt="{{ $data->name }}"
                        class="h-20 w-20 rounded-lg object-cover border border-black">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">{{ $data->name }}</h3>
                        <p class="text-sm text-gray-800">{{ $data->description }}</p>
                        <p class="text-sm text-gray-800">Início: {{ $start }}</p>
                        <p class="text-sm text-gray-800">Término: {{ $end }}</p>
                    </div>
                </div>

                {{-- Produtos encontrados --}}
                @if ($products->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-gray-800">
                            <thead class="text-bold">
                                <tr>
                                    <th scope="col" class="px-4 py-2">Produto</th>
                                    <th scope="col" class="px-4 py-2">Encontrado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="hover:bg-gray-50/10">
                                        <td class="px-4 py-2">
                                            <div class="flex items-center gap-2">
                                                <img src="{{ $product->game_data->images[0] ?? '/placeholder.png' }}"
                                                    alt="{{ $product->game_data->name }}"
                                                    class="h-6 rounded object-cover ">
                                                <span>{{ $product->game_data->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 text-right">
                                            {{ number_format($product->amount, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-gray-500 italic">Nenhum produto encontrado.</div>
                @endif
            </div>
        @endforeach

    @endif
</div>
