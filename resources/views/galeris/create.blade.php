@extends('adminlayout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('galeris.index', []) }}"> Galeris</a></li>
                    <li class="breadcrumb-item">@lang('Create new')</li>
                </ol>
            </div>

            <div class="card-body">
                <form action="{{ route('galeris.store', []) }}" method="POST" class="m-0 p-0" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="mb-3">
                            <label for="kategori_promo" class="form-label">Kategori Promo:</label>
                            <select name="kategori_promo" id="kategori_promo" class="form-control form-select">
                                <option value="">Select Kategori Promo</option>
                                @foreach ($promos as $promo)
                                    <option value="{{ $promo->kategori }}">{{ $promo->kategori }} - {{ $promo->nama }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('kategori_promo'))
                                <div class='error small text-danger'>{{ $errors->first('kategori_promo') }}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto:</label>
                            <input type="file" name="foto" id="foto" class="form-control" />
                            @error('foto')
                                <div class='error small text-danger'>{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('galeris.index', []) }}" class="btn btn-light">@lang('Cancel')</a>
                            <button type="submit" class="btn btn-primary">@lang('Create new Galeri')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
