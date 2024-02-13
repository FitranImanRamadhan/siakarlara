@extends('tmp')
@section('content')
    <br>
    <form action="{{ route('absensis.store') }}" method="POST">
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
                                <td><input type="hidden" name="user_id[]" value="{{ $user->id }}">{{-- Hidden input for user ID --}}
                                    <input class="form-control" type="number" name="hadir[]" placeholder="Hadir" required></td>
                                <td><input class="form-control" type="number" name="sakit[]" placeholder="Sakit" required></td>
                                <td><input class="form-control" type="number" name="alpha[]" placeholder="Alpha" required></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <button class="btn btn-primary" type="submit">Simpann</button>
    </form>

    <script>
        document.getElementById('generateButton').addEventListener('click', function() {
            var selectedMonth = document.getElementById('bulan').value;
            var selectedYear = document.getElementById('tahun').value;

            if (selectedMonth && selectedYear) {
                document.getElementById('attendanceTable').style.display = 'block';
            } else {
                alert('Please select both month and year.');
            }
        });
    </script>
@endsection
