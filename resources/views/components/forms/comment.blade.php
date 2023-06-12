@props([
    'comment' => null,
])

<form
    class="mb-6"
    method="POST"
    {!! $attributes !!}
>
    @csrf

    <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <label for="text" class="sr-only">{{ __('Your comment') }}</label>
        <x-textarea
            class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
            id="comment" name="text"
            rows="6" placeholder="{{ __('Write a comment...') }}"
            required
        >
            {{ $comment?->text ?? old('text') }}
        </x-textarea>
        <x-input-error for="text" class="mt-2" />
    </div>

    {{ $slot }}


</form>
