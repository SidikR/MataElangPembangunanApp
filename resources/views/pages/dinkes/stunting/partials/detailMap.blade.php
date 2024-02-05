<section id="detail_map" class="container data-detail p-4">

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
                        <td>
                            <a href="{{ env('URL_STORAGE_SIMS') . '/' . $dataArray['data']['path'] . '/' . $dataArray['data']['nama_file'] }}"
                                target="_blank">
                                <img src="{{ env('URL_STORAGE_SIMS') . '/' . $dataArray['data']['path'] . '/' . $dataArray['data']['nama_file'] }}"
                                    alt="profile" class="img-thumbnail" width="150">
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <th>Nama Anak</th>
                        <th>:</th>
                        <td>{{ $dataArray['data']['nama'] }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <th>:</th>
                        <td id="alamat">{{ $dataArray['data']['alamat'] }}</td>
                    </tr>
                    <tr>
                        <th>Informasi</th>
                        <th>:</th>
                        <td>{{ $dataArray['data']['status_penanganan'] }}</td>
                    </tr>
                    <tr>
                        <th>Instansi</th>
                        <th>:</th>
                        <td>Dinas Kesehatan</td>
                    </tr>
                    <tr>
                        <th>Petugas</th>
                        <th>:</th>
                        <td>{{ $dataArray['data']['nama_pendamping'] }}</td>
                    </tr>
                    <tr>
                        <th>Koordinat</th>
                        <th>:</th>
                        <td>{{ $dataArray['data']['koordinat'] }}</td>
                    </tr>

                </table>

                <a class="btn btn-danger" href="{{ route('detail') }}">Kembali</a>

            </div>
        </div>

        <br><br>

        <script>
            document.addEventListener('DOMContentLoaded', async function() {
                const kecamatanId = "{{ $dataArray['data']['kecamatan'] }}";
                const desaId = "{{ $dataArray['data']['desa'] }}";
                const alamat = "{{ $dataArray['data']['alamat'] }}";
                const kecamatanName = await handleNameKecamatan(kecamatanId);
                const desaName = await handleNameDesa(kecamatanId, desaId);
                document.getElementById('alamat').innerText =
                    `Desa ${desaName}, Kecamatan ${kecamatanName}, ${alamat}`;
            });

            async function handleNameDesa(id, idDesa) {
                const response = await axios.get(`/api/data-desa-by-kecamatan?id_kecamatan=${id}`);
                const dataDesa = response.data.data;
                const desa = dataDesa.find((item) => item.id_desa === idDesa);
                console.log("Data Desa", desa)
                return desa ? desa.name : 'Unknown Desa';
            }

            async function handleNameKecamatan(id) {
                const response = await axios.get(`/api/data-kecamatan`);
                const dataKecamatan = response.data.data;
                const kecamatan = dataKecamatan.find((item) => item.id_kecamatan === id);
                console.log("Data Kecamatans", kecamatan);
                return kecamatan ? kecamatan.name : 'Unknown Kecamatan';
            }

            var koordinat = "{{ $dataArray['data']['koordinat'] }}".split(',');
            var latitude = parseFloat(koordinat[0]);
            var longitude = parseFloat(koordinat[1]);

            var peta = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });

            var map = L.map('map', {
                center: [latitude, longitude],
                zoom: 14,
                layers: [peta]
            });

            this.map.addControl(new L.Control.Fullscreen());

            var redIcon = new L.Icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });

            L.marker([latitude, longitude], {
                icon: redIcon
            }).addTo(map).bindPopup(
                "Anak: <b>{{ $dataArray['data']['nama'] }}</b><br>" +
                "Petugas: {{ $dataArray['data']['nama_pendamping'] }}<br>" +
                `<a href="https://www.google.com/maps?q=${latitude},${longitude}" style="width: 100%;" class="btn btn-danger btn-sm text-light mt-1" onclick="handleButtonClick()" target="_blank"><i class='bi bi-map-fill'></i></a>`
            ).openPopup();
        </script>

    </div>

</section>
