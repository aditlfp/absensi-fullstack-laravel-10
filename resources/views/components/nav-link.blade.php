@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center w-auto mt-4 h-3/6 px-2 font-semibold rounded-md text-slate-200 bg-[#3A4F50] hover:bg-[#3A4F50]/80 hover:text-white hover:shadow-none shadow-md transition-all ease-in-out duration-200 overflow-hidden'
            : 'inline-flex text-white items-center w-auto mt-4 h-3/6 px-2 hover:bg-[#3A4F50]/80 hover:text-white hover:shadow-md rounded-md transition-all ease-in-out duration-200 font-semibold bg-[#3A4F50]/70 overflow-hidden';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
