<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <livewire:profile.update-profile-information-form />
            </div>
            {{--
            <div>
                <livewire:profile.theme-user-form />
            </div>

            <div>
                <livewire:profile.update-password-form />
            </div>

            <div>
                <livewire:profile.delete-user-form />
            </div>
            --}}
        </div>
    </div>
</x-app-layout>
