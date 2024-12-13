@extends('adminlayout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('galeris.index') }}">Galeris</a></li>
                    <li class="breadcrumb-item">@lang('Create new')</li>
                </ol>
            </div>

            <div class="card-body">
                <form action="{{ route('galeris.storeloker') }}" method="POST" enctype="multipart/form-data" class="m-0 p-0"
                    id="createForm">
                    <div class="card-body">
                        @csrf

                        <!-- Dropdown for Kode Loker -->
                        <div class="mb-3">
                            <label for="kode_loker" class="form-label">Kode Loker:</label>
                            <select name="kode_loker" id="kode_loker" class="form-control form-select">
                                <option value="">Select Kode Loker</option>
                                @foreach ($lokers as $loker)
                                    <option value="{{ $loker->kode_loker }}">{{ $loker->kode_loker }} - {{ $loker->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('kode_loker'))
                                <div class='error small text-danger'>{{ $errors->first('kode_loker') }}</div>
                            @endif
                        </div>

                        <!-- Input for Foto -->
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto:</label>
                            <input type="file" name="foto" id="foto" class="form-control" />
                            @if ($errors->has('foto'))
                                <div class='error small text-danger'>{{ $errors->first('foto') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <a href="{{ route('galeris.index') }}" class="btn btn-light">@lang('Cancel')</a>
                            <button type="submit" class="btn btn-primary">@lang('Create new Galeri')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
