        @extends('tmp')

        @section('content')
        <style>
            th {
                text-align: center;
            }
        </style>
            <br>
            <form action="{{ route('penggajians.create') }}" method="GET" id="attendanceForm">
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
                        <input class="form-control" id="tahun" name="tahun" value="{{ date('Y') }}" readonly>
                    </div>


                    <div class="col-md-2 align-self-end">
                        <button class="btn btn-primary" type="submit">Generate</button>
                    </div>
            </form>
            <br><br>

            @if ($absensis->isNotEmpty())
                <form action="{{ route('penggajians.store') }}" method="POST" id="attendanceForm">
                    @csrf
                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                    <input type="hidden" name="bulan" value="{{ $bulan }}">
                    <br>
                    <div id="attendanceTable" class="overflow-x-auto">
                        <p>Input Gaji Untuk bulan <span class="text-danger">{{ date('F', mktime(0, 0, 0, $bulan, 1)) }}</span> Tahun
                            <span class="text-danger">{{ $tahun }}</span>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered" style="width: 200%;">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Hadir</th>
                                        <th>Lembur</th>
                                        <th>Selisih Menit (Q)</th>
                                        <th>Gaji Harian</th>
                                        <th>Uang Makan</th>
                                        <th>Total Gaji</th>
                                        <th>Insentif Absen</th>
                                        <th>Tunjangan</th>
                                        <th>Uang Lembur</th>
                                        <th>Gaji Kotor</th>
                                        <th>BPJS Kerja</th>
                                        <th>BPJS Kesehatan</th>
                                        <th>Gaji Bersih</th>
                                        <th>Gaji Diterima</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensis as $absensi)
                                        <tr>
                                            <td>{{ $absensi->pegawai->nama }}</td>
                                            <td>{{ $absensi->pegawai->position->jabatan }}</td>
                                            <td>{{ $absensi->hadir }}</td>
                                            <td>{{ $absensi->lembur }}</td>
                                            <td>{{ $absensi->selisih }}</td>
                                            <td>{{ $absensi->pegawai->position->gaji_perhari }}</td>
                                            <td>{{ $absensi->pegawai->position->uang_makan }}</td>
                                            <td>
                                                <input type="hidden" name="absensi_id[]" value="{{ $absensi->id }}">
                                                <input class="form-control" type="number" name="total_gaji[]"
                                                    value="{{ $absensi->hadir * $absensi->pegawai->position->gaji_perhari + $absensi->hadir * $absensi->pegawai->position->uang_makan }}"
                                                    placeholder="Total Gaji" required readonly>
                                            </td>
                                            <td>
                                                <input type="hidden" name="absensi_id[]" value="{{ $absensi->id }}">
                                                <input class="form-control" type="number" name="insentif_absen[]"
                                                    value="{{ $absensi->hadir * $absensi->selisih * 20 * 1.15 }}"
                                                    placeholder="Insentif Absen" required readonly>
                                            </td>
                                            <td>
                                                <input type="hidden" name="absensi_id[]" value="{{ $absensi->id }}">
                                                <input class="form-control" type="number" name="insentif_absen[]"
                                                    value="{{ $absensi->pegawai->position->tunjangan_jabatan }}"
                                                    placeholder="Insentif Absen" required readonly>
                                            </td>
                                            <td>
                                                <input type="hidden" name="absensi_id[]" value="{{ $absensi->id }}">
                                                <input class="form-control" type="number" name="uang_lembur[]"
                                                    value="{{ $absensi->lembur * (($absensi->pegawai->position->gaji_perhari*25) / 173) }}"
                                                    placeholder="Uang_lembur" required readonly>
                                            </td>
                                            <td>
                                                <input type="hidden" name="absensi_id[]" value="{{ $absensi->id }}">
                                                <input class="form-control" type="number" name="gaji_kotor[]"
                                                    value="{{ ($absensi->hadir * $absensi->selisih * 20 * 1.15) + ($absensi->hadir * $absensi->pegawai->position->gaji_perhari + $absensi->hadir * $absensi->pegawai->position->uang_makan) + $absensi->pegawai->position->tunjangan_jabatan + ($absensi->lembur * (($absensi->pegawai->position->gaji_perhari*25) / 173)) }}"
                                                    placeholder="Gaji Kotor" required readonly>
                                            </td>
                                            <td><input class="form-control bpjs-tk" type="number" name="bpjs_tk[]"
                                                    placeholder="BPJS TK" value="{{ 2175000 * 0.03 }}" required></td>
                                            <td><input class="form-control bpjs-tk" type="number" name="bpjs_kes[]"
                                                    placeholder="BPJS Kes" value="{{ 2175000 * 0.01 }}" required></td>
                                            <td>
                                                <input class="form-control" type="number" name="gaji_bersih[]"
                                                    placeholder="Gaji Bersih"
                                                    value="{{ ($absensi->hadir * $absensi->selisih * 20 * 1.15) + ($absensi->hadir * $absensi->pegawai->position->gaji_perhari + $absensi->hadir * $absensi->pegawai->position->uang_makan) + $absensi->pegawai->position->tunjangan_jabatan + 53714 - (2175000 * 0.03 + 2175000 * 0.01) }}"
                                                    required readonly>
                                            </td>
                                            <td><input class="form-control" type="number" name="gaji_diterima[]"
                                                    placeholder="Gaji Diterima" required></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            @endif

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var gajiBersihInputs = document.getElementsByName("gaji_bersih[]");
                    var gajiDiterimaInputs = document.getElementsByName("gaji_diterima[]");
            
                    for (var i = 0; i < gajiBersihInputs.length; i++) {
                        var gajiBersih = parseFloat(gajiBersihInputs[i].value);
                        var gajiDiterima = Math.round(gajiBersih);
                        gajiDiterimaInputs[i].value = gajiDiterima;
                    }
                });
            </script>
        @endsection
