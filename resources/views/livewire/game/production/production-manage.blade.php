<div>
    <x-layout.header title="Produção" />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-buttons.big  href="{{route('production.create')}}" wire:navigate>
            <div class="flex-none p-4">
                <x-mary-icon name="o-plus" class="h-20"/>
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold">Adicionar</h3>
            </div>
        </x-buttons.big>
    </div>
</div>
