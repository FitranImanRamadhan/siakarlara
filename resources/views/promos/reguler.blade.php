@extends('layout')
@section('content')
    <div class="container-fluid page-header mb-0 p-0"
        style="background-image: url('{{ asset('assets/img/carousel-bg-2.jpg') }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown"><i class="fa fa-shopping-cart px-4"></i>Promo
                    Reguler</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="#">Promo</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Promo Reguler</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInDown" data-wow-delay="0.1s">
                <h6 class="text-primary text-uppercase">// Our Promotion //</h6>
                <h1 class="mb-4">PROMO REGULER</h1>
            </div>
            <div class="row p-3 bg-secondary" style="border-radius: 10px;">
                @foreach ($promos as $promo)
                    <div class="col-lg-6 wow fadeInDown" data-wow-delay="0.1s">
                        <div class="testimonial-item text-center" style="padding-top: 1rem; padding-bottom: 1rem;">
                            <img class="bg-warning rounded-circle p-1 mx-auto mb-2" src="{{ asset($promo->foto) }}"
                                class="img-fluid" style="width: 11rem; height: 11rem;">
                            <h5 class="text-white mb-2">{{ $promo->nama }}</h5>
                            <h7><span class="badge bg-warning text-dark py-2 px-5"
                                    style="font-size: 12pt; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                                    <s>Rp {{ $promo->harga_awal }},-</s>
                                </span></h7>
                            <h6><span class="badge bg-primary text-light py-2 px-1" style="border-radius: 5px;">
                                    <font size="5">Rp {{ $promo->harga_promo }}</font><br><br>
                                    <font>*{{ $promo->periode }}</font>
                                </span></h6>
                        </div>
                    </div>
                @endforeach

                {{-- <div class="col-lg-6 wow fadeInDown" data-wow-delay="0.1s">
                    <div class="testimonial-item text-center" style="padding-top: 1rem; padding-bottom: 1rem;">
                        <img class="bg-warning rounded-circle p-1 mx-auto mb-2"
                            src="{{ asset('assets/img/testimonial-1.jpg') }}" style="width: 11rem; height: 11rem;">
                        <h5 class="mb-0">DAIA SOFTENER PINK 1.7 KG</h5>
                        <h7><span class="badge bg-warning text-dark py-2 px-5"
                                style="font-size: 12pt; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                                <s>Rp 30.900,-</s>
                            </span></h7>
                        <h6><span class="badge bg-primary text-light py-2 px-1" style="border-radius: 5px;">
                                <font size="5">Rp 28.700,-</font><br><br>
                                <font>*Periode 1 November 2023 - 30 November 2023</font>
                            </span></h6>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeInDown" data-wow-delay="0.1s">
                    <div class="testimonial-item text-center" style="padding-top: 1rem; padding-bottom: 1rem;">
                        <img class="bg-warning rounded-circle p-1 mx-auto mb-2"
                            src="{{ asset('assets/img/testimonial-1.jpg') }}" style="width: 11rem; height: 11rem;">
                        <h5 class="mb-0">DAIA SOFTENER PINK 1.7 KG</h5>
                        <h7><span class="badge bg-warning text-dark py-2 px-5"
                                style="font-size: 12pt; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                                <s>Rp 30.900,-</s>
                            </span></h7>
                        <h6><span class="badge bg-primary text-light py-2 px-1" style="border-radius: 5px;">
                                <font size="5">Rp 28.700,-</font><br><br>
                                <font>*Periode 1 November 2023 - 30 November 2023</font>
                            </span></h6>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeInDown" data-wow-delay="0.1s">
                    <div class="testimonial-item text-center" style="padding-top: 1rem; padding-bottom: 1rem;">
                        <img class="bg-warning rounded-circle p-1 mx-auto mb-2"
                            src="{{ asset('assets/img/testimonial-1.jpg') }}" style="width: 11rem; height: 11rem;">
                        <h5 class="mb-0">DAIA SOFTENER PINK 1.7 KG</h5>
                        <h7><span class="badge bg-warning text-dark py-2 px-5"
                                style="font-size: 12pt; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                                <s>Rp 30.900,-</s>
                            </span></h7>
                        <h6><span class="badge bg-primary text-light py-2 px-1" style="border-radius: 5px;">
                                <font size="5">Rp 28.700,-</font><br><br>
                                <font>*Periode 1 November 2023 - 30 November 2023</font>
                            </span></h6>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeInDown" data-wow-delay="0.1s">
                    <div class="testimonial-item text-center" style="padding-bottom: 1rem; padding-top: 1rem;">
                        <img class="bg-warning rounded-circle p-1 mx-auto mb-2"
                            src="{{ asset('assets/img/testimonial-1.jpg') }}" style="width: 11rem; height: 11rem;">
                        <h5 class="mb-0">DAIA SOFTENER PINK 1.7 KG</h5>
                        <h7><span class="badge bg-warning text-dark py-2 px-5"
                                style="font-size: 12pt; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                                <s>Rp 30.900,-</s>
                            </span></h7>
                        <h6><span class="badge bg-primary text-light py-2 px-1" style="border-radius: 5px;">
                                <font size="5">Rp 28.700,-</font><br><br>
                                <font>*Periode 1 November 2023 - 30 November 2023</font>
                            </span></h6>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeInDown" data-wow-delay="0.1s">
                    <div class="testimonial-item text-center" style="padding-bottom: 1rem; padding-top: 1rem;">
                        <img class="bg-warning rounded-circle p-1 mx-auto mb-2"
                            src="{{ asset('assets/img/testimonial-1.jpg') }}" style="width: 11rem; height: 11rem;">
                        <h5 class="mb-0">DAIA SOFTENER PINK 1.7 KG</h5>
                        <h7><span class="badge bg-warning text-dark py-2 px-5"
                                style="font-size: 12pt; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                                <s>Rp 30.900,-</s>
                            </span></h7>
                        <h6><span class="badge bg-primary text-light py-2 px-1" style="border-radius: 5px;">
                                <font size="5">Rp 28.700,-</font><br><br>
                                <font>*Periode 1 November 2023 - 30 November 2023</font>
                            </span></h6>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeInDown" data-wow-delay="0.1s">
                    <div class="testimonial-item text-center" style="padding-bottom: 1rem; padding-top: 1rem;">
                        <img class="bg-warning rounded-circle p-1 mx-auto mb-2"
                            src="{{ asset('assets/img/testimonial-1.jpg') }}" style="width: 11rem; height: 11rem;">
                        <h5 class="mb-0">DAIA SOFTENER PINK 1.7 KG</h5>
                        <h7><span class="badge bg-warning text-dark py-2 px-5"
                                style="font-size: 12pt; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                                <s>Rp 30.900,-</s>
                            </span></h7>
                        <h6><span class="badge bg-primary text-light py-2 px-1" style="border-radius: 5px;">
                                <font size="5">Rp 28.700,-</font><br><br>
                                <font>*Periode 1 November 2023 - 30 November 2023</font>
                            </span></h6>
                    </div>
                </div>
                <div class="col-lg-3 wow fadeInDown" data-wow-delay="0.1s">
                    <div class="testimonial-item text-center" style="padding-bottom: 1rem; padding-top: 1rem;">
                        <img class="bg-warning rounded-circle p-1 mx-auto mb-2"
                            src="{{ asset('assets/img/testimonial-1.jpg') }}" style="width: 11rem; height: 11rem;">
                        <h5 class="mb-0">DAIA SOFTENER PINK 1.7 KG</h5>
                        <h7><span class="badge bg-warning text-dark py-2 px-5"
                                style="font-size: 12pt; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                                <s>Rp 30.900,-</s>
                            </span></h7>
                        <h6><span class="badge bg-primary text-light py-2 px-1" style="border-radius: 5px;">
                                <font size="5">Rp 28.700,-</font><br><br>
                                <font>*Periode 1 November 2023 - 30 November 2023</font>
                            </span></h6>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
