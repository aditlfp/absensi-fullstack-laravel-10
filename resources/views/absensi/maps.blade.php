<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <style>
        #map {
            height: 180px;
        }
    </style>
</head>

<body>


    <input id="demo" value=""/>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        var x = document.getElementById("demo");

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }

        function showPosition(position) {
            x.value = "Latitude: " + position.coords.latitude +
                "Longitude: " + position.coords.longitude;
            var latitude = position.coords.latitude;  // Ganti dengan latitude Anda
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
                radius: 100
            }).addTo(map);
        }
    </script>
</body>

</html>
