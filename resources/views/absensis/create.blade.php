@extends('adminlayout')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ implode('/', ['', 'absensis']) }}"> Absensis</a></li>
                    <li class="breadcrumb-item">@lang('Create new')</li>
                </ol>
            </div>
            <div class="card-body">
                <form action="{{ route('absensis.store', []) }}" method="POST" class="m-0 p-0">
                    <div class="card-body">
                        @csrf
                        <div>
                            <label for="id" class="form-label">Id:</label>
                            <select name="id" id="id" class="form-control" required>
                                <option value="">-- Pilih Id - Nama --</option>
                                @foreach ($pegawais as $pegawai)
                                    <option value="{{ $pegawai->id }}" {{ old('id') == $pegawai->id ? 'selected' : '' }}>
                                        {{ $pegawai->id }} - {{ $pegawai->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('nama'))
                                <div class='error small text-danger'>{{ $errors->first('nama') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal:</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                value="{{ @old('tanggal') }}" required />
                            @if ($errors->has('tanggal'))
                                <div class='error small text-danger'>{{ $errors->first('tanggal') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan:</label>
                            <input type="number" name="keterangan" id="keterangan" class="form-control"
                                value="{{ @old('keterangan') }}" required />
                            @if ($errors->has('keterangan'))
                                <div class='error small text-danger'>{{ $errors->first('keterangan') }}</div>
                            @endif
                        </div>

                    </div>

                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('absensis.index', []) }}" class="btn btn-light">@lang('Cancel')</a>
                            <button type="submit" class="btn btn-primary">@lang('Create new Absensi')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
