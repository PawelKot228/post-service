<a {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-purple-700 focus:ring-purple-300 hover:bg-purple-800 active:bg-purple-900 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
