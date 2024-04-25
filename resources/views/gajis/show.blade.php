@extends('gajis.layout')

@section('gajis.content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('gajis.index', compact([])) }}"> Gajis</a></li>
                    <li class="breadcrumb-item">@lang('Gaji') #{{$gaji->id}}</li>
                </ol>

                <a href="{{ route('gajis.index', []) }}" class="btn btn-light"><i class="fa fa-caret-left"></i> Back</a>
            </div>

            <div class="card-body">
                <table class="table table-striped">
    <tbody>
    <tr>
        <th scope="row">ID:</th>
        <td>{{$gaji->id}}</td>
    </tr>
            <tr>
            <th scope="row">Tanggal Gajian:</th>
            <td>{{ $gaji->tanggal_gajian ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Absensi:</th>
            <td><a href="{{implode('/', ['','absenses',$gaji->absensi_id ?: 0])}}" class="text-dark">{{$gaji?->absensi?->bulan ?: "(blank)"}}</a></td>
        </tr>
            <tr>
            <th scope="row">Pegawai:</th>
            <td><a href="{{route('pegawais.show', $gaji->pegawai_id ?: 0)}}" class="text-dark">{{$gaji?->pegawai?->nama ?: "(blank)"}}</a></td>
        </tr>
            <tr>
            <th scope="row">Tahun:</th>
            <td>{{ $gaji->tahun ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Bulan:</th>
            <td>{{ $gaji->bulan ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Total Gaji:</th>
            <td>{{ $gaji->total_gaji ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Gaji Kotor:</th>
            <td>{{ $gaji->gaji_kotor ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Gaji Bersih:</th>
            <td>{{ $gaji->gaji_bersih ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Pembulatan:</th>
            <td>{{ $gaji->pembulatan ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Gaji Diterima:</th>
            <td>{{ $gaji->gaji_diterima ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Remember Token:</th>
            <td>{{ $gaji->remember_token ?: "(blank)" }}</td>
        </tr>
                <tr>
            <th scope="row">Created at</th>
            <td>{{Carbon\Carbon::parse($gaji->created_at)->format('d/m/Y H:i:s')}}</td>
        </tr>
        <tr>
            <th scope="row">Updated at</th>
            <td>{{Carbon\Carbon::parse($gaji->updated_at)->format('d/m/Y H:i:s')}}</td>
        </tr>
        </tbody>
</table>

            </div>

            <div class="card-footer d-flex flex-column flex-md-row align-items-center justify-content-end">
                <a href="{{ route('gajis.edit', compact('gaji')) }}" class="btn btn-info text-nowrap me-1"><i class="fa fa-edit"></i> @lang('Edit')</a>
                <form action="{{ route('gajis.destroy', compact('gaji')) }}" method="POST" class="m-0 p-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger text-nowrap"><i class="fa fa-trash"></i> @lang('Delete')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
