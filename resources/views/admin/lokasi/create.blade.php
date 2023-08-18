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

        <!-- Scripts -->
	@vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
    <style>
       

    </style>

</head>
<body class="font-sans antialiased overflow-hidden bg-slate-400">
    <div class="min-h-screen">
        <main>
            @include('../layouts/navbar')
        <div class="bg-slate-500 p-4 mx-36 shadow-md rounded-md">
            <p class="text-center text-2xl uppercase font-bold">Tambah Lokasi</p>
                <form method="POST" action="{{ route('lokasi.store') }}" class="mx-[25%] my-10" id="form">
                @csrf
                <div class="bg-slate-100 px-10 py-5 rounded shadow">
                    <div class="flex flex-col">
                        <label for="client_id" class="label">Client</label>
                        <select name="client_id" id="client_id" class="select-bordered select mb-2">
                            <option selected disabled>~ Pilih Client ~</option>
                            @forelse ($client as $cli)
                                <option value="{{ $cli->id }}">{{ $cli->name }}</option>
                            @empty
                                <option disabled>~ Data Kosong ~</option>
                            @endforelse
                        </select>
                    </div>
                    {{-- lang --}}
                    <div class="flex flex-col">
                        <x-input-label for="latitude" :value="__('Latitude')" />
                        <input name="latitude" class="block mt-1 w-full input" id="latitude" value="" placeholder="Input Latitude..."/>
                    </div>
                    {{-- long --}}
                    <div class="flex flex-col">
                        <x-input-label for="longitude" :value="__('Longitude')" />
                        <input name="longtitude" class="block mt-1 w-full input" id="longtitude" value="" placeholder="Input Longitude..."/>
                    </div>
                    {{-- rad --}}
                    <div class="flex flex-col">
                        <x-input-label for="radius" :value="__('Radius')" />
                        <input  class="disabled block mt-1 w-full input input-bordered" value="" placeholder="input radius satuan 'M', min 50..." id="radius" name="radius" type="number"/>
                    </div>
                    <div id="map"></div>
                    <div class="flex gap-2 my-5 justify-end">
                        <button><a href="{{ route('lokasi.index') }}" class="btn btn-error">Back</a></button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </main>
    </div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var lat = document.getElementById('lat')
        var long = document.getElementById('long')

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }

        function showPosition(position) {
            lat.value = position.coords.latitude;
            long.value = position.coords.longitude;

            var latitude = position.coords.latitude;  // Ganti dengan latitude Anda
            var longitude = position.coords.longitude; // Ganti dengan longitude Anda

        }
    </script>
</body>
</html>




