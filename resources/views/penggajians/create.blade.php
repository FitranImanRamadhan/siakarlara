@extends('tmp')

@section('content')
    <br>
    <form action="{{ route('penggajians.create') }}" method="GET" id="attendanceForm">
        @csrf
        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <select class="form-select" id="tahun" name="tahun">
                <option selected disabled>Select Tahun</option>
                @for ($i = date('Y'); $i >= 2010; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="bulan" class="form-label">Bulan</label>
            <select class="form-select" id="bulan" name="bulan">
                <option selected disabled>Select Bulan</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                @endfor
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
    <br><br>

    @if($absensis->isNotEmpty())
        <form action="{{ route('penggajians.store') }}" method="POST" id="attendanceForm">
            @csrf
            <input  name="tahun" value="{{ $tahun }}">
            <input  name="bulan" value="{{ $bulan }}">
            <div id="attendanceTable">
                <p>Toleransi <span class="text-danger">15</span> menit</p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Gaji Harian</th>
                                <th>Tunjangan</th>
                                <th>Uang Makan</th>
                                <th>Hadir</th>
                                <th>Total Gaji</th>
                                <th>Gaji Kotor</th>
                                <th>BPJS Kerja</th>
                                <th>BPJS Kesehatan</th>
                                <th>Gaji Bersih</th>
                                <th>Pembulatan</th>
                                <th>Gaji Diterima</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absensis as $absensi)
                                <tr>
                                    <td>{{ $absensi->pegawai->nama }}</td>
                                    <td>{{ $absensi->pegawai->position->jabatan }}</td>
                                    <td>{{ $absensi->pegawai->position->gaji_perhari }}</td>
                                    <td>{{ $absensi->pegawai->position->tunjangan_jabatan }}</td>
                                    <td>{{ $absensi->pegawai->position->uang_makan }}</td>
                                    <td>{{ $absensi->hadir }}</td>
                                    <td>
                                        <input type="hidden" name="absensi_id[]" value="{{ $absensi->id }}">
                                        <input class="form-control" type="number" name="total_gaji[]" placeholder="Total Gaji" required>
                                    </td>
                                    <td><input class="form-control" type="number" name="gaji_kotor[]" placeholder="Gaji Kotor" required></td>
                                    <td><input class="form-control" type="number" name="bpjs_tk[]" placeholder="BPJS TK" required></td>
                                    <td><input class="form-control" type="number" name="bpjs_kes[]" placeholder="BPJS Kes" required></td>
                                    <td><input class="form-control" type="number" name="gaji_bersih[]" placeholder="Gaji Bersih" required></td>
                                    <td><input class="form-control" type="number" name="pembulatan[]" placeholder="Pembulatan" required></td>
                                    <td><input class="form-control" type="number" name="gaji_diterima[]" placeholder="Gaji Diterima" required></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    @endif
@endsection
