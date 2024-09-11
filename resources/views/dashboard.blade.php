<x-app-layout>
    <x-mary-alert icon="o-exclamation-triangle" class="alert-success">
        I am using the <strong>default slot.</strong>
    </x-mary-alert>
    <br/>
    <br/>
    <x-mary-button label="Hi!" class="btn-outline" />
    <x-mary-button label="How" class="btn-warning" />
    <x-mary-button label="Are" class="btn-success" />
    <x-mary-button label="You?" class="btn-error btn-sm" />
    <br/>
    <br/>
    <x-mary-card title="Nice things">
        I am using slots here.
     
        <x-slot:figure>
            <img src="https://picsum.photos/500/200" />
        </x-slot:figure>
        <x-slot:menu>
            <x-mary-button icon="o-share" class="btn-circle btn-sm" />
            <x-mary-icon name="o-heart" class="cursor-pointer" />
        </x-slot:menu>
        <x-slot:actions>
            <x-mary-button label="Ok" class="btn-primary" />
        </x-slot:actions>
    </x-mary-card>
    <x-mary-card title="Nice things">
        I am using slots here.
     
        <x-slot:figure>
            <img src="https://picsum.photos/500/200" />
        </x-slot:figure>
        <x-slot:menu>
            <x-mary-button icon="o-share" class="btn-circle btn-sm" />
            <x-mary-icon name="o-heart" class="cursor-pointer" />
        </x-slot:menu>
        <x-slot:actions>
            <x-mary-button label="Ok" class="btn-primary" />
        </x-slot:actions>
    </x-mary-card>
    <x-mary-card title="Nice things">
        I am using slots here.
     
        <x-slot:figure>
            <img src="https://picsum.photos/500/200" />
        </x-slot:figure>
        <x-slot:menu>
            <x-mary-button icon="o-share" class="btn-circle btn-sm" />
            <x-mary-icon name="o-heart" class="cursor-pointer" />
        </x-slot:menu>
        <x-slot:actions>
            <x-mary-button label="Ok" class="btn-primary" />
        </x-slot:actions>
    </x-mary-card>
</x-app-layout>
