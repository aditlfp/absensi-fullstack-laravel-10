<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- Leaflet --}}
    <link rel="stylesheet" href="{{ URL::asset('/src/leaflet.css') }}">

    <style>
        #map {
            height: 180px;
        }
    </style>
</head>

<body>


    <p id="demo"></p>
    <div id="map"></div>

    <script src="{{ URL::asset('src/leaflet.js') }}"></script>
    <script>
        var x = document.getElementById("demo");

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }

        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;
            var latitude = position.coords.latitude; // Ganti dengan latitude Anda
            var longitude = position.coords.longitude; // Ganti dengan longitude Anda

            var map = L.map('map').setView([latitude, longitude], 10); // 10 adalah zoom level

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([latitude, longitude]).addTo(map);

            var circle = L.circle([latitude, longitude], {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.5,
                radius: 500
            }).addTo(map);
        }
    </script>
</body>

</html>
