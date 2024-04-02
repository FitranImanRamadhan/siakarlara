@extends('tmp')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title }}</div>

                <div class="card-body">
                    <form action="{{ route('pegawais.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="nama" class="col-md-4 col-form-label text-md-right">Nama<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $pegawai->nama }}" required autofocus>

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="position_id" class="col-md-4 col-form-label text-md-right">Jabatan<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <select id="position_id" class="form-control @error('position_id') is-invalid @enderror" name="position_id" required onchange="calculateBPJSTK(); calculateBPJSKES()">
                                    <option value="" disabled>Pilih Jabatan</option>
                                    @foreach ($pst as $item)
                                        <option value="{{ $item->id }}" {{ $pegawai->position_id == $item->id ? 'selected' : '' }}>{{ $item->jabatan }}</option>
                                    @endforeach
                                </select>
                                @error('position_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-right">Jenis Kelamin<span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <select id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required>
                                    <option value="" disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ $pegawai->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $pegawai->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="tanggal_bergabung" class="col-md-4 col-form-label text-md-right">Tanggal Bergabung<span class="text-danger">*</span></label>

                            <div class="col-md-6">
                                <input id="tanggal_bergabung" type="date" class="form-control @error('tanggal_bergabung') is-invalid @enderror" name="tanggal_bergabung" value="{{ $pegawai->tanggal_bergabung }}" required>

                                @error('tanggal_bergabung')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-4">
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
