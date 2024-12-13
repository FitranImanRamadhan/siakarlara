@extends('adminlayout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('galeris.index', compact([])) }}"> Galeris</a></li>
                    <li class="breadcrumb-item">@lang('Edit Galeri') #{{$galeri->id}}</li>
                </ol>
            </div>
            <div class="card-body">
                <form action="{{ route('galeris.update', compact('galeri')) }}" method="POST" class="m-0 p-0">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
        <label for="kategori_promo" class="form-label">Kategori Promo:</label>
        <input type="text" name="kategori_promo" id="kategori_promo" class="form-control" value="{{@old('kategori_promo', $galeri->kategori_promo)}}" />
        @if($errors->has('kategori_promo'))
			<div class='error small text-danger'>{{$errors->first('kategori_promo')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="kode_loker" class="form-label">Kode Loker:</label>
        <input type="text" name="kode_loker" id="kode_loker" class="form-control" value="{{@old('kode_loker', $galeri->kode_loker)}}" />
        @if($errors->has('kode_loker'))
			<div class='error small text-danger'>{{$errors->first('kode_loker')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="foto" class="form-label">Foto:</label>
        <input type="text" name="foto" id="foto" class="form-control" value="{{@old('foto', $galeri->foto)}}" />
        @if($errors->has('foto'))
			<div class='error small text-danger'>{{$errors->first('foto')}}</div>
		@endif
    </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('galeris.index', []) }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">@lang('Update Galeri')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
