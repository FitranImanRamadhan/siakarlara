@extends('adminlayout')

@section('content')
    <div class="container">
        <!-- Galeri Promo -->
        <div class="card mb-4">
            <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                <ol class="breadcrumb m-0 p-0 flex-grow-1 mb-2 mb-md-0">
                    <li class="breadcrumb-item"><a href="{{ route('galeris.index') }}">Galeri Promo</a></li>
                </ol>
                <form action="{{ route('galeris.index') }}" method="GET" class="m-0 p-0">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm me-2" name="search_portofolio"
                               placeholder="Search Galeri Promo..." value="{{ request()->search_portofolio }}">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> @lang('Go!')</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Kategori Promo</th>
                            <th>Foto</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galeriPromo as $galeri)
                            <tr>
                                <td>{{ $galeri->kategori_promo ?: '' }}</td>
                                <td>
                                    @if ($galeri->foto)
                        <img src="{{ asset($galeri->foto) }}" alt="Galeri Image" width="100" height="50">
                                    @else
                                        (blank)
                                    @endif
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route('galeris.show', $galeri->id) }}" class="btn btn-primary btn-sm me-1">@lang('Show')</a>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('galeris.edit', $galeri->id) }}">@lang('Edit')</a></li>
                                            <li>
                                                <form action="{{ route('galeris.destroy', $galeri->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">@lang('Delete')</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('galeris.create') }}" class="btn btn-primary">Tambah Galeri Promo</a>
            </div>
        </div>

        <!-- Galeri Loker -->
        <div class="card">
            <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                <ol class="breadcrumb m-0 p-0 flex-grow-1 mb-2 mb-md-0">
                    <li class="breadcrumb-item"><a href="{{ route('galeris.index') }}">Galeri Loker</a></li>
                </ol>
                <form action="{{ route('galeris.index') }}" method="GET" class="m-0 p-0">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm me-2" name="search_artikel"
                               placeholder="Search Galeri Loker..." value="{{ request()->search_artikel }}">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> @lang('Go!')</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Kode Loker</th>
                            <th>Foto</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galeriLoker as $galeri)
                            <tr>
                                <td>{{ $galeri->kode_loker ?: '' }}</td>
                                <td>
                                    @if ($galeri->foto)
                                        <img src="{{ asset($galeri->foto) }}" alt="Galeri Image" width="100" height="50">
                                    @else
                                        (blank)
                                    @endif
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route('galeris.show', $galeri->id) }}" class="btn btn-primary btn-sm me-1">@lang('Show')</a>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('galeris.edit', $galeri->id) }}">@lang('Edit')</a></li>
                                            <li>
                                                <form action="{{ route('galeris.destroy', $galeri->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item">@lang('Delete')</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('galeris.createloker')}}" class="btn btn-primary">Tambah Galeri Loker</a>
            </div>
        </div>
    </div>
@endsection
