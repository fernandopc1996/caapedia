<div>
    @if(Session::has('player'))
    <div class="group fixed w-100 hover:w-auto bottom-5 right-5 backdrop-blur-3xl border-t border-gray-800 shadow-lg">
        <div class="flex flex-col sm:flex-row container justify-between items-center gap-12 p-4">

            <div class="hidden group-hover:flex flex-col sm:flex-row gap-4">
                <a href="#" wire:click="setTimerMode(0)" class="hover:text-green-100">
                    <x-mary-icon name="fas.pause" label="Pausar"/>
                </a>
                <a href="#" wire:click="setTimerMode(1)" class="hover:text-green-100">
                    <x-mary-icon name="fas.angle-right" label="Velocidade 1" />
                </a>
                <a href="#" wire:click="setTimerMode(2)" class="hover:text-green-100">
                    <x-mary-icon name="fas.angle-double-right" label="Velocidade 2" />
                </a>
            </div>  
               
            <div>
                <x-timers.timer startTime="{{$player->last_datetime}}" mode="{{$player->mode_time}}"/>
            </div>
        </div>
    </div>
    @endif

    @script
    <script>
        $wire.on('timer-mode-updated', (startTime, mode) => {
            window.dispatchEvent(new CustomEvent('timer-mode-updated', { detail: { startTime, mode } }));
        });
    </script>
    @endscript
</div>
