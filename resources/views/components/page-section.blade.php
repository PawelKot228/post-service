<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div {{ $attributes->merge(['class' => 'bg-white overflow-hidden shadow-xl sm:rounded-lg md:py-6 py-12 px-4 md:px-8'])  }}>
            {{ $slot }}
        </div>
    </div>
</div>
