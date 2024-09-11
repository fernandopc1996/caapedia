<div>
    <x-mary-card title="{{ __('Theme System') }}" subtitle="{{ __('Update your account\'s profile theme.') }}" shadow separator>
        <x-mary-form wire:submit="save">
            <x-mary-choices-offline
                label="Temas"
                wire:model="theme"
                :options="$themes"
                single
                searchable />
            <div>
                <x-mary-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
            </div>
            
        </x-mary-form>
    </x-mary-card>
</div>
