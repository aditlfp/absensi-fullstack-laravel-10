<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center w-auto mt-4 h-3/6 py-2 px-5 font-semibold rounded-md hover:text-slate-700 bg-yellow-400 hover:bg-yellow-300 text-white hover:shadow-none shadow-md transition all ease-in-out .2s']) }}>
    {{ $slot }}
</button>