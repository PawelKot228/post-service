<div class="flex justify-between items-center">
    <h2 class="font-semibold text-xl md:text-2xl lg:text-3xl text-gray-800 leading-none">
        {{ $slot }}
    </h2>

    @if (isset($buttons))
        <div class="right-2">
            {!! $buttons !!}
        </div>
    @endif
</div>

<hr class="h-px mt-2 mb-4 bg-gray-400 border-0 dark:bg-gray-700">
