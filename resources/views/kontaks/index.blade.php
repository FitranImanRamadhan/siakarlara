@extends('layout')
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-0 p-0" style="background-image: url('{{ asset('assets/img/carousel-bg-1.jpg') }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown"><i class="bi bi-telephone-inbound-fill px-4"></i>Contact</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">

                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">// Contact Us //</h6>
                <h1 class="mb-5">Hubungi Kami Untuk Mengajukan Pertanyaan</h1>
            </div>
            <div class="row g-4">
                <div class="col-12">
                    <div class="row gy-4">
                        <div class="col-md-4">
                            <div class="bg-primary d-flex flex-column justify-content-center p-4" style="border-radius: 5px;">
                                <h5 class="text-uppercase text-light">// Human Resource //</h5>
                                <p class="m-0 text-light"><i class="bi bi-envelope-open-fill text-light me-2"></i>book@example.com</p>
                                <p class="m-0 text-light"><i class="bi bi-whatsapp text-light me-2"></i>book@example.com</p>
                                <p class="m-0 text-light"><i class="bi bi-facebook text-light me-2"></i>book@example.com</p>
                                <p class="m-0 text-light"><i class="bi bi-instagram text-light me-2"></i>book@example.com</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-primary d-flex flex-column justify-content-center p-4" style="border-radius: 5px;">
                                <h5 class="text-uppercase text-light">// Commercial //</h5>
                                <p class="m-0 text-light"><i class="fab fa-tiktok text-light me-2"></i>tascominimart1</p>
                                <p class="m-0 text-light"><i class="bi bi-whatsapp text-light me-2"></i>book@example.com</p>
                                <p class="m-0 text-light"><i class="bi bi-facebook text-light me-2"></i>Tasco Minimart</p>
                                <p class="m-0 text-light"><i class="bi bi-instagram text-light me-2"></i>@tascominimarttasik</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-primary d-flex flex-column justify-content-center p-4" style="border-radius: 5px;">
                                <h5 class="text-uppercase text-light">// Operational //</h5>
                                <p class="m-0 text-light"><i class="bi bi-envelope-open-fill text-light me-2"></i>book@example.com</p>
                                <p class="m-0 text-light"><i class="bi bi-whatsapp text-light me-2"></i>book@example.com</p>
                                <p class="m-0 text-light"><i class="bi bi-facebook text-light me-2"></i>book@example.com</p>
                                <p class="m-0 text-light"><i class="bi bi-instagram text-light me-2"></i>book@example.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7914.352333821619!2d108.23032991116804!3d-7.334103079476951!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f592710c263ff%3A0x75036acef36ea714!2sTASCO%20OFFICE!5e0!3m2!1sid!2sid!4v1700557088844!5m2!1sid!2sid" 
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                
                <div class="col-md-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="bg-primary d-flex flex-column justify-content-center px-3 py-3" style="border-radius: 5px;">
                            <h4 class="text-uppercase text-light">// Open Hours //</h4>
                            <h5 class="mb-3 text-light">|| Senin - Jum'at : 08.00 - 17.00 WIB <br> || Sabtu : 08.00 - 13.00 WIB</h5>
                        </div>
                        <br>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name" style="border-radius: 5px;">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email" style="border-radius: 5px;">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="subject" placeholder="Subject" style="border-radius: 5px;">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 100%; border-radius: 5px;"></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="#">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br><hr>
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">// Mapping //</h6>
                <h1 class="mb-5">Outlet Tasco Minimart di Kota Tasikmalaya</h1>
            </div>
            <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s" id="map" style="width: 100%;height: 400px;"></div>

        </div>
    </div>
    <!-- Contact End -->

    
@endsection