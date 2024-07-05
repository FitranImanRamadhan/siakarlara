@extends('tmp')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ implode('/', ['','tokos']) }}"> Tokos</a></li>
                    <li class="breadcrumb-item">@lang('Edit Toko') #{{$toko->id}}</li>
                </ol>
            </div>
            <div class="card-body">
                <form action="{{ route('tokos.update', compact('toko')) }}" method="POST" class="m-0 p-0">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
        <label for="toko" class="form-label">Toko:</label>
        <input type="text" name="toko" id="toko" class="form-control" value="{{@old('toko', $toko->toko)}}" required/>
        @if($errors->has('toko'))
			<div class='error small text-danger'>{{$errors->first('toko')}}</div>
		@endif
    </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('tokos.index', []) }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">@lang('Update Toko')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
