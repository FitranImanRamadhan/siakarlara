@extends('tmp')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                <ol class="breadcrumb m-0 p-0 flex-grow-1 mb-2 mb-md-0">
                    <li class="breadcrumb-item"><a href="{{ route('gajis.index', compact([])) }}"> Gajis</a></li>
                </ol>

                <form action="{{ route('gajis.index', []) }}" method="GET" class="m-0 p-0">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm me-2" name="search"
                            placeholder="Search Gajis..." value="{{ request()->search }}">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i>
                                @lang('Go!')</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive table-hover">
                    <thead role="rowgroup">
                        <tr role="row">
                            <th role='columnheader'>Tanggal Gajian</th>
                            <th role='columnheader'>Nama</th>
                            <th role='columnheader'>Jabatan</th>
                            <th role='columnheader'>BPJS</th>
                            <th role='columnheader'>BPJS Kesehatan</th>
                            <th role='columnheader'>Tahun</th>
                            <th role='columnheader'>Bulan</th>
                            <th role='columnheader'>Total Gaji</th>
                            <th role='columnheader'>Gaji Kotor</th>
                            <th role='columnheader'>Gaji Bersih</th>
                            <th role='columnheader'>Pembulatan</th>
                            <th role='columnheader'>Gaji Diterima</th>
                            <th role='columnheader'>Remember Token</th>
                            <th scope="col" data-label="Actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gajis as $gaji)
                            <tr>
                                <td data-label="Tanggal Gajian">{{ $gaji->tanggal_gajian ?: '(blank)' }}</td>
                                <td data-label="Tahun">{{ $gaji->absensi->pegawai->nama ?: '(blank)' }}</td>
                                <td data-label="Tahun">{{ $gaji->absensi->pegawai->position->jabatan ?: '(blank)' }}</td>
                                <td data-label="Tahun">{{ $gaji->potongan->bpjs_tk ?: '(blank)' }}</td>
                                <td data-label="Tahun">{{ $gaji->potongan->bpjs_kes ?: '(blank)' }}</td>
                                <td data-label="Tahun">{{ $gaji->tahun ?: '(blank)' }}</td>
                                <td data-label="Bulan">{{ $gaji->bulan ?: '(blank)' }}</td>
                                <td data-label="Total Gaji">{{ $gaji->total_gaji ?: '(blank)' }}</td>
                                <td data-label="Gaji Kotor">{{ $gaji->gaji_kotor ?: '(blank)' }}</td>
                                <td data-label="Gaji Bersih">{{ $gaji->gaji_bersih ?: '(blank)' }}</td>
                                <td data-label="Pembulatan">{{ $gaji->pembulatan ?: '(blank)' }}</td>
                                <td data-label="Gaji Diterima">{{ $gaji->gaji_diterima ?: '(blank)' }}</td>
                                <td data-label="Remember Token">{{ $gaji->remember_token ?: '(blank)' }}</td>

                                <td data-label="Actions:" class="text-nowrap">
                                    <a href="{{ route('gajis.show', compact('gaji')) }}" type="button"
                                        class="btn btn-primary btn-sm me-1">@lang('Show')</a>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-light dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="fa fa-cog"></i></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('gajis.edit', compact('gaji')) }}">@lang('Edit')</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('gajis.destroy', compact('gaji')) }}" method="POST"
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

                {{ $gajis->withQueryString()->links() }}
            </div>
            <div class="text-center my-2">
                <a href="{{ route('gajis.create', []) }}" class="btn btn-primary"><i class="fa fa-plus"></i>
                    @lang('Create new Gaji')</a>
            </div>
        </div>
    </div>
@endsection
