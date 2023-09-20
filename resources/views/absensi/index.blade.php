<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ env('APP_NAME', 'Absensi SAC-PONOROGO') }}</title>
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

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ env('APP_NAME', 'KINERJA SAC-PONOROGO') }}</title>
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
		<div class="sm:mx-10 mx-5 bg-slate-500 rounded-md shadow-md">
			<main>
				<div class="px-5 py-5">
					<form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
						@method('POST')
						@csrf
						<div class="flex flex-col sm:flex-row sm:m-0 items-center  justify-center gap-3 mb-3">
							<div id="my_camera" class="bg-slate-200 px-10 rounded"></div>
							<div id="results" class=" sm:mt-0 rounded"></div>
						</div>

						<div class="flex justify-center">
							<button type=button onclick="take_snapshot()" class="p-2 my-2 px-3 mb-5 text-white bg-blue-400 rounded-full"><i
									class="ri-camera-fill"></i></button>
						</div>
						<div class="p-1 rounded my-3">
							<div id="map"></div>
						</div>
						<div class="flex flex-col gap-2">
							<div class="flex flex-col justify-between">
								<label>Nama: </label>
								<input type="text" id="user_id" name="user_id" value="{{ Auth::user()->id }}" hidden>
								<input type="text" value="{{ Auth::user()->name }}" disabled class="input input-bordered">
							</div>
							<div class="flex flex-col  justify-between">
								<label>Bermitra Dengan: </label>
								<input type="text" name="kerjasama_id" id="kerjasama_id" hidden value="{{ Auth::user()->kerjasama_id }}">
								<input type="text" value="{{ Auth::user()->kerjasama->client->name }}" disabled
									class="input input-bordered">
							</div>
							<div class="flex flex-col  justify-between">
								<label>Shift: </label>
								<select name="shift_id" id="shift_id" class="select select-bordered font-thin">
									<option disabled selected>-- Pilih Shift --</option>
									@forelse ($shift as $i)
										@if (Auth::user()->kerjasama->client_id == $i->client_id && Auth::user()->divisi->jabatan_id == $i->jabatan_id)
											<option value="{{ $i->id }}" data-shift="{{ $i->jam_start }}"> {{ $i->jabatan->name_jabatan }} |
												{{ $i->shift_name }} |
												{{ $i->jam_start }}</option>
										@else
										@endif
									@empty
										<option>~ Tidak ad Shift ! ~</option>
									@endforelse
								</select>
							</div>

							<div>
								<div>
									<label>Perlengkapan: </label>
								</div>
								<div class="p-2 bg-white rounded-lg ">
									<div class="grid grid-cols-1">
										@forelse ($dev as $arr)
											@if (Auth::user()->devisi_id == $arr->id)
												@foreach ($arr->perlengkapan as $i)
													<div>
														<input type="checkbox" name="perlengkapan[]" id="perlengkapan" value="{{ $i->name }}"
															class="checkbox checkbox-sm m-2">
														<label for="perlengkapan">{{ $i->name }}</label>
													</div>
												@endforeach
											@else
											@endif
										@empty
											<p>~ Kosong ~</p>
										@endforelse
									</div>
								</div>
							</div>
							<div>
								<label>Deskripsi: </label>
								<textarea name="deskripsi" id="deskripsi" value="" placeholder="deskripsi..."
								 class="w-full textarea textarea-bordered" required></textarea>
							</div>
							<div class="flex flex-col">
								<label>Jadwal Hari ini: </label>
								@php
									$today = Carbon\Carbon::now()->format('Y-m-d');
									$hasJadwal = false;
								@endphp
								@forelse ($jadwal as $jad)
									@php
										$tanggalJDW = strtotime($jad->tanggal);
										$jadiTGL = date('Y-m-d', $tanggalJDW);
									@endphp
									@if (Carbon\Carbon::now()->format('Y-m-d') == $jadiTGL)
										@if ($jad->status == 'OFF')
											<span class="input input-bordered" disabled>Tanggal: {{ $jad->tanggal }}, Shift:
												{{ $jad->shift->shift_name }}, Status: <span class="text-red-500">{{ $jad->status }}</span></span>
											@php
												$hasJadwal = true;
											@endphp
										@else
											<span class="input input-bordered" disabled>Tanggal: {{ $jad->tanggal }}, Shift:
												{{ $jad->shift->shift_name }}, Area: {{ $jad->area }}</span>
											@php
												$hasJadwal = true;
											@endphp
										@endif
									@endif
								@empty
								@endforelse
								@if (!$hasJadwal)
								<span class="input input-bordered flex items-center justify-center">
									<span class=" text-center" disabled>Belum Ada Jadwal</span>
								</span>
								@endif
							</div>
							<input type="text" id="image" name="image" class="image-tag" hidden>
							<input type="text" name="keterangan" value="masuk" hidden>
						</div>
						<input type="text" class="hidden" name="absensi_type_masuk" value="1">
						@php
							$key = Auth::user()->id;
						@endphp
						<div class="flex flex-col justify-center sm:justify-end gap-3 mt-2 mr-2">
							<span id="labelWaktuStart" class="text-center text-[10px] capitalize font-semibold hidden"></span>
							<span class="flex justify-center gap-3">
								@forelse ($absensi as $abs)
									{{-- sudah --}}
									@if ($abs->tanggal_absen == Carbon\Carbon::now()->format('Y-m-d'))
										<button
											class="p-2 my-2 px-4 text-slate-100 bg-blue-300  rounded transition-all ease-linear .2s disabled cursor-not-allowed"
											disabled>Sudah Absen</button>
										{{-- belum --}}
									@else
										<button class="p-2 my-2 px-4 text-white bg-blue-500 hover:bg-blue-600 rounded transition-all ease-linear .2s"
											id="btnAbsen">Absen</button>
									@endif
								@break

								@empty
									<button class="p-2 my-2 px-4 text-white bg-blue-500 hover:bg-blue-600 rounded transition-all ease-linear .2s"
										id="btnAbsen">Absen</button>
								@endforelse
								<a href="{{ route('dashboard.index') }}"
									class="p-2 my-2 px-4 text-white bg-red-500 hover:bg-red-600 rounded transition-all ease-linear .2s">
									Kembali
								</a>
							</span>
						</div>
						<input class="hidden" id="thisId" value="{{ Auth::user()->id }}">
						@php
							$mytime = Carbon\Carbon::now()->format('H:m:s');
							$mytime2 = '10:00:00';
						@endphp
						<input class="hidden" id="thisTime" value="{{ $mytime }}">
						<input class="hidden" id="thisTime2" value="{{ $mytime2 }}">
						<input class="hidden" id="isi" name="absensi_type_pulang" value="okok">
						<input id="lat" name="lat_user" value="" class="hidden" />
						<input id="long" name="long_user" value="" class="hidden" />
					</form>
				</div>
			</main>
		</div>
	</div>
	<div class="flex justify-center">
		<div class="fixed bottom-0 z-[999]">
			<x-menu-mobile />
		</div>
	</div>
	<!-- Configure a few settings and attach camera -->
	<script language="JavaScript">
		Webcam.set({
			width: 320,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 80
		});
		Webcam.attach('#my_camera');

		function take_snapshot() {
			Webcam.snap(function(data_uri) {
				$(".image-tag").val(data_uri);
				document.getElementById('results').innerHTML =
					'<img id="imgprev" src="' + data_uri + '"/>';
			});
			// Webcam.reset();
		}
	</script>

	<script>
		var lat = document.getElementById('lat')
		var long = document.getElementById('long')

		if (navigator.geolocation) {
			navigator.geolocation.watchPosition(showPosition);
		} else {
			alert('Geo Location Not Supported By This Browser !!');
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
					radius: radi
				}).addTo(map).bindPopup("Lokasi absen: " + client)
				.openPopup();
		}
	</script>
	<script>
		$(document).ready(function() {
			function calculatedJamStart() {
				// get jam
				var currentDate = new Date();
				var jamSaiki = currentDate.getHours();
				var menitSaiki = currentDate.getMinutes();
				var detikSaiki = currentDate.getSeconds();

				// fungsi
				var selectedOption = $('#shift_id').find(":selected");
				var shiftStart = selectedOption.data('shift');
				if (typeof shiftStart !== 'undefined' && shiftStart !== '') {
					var startTimeParts = shiftStart.split(':');
					var startHours = parseInt(startTimeParts[0]);
					var startMinutes = parseInt(startTimeParts[1]);

					var startDiffMinutes = startHours * 60 + startMinutes;
					var nowDiffMinutes = jamSaiki * 60 + menitSaiki;

					var jadi = startDiffMinutes - nowDiffMinutes;

					var kesimH = Math.floor(jadi / 60);
					var kesimM = Math.abs(jadi % 60);
					var kesimS = Math.abs(60 - detikSaiki);

					// console.log(jadi);

					if (jadi <= 60) {
						$('#btnAbsen').removeClass('cursor-not-allowed bg-blue-400/50 hover:bg-blue-400/50');
						$('#btnAbsen').prop('disabled', false);
						$('#labelWaktuStart').addClass('hidden py-2 px-4 rounded-md bg-slate-50');
					} else {
						$('#btnAbsen').addClass('cursor-not-allowed bg-blue-400/50 hover:bg-blue-400/50');
						$('#labelWaktuStart').removeClass('hidden');
						$('#btnAbsen').prop('disabled', true);
						if (kesimH == 0) {
							$('#labelWaktuStart').html(`tunggu ${kesimM} menit ${kesimS} detik lagi untuk absen`);
						} else if (kesimM == 0 && kesimH == 0) {
							$('#labelWaktuStart').html(`tunggu ${kesimS} detik lagi untuk absen`);
						} else
							$('#labelWaktuStart').html(
								`tunggu ${kesimH} jam ${kesimM} menit ${kesimS} detik lagi untuk absen`);
					}
					console.log();

				} else {
					console.log('kosong bg');
				}
				setTimeout(calculatedJamStart, 1000)
			}

			// Attach an event handler to the #shift_id change event
			$('#shift_id').change(function() {
				// This code runs when the #shift_id element changes
				calculatedJamStart();
			});
		})
	</script>
</body>

</html>
