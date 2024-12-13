@extends('layout')
@section('content')
<div class="container-fluid page-header mb-0 p-0" style="background-image: url('{{ asset('assets/img/carousel-bg-2.jpg') }}');">
    <div class="container-fluid page-header-inner py-5">
        <div class="container text-center">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Technicians</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center text-uppercase">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Technicians</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInDown mb-4" data-wow-delay="0.1s">
            <h6 class="text-primary text-uppercase">// Our Promotion //</h6>
            <h1 class="mb-5">Promo Mailer</h1>
        </div>
        <div class="row g-4 bg-primary px-5" style="border-radius: 10px;">
            @foreach ($promos as $promo)
                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="{{ asset($promo->foto) }}" alt="{{ $promo->nama }}">
                        </div>
                        <div class="bg-secondary text-center p-1" style="border-radius: 5px;">
                            <h5 class="fw-bold mb-0 text-light">{{ $promo->nama }}</h5>
                            <small class="text-light">*{{ $promo->periode }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination with icons -->
        <div class="d-flex justify-content-center mt-4">
            {{ $promos->links('pagination::bootstrap-4') }}
        </div>
        <!-- End Pagination with icons -->
    </div>
</div>


@endsection