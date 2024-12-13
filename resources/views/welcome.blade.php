@extends('layout')

@section('content')
<div class="container-fluid p-0 mb-5">
    <div id="header-carousel" class="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="{{ asset('assets/img/carousel_bg_fix.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex align-items-center">
                    <div class="container">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <div class="col-10 col-lg-7 text-center text-lg-start">
                                <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown"><br><br><br>Minimarket Lokal Tasikmalaya</h1>
                                <a href="" class="btn btn-primary py-3 px-5 animated slideInDown">SELENGKAPNYA<i class="fa fa-arrow-right ms-3"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->


<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="d-flex py-0 px-4">
                    <i class="fa fa-certificate fa-3x text-primary flex-shrink-0"></i>
                    <div class="ps-4">
                        <h5 class="mb-3">Memberikan Layanan Terbaik</h5>
                        <p>Strategi Memberikan Pelayanan Kepada Pelanggan yang Baik</p>
                        <a class="text-secondary border-bottom" href="">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="d-flex py-0 px-4">
                    <i class="fa fa-users-cog fa-3x text-primary flex-shrink-0"></i>
                    <div class="ps-4">
                        <h5 class="mb-3">Mengutamakan Pelanggan</h5>
                        <p>Memberikan Pelayanan Prima Adalah Sikap Yang Baik</p>
                        <a class="text-secondary border-bottom" href="">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="d-flex py-0 px-4">
                    <i class="fa fa-tools fa-3x text-primary flex-shrink-0"></i>
                    <div class="ps-4">
                        <h5 class="mb-3">Dengan Teknologi Modern</h5>
                        <p>Teknologi Modern Untuk Meningkatkan Efisiensi Dan Pengalaman Berbelanja Konsumen</p>
                        <a class="text-secondary border-bottom" href="">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->


<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 pt-4" style="min-height: 400px;">
                <div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
                    <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('assets/img/about.jpg') }}" style="object-fit: cover;" alt="">
                    <div class="position-absolute top-0 end-0 mt-n4 me-n4 py-4 px-5" style="background: rgba(0, 0, 0, .08);">
                        <h1 class="display-4 text-white mb-0">11 <span class="fs-4">Years</span></h1>
                        <h4 class="text-white">Experience</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h1 class="mb-4"><span class="text-primary">TASCO MINIMART</span></h1>
                <p class="mb-4">Berdiri pada tahun 2012 dan grand opening di Bulan Februari 2013 dan Menjadi Perusahaan Retail Terbaik di Priangan Timur 
                    dengan kualitas pelayanan standar Internasional dan Harga yang kompetitif.</p>
                <div class="row g-4 mb-3 pb-3">
                    <div class="col-12 wow fadeIn" data-wow-delay="0.1s">
                        <div class="d-flex">
                            <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                <span class="fw-bold text-secondary">01</span>
                            </div>
                            <div class="ps-3">
                                <h6>LOKASI STRATEGIS</h6>
                                <span>Menyediakan toko di lokasi yang strategis dan mudah diakses oleh pelanggan dengan 
                                    fasilitas dan system layanan berbasis kearifan lokal.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                        <div class="d-flex">
                            <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                <span class="fw-bold text-secondary">02</span>
                            </div>
                            <div class="ps-3">
                                <h6>KENYAMANAN BERBELANJA</h6>
                                <span>Senantiasa ramah, memberikan kenyamanan, dan kesenangan bagi konsumen yang berbelanja.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                        <div class="d-flex">
                            <div class="bg-light d-flex flex-shrink-0 align-items-center justify-content-center mt-1" style="width: 45px; height: 45px;">
                                <span class="fw-bold text-secondary">03</span>
                            </div>
                            <div class="ps-3">
                                <h6>SAHABAT KONSUMEN</h6>
                                <span>Menjadi sahabat konsumen dalam memenuhi kebutuhan sehari-hari.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="" class="btn btn-primary py-3 px-5">Read More<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Fact Start -->
<div class="container-fluid fact bg-dark my-5 py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 text-center wow fadeIn" data-wow-delay="0.1s">
                <i class="fa bi-calendar-check fa-2x text-white mb-3"></i>
                <h2 class="text-white mb-2" data-toggle="counter-up">11</h2>
                <p class="text-white mb-0">Years Experience</p>
            </div>
            <div class="col-md-6 col-lg-4 text-center wow fadeIn" data-wow-delay="0.3s">
                <i class="fa bi-shop-window fa-2x text-white mb-3"></i>
                <h2 class="text-white mb-2" data-toggle="counter-up">30</h2>
                <p class="text-white mb-0">Outlet</p>
            </div>
            <div class="col-md-6 col-lg-4 text-center wow fadeIn" data-wow-delay="0.5s">
                <i class="fa bi-people fa-2x text-white mb-3"></i>
                <h2 class="text-white mb-2" data-toggle="counter-up">4675</h2>
                <p class="text-white mb-0">Member</p>
            </div>
        </div>
    </div>
</div>
<!-- Fact End -->


<!-- Service Start -->
<div class="container-xxl service py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-primary text-uppercase">Beberapa Kategori Produk yang dijual</h6>
            <h1 class="mb-5">TASCO MINIMART</h1>
        </div>
        <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
            <div class="col-lg-4">
                <div class="nav w-100 nav-pills me-4">
                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4 active" data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                        <i class="fa fa-check fa-2x me-3"></i>
                        <h4 class="m-0">Sembako Lengkap</h4>
                    </button>
                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                        <i class="fa fa-check fa-2x me-3"></i>
                        <h4 class="m-0">Makanan & Minuman</h4>
                    </button>
                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                        <i class="fa fa-check fa-2x me-3"></i>
                        <h4 class="m-0">Susu & Perlengkapan Bayi</h4>
                    </button>
                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-0" data-bs-toggle="pill" data-bs-target="#tab-pane-4" type="button">
                        <i class="fa fa-check fa-2x me-3"></i>
                        <h4 class="m-0">Arena Bermain Anak</h4>
                    </button>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="tab-content w-100">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <div class="row g-4">
                            <div class="col-md-6" style="min-height: 350px;">
                                <div class="position-relative h-100">
                                    <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('assets/img/service-1.jpg') }}"
                                        style="object-fit: cover;" alt="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3 class="mb-3">Seputar Pelayanan TASCO MINIMART</h3>
                                <p class="mb-4">Menyediakan kebutuhan sehari-hari (Consumer Goods) melalui offline dan online.</p>
                                <p><i class="fa fa-check text-success me-3"></i>Tersedia di Grab Mart</p>
                                <p><i class="fa fa-check text-success me-3"></i>PPOB</p>
                                <a href="" class="btn btn-primary py-3 px-5 mt-3">Read More<i class="fa fa-arrow-right ms-3"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->


<!-- Booking Start -->
<div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-6 py-5">
                <div class="py-5">
                    <h1 class="text-white mb-4">Kritik dan Saran Anda, Ciptakan Pengalaman yang Lebih Baik</h1>
                    <p class="text-white mb-0">Merupakan komitmen suatu perusahaan untuk meningkatkan layanan yang memiliki makna penting 
                        dengan Mendengarkan Pelanggan, Respek terhadap pandangan pelanggan, Perbaikan berkelanjutan dan Kolaborasi dengan 
                        pelanggan.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-primary h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s" style="border-radius: 20px;">
                    <h1 class="text-white mb-4">Kritik & Saran Customer</h1>
                    <form>
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0" placeholder="Your Name" style="height: 55px; border-radius: 10px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" class="form-control border-0" placeholder="Your Email" style="height: 55px; border-radius: 10px;">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control border-0" placeholder="Special Request" style="border-radius: 10px;"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary w-100 py-3" type="submit">Kirim Kritik & Saran</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Booking End -->


<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h2 class="text-primary text-uppercase">PROGRAM EVENT</h2>
            <h1 class="mb-5">Tasco dan Tasmart</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="{{ asset('assets/img/team-1.jpg') }}" alt="">
                        <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="bg-light text-center p-4" style="border-radius: 8px;">
                        <h5 class="fw-bold mb-0">SENAM ZUMBA</h5>
                        <small>Sabtu, 25 Februari 2023</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="team-item">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="{{ asset('assets/img/team-2.jpg') }}" alt="">
                        <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="bg-light text-center p-4" style="border-radius: 8px;">
                        <h5 class="fw-bold mb-0">PEKAN GEMBIRA BERSAMA</h5>
                        <small>Jum'at, 07 Juli 2023</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="team-item">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="{{ asset('assets/img/team-3.jpg') }}" alt="">
                        <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="bg-light text-center p-4" style="border-radius: 8px;">
                        <h5 class="fw-bold mb-0">LOMBA MEWARNAI ANAK</h5>
                        <small>Sabtu, 10 September 2023</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="team-item">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="{{ asset('assets/img/team-4.jpg') }}" alt="">
                        <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square mx-1" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="bg-light text-center p-4" style="border-radius: 8px;">
                        <h5 class="fw-bold mb-0">GEBYAR UNDIAN TASCO</h5>
                        <small>Minggu, 17 September 2023</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->


<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h2 class="text-primary text-uppercase">TASCO PROMO DAHSYAT</h2>
            <h1 class="mb-5">Dapatkan Promonya Setiap Hari</h1>
        </div>
       
            
        
        <div class="owl-carousel testimonial-carousel position-relative">
            @foreach ( $promos as $promo ) 
            <div class="testimonial-item text-center">
                <img class="bg-light rounded-circle p-2 mx-auto mb-3" src="{{ asset($promo->foto) }}" style="width: 200px; height: 200px;">
                <h5 class="mb-0">{{ $promo->nama }}</h5>
                <h4><span class="badge bg-warning px-55 py-1 text-dark" style="border-radius: 3px;"><s>{{ $promo->harga_awal }}</s></span></h4>
                <h1><span class="badge bg-primary px-6 py-2 text-light" style="border-radius: 3px;">{{ $promo->harga_promo }}</span></h1>
            </div>
            @endforeach
            
        </div>
        <div class="testimonial-item text-center p-3">
            <a href="Reguler.html" class="btn btn-primary py-3 px-3 mb-3">Cek Promo Lainnya<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </div>
</div>
@endsection