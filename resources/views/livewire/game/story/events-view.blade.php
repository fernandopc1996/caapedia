<div class="h-screen flex flex-col">
    <x-layout.header title="História" />

    <div>
        <div id="story-container"
             class="overflow-y-auto max-h-[70vh] pr-2">

            @foreach($stories as $story)
                <div class="flex gap-4 items-start rounded-lg shadow p-4">
                    {{-- Imagem --}}
                    <img src="{{ $story->game_data?->character?->front_square ?? '/placeholder.png' }}"
                         alt="{{ $story->game_data?->character?->name ?? 'Personagem' }}"
                         class="w-16 h-16 rounded object-cover border" />

                    {{-- Conteúdo --}}
                    <div class="flex-1">
                        <div class="text-sm text-gray-800 mb-1">
                            <strong>{{ $story->game_data?->character?->name ?? 'Narrador' }}</strong> —
                            <span>{{ \Carbon\Carbon::parse($story->date)->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="text-base text-gray-800">
                            {!! nl2br(e($executor->parseText($story->game_data?->text ?? ''))) !!}
                        </div>
                        @if($story->choice)
                            <div class="mt-2 italic text-blue-900">
                                Escolha: "{{ $story->choice }}"
                            </div>
                            @php
                                $choice = collect($story->game_data->choices ?? [])
                                    ->firstWhere('text', $story->choice);
                            @endphp
                            @if($choice && $choice->description)
                                <div class="text-sm text-gray-600 mt-1">
                                    {{ $choice->description }}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function scrollToBottom() {
            const container = document.getElementById('story-container');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        }
    
        document.addEventListener('DOMContentLoaded', scrollToBottom);
    
        document.addEventListener('livewire:load', () => {
            scrollToBottom(); 
    
            Livewire.hook('message.processed', () => {
                requestAnimationFrame(() => scrollToBottom());
            });
        });

        window.addEventListener('livewire:navigated', () => {
            requestAnimationFrame(() => scrollToBottom());
        });
    </script>
</div>
