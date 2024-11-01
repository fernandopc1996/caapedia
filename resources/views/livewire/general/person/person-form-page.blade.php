<div>
    <x-mary-header title="Novo Personagem">
        <x-slot:subtitle class="text-gray-900">
            Crie e configure os personagens do jogo
        </x-slot:subtitle>
        <x-slot:actions>
            <x-mary-button icon="o-backspace" class="btn-outline" label="Limpar" responsive/>
            <x-mary-button icon="o-x-mark" class="btn-outline" label="Voltar" responsive link="{{route('general.person.index')}}"/>
        </x-slot:actions>
    </x-mary-header>
</div>
