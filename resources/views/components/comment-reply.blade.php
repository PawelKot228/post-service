@props(['comment' => null])

<x-comment class="ml-6 lg:ml-12" :comment="$comment">
    {{ $slot }}
</x-comment>
