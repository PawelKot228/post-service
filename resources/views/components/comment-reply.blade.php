@props([
    'post' => null,
    'comment' => null,
])

<x-comment class="ml-6 lg:ml-12" :comment="$comment" :post="$post">
    {{ $slot }}
</x-comment>
