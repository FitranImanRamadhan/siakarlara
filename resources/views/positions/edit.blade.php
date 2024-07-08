@extends('adminlayout')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('positions.index', compact([])) }}"> Positions</a></li>
                    <li class="breadcrumb-item">@lang('Edit Position') #{{$position->id}}</li>
                </ol>
            </div>
            <div class="card-body">
                <form action="{{ route('positions.update', compact('position')) }}" method="POST" class="m-0 p-0">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
        <label for="jabatan" class="form-label">Jabatan:</label>
        <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{@old('jabatan', $position->jabatan)}}" required/>
        @if($errors->has('jabatan'))
			<div class='error small text-danger'>{{$errors->first('jabatan')}}</div>
		@endif
    </div>

                    </div>
                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('positions.index', []) }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary">@lang('Update Position')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
