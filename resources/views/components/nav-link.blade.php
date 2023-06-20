@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center w-auto mt-4 h-3/6 px-2 font-semibold rounded-md text-slate-700 bg-yellow-300 hover:bg-yellow-400 hover:text-white hover:shadow-none shadow-md transition all ease-in-out .2s overflow-hidden'
            : 'inline-flex text-white items-center w-auto mt-4 h-3/6 px-2 hover:bg-yellow-400 hover:text-white hover:shadow-md rounded-md transition all ease-in-out .2s font-semibold bg-slate-400/30 overflow-hidden';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
