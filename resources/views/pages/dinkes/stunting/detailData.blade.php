@extends('layouts.detail')
@section('content')
    @include('pages.dinkes.stunting.partials.tabelData')
    <div id="map" class="peta"></div>
    <script>
        var peta1 = L.tileLayer(
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11'
            });

        var peta2 = L.tileLayer(
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/satellite-v9'
            });


        var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        var peta4 = L.tileLayer(
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/dark-v10'
            });

        var map = L.map('map', {
            center: [-5.374517805784923, 105.22335858085205],
            zoom: 10,
            layers: [peta3]
        });

        var baseLayers = {
            'Default': peta1,
            'Satelite': peta2,
            'Street': peta3,
            'Dark': peta4,

        };
        var layerControl = L.control.layers(baseLayers).addTo(map);


        L.marker([-5.7127694975182495, 105.58705019161188])
            .bindPopup("<b>tes</b><br>" +
                "Petugas: Andre<br><br>" +
                "<div class='text-center'>" +
                "<a class='btn btn-xs btn-success'"
            )
            .addTo(map);


        L.easyPrint({
            title: 'My awesome image button',
            position: 'topleft',
            exportOnly: true,
            filename: 'JasaRaharja',
            sizeModes: ['Current', 'A4Portrait', 'A4Landscape']
        }).addTo(map);

        L.easyPrint({
            title: 'My awesome print button',
            position: 'topleft',
            filename: 'JasaRaharja',
            sizeModes: ['Current', 'A4Portrait', 'A4Landscape']
        }).addTo(map);
    </script>
@endsection
