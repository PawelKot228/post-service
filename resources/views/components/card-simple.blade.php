<div {{ $attributes->merge(['class' => 'w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700']) }}>
    @if(isset($header))
        <h3 class="text-xl font-semibold">
            {{ $header }}
        </h3>
        <hr class="h-px my-2 bg-gray-200 border-0 dark:bg-gray-700">
    @endif

    {{ $slot }}
</div>
