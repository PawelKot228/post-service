@props(['post' => null])

<form id="post-form" method="POST" {{ $attributes->merge(['action' => '#']) }}>
    @csrf
    <div class="p-2">
        <x-label for="title" value="{{ __('Title') }}"/>
        <x-input id="title" name="title" type="text" class="mt-1 block w-full" autofocus required
                 value="{{ old('title') ?? $post?->title }}"
        />
        <x-input-error for="title" class="mt-2"/>
    </div>
    <div class="p-2">
        <x-label for="text" value="{{ __('Text') }}"/>
        <x-textarea id="text" name="text" type="text"
                    class="mt-1 block w-full"
        >
            {{ old('text') ?? $post?->text ?? '' }}
        </x-textarea>
        <x-input-error for="text" class="mt-2"/>
    </div>

    {{ $slot }}

</form>
