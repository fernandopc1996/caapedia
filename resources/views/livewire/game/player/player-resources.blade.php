<div>
    <div class="grid grid-cols-2 justify-between mt-3 gap-4">
        <div class="flex flex-col items-center gap-1">
            <span class="text-xs font-semibold">Área produtiva (Ha):</span>
            <x-mary-icon name="fas.layer-group" :label="number_format($player->area, 3, ',', '.')" class="text-2xl text-green-900"/>
        </div>
        <div class="flex flex-col items-center gap-1">
            <span class="text-xs font-semibold">Degradação (%):</span> 
            <x-mary-icon name="fas.frown" :label="number_format($player->degration, 1, ',', '.')" class="text-2xl text-red-900"/>
        </div>
        <div class="flex flex-col items-center gap-1">
            <span class="text-xs font-semibold">Água útil (m³):</span> 
            <x-mary-icon name="fas.tint" :label="number_format($player->water, 3, ',', '.')" class="text-2xl text-blue-900"/>
        </div>
        <div class="flex flex-col items-center gap-1">
            <span class="text-xs font-semibold">Montante (R$):</span> 
            <x-mary-icon name="fas.dollar-sign" :label="number_format($player->amount, 2, ',', '.')" class="text-2xl text-teal-900"/>
        </div>
    </div>
</div>
