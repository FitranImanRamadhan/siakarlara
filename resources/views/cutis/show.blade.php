@extends('adminlayout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('cutis.index', compact([])) }}"> Cutis</a></li>
                    <li class="breadcrumb-item">@lang('Cuti') #{{$cuti->id}}</li>
                </ol>

                <a href="{{ route('cutis.index', []) }}" class="btn btn-light"><i class="fa fa-caret-left"></i> Back</a>
            </div>

            <div class="card-body">
                <table class="table table-striped">
    <tbody>
    <tr>
        <th scope="row">ID:</th>
        <td>{{$cuti->id}}</td>
    </tr>
            <tr>
            <th scope="row">Urut:</th>
            <td>{{ $cuti->urut ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Nama:</th>
            <td>{{ $cuti->nama ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Date Cuti:</th>
            <td>{{ $cuti->date_cuti ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">End Cuti:</th>
            <td>{{ $cuti->end_cuti ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Jumlah Cuti:</th>
            <td>{{ $cuti->jumlah_cuti ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Toko:</th>
            <td>{{ $cuti->toko ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Jabatan:</th>
            <td>{{ $cuti->jabatan ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Jenis Cuti:</th>
            <td>{{ $cuti->jenis_cuti ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Alasan Cuti:</th>
            <td>{{ $cuti->alasan_cuti ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Ambil Tugas:</th>
            <td>{{ $cuti->ambil_tugas ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Filename:</th>
            <td>{{ $cuti->filename ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Image Data:</th>
            <td>{{ $cuti->image_data ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Status:</th>
            <td>{{ $cuti->status ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Kode:</th>
            <td>{{ $cuti->kode ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Date Acc:</th>
            <td>{{ $cuti->date_acc ?: "(blank)" }}</td>
        </tr>
                <tr>
            <th scope="row">Created at</th>
            <td>{{Carbon\Carbon::parse($cuti->created_at)->format('d/m/Y H:i:s')}}</td>
        </tr>
        <tr>
            <th scope="row">Updated at</th>
            <td>{{Carbon\Carbon::parse($cuti->updated_at)->format('d/m/Y H:i:s')}}</td>
        </tr>
        </tbody>
</table>

            </div>

            <div class="card-footer d-flex flex-column flex-md-row align-items-center justify-content-end">
                <a href="{{ route('cutis.edit', compact('cuti')) }}" class="btn btn-info text-nowrap me-1"><i class="fa fa-edit"></i> @lang('Edit')</a>
                <form action="{{ route('cutis.destroy', compact('cuti')) }}" method="POST" class="m-0 p-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger text-nowrap"><i class="fa fa-trash"></i> @lang('Delete')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
