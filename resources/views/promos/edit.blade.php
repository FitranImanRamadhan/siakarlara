@extends('adminlayout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('promos.index', compact([])) }}"> Promos</a></li>
                    <li class="breadcrumb-item">@lang('Edit Promo') #{{$promo->id}}</li>
                </ol>
            </div>
            <div class="card-body">
                <form action="{{ route('promos.update', compact('promo')) }}" method="POST" class="m-0 p-0">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
        <label for="kode_promo" class="form-label">Kode Promo:</label>
        <input type="text" name="kode_promo" id="kode_promo" class="form-control" value="{{@old('kode_promo', $promo->kode_promo)}}" />
        @if($errors->has('kode_promo'))
			<div class='error small text-danger'>{{$errors->first('kode_promo')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama:</label>
        <input type="text" name="nama" id="nama" class="form-control" value="{{@old('nama', $promo->nama)}}" />
        @if($errors->has('nama'))
			<div class='error small text-danger'>{{$errors->first('nama')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="harga_awal" class="form-label">Harga Awal:</label>
        <input type="text" name="harga_awal" id="harga_awal" class="form-control" value="{{@old('harga_awal', $promo->harga_awal)}}" />
        @if($errors->has('harga_awal'))
			<div class='error small text-danger'>{{$errors->first('harga_awal')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="harga_promo" class="form-label">Harga Promo:</label>
        <input type="text" name="harga_promo" id="harga_promo" class="form-control" value="{{@old('harga_promo', $promo->harga_promo)}}" />
        @if($errors->has('harga_promo'))
			<div class='error small text-danger'>{{$errors->first('harga_promo')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="kategori" class="form-label">Kategori:</label>
        <input type="text" name="kategori" id="kategori" class="form-control" value="{{@old('kategori', $promo->kategori)}}" />
        @if($errors->has('kategori'))
			<div class='error small text-danger'>{{$errors->first('kategori')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="periode" class="form-label">Periode:</label>
        <input type="text" name="periode" id="periode" class="form-control" value="{{@old('periode', $promo->periode)}}" />
        @if($errors->has('periode'))
			<div class='error small text-danger'>{{$errors->first('periode')}}</div>
		@endif
    </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('promos.index', []) }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">@lang('Update Promo')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
