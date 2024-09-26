<div>

    <x-layout.header title="Exploração"/>
    
    <x-mary-form wire:submit="save">
        <x-mary-input label="Name" wire:model="name" />
     
        <x-slot:actions>
            <x-mary-button label="Cancel" />
            <x-mary-button label="Click me!" class="btn-primary" type="submit"/>
        </x-slot:actions>
    </x-mary-form>
</div>
