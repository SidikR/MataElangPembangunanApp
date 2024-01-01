<section id="data_detail" class="container data-detail">

    <div class="container" id="stunting">

        <div class="container section-title pilihan rounded-2 fixed-top p-1" data-aos="fade-up">
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
            </div>
        </div>

        <div class="headerdetail mb-3 p-4 mt-0">
            <div class="d-flex align-items-center">
                <div class="headerfoto png">
                    <img src={{ asset('assets/img/dataset.png') }} alt="">
                </div>
                <div class="d-flex flex-column">
                    <span class="p-1 rounded-3 bg-success text-white" style="max-width: 150px">Dinas Kesehatan</span>
                    <h1 class="text-white"><strong>Sebaran Data Stunting di Kabupaten Lampung Selatan</strong></h1>
                </div>

            </div>
        </div>

        <div class="box-custome rounded-3 container p-3 px-5 mb-5" v-if="!isActiveRingkasan">
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
                                        <option v-for="kecamatan in kecamatanData" :key="kecamatan.id"
                                            :value="kecamatan.id">
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
                                        <option v-for="desa in dataDesa" :key="desa.id" :value="desa.id">
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


        <div class="row mt-4" v-if="isActiveDataSet">
            <table id="stuntingTable" class="table table-striped mb-5" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kecamatan</th>
                        <th>Desa</th>
                        {{-- <th>Status</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data, index) in dataStuntingView" :key="index">
                        <td>@{{ index + 1 }}</td>
                        <td>@{{ data.Name }}</td>
                        <td>@{{ handleKecamatan(data.Kecamatan) }}</td>
                        <td>@{{ data.Desa }}</td>
                        {{-- <td>@{{ data.Status }}</td> --}}
                    </tr>
                </tbody>
            </table>
            <div class="box-custome rounded-3 container p-3 px-5 mb-5 mt-5">
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
                            <td>@{{ handleKecamatan(selectedKecamatan) }}</td>
                            <td>@{{ kecamatanSelectedSummary[selectedKecamatan] || 0 }}</td>
                        </tr>
                    </tbody>
                </table>

                <h4 class="my-1 mt-4">Data Stunting per Desa</h4>
                <div style="overflow-x: auto;">
                    <table id="stuntingByDesa" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th v-for="desa in dataDesa" :key="desa.id">@{{ desa.name }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td v-for="desa in dataDesa" :key="desa.id">@{{ desaSummary[desa.id] || 0 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

        <div class="tabel-ringkasan-syunting-kecamatan" v-if="isActiveRingkasan">
            <h4>Data Stunting per Kecamatan</h4>
            <div style="overflow-x: auto;">
                <table id="stuntingByKecamatan" class="table table-striped">
                    <thead>
                        <tr>
                            {{-- <th>Data Stunting Count</th> --}}
                            <th v-for="kecamatan in kecamatanData" :key="kecamatan.id">@{{ kecamatan.name }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {{-- <td>Total</td> --}}
                            <td v-for="kecamatan in kecamatanData" :key="kecamatan.id">@{{ kecamatanSummary[kecamatan.id] || 0 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <div id="map" class="peta"></div>

        <div class="info-grafis" v-if="isActiveInfoGrafis">
            <h2 class="text-center">Grafik Sebaran Data Stunting Setiap Kecamatan</h2>
            <canvas ref="kecamatanChartCanvas" id="kecamatanChart" width="300" height="100"
                class="mb-5"></canvas>
            <h2 class="text-center">Grafik Sebaran Data Stunting Setiap Desa</h2>
            <canvas class="" ref="desaChartCanvas" id="desaChart" width="300" height="100"></canvas>

        </div>

    </div>
    <script>
        const app = Vue.createApp({
            data() {
                return {
                    apiBaseUrl: 'http://localhost:8080',
                    dataStunting: [],
                    dataStuntingView: [],
                    kecamatanData: [],
                    selectedKecamatan: '',
                    dataDesa: [],
                    selectedDesa: '',
                    isActiveRingkasan: true,
                    isActiveDataSet: false,
                    isActiveInfoGrafis: false,
                    map: null,
                };
            },

            mounted() {
                this.fetchKecamatanData();
                this.fetchDataStunting();
                this.updateDataTable();
                this.startChart();
            },

            updated() {
                this.createKecamatanChart();
                this.createDesaChart();
            },

            computed: {
                kecamatanSummary() {
                    const summary = {};
                    this.kecamatanData.forEach((kecamatan) => {
                        const kecamatanId = kecamatan.id;
                        const count = this.dataStunting.filter(data => data.Kecamatan === kecamatanId)
                            .length;
                        summary[kecamatanId] = count;
                    });
                    return summary;
                },

                kecamatanSelectedSummary() {
                    const summary = {};
                    if (this.selectedKecamatan !== '') {
                        const count = this.dataStunting.filter(data => data.Kecamatan === this
                                .selectedKecamatan)
                            .length;
                        summary[this.selectedKecamatan] = count;
                    }
                    return summary;
                },

                desaSummary() {
                    const summary = {};
                    this.dataDesa.forEach((desa) => {
                        const desaId = desa.id;
                        const count = this.dataStunting.filter(data => data.Desa === desaId)
                            .length;
                        summary[desaId] = count;
                    });
                    return summary;
                },
            },

            watch: {
                dataStuntingView: {
                    deep: true, // Membuat pemantauan menjadi rekursif untuk objek bersarang
                    handler: 'handleMaps', // Panggil handleMaps ketika dataStuntingView berubah
                },
            },

            methods: {
                handleKecamatan(id) {
                    const kecamatan = this.kecamatanData.find(
                        (item) => item.id === id
                    );
                    return kecamatan ? kecamatan.name : 'Unknown Kecamatan';
                },

                handleMaps() {
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

                    const markers = this.dataStuntingView.map(location => {
                        const [lat, lng] = location.koordinat.split(',').map(parseFloat);
                        if (!isNaN(lat) && !isNaN(lng)) {
                            return L.marker([lat, lng])
                                .bindPopup(`    <div class = "d-flex flex-column gap-2">
                                                <img class="bg-success border-1 rounded-2" src="${location.photoUrl}" alt="Photo" style="max-width: 200px; width:100px;height:100px; max-height: 200px;">
                                                <span>Nama : <b>${location.Name}</b></span>
                                                <button class="btn btn-success" onclick="handleButtonClick()">Button 1</button>
                                            </div>
                                        `)
                                .addTo(this.map);
                        } else {
                            console.error(`Invalid coordinates for ${location.Name}`);
                            return null;
                        }
                    });

                },

                async fetchKecamatanData() {
                    try {
                        const response = await axios.get(
                            'https://api.binderbyte.com/wilayah/kecamatan?api_key=26dc325e8104c47591ce093a2c050b92689a871f9b71c2ab496968f487343111&id_kabupaten=18.01'
                        );

                        this.kecamatanData = response.data.value;
                    } catch (error) {
                        console.error('Error fetching kecamatan data:', error);
                    }
                },

                async fetchDataDesa() {
                    try {
                        const idKecamatan = this.selectedKecamatan;
                        const response = await axios.get(
                            `https://api.binderbyte.com/wilayah/kelurahan?api_key=26dc325e8104c47591ce093a2c050b92689a871f9b71c2ab496968f487343111&id_kecamatan=${idKecamatan}`
                        );
                        this.dataDesa = response.data.value;
                        console.log(this.dataDesa);
                    } catch (error) {
                        console.error('Error fetching data desa:', error);
                    }
                },

                async fetchDataStunting() {
                    try {
                        const response = await axios.get(`${this.apiBaseUrl}/dinkes/stunting`);
                        this.dataStunting = response.data;
                        this.dataStuntingView = this.dataStunting;
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
                        this.dataStuntingView.filter(data => data.Kecamatan === this.selectedKecamatan);
                    this.dataStuntingView = filteredData;
                    this.updateDataTable();
                },

                handleFilterDesa(event) {
                    this.selectedDesa = event.target.value;
                    this.dataStuntingView = this.dataStunting;
                    const filteredData = this.selectedDesa === '' ?
                        this.dataStuntingView :
                        this.dataStuntingView.filter(data => data.Desa === this.selectedDesa);
                    this.dataStuntingView = filteredData;
                    this.updateDataTable();
                },

                updateDataTable() {
                    const stuntingTable = $('#stuntingTable').DataTable();

                    if (stuntingTable) {
                        stuntingTable.destroy();
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
                                        kecamatan.id] || 0),
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
                                    data: this.dataDesa.map(desa => this.desaSummary[desa.id] || 0),
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
                },

                activeRingkasan() {
                    this.isActiveRingkasan = true;
                    this.isActiveDataSet = false;
                    this.isActiveInfoGrafis = false;
                    this.updateDataTable();
                },

                activeDataSet() {
                    this.isActiveRingkasan = false;
                    this.isActiveDataSet = true;
                    this.isActiveInfoGrafis = false;
                    this.updateDataTable();
                },

                activeInfoGrafis() {
                    this.isActiveRingkasan = false;
                    this.isActiveDataSet = false;
                    this.isActiveInfoGrafis = true;
                    this.updateDataTable();
                },
            }
        });

        app.mount('#stunting');
    </script>

</section>
