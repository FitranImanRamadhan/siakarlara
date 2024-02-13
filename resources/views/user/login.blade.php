@extends('layout')

@section('content')
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card rounded-4 shadow-lg">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="{{asset('assets/images/backgrounds/login2.jpg')}}" alt="login form" class="img-fluid rounded-start-4" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form action="{{ route('login.action') }}" method="POST">
                                    @csrf
                                    <div class="d-flex align-items-center mb-5 pb-1">
                                    <img src="{{asset('assets/images/logos/logo2.png')}}" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />           
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

                                    <div class="form-outline mb-4">
                                        <input type="nip" id="form2Example17" class="form-control form-control-lg" name="nip" />
                                        <label class="form-label" for="form2Example17">NIP</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="form2Example27" class="form-control form-control-lg" name="password" />
                                        <label class="form-label" for="form2Example27">Password</label>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                                    </div>

                                    <a class="small text-muted" href="#!">Forgot password?</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
