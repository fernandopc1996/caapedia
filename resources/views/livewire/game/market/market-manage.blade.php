<div>
    <x-layout.header title="Comércio"/>
    <x-mary-tabs wire:model="selectedTab" label-div-class="">
        <x-mary-tab name="users-tab" label="Comprar" icon="o-users">
            <div>Comprar</div>
        </x-mary-tab>
        <x-mary-tab name="tricks-tab" label="Vender" icon="o-sparkles">
            <div>Vender</div>
        </x-mary-tab>
    </x-tabs>

    <div role="tablist" class="tabs tabs-border">
        <a role="tab" class="tab">
            <x-mary-icon name="o-envelope" label="Comprar" />
        </a>
        <a role="tab" class="tab tab-active">
            <x-mary-icon name="o-envelope" label="Vender" />
        </a>
      </div>
</div>
