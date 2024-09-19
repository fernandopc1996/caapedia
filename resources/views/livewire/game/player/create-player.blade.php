<div class="h-screen">
    <x-mary-header title="Criação de personagem" subtitle="Crie o nome do seu personagem de acordo com nossas regras de uso" separator />
    <div class="sm:p-5 md:p-16 lg:p-32">
    <x-mary-form wire:submit="createPlayer">
        <x-mary-input label="Nome do personagem" wire:model="nickname" maxlength="30" 
        error-class="" required/>             
        <x-mary-button label="Criar" class="btn-primary" type="submit" spinner="save" />
    </x-mary-form>
    </div>
</div>
