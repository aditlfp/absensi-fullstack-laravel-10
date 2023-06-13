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

    <div class="min-h-screen flex pt-6 sm:pt-0 bg-slate-300/50 items-center justify-center">

            <div
                class="w-full drop-shadow-2xl sm:max-w-md mt-6 px-6 py-4 bg-gradient-to-br from-[yellow] to-[orange] shadow-lg overflow-hidden rounded-lg h-fit mx-4 sm:mx-0 ">
                <div class="mt-4">
                    <h2 class="text-2xl font-bold">Silahkan</h2>
                    <span class="text-lg">Login Terlebih Dahulu</span>
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