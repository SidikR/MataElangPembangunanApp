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
                    <div class="list-kategori rounded-3 p-3 h-5">
                        <div class="wrapper-list" v-for="program in dataProgram" :key="program.ID">
                            <ul class="p-2 rounded-3 mb-2">
                                @{{ program.Name }}
                            </ul>
                            <ul class="p-2 rounded-3 mb-2">
                                @{{ program.Name }}
                            </ul>
                            <ul class="p-2 rounded-3 mb-2">
                                @{{ program.Name }}
                            </ul>
                            <ul class="p-2 rounded-3 mb-2">
                                @{{ program.Name }}
                            </ul>
                            <ul class="p-2 rounded-3 mb-2">
                                @{{ program.Name }}
                            </ul>
                            <ul class="p-2 rounded-3 mb-2">
                                @{{ program.Name }}
                            </ul>
                        </div>
                    </div>
            </div>
            <div class="col-8 box-data p-4">
                <h4>Data Terkait</h4>
                <div class="search-box mb-2">
                    <input type="text" class="form-control" placeholder="Cari data terkait...">
                </div>
                <div class="list-kategori-data rounded-3 h-5">
                    <div class="wrapper-list">
                        <div class="data my-2 p-3 rounded-3 text-white">
                            <a href={{ route('detail') }}>
                                <h5 class="text-white">Sebaran Stunting di Kabupaten</h5>
                            </a>
                            <p>data data stanting di kabupaten lampung selatan</p>
                        </div>
                        <div class="data my-2 p-3 rounded-3 text-white">
                            <a href={{ route('detail') }}>
                                <h5 class="text-white">Sebaran Stunting di Kabupaten</h5>
                            </a>
                            <p>data data stanting di kabupaten lampung selatan</p>
                        </div>
                        <div class="data my-2 p-3 rounded-3 text-white">
                            <a href={{ route('detail') }}>
                                <h5 class="text-white">Sebaran Stunting di Kabupaten</h5>
                            </a>
                            <p>data data stanting di kabupaten lampung selatan</p>
                        </div>
                        <div class="data my-2 p-3 rounded-3 text-white">
                            <a href={{ route('detail') }}>
                                <h5 class="text-white">Sebaran Stunting di Kabupaten</h5>
                            </a>
                            <p>data data stanting di kabupaten lampung selatan</p>
                        </div>
                        <div class="data my-2 p-3 rounded-3 text-white">
                            <a href={{ route('detail') }}>
                                <h5 class="text-white">Sebaran Stunting di Kabupaten</h5>
                            </a>
                            <p>data data stanting di kabupaten lampung selatan</p>
                        </div>
                        <div class="data my-2 p-3 rounded-3 text-white">
                            <a href={{ route('detail') }}>
                                <h5 class="text-white">Sebaran Stunting di Kabupaten</h5>
                            </a>
                            <p>data data stanting di kabupaten lampung selatan</p>
                        </div>
                        <div class="data my-2 p-3 rounded-3 text-white">
                            <a href={{ route('detail') }}>
                                <h5 class="text-white">Sebaran Stunting di Kabupaten</h5>
                            </a>
                            <p>data data stanting di kabupaten lampung selatan</p>
                        </div>
                        <div class="data my-2 p-3 rounded-3 text-white">
                            <a href={{ route('detail') }}>
                                <h5 class="text-white">Sebaran Stunting di Kabupaten</h5>
                            </a>
                            <p>data data stanting di kabupaten lampung selatan</p>
                        </div>
                        <div class="data my-2 p-3 rounded-3 text-white">
                            <a href={{ route('detail') }}>
                                <h5 class="text-white">Sebaran Stunting di Kabupaten</h5>
                            </a>
                            <p>data data stanting di kabupaten lampung selatan</p>
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
