@extends('layouts.home')
@section('content')
    @include('partials.hero')
    <div id="app">
        @include('partials.opd')
        @include('partials.opdDetail')
    </div>

    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const app = Vue.createApp({
            data() {
                return {
                    selectedOPDCard: false,
                    selectedDataCard: false,
                    selectedOPD: {},
                    selectedData: {},
                    apiBaseUrl: 'http://localhost:8080', // Replace with your actual API base URL
                    dataProgram: [],
                    dataStunting: [],
                    kecamatanData: [],
                    kelurahanData: [],
                    kelurahanNames: "",
                };
            },
            mounted() {
                this.fetchKecamatanData().then(() => {
                    this.initDataTables();
                });
            },
            methods: {
                handleKecamatan(id) {
                    console.log('Berjalan Kecamatan')
                    const kecamatan = this.kecamatanData.find(
                        (item) => item.id === id
                    );
                    console.log(kecamatan)
                    return kecamatan ? kecamatan.name : 'Unknown Kecamatan';
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
                async handleDataClick(nama, path) {
                    this.selectedData = {
                        nama
                    };
                    this.selectedDataCard = true;

                    try {
                        const response = await axios.get(`${this.apiBaseUrl}/${path}`);
                        console.log(response.data);
                        this.dataStunting = response.data;
                    } catch (error) {
                        console.error('Error fetching data:', error);
                    }
                },
                async handleCardClick(nama, path) {
                    this.selectedOPD = {
                        nama
                    };
                    this.selectedOPDCard = true;

                    try {
                        const response = await axios.get(`${this.apiBaseUrl}/${path}`);
                        console.log(response.data);
                        this.dataProgram = response.data;
                    } catch (error) {
                        console.error('Error fetching data:', error);
                    }
                }
            }
        });

        app.mount('#app');
    </script>
@endsection
