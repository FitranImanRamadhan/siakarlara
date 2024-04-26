@extends('tmp')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('penggajians.index', compact([])) }}"> Penggajians</a></li>
                    <li class="breadcrumb-item">@lang('Penggajian') #{{$penggajian->id}}</li>
                </ol>

                <a href="{{ route('penggajians.index', []) }}" class="btn btn-light"><i class="fa fa-caret-left"></i> Back</a>
            </div>

            <div class="card-body">
                <table class="table table-striped">
    <tbody>
    <tr>
        <th scope="row">ID:</th>
        <td>{{$penggajian->id}}</td>
    </tr>
            <tr>
            <th scope="row">Absensi:</th>
            <td><a href="{{implode('/', ['','absenses',$penggajian->absensi_id ?: 0])}}" class="text-dark">{{$penggajian?->absensi?->bulan ?: "(blank)"}}</a></td>
        </tr>
            <tr>
            <th scope="row">Tahun:</th>
            <td>{{ $penggajian->tahun ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Bulan:</th>
            <td>{{ $penggajian->bulan ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Total Gaji:</th>
            <td>{{ $penggajian->total_gaji ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Gaji Kotor:</th>
            <td>{{ $penggajian->gaji_kotor ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Bpjs Tk:</th>
            <td>{{ $penggajian->bpjs_tk ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Bpjs Kes:</th>
            <td>{{ $penggajian->bpjs_kes ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Gaji Bersih:</th>
            <td>{{ $penggajian->gaji_bersih ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Pembulatan:</th>
            <td>{{ $penggajian->pembulatan ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Gaji Diterima:</th>
            <td>{{ $penggajian->gaji_diterima ?: "(blank)" }}</td>
        </tr>
                <tr>
            <th scope="row">Created at</th>
            <td>{{Carbon\Carbon::parse($penggajian->created_at)->format('d/m/Y H:i:s')}}</td>
        </tr>
        <tr>
            <th scope="row">Updated at</th>
            <td>{{Carbon\Carbon::parse($penggajian->updated_at)->format('d/m/Y H:i:s')}}</td>
        </tr>
        </tbody>
</table>

            </div>

            <div class="card-footer d-flex flex-column flex-md-row align-items-center justify-content-end">
                <a href="{{ route('penggajians.edit', compact('penggajian')) }}" class="btn btn-info text-nowrap me-1"><i class="fa fa-edit"></i> @lang('Edit')</a>
                <form action="{{ route('penggajians.destroy', compact('penggajian')) }}" method="POST" class="m-0 p-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger text-nowrap"><i class="fa fa-trash"></i> @lang('Delete')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
