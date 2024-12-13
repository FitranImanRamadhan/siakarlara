@extends('layout')
@section('content')
 <!-- Page Header Start -->
 <div class="container-fluid page-header mb-0 p-0" style="background-image: url('{{ asset('assets/img/carousel-bg-2.jpg') }}');">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown"><i class="fa fa-shopping-cart px-4"></i>Promo Reguler</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#">Promo</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Promo CAP</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Testimonial Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInDown" data-wow-delay="0.1s">
            <h6 class="text-primary text-uppercase">// Our Promotion //</h6>
            <h1 class="mb-0">Promo Ceria Akhir Pekan</h1>
            <div class="badge bg-primary" style="border-top-right-radius: 10px; border-top-left-radius: 10px;">
                <h4 class="text-light">* Jum'at, Sabtu, Minggu *</h4>
            </div>
        </div>
        <div class="row bg-secondary" style="border-radius: 10px;">
            <div id="carouselExampleIndicators" class="carousel slide bg-secondary d-flex flex-column text-center p-2" data-bs-ride="carousel" style="border-radius: 10px;">
                <div class="carousel-indicators">
                    @foreach ($promos as $index => $promo)
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($promos as $index => $promo)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset($promo->foto) }}" style="width: fit-content; height: fit-content; padding: 1%;" class="d-block w-100" alt="{{ $promo->nama }}">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection