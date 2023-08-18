@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center w-auto mt-4 h-3/6 px-4 py-2 font-semibold rounded-md hover:text-slate-700 bg-red-500 hover:bg-red-400 text-white hover:shadow-none shadow-md transition all ease-in-out .2s'
            : 'inline-flex text-slate-700 items-center w-auto mt-4 h-3/6 px-2 hover:bg-red-400 text-white hover:shadow-md rounded-md transition all ease-in-out .2s font-semibold';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
