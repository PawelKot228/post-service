<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <x-page-section>
        <x-leading-title>
            {{ __('Create a Post') }}

            <x-slot:buttons>
                <x-button onclick="document.getElementById('post-form').submit()">
                    {{ __('Create') }}
                </x-button>
            </x-slot:buttons>
        </x-leading-title>

        <div class="flex">
            <div class="w-1/2">
                <x-card-simple>
                    <x-slot:header>
                        {{ __('Post details') }}
                    </x-slot:header>

                    <x-forms.post action="{{ route('posts.store') }}"/>
                </x-card-simple>
            </div>
        </div>
    </x-page-section>
</x-app-layout>
