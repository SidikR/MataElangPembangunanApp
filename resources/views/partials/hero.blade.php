<!-- Hero Section - Home Page -->
<section id="hero" class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <h2 data-aos="fade-up" data-aos-delay="100">Mata Elang Pembangunan</h2>
                <p data-aos="fade-up" data-aos-delay="200">Cari data tentang Lampung Selatan</p>
            </div>
            <div class="col-lg-5">
                <form action="#" class="sign-up-form d-flex" data-aos="fade-up" data-aos-delay="300">
                    <input type="text" class="form-control" placeholder="Cari Data...">
                    <input type="submit" class="btn btn-primary" value="Cari!">
                </form>
            </div>
        </div>
    </div>

    <div class="hero-bg-slider">
        <img src="assets/img/hero/hero1.jpg" alt="" data-aos="fade-in">
        <img src="assets/img/hero/hero2.jpg" alt="" data-aos="fade-in">
        <img src="assets/img/hero/hero3.jpeg" alt="" data-aos="fade-in">
    </div>
</section><!-- End Hero Section -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Change background image every 5 seconds
        let index = 0;
        const images = document.querySelectorAll('.hero-bg-slider img');

        function changeImage() {
            images.forEach(img => img.style.opacity = 0);
            images[index].style.opacity = 1;
            index = (index + 1) % images.length;
        }

        setInterval(changeImage, 3000);
    });
</script>
