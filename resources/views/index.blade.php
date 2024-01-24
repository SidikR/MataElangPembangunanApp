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
                };
            },
            methods: {
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
