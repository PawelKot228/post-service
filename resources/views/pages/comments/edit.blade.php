<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <x-page-section>
        <x-leading-title>
            {{ __('Edit comment') }}

            <x-slot:buttons>
                <x-button onclick="document.getElementById('post-form').submit()">
                    {{ __('Save') }}
                </x-button>
                <form class="delete-action inline-block" method="POST"
                      action="{{ route('posts.destroy', [$post]) }}"
                >
                    @csrf
                    @method('DELETE')

                    <x-danger-button type="submit">
                        {{ __('Delete') }}
                    </x-danger-button>
                </form>
            </x-slot:buttons>
        </x-leading-title>

        <div class="flex">
            <div class="w-1/2 px-4 py-2">
                <x-card-simple>
                    <x-slot:header>
                        {{ __('Post details') }}
                    </x-slot:header>

                    <x-forms.post action="{{ route('posts.update', [$post]) }}" :post="$post" >
                        @method('PUT')
                    </x-forms.post>
                </x-card-simple>
            </div>
            <div class="w-1/2 px-4 py-2">

                <x-card-simple>
                    <x-slot:header>
                        {{ __('Gallery') }}
                    </x-slot:header>

                    <livewire:file-uploader
                        source-id="{{ $post->id }}"
                        source-type="{{ $post->getTable() }}"
                    />
                </x-card-simple>

            </div>
        </div>
    </x-page-section>
</x-app-layout>
