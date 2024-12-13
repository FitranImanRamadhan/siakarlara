@extends('layout')
@section('content')
    <div class="container-fluid page-header mb-0 p-0" style="background-image: url('{{ asset('assets/img/carousel-bg-2.jpg') }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                <h1 class="display-3 text-white mb-3 animated slideInDown"><i class="bi bi-briefcase-fill px-4"></i>Career</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <!-- Breadcrumb items can be added here if needed -->
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-3">
                <div class="col-12">
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <!-- Slides with indicators -->
                            <div id="carouselExampleIndicators"
                                class="carousel slide bg-secondary d-flex flex-column text-center" data-bs-ride="carousel"
                                style="border-radius: 10px;">
                                <div class="carousel-indicators">
                                    @foreach ($lokers as $index => $loker)
                                        <button type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"
                                            aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @foreach ($lokers as $index => $loker)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            @if ($loker->foto)
                                                <img src="{{ asset($loker->foto) }}"
                                                    class="img-fluid" alt="Career Image">
                                            @else
                                                <img src="{{ asset('assets/img/default-placeholder.png') }}"
                                                    class="img-fluid" alt="Default Placeholder"> <!-- Fallback Image -->
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <!-- End Slides with indicators -->
                        </div>

                        <div class="col-md-6">
                            <div class="bg-primary d-flex flex-column justify-content-center p-4" style="border-radius: 10px;">
                                <h5 class="text-uppercase text-light">// Contact Person //</h5>
                                <p class="m-0 text-light"><i class="bi bi-envelope-open-fill text-light me-2"></i>book@example.com</p>
                                <p class="m-0 text-light"><i class="bi bi-whatsapp text-light me-2"></i>book@example.com</p>
                                <p class="m-0 text-light"><i class="bi bi-facebook text-light me-2"></i>book@example.com</p>
                                <p class="m-0 text-light"><i class="bi bi-instagram text-light me-2"></i>book@example.com</p>
                            </div>
                            <br>
                            <div class="bg-primary d-flex flex-column justify-content-center p-4" style="border-radius: 10px;">
                                <form>
                                    <div class="row mb-3 text-light">
                                        <label for="inputText" class="col-sm-2 col-form-label">Nama :</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" style="border-radius: 5px;">
                                        </div>
                                    </div>
                                    <div class="row mb-3 text-light">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email :</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" style="border-radius: 5px;">
                                        </div>
                                    </div>
                                    <div class="row mb-3 text-light">
                                        <label for="inputNumber" class="col-sm-2 col-form-label">Upload :</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" id="formFile" style="border-radius: 5px;">
                                        </div>
                                    </div>
                                    <div class="row mb-3 justify-content-center py-3 text-light">
                                        <label for="inputNumber" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-secondary px-5">KIRIM</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
