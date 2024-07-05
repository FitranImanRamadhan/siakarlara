@extends('tmp')

@section('content')
    @if (session('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">
        <h3 class="text-dark mb-4">Detail Absensi</h3>

        {{-- Form Filter Toko dan Tanggal --}}
        <form action="{{ route('detailabsen') }}" method="GET" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label for="toko" class="col-form-label text-md-right">Toko<span
                            class="text-danger">*</span></label>
                    <select id="toko" class="form-control @error('toko') is-invalid @enderror" name="toko" required>
                        <option value="" disabled selected>Pilih Toko</option>
                        @foreach ($tokos as $item)
                            <option value="{{ $item->toko }}" {{ request('toko') == $item->toko ? 'selected' : '' }}>
                                {{ $item->toko }}</option>
                        @endforeach
                    </select>
                    @error('toko')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="start_date" class="col-form-label text-md-right">Dari Tanggal</label>
                    <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror"
                        name="start_date" value="{{ request('start_date') ?? '' }}" required autocomplete="start_date">
                    @error('start_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="end_date" class="col-form-label text-md-right">Sampai Tanggal</label>
                    <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror"
                        name="end_date" value="{{ request('end_date') ?? '' }}" required autocomplete="end_date">
                    @error('end_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <button type="submit" name="export" value="excel" class="btn btn-success">Export</button>
                </div>
            </div>
        </form>

        {{-- Daftar Absensi --}}
        <div id="daftarAbsensi">
            @foreach ($groupedAbsensis as $pegawaiId => $absensiPegawai)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Pegawai ID: {{ $pegawaiId }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-dark mb-3">Nama: {{ $absensiPegawai->first()['nama'] }}</p>
                        <p class="card-text text-dark mb-3">Toko: {{ $absensiPegawai->first()['toko'] }}</p>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Jam Masuk</th>
                                        <th scope="col">Jam Keluar</th>
                                        <th scope="col">Shift</th>
                                        <th scope="col">Jam Kerja</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $start_date = request('start_date') ?? date('Y-m-01');
                                        $end_date = request('end_date') ?? date('Y-m-t');
                                        $tanggalRange = new DatePeriod(
                                            new DateTime($start_date),
                                            new DateInterval('P1D'),
                                            new DateTime($end_date),
                                        );
                                    @endphp

                                    @foreach ($tanggalRange as $tanggal)
                                        @php
                                            $tanggalFormatted = $tanggal->format('Y-m-d');
                                            $absensiTanggal = $absensiPegawai[$tanggalFormatted] ?? null;
                                        @endphp
                                        <tr>
                                            <td>{{ $tanggalFormatted }}</td>
                                            @if ($absensiTanggal)
                                                <td>{{ $absensiTanggal['jam_masuk'] }}</td>
                                                <td>{{ $absensiTanggal['jam_keluar'] }}</td>
                                                <td>{{ $absensiTanggal['shift'] }}</td>
                                                <td>{{ $absensiTanggal['jam_kerja'] }}</td>
                                                <td>{{ $absensiTanggal['status_shift'] }}</td>
                                                <td>{{ $absensiTanggal['keterangan'] }}</td>
                                                @else
                                                <td colspan="6" class="text-muted">{!! nl2br(e($absensiTanggal)) !!}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
