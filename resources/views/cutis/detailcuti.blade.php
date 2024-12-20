@extends('adminlayout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
            <ol class="breadcrumb m-0 p-0 flex-grow-1 mb-2 mb-md-0">
                <li class="breadcrumb-item"><a href="{{ route('cutis.index', compact([])) }}">Cuti</a></li>
            </ol>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover">
                    <thead role="rowgroup">
                        <tr role="row">
                            <th role='columnheader'>Urut</th>
                            <th role='columnheader'>Nama</th>
                            <th role='columnheader'>Date Cuti</th>
                            <th role='columnheader'>End Cuti</th>
                            <th role='columnheader'>Jumlah Cuti</th>
                            <th role='columnheader'>Toko</th>
                            <th role='columnheader'>Jabatan</th>
                            <th role='columnheader'>Jenis Cuti</th>
                            <th role='columnheader'>Alasan Cuti</th>
                            <th role='columnheader'>Ambil Tugas</th>
                            <th role='columnheader'>Filename</th>
                            <th role='columnheader'>Image Data</th>
                            <th role='columnheader'>Status</th>
                            <th role='columnheader'>Kode</th>
                            <th role='columnheader'>Date Acc</th>
                            <th scope="col" data-label="Actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cutis as $cuti)
                        <tr>
                            <td data-label="Urut">{{ $cuti->urut ?: '(blank)' }}</td>
                            <td data-label="Nama">{{ $cuti->nama ?: '(blank)' }}</td>
                            <td data-label="Date Cuti">{{ $cuti->date_cuti ?: '(blank)' }}</td>
                            <td data-label="End Cuti">{{ $cuti->end_cuti ?: '(blank)' }}</td>
                            <td data-label="Jumlah Cuti">{{ $cuti->jumlah_cuti ?: '(blank)' }}</td>
                            <td data-label="Toko">{{ $cuti->toko ?: '(blank)' }}</td>
                            <td data-label="Jabatan">{{ $cuti->jabatan ?: '(blank)' }}</td>
                            <td data-label="Jenis Cuti">{{ $cuti->jenis_cuti ?: '(blank)' }}</td>
                            <td data-label="Alasan Cuti">{{ $cuti->alasan_cuti ?: '(blank)' }}</td>
                            <td data-label="Ambil Tugas">{{ $cuti->ambil_tugas ?: '(blank)' }}</td>
                            <td data-label="Filename">{{ $cuti->filename ?: '(blank)' }}</td>
                            <td data-label="Image Data">{{ $cuti->image_data ?: '(blank)' }}</td>
                            <td data-label="Status">{{ $cuti->status ?: '(blank)' }}</td>
                            <td data-label="Kode">{{ $cuti->kode ?: '(blank)' }}</td>
                            <td data-label="Date Acc">{{ $cuti->date_acc ?: '(blank)' }}</td>

                            <td data-label="Actions:" class="text-nowrap">
                                <a href="{{ route('cutis.show', compact('cuti')) }}" type="button"
                                    class="btn btn-primary btn-sm me-1">@lang('Show')</a>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fa fa-cog"></i></button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                                href="{{ route('cutis.edit', compact('cuti')) }}">@lang('Edit')</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('cutis.destroy', compact('cuti')) }}" method="POST"
                                                style="display: inline;" class="m-0 p-0">
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

            {{ $cutis->withQueryString()->links() }}
        </div>
        <div class="text-center my-2">
            <a href="{{ route('cutis.create', []) }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                @lang('Create new Cuti')</a>
        </div>
    </div>
</div>
@endsection
