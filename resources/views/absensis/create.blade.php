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

        <div id="attendanceTable" style="display: none;">
            <!-- Table for inputting attendance data -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Hadir</th>
                            <th>Sakit</th>
                            <th>Alpha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($np as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->position->jabatan }}</td>
                                <td><input type="hidden" name="user_id[]" value="{{ $user->id }}">
                                    <input class="form-control attendance" type="number" name="hadir[]" placeholder="Hadir" required></td>
                                <td><input class="form-control attendance" type="number" name="sakit[]" placeholder="Sakit" required></td>
                                <td><input class="form-control attendance" type="number" name="alpha[]" placeholder="Alpha" required></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <button class="btn btn-primary" type="submit"></i>Submit</button>
    </form>

    <script>
        document.getElementById('generateButton').addEventListener('click', function() {
            var selectedMonth = document.getElementById('bulan').value;
            var selectedYear = document.getElementById('tahun').value;

            // Memeriksa apakah bulan di tahun yang sama sudah diinputkan sebelumnya
            var existingMonth = document.querySelector(`#attendanceTable input[value='${selectedMonth}'][name^='bulan']`);

            if (existingMonth) {
                // Tampilkan pesan kesalahan Bootstrap jika bulan di tahun yang sama sudah diinputkan sebelumnya
                showAlert('Bulan di tahun yang sama sudah diinputkan.', 'danger');
                return;
            }

            if (selectedMonth && selectedYear) {
                document.getElementById('attendanceTable').style.display = 'block';
            } else {
                // Tampilkan pesan kesalahan Bootstrap jika bulan dan tahun tidak dipilih
                showAlert('Please select both month and year.', 'danger');
            }
        });

        // Menambahkan event listener untuk setiap input dengan class 'attendance'
document.querySelectorAll('.attendance').forEach(function(input) {
    input.addEventListener('change', function() {
        var userRow = input.closest('tr'); // Mengambil baris (row) terdekat yang berisi input ini
        var totalHadir = 0;
        var totalSakit = 0;
        var totalAlpha = 0;

        // Menghitung total hadir, sakit, dan alpha untuk pengguna yang bersangkutan
        userRow.querySelectorAll('.attendance').forEach(function(userInput) {
            if (userInput.name.includes('hadir')) {
                totalHadir += parseInt(userInput.value) || 0;
            } else if (userInput.name.includes('sakit')) {
                totalSakit += parseInt(userInput.value) || 0;
            } else if (userInput.name.includes('alpha')) {
                totalAlpha += parseInt(userInput.value) || 0;
            }
        });

        // Memeriksa apakah total hadir, sakit, dan alpha untuk pengguna yang bersangkutan tidak melebihi 26
        if (totalHadir + totalSakit + totalAlpha > 26) {
            // Tampilkan pesan kesalahan Bootstrap jika total melebihi 26
            showAlert('Total absensi (hadir, sakit, dan alpha) untuk pengguna ini tidak boleh melebihi 26.', 'danger');
            // Mengatur kembali nilai input untuk pengguna ini menjadi kosong
            userRow.querySelectorAll('.attendance').forEach(function(userInput) {
                userInput.value = '';
            });
        }
    });
});



        // Fungsi untuk menampilkan pesan kesalahan Bootstrap
        function showAlert(message, type) {
            var alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-' + type;
            alertDiv.textContent = message;

            var form = document.getElementById('attendanceForm');
            form.prepend(alertDiv);

            // Hilangkan pesan kesalahan setelah beberapa detik
            setTimeout(function() {
                alertDiv.remove();
            }, 3000);
        }
    </script>
@endsection
