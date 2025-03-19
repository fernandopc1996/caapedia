<div>
    <x-layout.header title="Pessoas"/>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($characters as $character)
            <div class="border rounded shadow hover:bg-gray-200/80 hover:duration-300 hover:ease-in hover:z-10">
                <div class="flex">
                    <div class="flex-none">
                @if($character->front_square)
                    <img src="{{ $character->front_square }}" alt="{{ $character->name }}" class="h-32 object-cover">
                @else
                    <p>Sem imagem</p>
                @endif
            </div>
                <div class="flex-1 py-2 hover:scale-105">
                <h3 class="text-lg font-bold">{{ $character->name }}</h3>
            </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
