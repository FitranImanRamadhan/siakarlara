@extends('tmp')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('gajis.index', compact([])) }}"> Gajis</a></li>
                    <li class="breadcrumb-item">@lang('Create new')</li>
                </ol>
            </div>
            <div class="card-body">
                <form action="{{ route('gajis.create') }}" method="GET" id="attendanceForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="bulan" style="font-weight: bold;">Bulan:</label>
                            <select class="form-select" id="bulan" name="bulan">
                                <option value="">Pilih Bulan</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="tahun" style="font-weight: bold;">Tahun:</label>
                            <input class="form-control" id="tahun" name="tahun" value="{{ date('Y') }}">
                        </div>
                        <div class="col-md-2 align-self-end">
                            <button class="btn btn-primary" type="submit">Generate</button>
                        </div>
                    </div>
                </form>

                @if ($absensis->isNotEmpty())
                    <div class="card-body">
                        <form action="{{ route('gajis.store') }}" method="POST" id="bulkGajiForm">
                            @csrf
                            <input type="hidden" name="tahun" value="{{ $tahun }}">
                            <input type="hidden" name="bulan" value="{{ $bulan }}">
                            <div class="table-responsive">
                                <table class="table" style="width: 300%;">
                                    <thead>
                                        <tr>
                                            <th hidden>Kode</th>
                                            <th>Nama Pegawai</th>
                                            <th>Jabatan</th>
                                            <th>Hadir</th>
                                            <th>Jam Lembur</th>
                                            <th>Selisih Menit(Q)</th>
                                            <th>Gaji Perhari</th>
                                            <th>Uang Makan</th>
                                            <th>Total Gaji</th>
                                            <th>Uang Lembur</th>
                                            <th>Insentif Absen</th>
                                            <th>Tunjangan Jabatan</th>
                                            <th>Gaji Kotor</th>
                                            <th>Bpjs Tk</th>
                                            <th>Bpjs Kes</th>
                                            <th>Gaji Bersih</th>
                                            <th>Gaji Diterima</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensis as $key => $absensi)
                                            <tr>
                                                <td hidden>
                                                    <input type="hidden" name="kode[]" value="{{ $absensi->pegawai_id }}">
                                                    {{ $absensi->pegawai_id }}
                                                </td>
                                                <td>
                                                    @php
                                                        // Ambil nama pegawai berdasarkan pegawai_id
                                                        $pegawai = App\Models\Pegawai::find($absensi->pegawai_id);
                                                    @endphp
                                                    {{ $pegawai->nama }}
                                                </td>
                                                <td>
                                                    @php
                                                        // Ambil nama pegawai berdasarkan pegawai_id
                                                        $pegawai = App\Models\Pegawai::find($absensi->pegawai_id);
                                                    @endphp
                                                    {{ $pegawai->position->jabatan }}
                                                </td>
                                                <td>
                                                    @php
                                                        // Ambil data absensi berdasarkan pegawai_id
                                                        $dataAbsensi = App\Models\Absensi::where(
                                                            'pegawai_id',
                                                            $absensi->pegawai_id,
                                                        )->first();
                                                    @endphp
                                                    {{ $dataAbsensi ? $dataAbsensi->hadir : '-' }}
                                                </td>
                                                <td>
                                                    @php
                                                        // Ambil data absensi berdasarkan pegawai_id
                                                        $dataAbsensi = App\Models\Absensi::where(
                                                            'pegawai_id',
                                                            $absensi->pegawai_id,
                                                        )->first();
                                                    @endphp
                                                    {{ $dataAbsensi ? $dataAbsensi->lembur : '-' }}
                                                </td>
                                                <td>
                                                    @php
                                                        // Ambil data absensi berdasarkan pegawai_id
                                                        $dataAbsensi = App\Models\Absensi::where(
                                                            'pegawai_id',
                                                            $absensi->pegawai_id,
                                                        )->first();
                                                    @endphp
                                                    {{ $dataAbsensi ? $dataAbsensi->selisih : '-' }}
                                                </td>
                                                <td>
                                                    @php
                                                        // Ambil nama pegawai berdasarkan pegawai_id
                                                        $pegawai = App\Models\Pegawai::find($absensi->pegawai_id);
                                                    @endphp
                                                    <input class="form-control" type="number" name="gaji_perhari"
                                                        value="{{ $pegawai->position->gaji_perhari }}">
                                                </td>
                                                <td>
                                                    @php
                                                        // Ambil nama pegawai berdasarkan pegawai_id
                                                        $pegawai = App\Models\Pegawai::find($absensi->pegawai_id);
                                                    @endphp
                                                    <input class="form-control" type="number" name="gaji_perhari"
                                                        value="{{ $pegawai->position->uang_makan }}">
                                                </td>
                                                <td><input type="number" name="total_gaji[{{ $key }}]"
                                                        class="form-control"
                                                        value="{{ $absensi->hadir * $absensi->pegawai->position->gaji_perhari + $absensi->hadir * $absensi->pegawai->position->uang_makan }}"
                                                        placeholder="Total Gaji" required readonly></td>
                                                <td><input type="number" name="uang_lembur[{{ $key }}]"
                                                        class="form-control"
                                                        value="{{ $absensi->lembur * (($absensi->pegawai->position->gaji_perhari * 25) / 173) }}"
                                                        placeholder="Uang_lembur" required readonly></td>
                                                <td><input type="number" name="insentif_absen[{{ $key }}]"
                                                        class="form-control"
                                                        value="{{ $absensi->hadir * $absensi->selisih * 20 * 1.15 }}"
                                                        placeholder="Insentif Absen" required readonly></td>
                                                <td>
                                                    @php
                                                        // Ambil nama pegawai berdasarkan pegawai_id
                                                        $pegawai = App\Models\Pegawai::find($absensi->pegawai_id);
                                                    @endphp
                                                    <input class="form-control" type="number" name="tunjangan_jabatan"
                                                        value="{{ $pegawai->position->tunjangan_jabatan }}" required
                                                        readonly>
                                                </td>
                                                <td><input type="number" name="gaji_kotor[{{ $key }}]"
                                                        class="form-control"
                                                        value="{{ $absensi->hadir * $absensi->selisih * 20 * 1.15 + ($absensi->hadir * $absensi->pegawai->position->gaji_perhari + $absensi->hadir * $absensi->pegawai->position->uang_makan) + $absensi->pegawai->position->tunjangan_jabatan + $absensi->lembur * (($absensi->pegawai->position->gaji_perhari * 25) / 173) }}"
                                                        placeholder="Gaji Kotor" required readonly></td>
                                                <td><input type="number" name="bpjs_tk[{{ $key }}]"
                                                        class="form-control" value="{{ 2175000 * 0.03 }}" required
                                                        readonly></td>
                                                <td><input type="number" name="bpjs_kes[{{ $key }}]"
                                                        class="form-control" value="{{ 2175000 * 0.01 }}" required
                                                        readonly></td>
                                                <td><input type="number" name="gaji_bersih[{{ $key }}]"
                                                        class="form-control"
                                                        value="{{ $absensi->hadir * $absensi->selisih * 20 * 1.15 + ($absensi->hadir * $absensi->pegawai->position->gaji_perhari + $absensi->hadir * $absensi->pegawai->position->uang_makan) + $absensi->pegawai->position->tunjangan_jabatan + 53714 - (2175000 * 0.03 + 2175000 * 0.01) }}"
                                                        required readonly></td>
                                                <td><input type="number" name="gaji_diterima[{{ $key }}]"
                                                        class="form-control"
                                                        value="{{ round($absensi->hadir * $absensi->selisih * 20 * 1.15) + ($absensi->hadir * $absensi->pegawai->position->gaji_perhari + $absensi->hadir * $absensi->pegawai->position->uang_makan) + $absensi->pegawai->position->tunjangan_jabatan + 53714 - (2175000 * 0.03 + 2175000 * 0.01) }}"
                                                        required readonly></td>
                                            </tr>
                                        @endforeach
                                        <!-- Anda bisa menambahkan baris-baris tambahan dengan tombol "Tambah Baris" -->
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <!-- Tombol "Tambah Baris" bisa diletakkan di sini -->
                        </form>
                    </div>
            </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Loop through all input elements with class "dynamic-width"
            document.querySelectorAll('.dynamic-width').forEach(function(input) {
                // Set initial width based on input value length
                input.style.width = input.value.length + "ch";

                // Update width when input value changes
                input.addEventListener('input', function() {
                    this.style.width = this.value.length + "ch";
                });
            });
        });

    </script>

@endsection
