@extends('adminlayout')

@section('content')
    @if (session('success'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container">
        <h3 class="text-dark mb-4">Rekap Absensi</h3>

        {{-- Form Filter Toko dan Tanggal --}}
        <form id="filterForm" action="{{ route('rekapabsen') }}" method="GET" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label for="toko" class="col-form-label text-md-right">Toko<span class="text-danger">*</span></label>
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

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <button type="submit" name="export" value="excel" class="btn btn-success ml-2">Export</button>
                </div>
            </div>
        </form>

        {{-- Tampilkan tabel rekap absensi hanya jika sudah difilter --}}
        @if (isset($groupedAbsensis))
            <div id="rekapAbsensi" class="table-responsive">
                <p class="text-dark mb-3">
                    Rekap Absensi dari tanggal {{ request('start_date') }} sampai tanggal {{ request('end_date') }}
                </p>
                <p class="text-dark mb-3">
                    Toko: {{ request('toko') }}
                </p>
                <table id="example" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Pegawai ID</th>
                            <th scope="col" style="width: 100px;">Nama</th>
                            <th scope="col">Masuk Kerja</th>
                            <th scope="col">Terlambat</th>
                            <th scope="col">Pulang Cepat</th>
                            <th scope="col">Tidak Ada In/Out</th>
                            <th scope="col">Full</th>
                            <th scope="col">Off</th>
                            <th scope="col">Jam Kerja</th>
                            <th scope="col">Setengah Hari</th>
                            <th scope="col">Sakit</th>
                            <th scope="col">Cuti</th>
                            <th scope="col">Ijin</th>
                            <th scope="col">Alpha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groupedAbsensis as $pegawaiId => $rekap)
                            <tr>
                                <td>{{ $pegawaiId }}</td>
                                <td>{{ $rekap['nama'] }}</td>
                                <td>{{ $rekap['jumlah_masuk'] }}</td>
                                <td>{{ $rekap['jumlah_terlambat'] }}</td>
                                <td>{{ $rekap['jumlah_pulang_cepat'] }}</td>
                                <td>{{ $rekap['jumlah_tidak_ada_in_out'] }}</td>
                                <td>{{ $rekap['jumlah_full'] }}</td>
                                <td>{{ $rekap['jumlah_off'] }}</td>
                                <td>{{ $rekap['total_jam_kerja'] }}</td>
                                <td>{{ $rekap['jumlah_setengah_hari'] }}</td>
                                <td>{{ $rekap['jumlah_sakit'] }}</td>
                                <td>{{ $rekap['jumlah_cuti'] }}</td>
                                <td>{{ $rekap['jumlah_ijin'] }}</td>
                                <td>{{ $rekap['jumlah_alpha'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        // Fungsi untuk mengosongkan form saat halaman direfresh
        function clearForm() {
            document.getElementById("filterForm").reset();
        }

        // Panggil fungsi clearForm saat halaman dimuat
        window.onload = clearForm;
    </script>
@endsection
