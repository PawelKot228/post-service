@props(['post' => null])


<section class="bg-white dark:bg-gray-900 py-8 lg:py-16">
    <div class="max-w-2xl mx-auto px-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">{{ __('Discussion') }} ({{ $post->comments_count }})</h2>
        </div>

        <x-forms.comment :post="$post" >
            <x-button>
                {{ __('Post comment') }}
            </x-button>
        </x-forms.comment>

        <livewire:comment-section post-id="{{ $post->id }}" />

{{--        @foreach($post->comments as $comment)--}}
{{--            <x-comment :comment="$comment" :post="$post" />--}}

{{--            @foreach($comment->comments as $threadComment)--}}
{{--                <x-comment-reply :comment="$threadComment" :post="$post" />--}}
{{--            @endforeach--}}

{{--        @endforeach--}}

    </div>
</section>
