@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 py-3 border-b-2 border-yellow-300 text-sm font-medium leading-5 text-yellow-300 focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 py-3 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-300 hover:text-yellow-100 hover:border-yellow-100 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
