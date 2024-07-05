@extends('tmp')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ implode('/', ['', 'absensis']) }}"> Absensis</a></li>
                    <li class="breadcrumb-item">@lang('Absensi') #{{ $absensi->id }}</li>
                </ol>

                <a href="{{ route('absensis.index', []) }}" class="btn btn-light"><i class="fa fa-caret-left"></i> Back</a>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row">ID:</th>
                            <td>{{ $absensi->id }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nama:</th>
                            <td>{{ $absensi->pegawai_nama ?: '(blank)' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Urut:</th>
                            <td>{{ $absensi->urut ?: '(blank)' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Tanggal:</th>
                            <td>{{ $absensi->tanggal ?: '(blank)' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Jam:</th>
                            <td>{{ $absensi->jam ?: '(blank)' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Kode1:</th>
                            <td>{{ $absensi->kode1 ?: '(blank)' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Kode2:</th>
                            <td>{{ $absensi->kode2 ?: '(blank)' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Kode3:</th>
                            <td>{{ $absensi->kode3 ?: '(blank)' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Created at</th>
                            <td>{{ Carbon\Carbon::parse($absensi->created_at)->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Updated at</th>
                            <td>{{ Carbon\Carbon::parse($absensi->updated_at)->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex flex-column flex-md-row align-items-center justify-content-end">
                <a href="{{ route('absensis.edit', compact('absensi')) }}" class="btn btn-info text-nowrap me-1"><i
                        class="fa fa-edit"></i> @lang('Edit')</a>
                <form action="{{ route('absensis.destroy', compact('absensi')) }}" method="POST" class="m-0 p-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger text-nowrap"><i class="fa fa-trash"></i>
                        @lang('Delete')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
