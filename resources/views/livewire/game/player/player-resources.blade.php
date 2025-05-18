<div>
    <div class="grid grid-cols-2 justify-between mt-3 gap-4">
        <div class="flex flex-col items-center gap-1">
            <span class="text-xs font-semibold">Área produtiva (Ha):</span>
            <x-mary-icon name="fas.layer-group" :label="App\Helpers\Formatter::formatNumber($player->area, 3, 5)" class="text-2xl text-green-900" />
        </div>
        <div class="flex flex-col items-center gap-1">
            <span class="text-xs font-semibold">Degradação (%):</span>
            <x-mary-icon name="fas.frown" :label="App\Helpers\Formatter::formatNumber($player->degration, 1, 6)" class="text-2xl text-red-900" />
        </div>
        <div class="flex flex-col items-center gap-1">
            <span class="text-xs font-semibold">Água útil (m³):</span>
            <x-mary-icon name="fas.tint" :label="App\Helpers\Formatter::formatNumber($player->water, 3, 4)" class="text-2xl text-blue-900" />
        </div>
        <div class="flex flex-col items-center gap-1">
            <span class="text-xs font-semibold">Montante (R$):</span>
            <x-mary-icon name="fas.dollar-sign" :label="App\Helpers\Formatter::formatNumber($player->amount, 2, 6)"
                class="text-2xl {{ $player->amount < 0 ? 'text-red-900' : 'text-teal-900' }}" />
        </div>
    </div>
</div>
