@extends('adminlayout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('lokers.index', compact([])) }}"> Lokers</a></li>
                    <li class="breadcrumb-item">@lang('Create new')</li>
                </ol>
            </div>

            <div class="card-body">
                <form action="{{ route('lokers.store', []) }}" method="POST" class="m-0 p-0">
                    <div class="card-body">
                        @csrf
                        <div class="mb-3">
        <label for="kode_loker" class="form-label">Kode Loker:</label>
        <input type="text" name="kode_loker" id="kode_loker" class="form-control" value="{{@old('kode_loker')}}" />
        @if($errors->has('kode_loker'))
			<div class='error small text-danger'>{{$errors->first('kode_loker')}}</div>
		@endif
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama:</label>
        <input type="text" name="nama" id="nama" class="form-control" value="{{@old('nama')}}" />
        @if($errors->has('nama'))
			<div class='error small text-danger'>{{$errors->first('nama')}}</div>
		@endif
    </div>

                    </div>

                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('lokers.index', []) }}" class="btn btn-light">@lang('Cancel')</a>
                            <button type="submit" class="btn btn-primary">@lang('Create new Loker')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
