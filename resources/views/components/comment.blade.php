@props([
    'post' => null,
    'comment' => null
])

<article {{ $attributes->merge(['class' => 'p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900']) }}>
    <footer class="flex justify-between items-center mb-2">
        <div class="flex items-center">
            <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                <img
                    class="mr-2 w-6 h-6 rounded-full"
                    src="{{ $comment->user->profile_photo_url }}"
                    alt="{{ $comment->user->name }}">
                {{ $comment->user->name }}
            </p>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                <time pubdate
                      title="{{ $comment->created_at->isoFormat('D MMMM YYYY, HH:ss') }}">
                    {{ $comment->created_at->isoFormat('D MMMM YYYY, HH:ss') }}
                </time>
            </p>
        </div>
        @if($comment->user_id === auth()->id())
            <button id="dropdownComment{{ $comment->id }}Button"
                    data-dropdown-toggle=dropdownComment{{ $comment->id }}Button"
                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    type="button">
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                    </path>
                </svg>
                <span class="sr-only">Comment settings</span>
            </button>
            <!-- Dropdown menu -->
            <div id=dropdownComment{{ $comment->id }}Button"
                 class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
            >
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownComment{{ $comment->id }}Button"
                >
                    <li>
                        <a href="{{ route('posts.comments.edit', [$post, $comment]) }}"
                           class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            {{ __('Edit') }}
                        </a>
                    </li>


                    <li>
                        <form class="delete-action" method="POST"
                              action="{{ route('posts.comments.destroy', [$post, $comment]) }}"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                class="block w-full py-2 px-4 text-left hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            >
                                {{ __('Remove') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @endif
    </footer>
    <p class="text-gray-500 dark:text-gray-400">
        {{ $comment->text }}
    </p>
    @if(!$comment->comment_id)
        <div
            x-cloak
            x-data="{
                showForm: false
            }"
        x-key="{{ $comment->id }}"
        >
            <div class="flex items-center mt-4 space-x-4">
                <button type="button"
                        class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400"
                        @click="showForm = !showForm"
                >
                    <svg aria-hidden="true" class="mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    {{ __('Reply') }}
                </button>
            </div>

            <div
                x-show="showForm"
            >
                <x-forms.comment
                    :id='"post-form-$comment->id"'
                    :post="$post"
                    :action="route('posts.comments.store', [$post, $comment])"
                >
                    <x-input type="hidden" name="comment_id" :value="$comment->id" />


                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        {{ __('Post comment') }}
                    </button>

                </x-forms.comment>
            </div>
        </div>

    @endif
</article>
