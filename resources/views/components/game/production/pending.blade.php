@props(['pending', 'player'])

@foreach ($pending as $item)
    @php
        $character = $item->playerCharacter->game_data;
        // Se existir pending_action, utiliza seus valores; caso contrário, usa os do playerProduction.
        $start = \Carbon\Carbon::parse($item->pending_action->start ?? $item->start_build)->timestamp * 1000;
        $end = \Carbon\Carbon::parse($item->pending_action->end ?? $item->end_build)->timestamp * 1000;
        $now = \Carbon\Carbon::parse($player->last_datetime)->timestamp * 1000;
        $duration = $end - $start;
        $initialProgress = max(0, min(100, (($now - $start) / $duration) * 100));
        $statusLabel = $item->pending_action ? 'Produzindo' : 'Construindo/Preparando';
    @endphp

    <x-buttons.big class="h-50 p-4 flex flex-col items-start justify-between relative"
        wire:navigate :disabled="true" data-start="{{ $start }}"
        data-end="{{ $end }}" wire:key="{{ $item->id }}">
        <div class="w-full">
            <h2 class="text-xl font-bold">{{ $item->game_data->name }}</h2>
            <p class="text-sm text-gray-600">{{ $statusLabel }}</p>
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
            Termina em {{ \Carbon\Carbon::parse($item->pending_action->end ?? $item->end_build)->format('d/m/Y H:i') }}
        </div>
    </x-buttons.big>
@endforeach

@once
<script>
    (function() {
        if (window.progressBarsInitialized) return;
        window.progressBarsInitialized = true;
        window.progressStates = window.progressStates || {};

        const fallbackTime = {{ \Carbon\Carbon::parse($player->last_datetime)->timestamp * 1000 }};

        window.updateProgressBars = function(currentTimestamp) {
            const bars = document.querySelectorAll('[data-start][data-end][wire\\:key]');
            bars.forEach(el => {
                const id = el.getAttribute('wire:key');
                const bar = el.querySelector('.progress-bar');
                const start = parseInt(el.dataset.start);
                const end = parseInt(el.dataset.end);
                const total = end - start;
                const elapsed = currentTimestamp - start;
                const progress = Math.max(0, Math.min(100, (elapsed / total) * 100));
                bar.style.width = `${progress}%`;

                if (progress >= 100 && !window.progressStates[id]) {
                    window.progressStates[id] = true;
                    setTimeout(() => {
                        Livewire.dispatch('updatePlayerTimer');
                    }, 2000);
                }
            });
        };

        window.addEventListener('virtual-time-tick', function(event) {
            window.updateProgressBars(event.detail.currentTime);
        });

        document.addEventListener('livewire:navigated', function() {
            window.updateProgressBars(fallbackTime);
        });

        if (document.readyState !== 'loading') {
            window.updateProgressBars(fallbackTime);
        } else {
            document.addEventListener('DOMContentLoaded', function() {
                window.updateProgressBars(fallbackTime);
            });
        }
    })();
</script>
@endonce