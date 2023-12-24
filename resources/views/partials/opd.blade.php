<!-- Services Section - Home Page -->
<section id="list_op" class="services" v-if="!selectedOPDCard && !selectedDataCard">

    <!--  Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Organisasi Perangkat Daerah (OPD)</h2>
        <p>Berikut ini beberapa OPD yang ada di Lampung Selatan</p>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="row gy-4 justify-content-center">

            @foreach ($instansi as $item)
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-hover pointer-event rounded-3 p-4 d-flex flex-column justify-content-center align-items-center"
                        @click="handleCardClick('{{ $item->nama }}', 'dinkes/program')">

                        <i class="bi bi-hospital fs-1 text-white"></i>
                        <h5 class="card-title text-white text-center justify-content-center">{{ $item->nama }}</h5>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section><!-- End Services Section -->
