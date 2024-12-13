@extends('adminlayout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('promos.index', compact([])) }}"> Promos</a></li>
                    <li class="breadcrumb-item">@lang('Promo') #{{$promo->id}}</li>
                </ol>

                <a href="{{ route('promos.index', []) }}" class="btn btn-light"><i class="fa fa-caret-left"></i> Back</a>
            </div>

            <div class="card-body">
                <table class="table table-striped">
    <tbody>
    <tr>
        <th scope="row">ID:</th>
        <td>{{$promo->id}}</td>
    </tr>
            <tr>
            <th scope="row">Kode Promo:</th>
            <td>{{ $promo->kode_promo ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Nama:</th>
            <td>{{ $promo->nama ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Harga Awal:</th>
            <td>{{ $promo->harga_awal ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Harga Promo:</th>
            <td>{{ $promo->harga_promo ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Kategori:</th>
            <td>{{ $promo->kategori ?: "(blank)" }}</td>
        </tr>
            <tr>
            <th scope="row">Periode:</th>
            <td>{{ $promo->periode ?: "(blank)" }}</td>
        </tr>
                <tr>
            <th scope="row">Created at</th>
            <td>{{Carbon\Carbon::parse($promo->created_at)->format('d/m/Y H:i:s')}}</td>
        </tr>
        <tr>
            <th scope="row">Updated at</th>
            <td>{{Carbon\Carbon::parse($promo->updated_at)->format('d/m/Y H:i:s')}}</td>
        </tr>
        </tbody>
</table>

            </div>

            <div class="card-footer d-flex flex-column flex-md-row align-items-center justify-content-end">
                <a href="{{ route('promos.edit', compact('promo')) }}" class="btn btn-info text-nowrap me-1"><i class="fa fa-edit"></i> @lang('Edit')</a>
                <form action="{{ route('promos.destroy', compact('promo')) }}" method="POST" class="m-0 p-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger text-nowrap"><i class="fa fa-trash"></i> @lang('Delete')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
