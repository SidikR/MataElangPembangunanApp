<section id="opd_detail" class="services" v-if="selectedOPDCard && !selectedDataCard">

    <div class="container section-title" data-aos="fade-up">
        <h2>@{{ selectedOPD.nama }}</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-4 box-data p-4" id="myDropdown">
                <h4>Kategori Data</h3>
                    <div class="search-box mb-2">
                        <input type="text" class="form-control" id="myInput" onkeyup="filterFunction()"
                            placeholder="Cari kategori data...">
                    </div>
                    <div class="list-kategori rounded-3 p-3">
                        <div class="wrapper-list">
                            <ul class="p-2 rounded-3 mb-2">
                                Stunting
                            </ul>
                            <ul class="p-2 rounded-3 mb-2">
                                Fasilitas Kesehatan
                            </ul>
                            <ul class="p-2 rounded-3 mb-2">
                                Tenaga Kesehatan
                            </ul>
                            <ul class="p-2 rounded-3 mb-2">
                                Stunting
                            </ul>
                            <ul class="p-2 rounded-3 mb-2">
                                Fasilitas Kesehatan
                            </ul>
                            <ul class="p-2 rounded-3 mb-2">
                                Tenaga Kesehatan
                            </ul>
                            <ul class="p-2 rounded-3 mb-2">
                                Stunting
                            </ul>
                            <ul class="p-2 rounded-3 mb-2">
                                Fasilitas Kesehatan
                            </ul>
                            <ul class="p-2 rounded-3 mb-2">
                                Tenaga Kesehatan
                            </ul>
                        </div>
                    </div>
            </div>
            <div class="col-8 box-data p-4">
                <h4>Data Terkait</h4>
                <div class="search-box mb-2">
                    <input type="text" class="form-control" placeholder="Cari data terkait...">
                </div>
                <div class="ketegoridata-tabel p-3 rounded-2 mb-2">
                    <div class="d-flex justify-content-between">
                        <span>Judul</span>
                        <span>Sifat & Frekuensi</span>
                        <span>Kategori Sektoral</span>
                    </div>
                </div>
                <div class="list-kategori-data rounded-3 h-5">
                    <div class="wrapper-list">
                        <div class="data my-2 p-3 rounded-3 text-white">
                            <div class="row d-flex">
                                <div class="col">
                                    <a href={{ route('detail') }}>
                                        <p class="text-white fs-bold mb-0">Sebaran Data Stunting di Kabupaten Lampung
                                            Selatan</p>
                                    </a>
                                    <p>Dinas Kesehatan</p>
                                    <p>Diperbaharui pada 21 Des 2023, 15:09 WIB</p>
                                </div>
                                <div class="col">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex row flex-column">
                                            <p class="fw-bold mb-0">Sifat Data</p>
                                            <p>Data Prioritas</p>
                                        </div>
                                        <div class="d-flex row flex-column">
                                            <p class="fw-bold mb-0">Frekuensi</p>
                                            <p>Setiap ada Perubahan</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <p>Pendidikan, Kesehatan, Sosial, Pemberdayaan Masyarakat Desa, Perpustakaan dan
                                        Kearsipan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function filterFunction() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            div = document.getElementById("myDropdown");
            a = div.getElementsByTagName("ul");
            for (i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }
    </script>
</section>
