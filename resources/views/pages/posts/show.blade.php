<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <x-page-section>
        <x-leading-title>
            {{ $post->title }}
        </x-leading-title>

        <div class="flex items-center ">

            @if($post->cover)
                <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-60 md:rounded-none md:rounded-l-lg"
                     src="{{ $post->cover->url }}" alt=""
                >
            @endif
            <div class="p-4 leading-normal">
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    {{ $post->text }}
                </p>
            </div>
        </div>

        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

        <div>
            <h3 class="text-xl md:text-2xl font-semibold mb-2">{{ __('Gallery') }}</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($post->gallery as $image)
                    <div>
                        <img class="h-auto max-w-full rounded-lg"
                             src="{{ $image->url }}"
                             alt=""
                        >
                    </div>
                @endforeach
            </div>
        </div>

        <h3 class="text-xl md:text-2xl font-semibold mb-2">{{ __('Comments') }}</h3>

        <x-comment-section :post="$post" />

    </x-page-section>
</x-app-layout>
