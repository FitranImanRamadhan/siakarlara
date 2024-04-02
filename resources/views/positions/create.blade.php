@extends('tmp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <form action="{{ route('positions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="jabatan" class="col-md-4 col-form-label text-md-right">Jabatan<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan" value="{{ old('jabatan') }}" required autofocus>

                                @error('jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="gaji_perhari" class="col-md-4 col-form-label text-md-right">Gaji Perhari<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="gaji_perhari" type="text" class="form-control @error('gaji_perhari') is-invalid @enderror" name="gaji_perhari" value="{{ old('gaji_perhari') }}" required>

                                @error('gaji_perhari')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="tunjangan_jabatan" class="col-md-4 col-form-label text-md-right">Tunjangan Jabatan<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="tunjangan_jabatan" type="text" class="form-control @error('tunjangan_jabatan') is-invalid @enderror" name="tunjangan_jabatan" value="{{ old('tunjangan_jabatan') }}" required>

                                @error('tunjangan_jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="uang_makan" class="col-md-4 col-form-label text-md-right">Uang Makan<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="uang_makan" type="text" class="form-control @error('uang_makan') is-invalid @enderror" name="uang_makan" value="{{ old('uang_makan') }}" required>

                                @error('uang_makan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
