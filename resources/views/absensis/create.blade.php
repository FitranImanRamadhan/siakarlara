@extends('adminlayout')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Absensi</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('absensis.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="urut" class="form-label">Urut</label>
            <input type="number" class="form-control" id="urut" name="urut" value="{{ old('urut') }}" required>
        </div>

        <div class="mb-3">
            <label for="id" class="form-label">Pegawai</label>
            <select class="form-select" id="id" name="id" required>
                <option value="">Pilih Pegawai</option>
                @foreach ($pegawais as $pegawai)
                    <option value="{{ $pegawai->id }}" {{ old('id') == $pegawai->id ? 'selected' : '' }}>
                        {{ $pegawai->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
        </div>

        <div class="mb-3">
            <label for="jam" class="form-label">Jam</label>
            <input type="time" class="form-control" id="jam" name="jam" value="{{ old('jam') }}" required>
        </div>

        <div class="mb-3">
            <label for="kode1" class="form-label">Kode 1</label>
            <input type="text" class="form-control" id="kode1" name="kode1" value="{{ old('kode1') }}">
        </div>

        <div class="mb-3">
            <label for="kode2" class="form-label">Kode 2</label>
            <input type="text" class="form-control" id="kode2" name="kode2" value="{{ old('kode2') }}">
        </div>

        <div class="mb-3">
            <label for="kode3" class="form-label">Kode 3</label>
            <input type="text" class="form-control" id="kode3" name="kode3" value="{{ old('kode3') }}">
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('absensis.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
