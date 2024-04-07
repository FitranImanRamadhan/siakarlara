@extends('tmp')

@section('content')
    <br>
    <form action="{{ route('absensis.store') }}" method="POST" id="attendanceForm">
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
                <select class="form-select" id="tahun" name="tahun">
                    <option value="">Pilih Tahun</option>
                    @for ($year = 2022; $year <= 2025; $year++)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2 align-self-end">
                <button id="generateButton" class="btn btn-primary">Generate</button>
            </div>
        </div>
        <br><br>

        <div>
            <p id="workdaysInfo"></p>
        </div>


        <div id="attendanceTable" style="display: none;">

            <p>Toleransi <span class="text-danger">15</span> menit</p>
            <!-- Table for inputting attendance data -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Hadir</th>
                            <th>Izin</th>
                            <th>Sakit</th>
                            <th>Alpha</th>
                            <th>Terlambat</th>
                            <th>Selisih Menit</th>
                            <th>Penjualan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pgw as $pegawai)
                            <tr>
                                <td>{{ $pegawai->nama }}</td>
                                <td>{{ $pegawai->position->jabatan }}</td>
                                <td><input type="hidden" name="pegawai_id[]" value="{{ $pegawai->id }}">
                                    <input class="form-control attendance" type="number" name="hadir[]" placeholder="Hadir"
                                        required>
                                </td>
                                <td><input class="form-control attendance" type="number" name="izin[]" placeholder="Izin"
                                        required></td>
                                <td><input class="form-control attendance" type="number" name="sakit[]" placeholder="Sakit"
                                        required></td>
                                <td><input class="form-control attendance" type="number" name="alpha[]" placeholder="Alpha"
                                        required></td>
                                <td><input class="form-control attendance" type="number" name="terlambat[]"
                                        placeholder="Terlambat" required></td>
                                <td><input class="form-control attendance" type="number" name="selisih[]"
                                        placeholder="Selisih" required></td>
                                <td><input class="form-control attendance" type="number" name="penjualan[]"
                                        placeholder="Alpha" required></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

    <script>
        document.getElementById('generateButton').addEventListener('click', function() {
    var selectedMonth = document.getElementById('bulan').value;
    var selectedYear = document.getElementById('tahun').value;

    if (selectedMonth && selectedYear) {
        // Menghitung jumlah hari kerja tanpa hari Minggu
        var workdays = getWorkdays(selectedYear, selectedMonth);

        // Menampilkan informasi jumlah hari kerja
        document.getElementById('workdaysInfo').innerHTML = 'Jumlah hari kerja pada bulan ' + getMonthName(selectedMonth) + ' ' + selectedYear + ': <span class="text-danger">' + workdays + '</span> hari';

        document.getElementById('attendanceTable').style.display = 'block';
    } else {
        // Menampilkan pesan kesalahan jika bulan dan tahun tidak dipilih
        showAlert('Please select both month and year.', 'danger');
    }
});

document.getElementById('attendanceForm').addEventListener('submit', function(event) {
    // Mendapatkan jumlah hari kerja
    var workdays = parseInt(document.querySelector('#workdaysInfo span').textContent);
    
    // Mendapatkan total hadir, izin, sakit, dan alpha dari setiap input
    var totalHadir = 0;
    var totalIzin = 0;
    var totalSakit = 0;
    var totalAlpha = 0;

    var attendances = document.querySelectorAll('.attendance');
    attendances.forEach(function(attendance) {
        var value = parseInt(attendance.value);
        if (attendance.name === 'hadir[]') {
            totalHadir += value;
        } else if (attendance.name === 'izin[]') {
            totalIzin += value;
        } else if (attendance.name === 'sakit[]') {
            totalSakit += value;
        } else if (attendance.name === 'alpha[]') {
            totalAlpha += value;
        }
    });

    // Menghitung total keseluruhan
    var totalAll = totalHadir + totalIzin + totalSakit + totalAlpha;

    // Periksa apakah total keseluruhan melebihi jumlah hari kerja
    if (totalAll > workdays) {
        // Hentikan pengiriman formulir
        event.preventDefault();
        // Tampilkan pesan kesalahan
        showAlert('Total hadir, izin, sakit, dan alpha tidak boleh melebihi jumlah hari kerja.', 'danger');
    }
});

// Fungsi untuk mendapatkan nama bulan berdasarkan nomor bulan
function getMonthName(monthNumber) {
    return new Date(new Date().getFullYear(), monthNumber - 1, 1).toLocaleString('default', { month: 'long' });
}

// Fungsi untuk mendapatkan jumlah hari kerja tanpa hari Minggu dalam bulan dan tahun tertentu
function getWorkdays(year, month) {
    var daysInMonth = new Date(year, month, 0).getDate(); // Mendapatkan jumlah hari dalam bulan tersebut
    var workdays = 0;

    for (var day = 1; day <= daysInMonth; day++) {
        var date = new Date(year, month - 1, day);
        var dayOfWeek = date.getDay(); // Mendapatkan hari dalam seminggu (0: Minggu, 1: Senin, ..., 6: Sabtu)
        
        // Menambahkan 1 ke jumlah hari kerja jika bukan hari Minggu (0)
        if (dayOfWeek !== 0) {
            workdays++;
        }
    }

    return workdays;
}

// Fungsi untuk menampilkan pesan kesalahan Bootstrap
function showAlert(message, type) {
    var alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-' + type;
    alertDiv.textContent = message;

    var form = document.getElementById('attendanceForm');
    form.prepend(alertDiv);

    // Menghilangkan pesan kesalahan setelah beberapa detik
    setTimeout(function() {
        alertDiv.remove();
    }, 3000);
}
    </script>
@endsection
