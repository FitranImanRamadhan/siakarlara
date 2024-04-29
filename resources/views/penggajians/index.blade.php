@extends('tmp')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                <ol class="breadcrumb m-0 p-0 flex-grow-1 mb-2 mb-md-0">
                    <li class="breadcrumb-item"><a href="{{ route('penggajians.index', compact([])) }}"> Penggajians</a></li>
                </ol>

                <form action="{{ route('penggajians.index', []) }}" method="GET" class="m-0 p-0">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm me-2" name="search" placeholder="Search Penggajians..." value="{{ request()->search }}">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> @lang('Go!')</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive table-hover">
    <thead role="rowgroup">
    <tr role="row">
                    <th role='columnheader'>Absensi</th>
                    <th role='columnheader'>Tahun</th>
                    <th role='columnheader'>Bulan</th>
                    <th role='columnheader'>Total Gaji</th>
                    <th role='columnheader'>Insentif Absen</th>
                    <th role='columnheader'>Gaji Kotor</th>
                    <th role='columnheader'>Bpjs Tk</th>
                    <th role='columnheader'>Bpjs Kes</th>
                    <th role='columnheader'>Gaji Bersih</th>
                    <th role='columnheader'>Pembulatan</th>
                    <th role='columnheader'>Gaji Diterima</th>
                <th scope="col" data-label="Actions">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($penggajians as $penggajian)
        <tr>
                            <td data-label="Absensi"><a href="{{implode('/', ['','absenses',$penggajian->absensi_id ?: 0])}}" class="text-dark">{{$penggajian?->absensi?->bulan ?: "(blank)"}}</a></td>
                            <td data-label="Tahun">{{ $penggajian->tahun ?: "(blank)" }}</td>
                            <td data-label="Bulan">{{ $penggajian->bulan ?: "(blank)" }}</td>
                            <td data-label="Total Gaji">{{ $penggajian->total_gaji ?: "(blank)" }}</td>
                            <td data-label="Total Gaji">{{ $penggajian->insentif_absen ?: "(blank)" }}</td>
                            <td data-label="Gaji Kotor">{{ $penggajian->gaji_kotor ?: "(blank)" }}</td>
                            <td data-label="Bpjs Tk">{{ $penggajian->bpjs_tk ?: "(blank)" }}</td>
                            <td data-label="Bpjs Kes">{{ $penggajian->bpjs_kes ?: "(blank)" }}</td>
                            <td data-label="Gaji Bersih">{{ $penggajian->gaji_bersih ?: "(blank)" }}</td>
                            <td data-label="Pembulatan">{{ $penggajian->pembulatan ?: "(blank)" }}</td>
                            <td data-label="Gaji Diterima">{{ $penggajian->gaji_diterima ?: "(blank)" }}</td>

            <td data-label="Actions:" class="text-nowrap">
                                   <a href="{{route('penggajians.show', compact('penggajian'))}}" type="button" class="btn btn-primary btn-sm me-1">@lang('Show')</a>
<div class="btn-group btn-group-sm">
    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{route('penggajians.edit', compact('penggajian'))}}">@lang('Edit')</a></li>
        <li>
            <form action="{{route('penggajians.destroy', compact('penggajian'))}}" method="POST" style="display: inline;" class="m-0 p-0">
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

                {{ $penggajians->withQueryString()->links() }}
            </div>
            <div class="text-center my-2">
                <a href="{{ route('penggajians.create', []) }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('Create new Penggajian')</a>
            </div>
        </div>
    </div>
@endsection
