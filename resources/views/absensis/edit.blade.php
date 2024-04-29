@extends('tmp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Data Absensi - {{ $absensi->pegawai->nama }}</div>

                <div class="card-body">
                    <form action="{{ route('absensis.update', $absensi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="hadir" class="col-md-4 col-form-label text-md-right">Hadir:</label>

                            <div class="col-md-6">
                                <input id="hadir" type="number" class="form-control @error('hadir') is-invalid @enderror" name="hadir" value="{{ $absensi->hadir }}" required autofocus>

                                @error('hadir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="izin" class="col-md-4 col-form-label text-md-right">Izin:</label>

                            <div class="col-md-6">
                                <input id="izin" type="number" class="form-control @error('izin') is-invalid @enderror" name="izin" value="{{ $absensi->izin }}" required>

                                @error('izin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="sakit" class="col-md-4 col-form-label text-md-right">Sakit:</label>

                            <div class="col-md-6">
                                <input id="sakit" type="number" class="form-control @error('sakit') is-invalid @enderror" name="sakit" value="{{ $absensi->sakit }}" required>

                                @error('sakit')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="alpha" class="col-md-4 col-form-label text-md-right">Alpha:</label>

                            <div class="col-md-6">
                                <input id="alpha" type="number" class="form-control @error('alpha') is-invalid @enderror" name="alpha" value="{{ $absensi->alpha }}" required>

                                @error('alpha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="selisih" class="col-md-4 col-form-label text-md-right">Selisih Menit:</label>

                            <div class="col-md-6">
                                <input id="selisih" type="number" class="form-control @error('selisih') is-invalid @enderror" name="selisih" value="{{ $absensi->selisih }}" required>

                                @error('selisih')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mt-2">
                            <label for="lembur" class="col-md-4 col-form-label text-md-right">Lembur:</label>

                            <div class="col-md-6">
                                <input id="lembur" type="number" class="form-control @error('lembur') is-invalid @enderror" name="lembur" value="{{ $absensi->lembur }}" required>

                                @error('lembur')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
