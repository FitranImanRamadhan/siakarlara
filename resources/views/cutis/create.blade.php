@extends('adminlayout')

@section('content')
<div class="container">
    <h1>Create Cuti</h1>

    <!-- Menampilkan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form untuk input data -->
    <form action="{{ route('cutis.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="id">ID</label>
            <input type="number" name="id" id="id" class="form-control" value="{{ old('id') }}">
        </div>

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}">
        </div>

        <div class="form-group">
            <label for="date_cuti">Tanggal Cuti</label>
            <input type="date" name="date_cuti" id="date_cuti" class="form-control" value="{{ old('date_cuti') }}">
        </div>

        <div class="form-group">
            <label for="end_cuti">Akhir Cuti</label>
            <input type="date" name="end_cuti" id="end_cuti" class="form-control" value="{{ old('end_cuti') }}">
        </div>

        <div class="form-group">
            <label for="jumlah_cuti">Jumlah Cuti</label>
            <input type="text" name="jumlah_cuti" id="jumlah_cuti" class="form-control" value="{{ old('jumlah_cuti') }}">
        </div>

        <div class="form-group">
            <label for="toko">Toko</label>
            <input type="text" name="toko" id="toko" class="form-control" value="{{ old('toko') }}">
        </div>

        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ old('jabatan') }}">
        </div>

        <div class="form-group">
            <label for="jenis_cuti">Jenis Cuti</label>
            <input type="text" name="jenis_cuti" id="jenis_cuti" class="form-control" value="{{ old('jenis_cuti') }}">
        </div>

        <div class="form-group">
            <label for="alasan_cuti">Alasan Cuti</label>
            <input type="text" name="alasan_cuti" id="alasan_cuti" class="form-control" value="{{ old('alasan_cuti') }}">
        </div>

        <div class="form-group">
            <label for="ambil_tugas">Ambil Tugas</label>
            <input type="text" name="ambil_tugas" id="ambil_tugas" class="form-control" value="{{ old('ambil_tugas') }}">
        </div>

        <div class="form-group">
            <label for="filename">Filename</label>
            <input type="text" name="filename" id="filename" class="form-control" value="{{ old('filename') }}">
        </div>

        <div class="form-group">
            <label for="image_data">Image Data</label>
            <input type="text" name="image_data" id="image_data" class="form-control" value="{{ old('image_data') }}">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status" id="status" class="form-control" value="{{ old('status') }}">
        </div>

        <div class="form-group">
            <label for="kode">Kode</label>
            <input type="text" name="kode" id="kode" class="form-control" value="{{ old('kode') }}">
        </div>

        <div class="form-group">
            <label for="date_acc">Tanggal Acc</label>
            <input type="date" name="date_acc" id="date_acc" class="form-control" value="{{ old('date_acc') }}">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
