@extends('adminlayout')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('positions.index', compact([])) }}"> Positions</a></li>
                    <li class="breadcrumb-item">@lang('Create new')</li>
                </ol>
            </div>

            <div class="card-body">
                <form action="{{ route('positions.store', []) }}" method="POST" class=4"m-0 p-0">
                    <div class="card-body">
                        @csrf
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan:</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control"
                                value="{{ @old('jabatan') }}" required />
                            @if ($errors->has('jabatan'))
                                <div class='error small text-danger'>{{ $errors->first('jabatan') }}</div>
                            @endif
                        </div>

                    </div>

                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('positions.index', []) }}" class="btn btn-light">@lang('Cancel')</a>
                            <button type="submit" class="btn btn-primary">@lang('Create new Position')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
