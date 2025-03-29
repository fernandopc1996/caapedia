@props(['pending', 'player'])

@foreach ($pending as $item)
    @php
        $character = $item->playerCharacter->game_data;
        $start = \Carbon\Carbon::parse($item->start_build)->timestamp * 1000;
        $end = \Carbon\Carbon::parse($item->end_build)->timestamp * 1000;
        $now = \Carbon\Carbon::parse($player->last_datetime)->timestamp * 1000;
        $duration = $end - $start;
        $initialProgress = max(0, min(100, (($now - $start) / $duration) * 100));
    @endphp

    <x-buttons.big class="h-50 p-4 flex flex-col items-start justify-between relative"
        wire:navigate :disabled="true" data-start="{{ $start }}"
        data-end="{{ $end }}" wire:key="{{ $item->id }}">
        <div class="w-full">
            <h2 class="text-xl font-bold">{{ $item->game_data->name }}</h2>
            <p class="text-sm text-gray-600">Construindo {{ $item->completed }}</p>
        </div>

        <div class="flex items-center gap-2 w-full mt-2">
            <img src="{{ $character->front_square }}" alt="{{ $character->name }}"
                class="h-10 w-10 rounded object-cover">
            <span class="text-sm">{{ $character->name }}</span>
        </div>

        <div class="w-full bg-gray-200 rounded-full h-3 mt-4 overflow-hidden">
            <div class="progress-bar bg-green-500 h-3 transition-all duration-500"
                style="width: {{ $initialProgress }}%;"></div>
        </div>
        <div class="w-full mt-1 text-right text-xs text-gray-500">
            Termina em {{ \Carbon\Carbon::parse($item->end_build)->format('d/m/Y H:i') }}
        </div>
    </x-buttons.big>
@endforeach

@once
    <script>
        function setupProgressBars() {
            const bars = document.querySelectorAll('[data-start][data-end][wire\\:key]');
            const progressStates = {};

            function updateProgressBars(currentTimestamp) {
                bars.forEach(el => {
                    const id = el.getAttribute('wire:key');
                    const bar = el.querySelector('.progress-bar');
                    const start = parseInt(el.dataset.start);
                    const end = parseInt(el.dataset.end);
                    const now = currentTimestamp;

                    const total = end - start;
                    const elapsed = now - start;
                    const progress = Math.max(0, Math.min(100, (elapsed / total) * 100));
                    if (progress <= 100) {
                        bar.style.width = `${progress}%`;
                    }

                    if (progress >= 100 && !progressStates[id]) {
                        progressStates[id] = true;
                        setTimeout(() => {
                            Livewire.dispatch('updatePlayerTimer');
                        }, 2000);
                    }
                });
            }

            window.addEventListener('virtual-time-tick', (event) => {
                updateProgressBars(event.detail.currentTime);
            });
        }

        document.addEventListener('DOMContentLoaded', setupProgressBars);
        document.addEventListener('livewire:navigated', setupProgressBars);
    </script>
@endonce
