@extends('adminlayout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('cutis.index', compact([])) }}"> Cutis</a></li>
                    <li class="breadcrumb-item">@lang('Edit Cuti') #{{$cuti->id}}</li>
                </ol>
            </div>
            <div class="card-body">
                <form action="{{ route('cutis.update', compact('cuti')) }}" method="POST" class="m-0 p-0">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
        <label for="urut" class="form-label">Urut:</label>
        <input type="number" name="urut" id="urut" class="form-control" value="{{@old('urut', $cuti->urut)}}" required/>
        @if($errors->has('urut'))
			<div class='error small text-danger'>{{$errors->first('urut')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama:</label>
        <input type="text" name="nama" id="nama" class="form-control" value="{{@old('nama', $cuti->nama)}}" />
        @if($errors->has('nama'))
			<div class='error small text-danger'>{{$errors->first('nama')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="date_cuti" class="form-label">Date Cuti:</label>
        <input type="text" name="date_cuti" id="date_cuti" class="form-control" value="{{@old('date_cuti', $cuti->date_cuti)}}" />
        @if($errors->has('date_cuti'))
			<div class='error small text-danger'>{{$errors->first('date_cuti')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="end_cuti" class="form-label">End Cuti:</label>
        <input type="text" name="end_cuti" id="end_cuti" class="form-control" value="{{@old('end_cuti', $cuti->end_cuti)}}" />
        @if($errors->has('end_cuti'))
			<div class='error small text-danger'>{{$errors->first('end_cuti')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="jumlah_cuti" class="form-label">Jumlah Cuti:</label>
        <input type="text" name="jumlah_cuti" id="jumlah_cuti" class="form-control" value="{{@old('jumlah_cuti', $cuti->jumlah_cuti)}}" />
        @if($errors->has('jumlah_cuti'))
			<div class='error small text-danger'>{{$errors->first('jumlah_cuti')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="toko" class="form-label">Toko:</label>
        <input type="text" name="toko" id="toko" class="form-control" value="{{@old('toko', $cuti->toko)}}" />
        @if($errors->has('toko'))
			<div class='error small text-danger'>{{$errors->first('toko')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="jabatan" class="form-label">Jabatan:</label>
        <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{@old('jabatan', $cuti->jabatan)}}" />
        @if($errors->has('jabatan'))
			<div class='error small text-danger'>{{$errors->first('jabatan')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="jenis_cuti" class="form-label">Jenis Cuti:</label>
        <input type="text" name="jenis_cuti" id="jenis_cuti" class="form-control" value="{{@old('jenis_cuti', $cuti->jenis_cuti)}}" />
        @if($errors->has('jenis_cuti'))
			<div class='error small text-danger'>{{$errors->first('jenis_cuti')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="alasan_cuti" class="form-label">Alasan Cuti:</label>
        <input type="text" name="alasan_cuti" id="alasan_cuti" class="form-control" value="{{@old('alasan_cuti', $cuti->alasan_cuti)}}" />
        @if($errors->has('alasan_cuti'))
			<div class='error small text-danger'>{{$errors->first('alasan_cuti')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="ambil_tugas" class="form-label">Ambil Tugas:</label>
        <input type="text" name="ambil_tugas" id="ambil_tugas" class="form-control" value="{{@old('ambil_tugas', $cuti->ambil_tugas)}}" />
        @if($errors->has('ambil_tugas'))
			<div class='error small text-danger'>{{$errors->first('ambil_tugas')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="filename" class="form-label">Filename:</label>
        <input type="text" name="filename" id="filename" class="form-control" value="{{@old('filename', $cuti->filename)}}" />
        @if($errors->has('filename'))
			<div class='error small text-danger'>{{$errors->first('filename')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="image_data" class="form-label">Image Data:</label>
        <input type="text" name="image_data" id="image_data" class="form-control" value="{{@old('image_data', $cuti->image_data)}}" />
        @if($errors->has('image_data'))
			<div class='error small text-danger'>{{$errors->first('image_data')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status:</label>
        <input type="text" name="status" id="status" class="form-control" value="{{@old('status', $cuti->status)}}" />
        @if($errors->has('status'))
			<div class='error small text-danger'>{{$errors->first('status')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="kode" class="form-label">Kode:</label>
        <input type="text" name="kode" id="kode" class="form-control" value="{{@old('kode', $cuti->kode)}}" />
        @if($errors->has('kode'))
			<div class='error small text-danger'>{{$errors->first('kode')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="date_acc" class="form-label">Date Acc:</label>
        <input type="text" name="date_acc" id="date_acc" class="form-control" value="{{@old('date_acc', $cuti->date_acc)}}" />
        @if($errors->has('date_acc'))
			<div class='error small text-danger'>{{$errors->first('date_acc')}}</div>
		@endif
    </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('cutis.index', []) }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">@lang('Update Cuti')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
