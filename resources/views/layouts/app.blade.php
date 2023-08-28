<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ env('APP_NAME', 'Absensi SAC-PONOROGO') }}</title>
	<link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
		integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
	<!-- Scripts -->
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<!-- Webcam CDN -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
    
   
	
    
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
		<div class="fixed bottom-0 z-[999]">
			<x-menu-mobile />
		</div>
	</div>
	<script src="{{ URL::asset('src/js/jquery-min.js') }}"></script>
	 <!-- cdnjs -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>

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
			
			 $('.lazy').lazy({
                // your configuration goes here
                scrollDirection: 'vertical',
                effect: 'fadeIn',
                visibleOnly: true,
                onError: function(element) {
                    console.log('error loading ' + element.data('src'));
                }
            }); 
		});
		//input ++

		$(document).ready(function() {
			var count = 1
			$('#add').click(function() {
				var input = $(
					'<input class="input input-bordered my-2" placeholder="Add Name ...." name="name[]" type="text"/>'
				);
				$('#inputContainer').append(input);

				count++
			});
		});

		$(document).ready(function() {
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
						preview.find('.img1').attr('src', e.target.result);
						preview.removeClass('hidden');
						preview.find('.img1').addClass('rounded-md shadow-md my-4');
					};

					reader.readAsDataURL(input.files[0]);
				}
			


				// handle rate

				$("#searchInput").on("keyup", function() {
					let value = $(this).val().toLowerCase();
					$("#searchTable tbody tr").filter(function() {
						$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
				
			});
			$('#img2').change(function() {
				const input = $(this)[0];
				const preview = $('.preview2');

				if (input.files && input.files[0]) {
					const reader = new FileReader();

					reader.onload = function(e) {
						preview.show();
						preview.find('.img2').attr('src', e.target.result);
						preview.removeClass('hidden');
						preview.find('.img2').addClass('rounded-md shadow-md my-4');
					};

					reader.readAsDataURL(input.files[0]);
				}
			});
			$('#img3').change(function() {
				const input = $(this)[0];
				const preview = $('.preview3');

				if (input.files && input.files[0]) {
					const reader = new FileReader();

					reader.onload = function(e) {
						preview.show();
						preview.find('.img3').attr('src', e.target.result);
						preview.removeClass('hidden');
						preview.find('.img3').addClass('rounded-md shadow-md my-4');
					};

					reader.readAsDataURL(input.files[0]);
				}
			});

			var btnAbsensi = $("#btnAbsensi");
			var btnRating = $("#btnRating");

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
			var menu7 = $('.menu7');
			var menu8 = $('.menu8');
			var menu9 = $('.menu9');
			var menu10 = $('.menu10');
			var menu11 = $('.menu11');
			var menu12 = $('.menu12');
			var menu13 = $('.menu13');
			var menu14 = $('.menu14');
			var absen = $('#absen');
			var iPulang = $('.iPulang');
			var iAbsensi = $('.iAbsensi');

			btnAbsensi.click(function() {
				btnRating.toggle();
				$('#isiAbsen').toggle();
				$('#ngabsen').toggle();
				$('#ngeLembur').toggle();
				$('#isiLembur').toggle();
			});

			btnRating.click(function() {
				$('#cekMe').toggle();
				$('#cekRate').toggle();
			});

			// $('#isiAbsen').click(function() {
			// 	table.toggle();
			// 	table.addClass('my-0 sm:my-5 mx-5 shadow-md');
			// });

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
				menu8.toggle();
				menu11.toggle();
                menu12.toggle();
                menu14.toggle();
			});

			$('#menuClient').click(function() {
				$('#client').toggle();
				menu1.toggle();
				// menu3.toggle();
				// menu4.toggle();
				menu5.toggle();
				menu8.toggle();
                menu11.toggle();
                menu12.toggle();
                menu14.toggle();
			});

			$('#menuKerjasama').click(function() {
				$('#kerjasama').toggle();
				// menu1.toggle();
				// menu2.toggle();
				menu4.toggle();
				// menu5.toggle();
				menu6.toggle();
				menu7.toggle();
				menu9.toggle();
				menu10.toggle();
				menu13.toggle();

			});

			$('#menuAbsen').click(function() {
				var absen = $('#absen').toggle();
				// menu1.toggle();
				// menu2.toggle();
				menu3.toggle();
				// menu5.toggle();
				menu6.toggle();
				menu7.toggle();
				menu9.toggle();
				menu10.toggle();
				menu13.toggle();

			});
			$('#menuDevisi').click(function() {
				$('#devisi').toggle();
				menu1.toggle();
				menu2.toggle();
				// menu3.toggle();
				// menu4.toggle();
				menu8.toggle();
				menu11.toggle();
				menu12.toggle();
				menu14.toggle();
			});
			$('#menuPerlengkapan').click(function() {
				$('#perlengkapan').toggle();
				// menu1.toggle();
				// menu2.toggle();
				menu3.toggle();
				menu4.toggle();
				menu7.toggle();
				menu9.toggle();
				menu10.toggle();
				menu13.toggle();

			});
			$('#menuLembur').click(function() {
				$('#lembur').toggle();
				menu3.toggle();
				menu4.toggle();
				menu6.toggle();
				menu9.toggle();
				menu10.toggle();
				menu13.toggle();

			});
			$('#menuJabatan').click(function() {
				$('#jabatan').toggle();
				menu3.toggle();
				menu4.toggle();
				menu6.toggle();
				menu7.toggle();
				menu10.toggle();
				menu13.toggle();

			});
			$('#menuShift').click(function() {
				$('#shift').toggle();
				menu1.toggle();
				menu2.toggle();
				menu5.toggle();
				menu11.toggle();
				menu12.toggle();
				menu14.toggle();
			});
			$('#menuHoliday').click(function() {
				$('#holiday').toggle();
				menu3.toggle();
				menu4.toggle();
				menu6.toggle();
				menu7.toggle();
				menu9.toggle();
				menu13.toggle();
			});
			
			$('#menuLokasi').click(function() {
			  $('#lokasi').toggle();  
			    menu3.toggle();
    			menu4.toggle();
    			menu6.toggle();
    			menu7.toggle();
    			menu9.toggle();
    			menu10.toggle();
			});
		});
		$(document).ready(function(){
			$(document).on("click", ".myModalBtn", function(){
				var modalId = $(this).attr('id').replace('myModalBtn', '');
				var modal = $('#myModal' + modalId);
				modal.removeClass('hidden ');
				modal.addClass(' inset-0 z-[999]');
			});

			$(document).on("click", ".close", function(){
				var modalId = $(this).closest('.modalz').attr('id').replace('myModal', '');
				var modal = $('#myModal' + modalId);
				modal.removeClass(' inset-0 z-[99]');
				modal.addClass('hidden ');
			});
		});
	</script>
</body>

</html>
