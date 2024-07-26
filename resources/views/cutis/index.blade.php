@extends('adminlayout')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between">
            <ol class="breadcrumb m-0 p-0 flex-grow-1 mb-2 mb-md-0">
                <li class="breadcrumb-item"><a href="{{ route('cutis.index') }}">List Pengajuan Cuti</a></li>
            </ol>

            <form action="{{ route('cutis.index') }}" method="GET" class="m-0 p-0">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm me-2" name="search" placeholder="Search Cutis..." value="{{ request()->search }}">
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-sm" type="submit"><i class="fa fa-search"></i> @lang('Go!')</button>
                    </span>
                </div>
            </form>
        </div>
        <div class="card-body">
            <!-- Tabel Pengajuan Cuti Belum Diproses -->
            <div class="table-responsive">
                <h5>Pending Requests</h5>
                <table id="pending-table" class="table table-striped table-hover">
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
                            <th role='columnheader'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cutis as $cuti)
                        <tr>
                            <td data-label="Urut">{{ $cuti->urut ?: "(blank)" }}</td>
                            <td data-label="Nama">{{ $cuti->nama ?: "(blank)" }}</td>
                            <td data-label="Date Cuti">{{ $cuti->date_cuti ?: "(blank)" }}</td>
                            <td data-label="End Cuti">{{ $cuti->end_cuti ?: "(blank)" }}</td>
                            <td data-label="Jumlah Cuti">{{ $cuti->jumlah_cuti ?: "(blank)" }}</td>
                            <td data-label="Toko">{{ $cuti->toko ?: "(blank)" }}</td>
                            <td data-label="Jabatan">{{ $cuti->jabatan ?: "(blank)" }}</td>
                            <td data-label="Jenis Cuti">{{ $cuti->jenis_cuti ?: "(blank)" }}</td>
                            <td data-label="Alasan Cuti">{{ $cuti->alasan_cuti ?: "(blank)" }}</td>
                            <td data-label="Ambil Tugas">{{ $cuti->ambil_tugas ?: "(blank)" }}</td>
                            <td data-label="Filename">{{ $cuti->filename ?: "(blank)" }}</td>
                            <td data-label="Image Data">{{ $cuti->image_data ?: "(blank)" }}</td>
                            <td data-label="Status">
                                @if($cuti->status == 'Acc')
                                    <span class="badge bg-success">{{ $cuti->status }}</span>
                                @elseif($cuti->status == 'Tidak di Acc')
                                    <span class="badge bg-danger">{{ $cuti->status }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $cuti->status ?: '(blank)' }}</span>
                                @endif
                            </td>
                            <td data-label="Kode">{{ $cuti->kode ?: "(blank)" }}</td>
                            <td data-label="Date Acc">{{ $cuti->date_acc ?: "(blank)" }}</td>

                            <td data-label="Actions" class="text-nowrap">
                                <form action="{{ route('cutis.updateStatus', $cuti->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="status" value="Acc" class="btn btn-success btn-sm">@lang('Acc')</button>
                                    <button type="submit" name="status" value="Tidak di Acc" class="btn btn-danger btn-sm">@lang('Tidak di Acc')</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $cutis->withQueryString()->links() }}

            <!-- Tabel Pengajuan Cuti Yang Sudah Diproses -->
            <div class="table-responsive mt-4">
                <h5>Processed Requests</h5>
                <table id="processed-table" class="table table-striped table-hover">
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
                            <th role='columnheader'>Actions</th> <!-- Kolom baru untuk tombol cetak -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($processedCutis as $cuti)
                        <tr>
                            <td data-label="Urut">{{ $cuti->urut ?: "(blank)" }}</td>
                            <td data-label="Nama">{{ $cuti->nama ?: "(blank)" }}</td>
                            <td data-label="Date Cuti">{{ $cuti->date_cuti ?: "(blank)" }}</td>
                            <td data-label="End Cuti">{{ $cuti->end_cuti ?: "(blank)" }}</td>
                            <td data-label="Jumlah Cuti">{{ $cuti->jumlah_cuti ?: "(blank)" }}</td>
                            <td data-label="Toko">{{ $cuti->toko ?: "(blank)" }}</td>
                            <td data-label="Jabatan">{{ $cuti->jabatan ?: "(blank)" }}</td>
                            <td data-label="Jenis Cuti">{{ $cuti->jenis_cuti ?: "(blank)" }}</td>
                            <td data-label="Alasan Cuti">{{ $cuti->alasan_cuti ?: "(blank)" }}</td>
                            <td data-label="Ambil Tugas">{{ $cuti->ambil_tugas ?: "(blank)" }}</td>
                            <td data-label="Filename">{{ $cuti->filename ?: "(blank)" }}</td>
                            <td data-label="Image Data">{{ $cuti->image_data ?: "(blank)" }}</td>
                            <td data-label="Status">
                                @if($cuti->status == 'Acc')
                                    <span class="badge bg-success">{{ $cuti->status }}</span>
                                @elseif($cuti->status == 'Tidak di Acc')
                                    <span class="badge bg-danger">{{ $cuti->status }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ $cuti->status ?: '(blank)' }}</span>
                                @endif
                            </td>
                            <td data-label="Kode">{{ $cuti->kode ?: "(blank)" }}</td>
                            <td data-label="Date Acc">{{ $cuti->date_acc ?: "(blank)" }}</td>

                            <!-- Tambahkan kolom untuk tombol cetak -->
                            <td data-label="Actions" class="text-nowrap">
                                <a href="{{ route('print.surat', $cuti->id) }}" class="btn btn-primary btn-sm">Print</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center my-2">
                <a href="{{ route('cutis.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('Create new Cuti')</a>
            </div>
        </div>
    </div>
</div>
@endsection
