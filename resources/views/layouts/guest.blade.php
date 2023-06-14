<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME', 'Absensi SAC-PO') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">

    <div class="min-h-screen flex flex-col pt-6 sm:pt-0 bg-slate-300 items-center justify-center">
        <div class="sm:flex sm:flex-col justify-center">
            <div class="flex flex-col sm:flex-row justify-center items-center gap-2 sm:gap-0">
                <img src="{{ URL::asset('/logo/sac.png') }}" class="w-20 sm:relative -right-2 bg-white p-3 rounded-full shadow" alt="...">
                <p class="text-slate-800 font-black text-lg p-2 rounded-md sm:rounded-r-full sm:pl-4 text-center sm:pr-2 z-[10] bg-white shadow">PT. Surya Amanah Cendikia</p>
            </div>
        </div>
            <div
                class="w-full drop-shadow-2xl sm:max-w-md mt-6 px-6 py-4 bg-gradient-to-br from-yellow-400 to-amber-500 shadow-lg overflow-hidden rounded-lg h-fit mx-4 sm:mx-0 ">
                <div class="mt-4">
                    <p class="text-center font-black text-xl text-slate-800">Silahkan Login Terlebih Dahulu</p>
                </div>
                {{ $slot }}
            </div>
    </div>

    <script src="{{ URL::asset('src/js/jquery-min.js') }}"></script>

    <script>
        // Preview Script
        $(document).ready(function() {
            $('#img').change(function() {
                const input = $(this)[0];
                const preview = $('.preview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.show();
                        preview.find('img').attr('src', e.target.result);
                        preview.removeClass('hidden');
                        preview.find('img').addClass('rounded-md shadow-md my-4');
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
</body>

</html>