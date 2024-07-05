@extends('tmp')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ implode('/', ['', 'absensis']) }}"> Absensis</a></li>
                    <li class="breadcrumb-item">@lang('Edit Absensi') #{{ $absensi->id }}</li>
                </ol>
            </div>
            <div class="card-body">
                <form action="{{ route('absensis.update', compact('absensi')) }}" method="POST" class="m-0 p-0">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="urut" class="form-label">Urut:</label>
                            <input type="text" name="urut" id="urut" class="form-control"
                                value="{{ @old('urut', $absensi->urut) }}" required />
                            @if ($errors->has('urut'))
                                <div class='error small text-danger'>{{ $errors->first('urut') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="id" class="form-label">Id:</label>
                            <input type="text" name="id" id="id" class="form-control"
                                value="{{ @old('id', $absensi->id) }}" required />
                            @if ($errors->has('id'))
                                <div class='error small text-danger'>{{ $errors->first('id') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal:</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ @old('tanggal', $absensi->tanggal) }}" required />
                            @if ($errors->has('tanggal'))
                                <div class='error small text-danger'>{{ $errors->first('tanggal') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="jam" class="form-label">Jam:</label>
                            <input type="time" name="jam" id="jam" class="form-control"
                                value="{{ @old('jam', $absensi->jam) }}" required />
                            @if ($errors->has('jam'))
                                <div class='error small text-danger'>{{ $errors->first('jam') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="kode1" class="form-label">Kode1:</label>
                            <input type="number" name="kode1" id="kode1" class="form-control"
                                value="{{ @old('kode1', $absensi->kode1) }}" required />
                            @if ($errors->has('kode1'))
                                <div class='error small text-danger'>{{ $errors->first('kode1') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="kode2" class="form-label">Kode2:</label>
                            <input type="number" name="kode2" id="kode2" class="form-control"
                                value="{{ @old('kode2', $absensi->kode2) }}" required />
                            @if ($errors->has('kode2'))
                                <div class='error small text-danger'>{{ $errors->first('kode2') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="kode3" class="form-label">Kode3:</label>
                            <input type="number" name="kode3" id="kode3" class="form-control"
                                value="{{ @old('kode3', $absensi->kode3) }}" required />
                            @if ($errors->has('kode3'))
                                <div class='error small text-danger'>{{ $errors->first('kode3') }}</div>
                            @endif
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('absensis.index', []) }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">@lang('Update Absensi')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
