<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ env('APP_NAME', 'Kinerja SAC-PONOROGO') }}</title>
	<link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">

	<link rel="preconnect" href="https://fonts.bunny.net">
	<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
		integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
	<script src="{{ URL::asset('src/js/jquery-min.js') }}"></script>
	<!-- Scripts -->
	@vite(['resources/css/app.css', 'resources/js/app.js'])

	{{-- Leaflet --}}
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
		integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
		integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/remixicon@2.2.0/fonts/remixicon.css" rel="stylesheet">
	<style>
		#map {
			height: 180px;
		}
	</style>

</head>

<body class="font-sans antialiased  bg-slate-400">
	<div class="min-h-screen pb-[12.5rem]">
		@include('../layouts/navbar')
		<div class="justify-start flex items-center">
			@forelse ($absen as $arr)
				@if (Auth::user()->id == $arr->user_id &&
						$arr->tanggal_absen == Carbon\Carbon::now()->format('Y-m-d') &&
						$arr->absensi_type_pulang == null)
					<div
						class="text-center rounded-tr-lg rounded-bl-lg mb-5 w-fit text-md sm:text-xl font-semibold text-slate-300 bg-red-500 py-2 px-4 shadow-md ml-5 inset-0">
						<p>Kamu Belum Absen Pulang !!</p>
					</div>
				@endif
			@empty
			@endforelse

			@forelse ($lembur as $i)
				@if (Auth::user()->id == $i->user_id)
					@if ($i->jam_selesai == null)
						<div
							class="text-center rounded-tr-lg rounded-bl-lg mb-5 sm:w-fit text-md sm:text-xl font-semibold text-slate-300 bg-red-500 py-2 px-4 shadow-md ml-5 sm:ml-10 inset-0">
							<p>Kamu Belum Mengakhiri Lembur !!</p>
						</div>
					@endif
				@else
				@endif
			@empty
			@endforelse

		</div>
		<div class="sm:mx-10 mx-5 bg-slate-500 rounded-md shadow-md">
			<main>
			    @if(Route::has('login') && Auth::user()->divisi->jabatan->code_jabatan == 'MITRA' || Auth::user()->divisi->jabatan->code_jabatan == 'LEADER')
			        @auth
			           <div class="bg-amber-500 mr-10 sm:w-fit flex justify-start px-4" style="border-radius: 5px 0px 6px 0px">
			               <span class="text-white text-center text-xs font-semibold my-1 sm:pr-5"><i class="text-center">Wellcome, You Logged As, {{Auth::user()->divisi->jabatan->name_jabatan}}</i></span> 
			           </div>
			        @endauth
			    @endif
				<div class="sm:mx-10 mx-5 bg-slate-500 rounded-md  ">
					<div class="py-5">
						<div class="flex items-end justify-end mr-3">
							<span
								class="text-xs font-bold text-white sm:hidden bg-green-500 px-4 py-1 rounded-full shadow-md">{{ Carbon\Carbon::now()->isoFormat('dddd, D/MMMM/Y') }},
								<span id="jam"></span>
							</span>
						</div>
						<div class="flex flex-col items-center gap-2 justify-center pt-2 px-2 overflow-hidden">
							<div class="flex justify-end w-full mx-10">
								<div
									class="text-center md:flex hidden justify-end items-end rounded-tr-lg rounded-bl-lg mb-5 w-fit text-md sm:text-xl font-semibold text-slate-100 bg-red-500 py-2 px-4 shadow-md ml-10 ">
									<span class="text-white">{{ Carbon\Carbon::now()->format('d-m-Y') }}</span>
								</div>
							</div>
							
							{{-- Handle Check Kode Jabatan --}}
						@if(Auth::user()->divisi->jabatan->code_jabatan != 'MITRA' && Auth::user()->divisi->jabatan->code_jabatan != 'LEADER')
							
							{{-- absensi --}}
							<div id="btnAbsensi"
								class=" w-full flex justify-center items-center gap-2 bg-amber-400 rounded-md h-11 hover:bg-amber-500 transition-all ease-linear .2s">
								<i class="ri-todo-line text-xl"></i>
								<button class="uppercase font-bold text-sm">
									Attendance( Kehadiran )
								</button>
							</div>
							{{-- menu menu dashboard absensi --}}
							<div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="ngabsen">
								<a href="{{ route('absensi.index') }}" class="btn btn-info w-full" id="aAbsen">Kehadiran</a>
							</div>
							<div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="ngeLembur">
								<a href="{{ route('lembur.index') }}" class="btn btn-info w-full">Lembur</a>
							</div>
							<div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="ngIzin">
								<a href="{{ route('izin.create') }}" class="btn btn-info w-full">Izin</a>
							</div>
							<div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="isiAbsen">
								<a href="historyAbsensi" class="btn btn-info w-full">Riwayat Kehadiran</a>
							</div>
							<div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="isiLembur">
								<a href="{{ route('lemburIndexUser') }}" class="btn btn-info w-full">Riwayat Lembur</a>
							</div>
							<div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="isiIzin">
								<a href="{{ route('izin.index') }}" class="btn btn-info w-full">Riwayat Izin</a>
							</div>
						</div>
						<div class="flex flex-col items-center gap-2 justify-center pt-2 px-2 overflow-hidden">
							<div id="btnCP" disabled
								class="text-gray-700 w-full flex justify-center items-center gap-2 bg-amber-400/70 rounded-md h-11 cursor-not-allowed transition-all ease-linear .2s">
								<i class="ri-list-check-3"></i>
								<button class="uppercase font-bold text-sm cursor-not-allowed" disabled>
									Kinerja harian <br>(coming soon)
								</button>
							</div>
						</div>
						<div class="flex flex-col items-center gap-2 justify-center pt-2 px-2 overflow-hidden">
							<div id="btnRating"
								class=" w-full flex justify-center items-center gap-2 bg-amber-400 rounded-md h-11 hover:bg-amber-500 transition-all ease-linear .2s">
								<i class="ri-user-star-line text-xl"></i>
								<button class="uppercase font-bold text-sm">Rating</button>
							</div>
							<div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="cekMe">
								<a href="{{ url('rate/' . Auth::user()->id) }}" class="btn btn-info w-full">Check Rating Saya</a>
							</div>
							@if (Auth::user()->role_id == 2)
								<div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="cekRate">
									<a href="{{ route('leader-rating.index') }}" class="btn btn-info w-full">Rating</a>
								</div>
							@else
							@endif
						</div>
						<div class="flex flex-col items-center gap-2 justify-center pt-2 px-2 overflow-hidden">
							<div id="btnLaporan"
								class=" w-full flex justify-center items-center gap-2 bg-amber-400 rounded-md h-11 hover:bg-amber-500 transition-all ease-linear .2s">
								<i class="ri-speak-line text-xl"></i>
								<button class="uppercase font-bold text-sm">Laporan</button>
							</div>
							<div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="cekLaporan">
								<a href="{{ route('laporan.index') }}" class="btn btn-info w-full">Riwayat Laporan</a>
							</div>
							<div class="hidden w-full space-y-4 px-2 sm:px-16 overflow-hidden" id="tambahLaporan">
								<a href="{{ route('laporan.create') }}" class="btn btn-info w-full">Tambah Laporan</a>
							</div>
						</div>
							
					@else

								{{-- menu menu mitra --}}
								<div class="w-full space-y-4  sm:px-16 overflow-hidden flex items-center"id="Luser">
								    <a href="{{ route('lead_user') }}" class="btn btn-info w-full"><i class="ri-pass-pending-line text-xl"></i>Data Karyawan</a>
								</div>
								@if(Auth::user()->role_id == 2)
								    <div class="w-full space-y-4  sm:px-16 overflow-hidden" id="Ljadwal">
    									<a href="{{ route('admin-jadwal.index') }}" class="btn btn-info w-full"><i class="ri-calendar-check-line text-xl"></i>Jadwal User</a>
    								</div>
								@else
    								<div class="w-full space-y-4  sm:px-16 overflow-hidden" id="Ljadwal">
    									<a href="{{ route('leader-jadwal.index') }}" class="btn btn-info w-full"><i class="ri-calendar-check-line text-xl"></i>Jadwal</a>
    								</div>
								@endif
								<div class="w-full space-y-4  sm:px-16 overflow-hidden" id="Labsensi">
									<a href="{{ route('lead_absensi') }}" class="btn btn-info w-full"><i class="ri-todo-line text-xl"></i>Data Absensi</a>
								</div>
								<div class="w-full space-y-4  sm:px-16 overflow-hidden" id="lizin">
									<a href="{{ route('lead_izin') }}" class="btn btn-info w-full"><i class="ri-shield-user-line text-xl"></i>Data Izin</a>
								</div>
								<div class="w-full space-y-4  sm:px-16 overflow-hidden" id="Llembur">
									<a href="{{ route('lead_lembur') }}" class="btn btn-info w-full"><i class="ri-time-line text-xl"></i>Data Lembur</a>
								</div>
								<div class="w-full space-y-4  sm:px-16 overflow-hidden" id="Llaporan">
									<a href="{{ route('lead_laporan') }}" class="btn btn-info w-full"><i class="ri-image-add-line text-xl"></i>Data Laporan</a>
								</div>
								@if (Auth::user()->divisi->jabatan->code_jabatan == "MITRA")
								<div class="w-full space-y-4  sm:px-16 overflow-hidden" id="LRating">
									<a href="{{ route('mitra-rating.index') }}" class="btn btn-info w-full"><i class="ri-sparkling-line text-xl"></i>Rating</a>
								</div>
									
								@else
								<div class="w-full space-y-4  sm:px-16 overflow-hidden" id="LRating">
									<a href="{{ route('leader-rating.index') }}" class="btn btn-info w-full"><i class="ri-sparkling-line text-xl"></i>Rating</a>
								</div>
								@endif
					@endif

						{{-- handle Pulang --}}
						<div class="flex justify-center sm:justify-end">
							@foreach ($absen as $arr)
								@if (Auth::user()->id == $arr->user_id && $arr->absensi_type_pulang == null)
									@php
										$now = now();
										$shiftEnd = \Carbon\Carbon::parse($arr->shift->jam_end);
										$timeDifference = $now->diffInMinutes($shiftEnd, false);
									@endphp

									    <span class="hidden">
    										<span id="userId" data-user-id="{{ $arr->user_id }}" data-auth-user="{{ Auth::user()->id }}"></span>
    										<span id="endTime" endTimer="{{ $arr->shift->jam_end }}"></span>
    											@foreach ($shift as $shif)
												@if ($shif->client_id == Auth::user()->kerjasama->client_id && $arr->shift->jam_start == $shif->jam_start)
												<span id="startTime" startTimer="{{ $shif->jam_start }}"></span>
													
												@endif
											@endforeach
    									</span>
										<div>
											<button id="modalPulangBtn"
												class="bg-yellow-600 flex justify-center shadow-md hover:bg-yellow-700 text-white hover:shadow-none px-3 py-1 text-xl rounded-md transition all ease-out duration-100 mt-5 mr-0 sm:mr-2 uppercase items-center"><i
													class="ri-run-line font-sans text-3xl"></i><span class="font-bold">Pulang</span>
											</button>
										</div>
										<div
											class="fixed inset-0 modalp hidden bg-slate-500/10 backdrop-blur-sm transition-all duration-300 ease-in-out">
											<div class="bg-slate-200 w-fit p-5 rounded-md shadow">
												<div class="flex justify-end mb-3">
													<button class="btn btn-error scale-90 close">&times;</button>
												</div>
												<form action="{{ route('data.update', $arr->id) }}" method="POST"
													class="flex justify-center items-center  ">
													@csrf
													@method('PUT')
													<div class="flex justify-center flex-col ">

														<div class="flex flex-col gap-2">
															<p class="text-center text-lg font-semibold">Apakah Anda Yakin Ingin Pulang Sekarang?</p>
															<span id="labelWaktu"></span>
    														<span class="flex justify-center">
    															<span id="jam2" class="badge badge-info underline font-semibold text-slate-800 text-sm"></span>
    														</span>
														</div>
														<div class="flex justify-center items-center">
															<button type="submit"
																class="bg-yellow-600 flex justify-center shadow-md hover:bg-yellow-700 text-white hover:shadow-none px-3 py-1 text-xl rounded-md transition all ease-out duration-100 mt-5 mr-0 sm:mr-2 uppercase items-center"><i
																	class="ri-run-line font-sans text-3xl"></i><span class="font-bold">Pulang Sekarang</span>
															</button>
															<input id="lat" name="lat_user" value="" class="hidden" />
															<input id="long" name="long_user" value="" class="hidden" />
															<div id="map" class="hidden"></div>
														</div>
													</div>
												</form>
											</div>
										</div>
									
								@else
								@endif
							@endforeach
						</div>
						{{-- handle akhiri lembur --}}
						<div class="flex justify-center sm:justify-end">
							@foreach ($lembur as $i)
								@if (Auth::user()->id == $i->user_id && $i->jam_selesai == null)
									<form action="{{ url('lembur/' . $i->id) }}" method="POST" class="tooltip">
										@csrf
										@method('PUT')
										<button type="submit"
											class="bg-yellow-600 flex justify-center shadow-md hover:bg-yellow-700 text-white hover:shadow-none px-3 py-1 text-xl rounded-md transition all ease-out duration-100 mt-5 mr-0 sm:mr-2 uppercase items-center"><i
												class="ri-run-line font-sans text-3xl"></i><span class="font-bold">Selasaikan Lembur</span>
										</button>
									</form>
								@else
								@endif
							@endforeach
						</div>
					</div>
				</div>
				

				<div class="flex justify-center">
					<div class="fixed bottom-0 z-[999]">
						<x-menu-mobile />
					</div>
				</div>
			</main>
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

		// modal pulang
		$(document).ready(function() {
			$(document).on('click', '#modalPulangBtn', function() {
				$('.modalp')
					.removeClass('hidden')
					.addClass('flex justify-center items-center opacity-100'); // Add opacity class
			});

			$(document).on('click', '.close', function() {
				$('.modalp')
					.removeClass('flex justify-center items-center opacity-100') // Remove opacity class
					.addClass('opacity-0') // Add opacity class for fade-out
					.addClass('hidden')
					.removeClass('flex justify-center items-center');
			});
		});


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
			var btnMitra = $('#btnMitra');

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
			var absen = $('#absen');
			var iPulang = $('.iPulang');
			var iAbsensi = $('.iAbsensi');

			btnAbsensi.click(function() {
				btnRating.toggle();
				$('#isiAbsen').toggle();
				$('#ngabsen').toggle();
				$('#ngeLembur').toggle();
				$('#isiLembur').toggle();
				$('#ngIzin').toggle();
				$('#isiIzin').toggle();
			});

			btnRating.click(function() {
				$('#cekMe').toggle();
				$('#cekRate').toggle();
			});

			$('#btnLaporan').click(function() {
				$('#cekLaporan').toggle();
				$('#tambahLaporan').toggle();
			});

			btnMitra.click(function() {
				$('#Labsensi').toggle();
				$('#Llaporan').toggle();
				$('#Llembur').toggle();
				$('#Luser').toggle();
				$('#Ljadwal').toggle();
				$('#lizin').toggle();
			})

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

			});
			$('#menuLembur').click(function() {
				$('#lembur').toggle();
				menu3.toggle();
				menu4.toggle();
				menu6.toggle();
				menu9.toggle();
				menu10.toggle();

			});
			$('#menuJabatan').click(function() {
				$('#jabatan').toggle();
				menu3.toggle();
				menu4.toggle();
				menu6.toggle();
				menu7.toggle();
				menu10.toggle();

			});
			$('#menuShift').click(function() {
				$('#shift').toggle();
				menu1.toggle();
				menu2.toggle();
				menu5.toggle();
				menu11.toggle();
				menu12.toggle();
			})
			$('#menuHoliday').click(function() {
				$('#holiday').toggle();
				menu3.toggle();
				menu4.toggle();
				menu6.toggle();
				menu7.toggle();
				menu9.toggle();
			})
		});
	</script>
	<script>
		var lat = document.getElementById('lat')
		var long = document.getElementById('long')

		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(showPosition);
		}

		function showPosition(position) {
			lat.value = position.coords.latitude;
			long.value = position.coords.longitude;

			var lati = "{{ $harLok->latitude }}"
			var longi = "{{ $harLok->longtitude }}"
			var radi = "{{ $harLok->radius }}"
			var client = "{{ $harLok->client->name }}"

			var latitude = position.coords.latitude; // Ganti dengan latitude Anda
			var longitude = position.coords.longitude; // Ganti dengan longitude Anda


			var map = L.map('map').setView([latitude, longitude], 13); // ini adalah zoom level

			L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
				attribution: '© OpenStreetMap contributors'
			}).addTo(map);

			var marker = L.marker([latitude, longitude]).addTo(map);
			var circle = L.circle([lati, longi], {
					color: 'crimson',
					fillColor: '#f09',
					fillOpacity: 0.5,
					radius: radi,
				}).addTo(map).bindPopup("Lokasi absen: " + client)
				.openPopup();
		}
		window.onload = function() {
			jam();
			jam2();
		}

		function jam() {
			var e = document.getElementById('jam'),
				d = new Date(),
				h, m, s;
			h = d.getHours();
			m = set(d.getMinutes());
			s = set(d.getSeconds());

			e.innerHTML = h + ':' + m + ':' + s;

			setTimeout('jam()', 1000);
		}

		function set(e) {
			e = e < 10 ? '0' + e : e;
			return e;
		}
		// jam 2
// jam 2
		function jam2() {
			var e2 = document.getElementById('jam2'),
				d2 = new Date(),
				h2 = d2.getHours(),
				m2 = set(d2.getMinutes()),
				s2 = set(d2.getSeconds())
			;
			
            var startTime = document.getElementById('startTime').getAttribute('startTimer');
            var btnAbsensi = document.getElementById('ngabsen');
            var aAbsensi = document.getElementById('aAbsen');
            var aAbsensi2 = document.getElementById('aAbsen2');
            var hrefAbsen = aAbsensi.getAttribute("href");
			var endTime = document.getElementById('endTime').getAttribute('endTimer');
			var btnPulang = document.getElementById('modalPulangBtn');
			var labelWaktu = document.getElementById('labelWaktu');
			
			var startTimeParts = startTime.split(':');
			var startHours = parseInt(startTimeParts[0]);
			var startMinutes = parseInt(startTimeParts[1]);
			
			var startDiffMinutes = startHours * 60 + startMinutes;
			var nowDiffMinutes = h2 * 60 + m2;
			
			var jadi = nowDiffMinutes - startDiffMinutes;
			
			var kesimH = Math.floor(jadi / 60);
			var kesimM = Math.abs(jadi % 60);
			var kesimS = Math.abs(60 - s2);
			
			if(jadi >= -60){
			    btnAbsensi.removeAttribute("disabled");
			    btnAbsensi.classList.remove('cursor-not-allowed');
			    aAbsensi.classList.remove('cursor-not-allowed');
			    aAbsensi.style.backgroundColor = "";
                aAbsensi.style.border = "";
                aAbsensi.setAttribute("href", "{{ route('absensi.index') }}");
                aAbsensi.innerHTML = "Kehadiran";
                //   a2
			    aAbsensi2.classList.remove('cursor-not-allowed');
			    aAbsensi2.style.backgroundColor = "";
			    aAbsensi2.style.border = "";
			    aAbsensi2.setAttribute("href", "{{ route('absensi.index') }}");
			}else{
			    btnAbsensi.setAttribute("disabled", true);
			    btnAbsensi.classList.add('cursor-not-allowed');
			    aAbsensi.classList.add('cursor-not-allowed');
			    aAbsensi.style.backgroundColor = "rgba(59, 130, 246, 0.5)";
			    aAbsensi.style.border = "none";
			    aAbsensi.removeAttribute("href");
			    aAbsensi.innerHTML = set(kesimH)+ ' jam ' + set(kesimM) + ' menit ' + kesimS + ' detik lagi';
			 //   a2
			    aAbsensi2.classList.add('cursor-not-allowed');
			    aAbsensi2.style.backgroundColor = "rgba(59, 130, 246, 0.5)";
			    aAbsensi2.style.border = "none";
			    aAbsensi2.removeAttribute("href");
			}
			

			var endTimeParts = endTime.split(':');
			var endHours = parseInt(endTimeParts[0]);
			var endMinutes = parseInt(endTimeParts[1]);

			var timeDiffHours = endHours - h2 - 1;
			var timeDiffMinutes = endMinutes - m2;
			var timeDiffSeconds = 60 - s2;

			if (timeDiffMinutes < 0) {
				timeDiffHours--;
				timeDiffMinutes += 60;
			}
			var jadiMenit = timeDiffHours * 60 + timeDiffMinutes;

			var timeDiffStr = (timeDiffHours < 0) ? '-' : '';
			timeDiffStr += Math.abs(timeDiffHours) + ' jam ' + set(timeDiffMinutes) + ' menit ' + set(timeDiffSeconds) + ' detik';

			e2.innerHTML = timeDiffStr;

			if (jadiMenit <= 0) {
				e2.innerHTML = '~ Shift Anda Telah Selesai ~';
				labelWaktu.innerHTML = '';
			} else {
				e2.innerHTML = timeDiffStr;
				labelWaktu.innerHTML = 'Shift Anda Masih';
				labelWaktu.classList.add('text-center');
			}

			if (jadiMenit <= 120) {
				btnPulang.classList.add('flex');
				btnPulang.classList.remove('hidden');
			} else {
				btnPulang.classList.add('hidden');
				btnPulang.classList.remove('flex');
			}

// 			console.log(
// 				endTime,
// 				'dipartisi: ', endHours, ':', endMinutes, 
// 				'waktu sekarang: ', h2, m2,
// 				'beda jam: ', timeDiffHours, timeDiffMinutes, timeDiffSeconds,
				// 'beda menit: ', jadiMenit,
// 				'jadi jam: ', Math.abs(jadiMenit / 60),
				// );
        
            setTimeout(jam2, 1000);
		}

		function set(e2) {
			return e2 < 10 ? '0' + e2 : e2;
		}
	</script>
</body>

</html>
