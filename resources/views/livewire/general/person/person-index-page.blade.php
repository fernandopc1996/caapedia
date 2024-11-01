<div>
    <x-mary-header title="Personagens">
        <x-slot:subtitle class="text-gray-900">
            Crie e configure os personagens do jogo
        </x-slot:subtitle>
        <x-slot:middle class="!justify-end">
            <x-mary-input placeholder="Procurar"/>
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-funnel" class="btn-outline" />
            <x-mary-button icon="o-plus" class="btn-outline" link="{{route('general.person.form')}}"/>
        </x-slot:actions>
    </x-mary-header>

    <x-mary-table :headers="$headers" :rows="$characters" :sort-by="$sortBy"
        per-page="perPage"
        :per-page-values="[1, 3, 5, 10]"
        with-pagination show-empty-text empty-text="Nenhum personagem"/>
</div>
