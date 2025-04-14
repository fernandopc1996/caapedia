<div>

    <x-layout.header title="Exploração"/>
    
    @if ($pending)
        a
    @else
        <livewire:game.explore.explore-action/>
    @endif
</div>
