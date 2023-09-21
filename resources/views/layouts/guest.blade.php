<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ env('APP_NAME', 'Kinerja SAC-PO') }}</title>
	<link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">


	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
	<!-- Scripts -->
	@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">

	<div class="min-h-screen flex flex-col px-4 sm:px-0 pt-6 sm:pt-0 bg-[url('/public/logo/abs2.jpg')] sm:bg-[url('/public/logo/abs4.jpg')] bg-cover bg-top bg-fixed items-center justify-center">
		<div class="sm:flex sm:flex-col justify-center">
			<a href="{{ url('https://sac-po.com') }}">
			<div class="flex flex-col sm:flex-row justify-center items-center gap-2 sm:gap-0 sm:bg-slate-400 sm:p-2 sm:py-4 rounded-md shadow-md">
				<img src="{{ URL::asset('/logo/sac.png') }}" class="w-20 sm:relative -right-2 bg-white p-3 rounded-full shadow"
					alt="...">
				<p
					class="text-slate-800 font-black text-lg p-2 rounded-md sm:rounded-r-full sm:pl-4 text-center sm:pr-2  bg-white shadow">
					PT. Surya Amanah Cendikia</p>
			</div>
		</a>
		</div>
		<div
			class="w-full drop-shadow-2xl sm:max-w-md mt-6 px-6 py-4 bg-gradient-to-br from-yellow-400 to-amber-500 shadow-lg overflow-hidden rounded-lg h-fit mx-4 sm:mx-0 ">
			<div class="mt-4">
			    @auth
				<p class="text-center font-black text-xl text-slate-800">Anda Sudah Login</p>
				@endauth
			    @guest
				<p class="text-center sm:hidden font-black text-xl text-slate-800">Silahkan Login<br>Terlebih Dahulu</p>
				@endguest
			</div>
			@auth
			<div>
				<div class="flex items-center justify-center mt-4">
                    <a href="/dashboard" class="bg-teal-400 hover:bg-teal-500 rounded-lg py-2 px-10 shadow">Klik Disini</a>
                </div>
			</div>
			@endauth
			@guest
			<div>
				{{ $slot }}
			</div>
			@endguest
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
