<section id="data_detail" class="services">

    <div class="container section-title" data-aos="fade-up">
        <h1>wkwk</h1>
    </div>

    <div class="container" id="stunting">
        <div class="row">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kecamatan</th>
                        <th>Desa</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data, index) in dataStunting" :key="index">
                        <td>@{{ index + 1 }}</td>
                        <td>@{{ data.Name }}</td>
                        <td>@{{ handleKecamatan(data.Kecamatan) }}</td>
                        <td>@{{ data.Desa }}</td>
                        <td>@{{ data.Status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        const app = Vue.createApp({
            data() {
                return {
                    apiBaseUrl: 'http://localhost:8080',
                    dataStunting: [],
                    kecamatanData: [],
                };
            },
            mounted() {
                this.fetchKecamatanData();
                this.fetchDataStunting();
            },
            methods: {
                handleKecamatan(id) {
                    const kecamatan = this.kecamatanData.find(
                        (item) => item.id === id
                    );
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
                async fetchDataStunting() {
                    try {
                        const response = await axios.get(`${this.apiBaseUrl}/dinkes/stunting`);
                        this.dataStunting = response.data;

                        // Destroy existing DataTable instance
                        $('#example').DataTable().destroy();

                        // Initialize DataTables after updating the data
                        this.$nextTick(() => {
                            $('#example').DataTable();
                        });
                    } catch (error) {
                        console.error('Error fetching data:', error);
                    }
                },
            }
        });

        app.mount('#stunting');
    </script>
</section>
