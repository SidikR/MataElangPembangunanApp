<section id="detail_map" class="container data-detail">


    <div class="container" id="detail_map">
        <div class="row">
            <div class="col-sm-6">
                <div id="map" style="width: 100%; height: 500px;" class="z-1"></div><br>
            </div>
            <div class="col-sm-6">

                <table class="table ">
                    <tr>
                        <th>Foto</th>
                        <th>:</th>
                        <td><img src="{{ asset('assets/img/profile.png') }}" alt="profile" class="img-thumbnail"
                                width="150"></td>
                    </tr>

                    <tr>
                        <th>Nama Anak</th>
                        <th>:</th>
                        <td>Hery</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td>Kalianda</td>
                    </tr>
                    <tr>
                        <th>Informasi</th>
                        <th>:</th>
                        <td>Sudah ditangani</td>
                    </tr>
                    <tr>
                        <th>Instansi</th>
                        <th>:</th>
                        <td>Dinas Kesehatan</td>
                    </tr>
                    <tr>
                        <th>Petugas</th>
                        <th>:</th>
                        <td>Budianto</td>
                    </tr>
                    <tr>
                        <th>Latitude</th>
                        <th>:</th>
                        <td>-5.416888540509599</td>
                    </tr>
                    <tr>
                        <th>Longitude</th>
                        <th>:</th>
                        <td>105.25394300867542</td>
                    </tr>



                </table>

                <a class="btn btn-danger" href="{{ route('detail') }}">Kembali</a>

            </div>
        </div>

        <br><br>

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
                center: [-5.416888540509599, 105.25394300867542],
                zoom: 14,
                layers: [peta3]
            });

            var baseLayers = {
                'Default': peta1,
                'Satelite': peta2,
                'Street': peta3,
                'Dark': peta4,

            };
            this.map.addControl(new L.Control.Fullscreen());

            var redIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            L.marker([-5.416888540509599, 105.25394300867542], {
                icon: redIcon
            }).addTo(map).bindPopup(
                "Anak: <b>Hery</b><br>" +
                "Petugas: Budianto<br>" +
                `<a href="https://www.google.com/maps?q=-5.416888540509599,105.25394300867542" style="width: 100%;" class="btn btn-danger btn-sm text-light mt-1" onclick="handleButtonClick()" target="_blank"><i class='bi bi-map-fill'></i></a>`
            ).openPopup();
        </script>

    </div>

</section>
