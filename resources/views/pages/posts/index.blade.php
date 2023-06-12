<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <x-page-section class="space-y-2 md:space-y-6">
        @foreach($posts as $post)
            <div class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                @if($post->cover)
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-60 md:rounded-none md:rounded-l-lg"
                         src="{{ $post->cover->url }}" alt=""
                    >
                @endif

                <div class="flex flex-1 flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $post->title }}

                        @if($post->user_id === auth()->id())
                            <div class="float-right">
                                <x-button-info :href="route('posts.edit', ['post' => $post->id])">
                                    {{ __('Edit') }}
                                </x-button-info>
                            </div>
                        @endif

                    </h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        {{ $post->text }}
                    </p>
                    <div class="flex justify-between items-center">
                        <div>
                            {{ $post->published_at->isoFormat('HH:ss, D MMMM YYYY') }}
                        </div>
                        <div>
                            <span class="text-sm font-semibold">
                                {{ $post->comments_count }} {{ __('Comments') }}
                            </span>

                            <x-button-link href="{{ route('posts.show', [$post]) }}">
                                {{ __('Read more') }}
                                <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </x-button-link>
                        </div>
                    </div>
                </div>
            </div>


{{--            <div class="bg-white border border-gray-200 rounded-lg shadow">--}}
{{--                --}}{{--                <a href="#">--}}
{{--                --}}{{--                    <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />--}}
{{--                --}}{{--                </a>--}}
{{--                <div class="p-5">--}}
{{--                    <a href="#">--}}
{{--                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">--}}
{{--                            {{ $post->title }}--}}
{{--                        </h5>--}}
{{--                    </a>--}}
{{--                    <p class="mb-3 font-normal text-gray-700">--}}
{{--                        {{ $post->text }}--}}
{{--                    </p>--}}
{{--                    <div class="flex justify-between">--}}
{{--                        <div>--}}
{{--                            {{ $post->published_at->isoFormat('HH:ss, D MMMM YYYY') }}--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <span class="text-sm font-semibold">--}}
{{--                                {{ $post->comments_count }} {{ __('Comments') }}--}}
{{--                            </span>--}}
{{--                            <x-button-link href="{{ route('posts.show', [$post]) }}">--}}
{{--                                {{ __('Read more') }}--}}
{{--                                <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>--}}
{{--                            </x-button-link>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

        @endforeach
        {!! $posts->links() !!}
    </x-page-section>
</x-app-layout>
