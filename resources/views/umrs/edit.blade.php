@extends('tmp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <form action="{{ route('umrs.update', $umr->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="kota" class="col-md-4 col-form-label text-md-right">Kota<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="kota" type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" value="{{ $umr->kota }}" required autofocus>

                                @error('kota')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="upah_umr" class="col-md-4 col-form-label text-md-right">Upah Minimum<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="upah_umr" type="text" class="form-control @error('upah_umr') is-invalid @enderror" name="upah_umr" value="{{ $umr->upah_umr }}" required>

                                @error('upah_umr')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
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
