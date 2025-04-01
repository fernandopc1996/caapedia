<div>
    <div class="hidden lg:block">
        <x-mary-header title="{{$title}}" separator/>
    </div>

    <div wire:offline>
        <x-mary-alert title="Você está offline" 
        description="É necessário uma conexão ativa com a internet para continuar" 
        icon="o-exclamation-triangle" dismissible
        />
    </div>

    <div wire:loading>
        <div class="fixed inset-0 flex items-center justify-center bg-white/50 z-50">
            <x-mary-loading class="text-primary loading-lg" />
        </div>
    </div>
</div>