@extends('adminlayout')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('pegawais.index', compact([])) }}"> Pegawais</a></li>
                    <li class="breadcrumb-item">@lang('Pegawai') #{{$pegawai->id}}</li>
                </ol>

                <a href="{{ route('pegawais.index', []) }}" class="btn btn-light"><i class="fa fa-caret-left"></i> Back</a>
            </div>

            <div class="card-body">
                <table class="table table-striped">
    <tbody>
    <tr>
        <th scope="row">ID:</th>
        <td>{{$pegawai->id}}</td>
    </tr>
            <tr>
            <th scope="row">Nama:</th>
            <td>{{ $pegawai->nama ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Toko:</th>
            <td>{{ $pegawai->toko ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Score:</th>
            <td>{{ $pegawai->score ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Jabatan:</th>
            <td>{{ $pegawai->jabatan ?: "(blank)" }}</td>
        </tr>
                <tr>
            <th scope="row">Created at</th>
            <td>{{Carbon\Carbon::parse($pegawai->created_at)->format('d/m/Y H:i:s')}}</td>
        </tr>
        <tr>
            <th scope="row">Updated at</th>
            <td>{{Carbon\Carbon::parse($pegawai->updated_at)->format('d/m/Y H:i:s')}}</td>
        </tr>
        </tbody>
</table>

            </div>

            <div class="card-footer d-flex flex-column flex-md-row align-items-center justify-content-end">
                <a href="{{ route('pegawais.edit', compact('pegawai')) }}" class="btn btn-info text-nowrap me-1"><i class="fa fa-edit"></i> @lang('Edit')</a>
                <form action="{{ route('pegawais.destroy', compact('pegawai')) }}" method="POST" class="m-0 p-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger text-nowrap"><i class="fa fa-trash"></i> @lang('Delete')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
