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
                      action="{{ route('posts.comments.destroy', [$post->id, $comment->id]) }}"
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
                <x-forms.comment
                    id="post-form"
                    :comment="$comment"
                    :action="route('posts.comments.update', [$post->id, $comment->id])"
                >
                    @method('PUT')
                </x-forms.comment>
            </div>
        </div>
    </x-page-section>
</x-app-layout>
