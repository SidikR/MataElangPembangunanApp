<section id="data_detail" class="container-data-detail mb-3">

    <div class="container" id="stunting">

        <div class="container section-title pilihan rounded-2 fixed-top">
            <div class="d-flex box-pilihan rounded-2">
                <div class="ringkasan item box-item cursor-pointer rounded-2 py-2" :class="{ active: isActiveRingkasan }"
                    @click="activeRingkasan">
                    Ringkasan
                </div>
                <div class="dataset item box-item cursor-pointer rounded-2 py-2" :class="{ active: isActiveDataSet }"
                    @click="activeDataSet">
                    Dataset
                </div>
                <div class="infografi item box-item cursor-pointer rounded-2 py-2"
                    :class="{ active: isActiveInfoGrafis }" @click="activeInfoGrafis">
                    Info Grafis
                </div>
                <div class="infografi item box-item cursor-pointer rounded-2 py-2" :class="{ active: isActiveMaps }"
                    @click="activeMaps">
                    Maps
                </div>
            </div>
        </div>


        <div class="container data-detail mx-0">

            <div class="headerdetail mb-3 p-4 mt-0 mx-0">
                <div class="d-flex align-items-center">
                    <div class="headerfoto png">
                        <img src={{ asset('assets/img/dataset.png') }} alt="">
                    </div>
                    <div class="d-flex flex-column">
                        <span class="p-1 rounded-3 bg-success text-white" style="max-width: 150px">Dinas
                            Kesehatan</span>
                        <h1 class="text-white"><strong>Sebaran Data Stunting di Kabupaten Lampung Selatan</strong>
                        </h1>
                    </div>

                </div>
            </div>

            <div class="box-custome rounded-3 container " v-if="!isActiveRingkasan">
                <form action="" id="form">
                    <div class="row">
                        <h4 class="mb-3 mt-3">Filter</h4>
                        <div class="">
                            <div class="d-flex justify-content-between" style="margin-bottom: 20px">
                                <div class="mb-3 col-5 mx-2">
                                    <label for="filter-kecamatan" class="form-label">Filter by Kecamatan</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z">
                                                </path>
                                                <path
                                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z">
                                                </path>
                                            </svg>
                                        </span>
                                        <select name="filter-kecamatan" id="filter-kecamatan" class="form-control"
                                            @change="handleFilterKecamatan">
                                            <option value="" selected>--Pilih Kecamatan--</option>
                                            <option v-for="kecamatan in kecamatanData" :key="kecamatan.id_kecamatan"
                                                :value="kecamatan.id_kecamatan">
                                                @{{ kecamatan.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 col-5 mx-2">
                                    <label for="filter-desa" class="form-label">Filter by Desa</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z">
                                                </path>
                                                <path
                                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z">
                                                </path>
                                            </svg>
                                        </span>
                                        <select name="filter-desa" id="filter-desa" class="form-control"
                                            @change="handleFilterDesa">
                                            <option value="" selected>--Pilih Desa--</option>
                                            <option v-for="desa in dataDesa" :key="desa.id_desa"
                                                :value="desa.id_desa">
                                                @{{ desa.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid mt-0 d-md-flex justify-content-md-end">
                            <button type="reset" @click="buttonReset" class="btn btn-danger reset">Reset
                                Filter</button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="" v-if="isActiveDataSet">
                <div class="mt-3 box-custome container rounded-3 ">
                    <h4 class="mb-4 mt-2">Dataset Stunting</h4>
                    <table id="stuntingTable" class="table table-striped mb-5" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kecamatan</th>
                                <th>Desa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(data, index) in dataStuntingView" :key="index">
                                <td>@{{ index + 1 }}</td>
                                <td>@{{ data.name }}</td>
                                <td>@{{ handleNameKecamatan(data.kecamatan) }}</td>
                                <td>@{{ handleNameDesa(data.desa) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 box-custome container rounded-3">
                    <h4 class="mt-4">Jumlah Stunting di Kecamatan</h4>
                    <table id="" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Kecamatan</th>
                                <th>Jumlah Stunting</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="selectedKecamatan !== ''">
                                <td>@{{ handleNameKecamatan(selectedKecamatan) }}</td>
                                <td>@{{ kecamatanSelectedSummary[selectedKecamatan] || 0 }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <hr>

                    <h4 class="my-1 mt-4 mb-4">Data Stunting per Desa</h4>
                    <div style="overflow-x: auto;">
                        <table id="stuntingByDesa" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Desa</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(desa, index) in dataDesa" :key="index">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ desa.name }}</td>
                                    <td>@{{ desaSummary[desa.id_desa] || 0 }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            {{-- Ringkasan section (data per kecamatan ) --}}
            <div class="box-custome rounded-3 container tabel-ringkasan-syunting-kecamatan" v-if="isActiveRingkasan">
                <h4>Data Stunting Setiap Kecamatan</h4>
                <div style="overflow-x: auto;">
                    <table id="stuntingByKecamatan" class="table table-striped mb-5" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kecamatan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(kecamatan, index) in kecamatanData" :key="index">
                                <td>@{{ index + 1 }}</td>
                                <td>@{{ kecamatan.name }}</td>
                                <td>@{{ kecamatanSummary[kecamatan.id_kecamatan] || 0 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            {{-- Maps --}}
            <div class="maps box-custome rounded-3 container" v-if="isActiveMaps">
                <div id="map" class="peta z-1"></div>
            </div>


            {{-- Info Grafik --}}
            <div class="info-grafis box-custome rounded-3 container" v-if="isActiveInfoGrafis">
                <h2 class="text-center">Grafik Sebaran Data Stunting Setiap Kecamatan</h2>
                <canvas ref="kecamatanChartCanvas" id="kecamatanChart" width="300" height="100"
                    class="mb-5"></canvas>
                <h2 class="text-center">Grafik Sebaran Data Stunting Setiap Desa</h2>
                <canvas class="" ref="desaChartCanvas" id="desaChart" width="300" height="100"></canvas>
            </div>

        </div>
    </div>

    <script>
        const app = Vue.createApp({
            data() {
                return {
                    apiBaseUrl: 'http://localhost:8000/api',
                    dataStunting: [],
                    dataStuntingView: [],
                    kecamatanData: [],
                    selectedKecamatan: '',
                    dataDesa: [],
                    allDataDesa: [],
                    selectedDesa: '',
                    isActiveRingkasan: true,
                    isActiveDataSet: false,
                    isActiveInfoGrafis: false,
                    isActiveMaps: false,
                    map: null,
                };
            },

            mounted() {
                this.fetchKecamatanData();
                this.fetchAllDataDesa();
                this.fetchDataStunting();
                this.updateDataTable();
                this.startChart();
            },

            updated() {
                this.createKecamatanChart();
                this.createDesaChart();
                this.handleMaps();
            },

            computed: {
                kecamatanSummary() {
                    const summary = {};
                    this.kecamatanData.forEach((kecamatan) => {
                        const kecamatanId = kecamatan.id_kecamatan;
                        const count = this.dataStunting.filter(data => data.kecamatan === kecamatanId)
                            .length;
                        summary[kecamatanId] = count;
                    });
                    return summary;
                },

                kecamatanSelectedSummary() {
                    const summary = {};
                    if (this.selectedKecamatan !== '') {
                        const count = this.dataStunting.filter(data => data.kecamatan === this
                                .selectedKecamatan)
                            .length;
                        summary[this.selectedKecamatan] = count;
                    }
                    return summary;
                },

                desaSummary() {
                    const summary = {};
                    this.dataDesa.forEach((desa) => {
                        const desaId = desa.id_desa;
                        const count = this.dataStunting.filter(data => data.desa === desaId)
                            .length;
                        summary[desaId] = count;
                    });
                    return summary;
                },
            },

            watch: {
                dataStunting: {
                    deep: true, // Membuat pemantauan menjadi rekursif untuk objek bersarang
                    handler: 'handleMaps', // Panggil handleMaps ketika dataStuntingView berubah
                },
            },

            methods: {
                handleNameKecamatan(id) {
                    const kecamatan = this.kecamatanData.find(
                        (item) => item.id_kecamatan === id
                    );
                    return kecamatan ? kecamatan.name : 'Unknown Kecamatan';
                },

                handleNameDesa(id) {
                    const desa = this.allDataDesa.find(
                        (item) => item.id_desa === id
                    );
                    return desa ? desa.name : 'Unknown Desa';
                },

                handleMaps() {
                    if (this.isActiveMaps) {
                        const baseLayers = {
                            'Map 1': L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }),
                        };

                        var peta3 = baseLayers['Map 1'];

                        // Hapus peta sebelumnya jika ada
                        if (this.map) {
                            this.map.remove();
                        }

                        this.map = L.map('map', {
                            center: [-5.7127694975182495, 105.58705019161188],
                            zoom: 10,
                            layers: [baseLayers['Map 1']],
                        });

                        // L.control.layers(baseLayers).addTo(this.map);

                        this.map.addControl(new L.Control.Fullscreen());


                        const geoJSONUrl = '{{ asset('assets/geo-location/lampung-selatan.geojson') }}';
                        fetch(geoJSONUrl)
                            .then(response => response.json())
                            .then(geoJSONData => {
                                L.geoJSON(geoJSONData).addTo(this.map);
                            })
                            .catch(error => {
                                console.error('Error loading GeoJSON data:', error);
                            });

                        var redIcon = new L.Icon({
                            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                            iconSize: [25, 41],
                            iconAnchor: [12, 41],
                            popupAnchor: [1, -34],
                            shadowSize: [41, 41]
                        });

                        const markers = this.dataStuntingView.map(location => {
                            const [lat, lng] = location.koordinat.split(',').map(parseFloat);
                            if (!isNaN(lat) && !isNaN(lng)) {
                                return L.marker([lat, lng], {
                                        icon: redIcon
                                    })
                                    .bindPopup(`    <div class = "d-flex flex-column gap-2">
                                                <img class="bg-success border-1 rounded-2 text-center" src="{{ asset('assets/img/profile.png') }}" alt="Photo" style="max-width: 200px; width:100px;height:100px; max-height: 200px;">
                                                <span>Nama : <b>${location.name}</b></span>
                                                <a href="{{ route('detail/map') }}" class="btn btn-danger text-light" onclick="handleButtonClick()"><i class='bi bi-reply-fill'></i></a>
                                            </div>
                                        `)
                                    .addTo(this.map);
                            } else {
                                console.error(`Invalid coordinates for ${location.name}`);
                                return null;
                            }
                        });

                    }
                },

                async fetchKecamatanData() {
                    try {
                        const response = await axios.get('/api/data-kecamatan');
                        this.kecamatanData = response.data.data;
                        console.log(this.kecamatanData);
                        this.updateDataTable();
                    } catch (error) {
                        console.error('Error fetching kecamatan data:', error);
                    }
                },

                async fetchDataDesa() {
                    try {
                        const idKecamatan = this.selectedKecamatan;
                        const response = await axios.get(
                            `/api/data-desa-by-kecamatan?id_kecamatan=${idKecamatan}`);
                        this.dataDesa = response.data.data;
                        console.log(this.dataDesa);
                        this.updateDataTable();
                    } catch (error) {
                        console.error('Error fetching data desa:', error);
                    }
                },

                async fetchAllDataDesa() {
                    try {
                        const idKecamatan = this.selectedKecamatan;
                        const response = await axios.get('/api/data-desa');
                        this.allDataDesa = response.data.data;
                        console.log(this.allDataDesa);
                        this.updateDataTable();
                    } catch (error) {
                        console.error('Error fetching data desa:', error);
                    }
                },

                async fetchDataStunting() {
                    try {
                        const response = await axios.get(`${this.apiBaseUrl}/stunting`);
                        this.dataStunting = response.data.data;
                        this.dataStuntingView = this.dataStunting;
                        console.log(this.dataStuntingView);
                        this.updateDataTable();
                        this.handleMaps();
                    } catch (error) {
                        console.error('Error fetching data:', error);
                    }
                },

                handleFilterKecamatan(event) {
                    this.selectedKecamatan = event.target.value;
                    this.fetchDataDesa();
                    this.dataStuntingView = this.dataStunting;
                    const filteredData = this.selectedKecamatan === '' ?
                        this.dataStuntingView :
                        this.dataStuntingView.filter(data => data.kecamatan === this.selectedKecamatan);
                    this.dataStuntingView = filteredData;
                    this.updateDataTable();
                },

                handleFilterDesa(event) {
                    this.selectedDesa = event.target.value;
                    this.dataStuntingView = this.dataStunting;
                    const filteredData = this.selectedDesa === '' ?
                        this.dataStuntingView :
                        this.dataStuntingView.filter(data => data.desa === this.selectedDesa);
                    this.dataStuntingView = filteredData;
                    this.updateDataTable();
                },

                updateDataTable() {
                    const stuntingTable = $('#stuntingTable').DataTable();
                    const stuntingByKecamatan = $('#stuntingByKecamatan').DataTable();
                    const stuntingByDesa = $('#stuntingByDesa').DataTable();

                    if (stuntingTable) {
                        stuntingTable.destroy();
                    }
                    if (stuntingByKecamatan) {
                        stuntingByKecamatan.destroy();
                    }
                    if (stuntingByDesa) {
                        stuntingByDesa.destroy();
                    }

                    this.$nextTick(() => {
                        $('#stuntingTable').DataTable({
                            colReorder: true,
                            responsive: true,
                            lengthMenu: [
                                [10, 25, 50, -1],
                                [10, 25, 50, 'All'],
                            ],
                            scrollX: true,
                        });

                        $('#stuntingByKecamatan').DataTable({
                            colReorder: true,
                            responsive: true,
                            lengthMenu: [
                                [5, 10, 20, 50, -1],
                                [5, 10, 20, 50, 'All'],
                            ],
                            scrollX: true,
                        });
                        this.startChart();

                        $('#stuntingByDesa').DataTable({
                            colReorder: true,
                            responsive: true,
                            lengthMenu: [
                                [5, 10, 20, 50, -1],
                                [5, 10, 20, 50, 'All'],
                            ],
                            scrollX: true,
                        });
                        this.startChart();
                    });

                },

                startChart() {
                    this.createKecamatanChart();
                    this.createDesaChart();
                },

                createKecamatanChart() {
                    if (this.isActiveInfoGrafis) {
                        const kecamatanChartCanvass = this.$refs.kecamatanChartCanvas.getContext('2d');
                        const existingChart = Chart.getChart(kecamatanChartCanvass);

                        if (existingChart) {
                            existingChart.destroy();
                        }

                        const getRandomColor = () => {
                            return '#' + Math.floor(Math.random() * 16777215).toString(16);
                        };

                        const kecamatanChart = new Chart(kecamatanChartCanvass, {
                            type: 'bar',
                            data: {
                                labels: this.kecamatanData.map(kecamatan => kecamatan.name),
                                datasets: [{
                                    label: 'Jumlah Stunting ',
                                    data: this.kecamatanData.map(kecamatan => this.kecamatanSummary[
                                        kecamatan.id_kecamatan] || 0),
                                    backgroundColor: this.kecamatanData.map(() => getRandomColor()),
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                },

                createDesaChart() {
                    if (this.isActiveInfoGrafis) {
                        const desaChartCanvas = this.$refs.desaChartCanvas.getContext('2d');
                        const existingChart = Chart.getChart(desaChartCanvas);

                        if (existingChart) {
                            existingChart.destroy();
                        }

                        const getRandomColor = () => {
                            return '#' + Math.floor(Math.random() * 16777215).toString(16);
                        };

                        const desaChart = new Chart(desaChartCanvas, {
                            type: 'bar',
                            data: {
                                labels: this.dataDesa.map(desa => desa.name),
                                datasets: [{
                                    label: 'Jumlah Stunting',
                                    data: this.dataDesa.map(desa => this.desaSummary[desa
                                        .id_desa] || 0),
                                    backgroundColor: this.dataDesa.map(() =>
                                        getRandomColor()),
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    }
                },

                buttonReset() {
                    this.dataStuntingView = this.dataStunting;
                    this.updateDataTable();
                    this.handleMaps();
                },

                activeRingkasan() {
                    this.isActiveRingkasan = true;
                    this.isActiveDataSet = false;
                    this.isActiveInfoGrafis = false;
                    this.isActiveMaps = false;
                    this.updateDataTable();
                },

                activeDataSet() {
                    this.isActiveRingkasan = false;
                    this.isActiveDataSet = true;
                    this.isActiveInfoGrafis = false;
                    this.isActiveMaps = false;
                    this.updateDataTable();
                },

                activeInfoGrafis() {
                    this.isActiveRingkasan = false;
                    this.isActiveDataSet = false;
                    this.isActiveInfoGrafis = true;
                    this.isActiveMaps = false;
                    this.updateDataTable();
                },

                activeMaps() {
                    this.isActiveRingkasan = false;
                    this.isActiveDataSet = false;
                    this.isActiveInfoGrafis = false;
                    this.isActiveMaps = true;
                    this.updateDataTable();
                },
            }
        });

        app.mount('#stunting');
    </script>

</section>
