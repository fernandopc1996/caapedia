<div>
    <div wire:loading>
        <div class="fixed inset-0 flex items-center justify-center bg-white bg-opacity-50 z-50">
            <x-mary-loading class="text-primary loading-lg" />
        </div>
    </div>
    <div class="group fixed w-55 hover:w-auto bottom-5 right-5 backdrop-blur-3xl border-t border-gray-800 shadow-lg">
        <div class="flex flex-col sm:flex-row container justify-between items-center gap-12 p-4">

            <div class="hidden group-hover:flex flex-col sm:flex-row gap-4">
                <a href="#" wire:click="setTimerMode(0)"
                    class="{{ $player->mode_time == 0 ? 'text-neutral-500 cursor-not-allowed' : 'hover:text-green-100 ' }}"
                    {{ $player->mode_time == 0 ? 'disabled' : '' }}>
                    <x-mary-icon name="fas.pause" label="Pausar" />
                </a>
                <a href="#" wire:click="setTimerMode(1)"
                    class="{{ $player->mode_time == 1 ? 'text-neutral-500 cursor-not-allowed' : 'hover:text-green-100 ' }}"
                    {{ $player->mode_time == 1 ? 'disabled' : '' }}>
                    <x-mary-icon name="fas.angle-right" label="Velocidade 1" />
                </a>
                <a href="#" wire:click="setTimerMode(2)"
                    class="{{ $player->mode_time == 2 ? 'text-neutral-500 cursor-not-allowed' : 'hover:text-green-100 ' }}"
                    {{ $player->mode_time == 2 ? 'disabled' : '' }}>
                    <x-mary-icon name="fas.angle-double-right" label="Velocidade 2" />
                </a>
            </div>

            <div class="flex gap-4 justify-between items-center">
                <x-timers.timer startTime="{{ $player->last_datetime }}" mode="{{ $player->mode_time }}" />

                <x-timers.clock :mode="$player->mode_time" :lastDatetime="$player->last_datetime"/>
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
