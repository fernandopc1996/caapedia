<div x-data="{ showModal: false }" @click.outside="showModal = false">
    <div wire:loading>
        <div class="fixed inset-0 flex items-center justify-center bg-white bg-opacity-50 z-50">
            <x-mary-loading class="text-primary loading-lg" />
        </div>
    </div>

    <a href="#" @click.prevent="showModal = true">
        <div class="fixed bottom-5 right-5 w-auto backdrop-blur-3xl border-t border-gray-800 shadow-lg p-4 rounded-lg hover:bg-white/90 hover:px-8">
            <div class="flex items-center gap-4">
                <x-timers.timer startTime="{{ $player->last_datetime }}" mode="{{ $player->mode_time }}" />
                <x-timers.clock :mode="$player->mode_time" :lastDatetime="$player->last_datetime"/>
            </div>
        </div>
    </a>

    {{-- Modal --}}
    <div 
        x-show="showModal"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center md:justify-end md:items-end"
        style="display: none;"
        @click.self="showModal = false"
    >
        <div 
            class="text-gray-800 backdrop-blur-3xl p-6 rounded-lg w-full max-w-sm shadow-xl 
                   md:absolute md:bottom-24 md:right-5 md:rounded-xl md:w-80"
            x-data
        >
            <h2 class="text-lg font-bold mb-4">Velocidade do tempo</h2>

            <div class="flex flex-col gap-4">
                <a href="#"
                   @click.prevent="showModal = false"
                   wire:click="setTimerMode(0)"
                   class="flex items-center gap-2 p-2 rounded {{ $player->mode_time == 0 ? 'bg-gray-300 cursor-not-allowed' : 'hover:bg-gray-200' }}"
                   {{ $player->mode_time == 0 ? 'disabled' : '' }}>
                    <x-mary-icon name="fas.pause" />
                    Pausar
                </a>

                <a href="#"
                   @click.prevent="showModal = false"
                   wire:click="setTimerMode(1)"
                   class="flex items-center gap-2 p-2 rounded {{ $player->mode_time == 1 ? 'bg-gray-300 cursor-not-allowed' : 'hover:bg-gray-200' }}"
                   {{ $player->mode_time == 1 ? 'disabled' : '' }}>
                    <x-mary-icon name="fas.angle-right" />
                    Velocidade 1
                </a>

                <a href="#"
                   @click.prevent="showModal = false"
                   wire:click="setTimerMode(2)"
                   class="flex items-center gap-2 p-2 rounded {{ $player->mode_time == 2 ? 'bg-gray-300 cursor-not-allowed' : 'hover:bg-gray-200' }}"
                   {{ $player->mode_time == 2 ? 'disabled' : '' }}>
                    <x-mary-icon name="fas.angle-double-right" />
                    Velocidade 2
                </a>
            </div>

            <div class="mt-6 text-right">
                <a href="#" @click.prevent="showModal = false" class="text-sm text-gray-800 hover:text-white">
                    Fechar
                </a>
            </div>
        </div>
    </div>

    @script
        <script>
            $wire.on('timer-mode-updated', (startTime, mode) => {
                window.dispatchEvent(new CustomEvent('timer-mode-updated', {
                    detail: {
                        startTime,
                        mode
                    }
                }));
            });
        </script>
    @endscript
</div>