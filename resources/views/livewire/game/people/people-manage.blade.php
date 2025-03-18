<div>
    <x-layout.header title="Pessoas"/>
    <div class="grid grid-cols-3 gap-4">
        @foreach($characters as $character)
            <div class="border p-4 rounded shadow">
                <h3 class="text-lg font-bold">{{ $character->name }}</h3>
                @if($character->front_square)
                    <img src="{{ $character->front_square }}" alt="{{ $character->name }}" class="w-32 h-32 object-cover">
                @else
                    <p>Sem imagem</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
