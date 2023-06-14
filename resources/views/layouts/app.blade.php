<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ env('APP_NAME', 'Absensi SAC-PONOROGO') }}</title>

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
		integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
	<!-- Scripts -->
	@vite(['resources/css/app.css', 'resources/js/app.js'])

	<!-- Webcam CDN -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

	<style>
		*,
		body,
		html {
			overflow-x: hidden;
		}
	</style>

</head>

<body class="font-sans antialiased bg-slate-400">
	<div class="min-h-screen">
		@include('layouts.navbar')

		<!-- Page Heading -->
		@if (isset($header))
			<header class="bg-white shadow">
				<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
					{{ $header }}
				</div>
			</header>
		@endif

		<!-- Page Content -->
		<main>

			{{ $slot }}

		</main>

	</div>
	<div class="flex justify-center">
		<div class="fixed bottom-1 z-[999]">
			<x-menu-mobile />
		</div>
	</div>
	<script src="{{ URL::asset('src/js/jquery-min.js') }}"></script>

	<script>
		$(document).ready(function() {
			$("#searchInput").on("keyup", function() {
				let value = $(this).val().toLowerCase();
				$("#searchTable tbody tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			});
			$('#nav-btn').click(function() {
				$('#mobile-menu').addClass('absolute');
				$('#mobile-menu').toggle();
			});
		});

		//input ++

		$(document).ready(function(){
			var count = 1
			$('#add').click(function() {
				var input = $('<input class="input input-bordered my-2" placeholder="Add Name ...." name="name[]" type="text"/>');
				$('#inputContainer').append(input);

				count++
			});
		});

		$(document).ready(function(){
			var count = 1
			$('#btnAdd').click(function() {
				var ElementAsli = $('#inputContainer').html();
				var input = $('<select class="my-2 select select-bordered">').html(ElementAsli);
				$('#inputContainer').append(input);
				count++
			});
		});

		 //End input ++ 

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

				$("#searchInput").on("keyup", function() {
					let value = $(this).val().toLowerCase();
					$("#searchTable tbody tr").filter(function() {
						$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
			});
			var table = $("#table");
			var table2 = $("#table2");
			var btn2 = $('#btnShow2');
			var menuUser = $('#menuUser');
			var user = $('#user');
			var menu1 = $('.menu1');
			var menu2 = $('.menu2');
			var menu3 = $('.menu3');
			var menu4 = $('.menu4');
			var menu5 = $('.menu5');
			var menu6 = $('.menu6');
			var absen = $('#absen');
			var iPulang = $('.iPulang');
			var iAbsensi = $('.iAbsensi');

			$('#btnShow').click(function() {
				$('#pag-1').toggle();
				btn2.toggle();
				table.toggle();
				table.addClass('my-0 sm:my-5 mx-5 shadow-md');
				iPulang.toggle();

			});

			btn2.click(function() {
				table2.toggle();
				table2.addClass('my-0 sm:my-5 mx-0 sm:mx-5 shadow-md');
				iAbsensi.toggle();
			});

			menuUser.click(function() {
				user.toggle();
				menu2.toggle();
				// menu3.toggle();
				// menu4.toggle();
				menu5.toggle();

			});

			$('#menuClient').click(function() {
				$('#client').toggle();
				menu1.toggle();
				// menu3.toggle();
				// menu4.toggle();
				menu5.toggle();

			});

			$('#menuKerjasama').click(function() {
				$('#kerjasama').toggle();
				// menu1.toggle();
				// menu2.toggle();
				menu4.toggle();
				// menu5.toggle();
				menu6.toggle();

			});

			$('#menuAbsen').click(function() {
				var absen = $('#absen').toggle();
				// menu1.toggle();
				// menu2.toggle();
				menu3.toggle();
				// menu5.toggle();
				menu6.toggle();
			});
			$('#menuDevisi').click(function() {
				$('#devisi').toggle();
				menu1.toggle();
				menu2.toggle();
				// menu3.toggle();
				// menu4.toggle();
			});
			$('#menuPerlengkapan').click(function() {
				$('#perlengkapan').toggle();
				// menu1.toggle();
				// menu2.toggle();
				menu3.toggle();
				menu4.toggle();
			});
		});
	</script>
</body>

</html>
