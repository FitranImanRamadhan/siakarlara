@extends('tmp')
@section('content')
    @if (session('success'))
        <div class="alert alert-primary alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <br>
    <div class="mb-2">
        <a class="btn btn-success float-end" href="{{ route('absensis.create') }}">Add Absensi</a>
    </div>
    <br><br>
    <form id="filterForm" method="GET" action="{{ route('getDataForTable') }}">
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
                <button type="submit" class="btn btn-primary">View</button>
            </div>
        </div>

    </form>

    <br>

    @if (isset($absensis) && $absensis->count() > 0 && request()->has('bulan') && request()->has('tahun'))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Hadir</th>
                    <th scope="col">Izin</th>
                    <th scope="col">Sakit</th>
                    <th scope="col">Alpha</th>
                    <th scope="col">Selisih Menit (q)</th>
                    <th scope="col">Lembur</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1 @endphp
                @foreach ($absensis as $data)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td class="text-left">{{ $data->pegawai->nama }}</td>
                        <td class="text-left">{{ $data->pegawai->position->jabatan }}</td>
                        <td>{{ $data->hadir }}</td>
                        <td>{{ $data->izin }}</td>
                        <td>{{ $data->sakit }}</td>
                        <td>{{ $data->alpha }}</td>
                        <td>{{ $data->selisih }}</td>
                        <td>{{ $data->lembur }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('absensis.edit', $data->id) }}">Edit</a>
                            <form action="{{ route('absensis.destroy', $data->id) }}" method="Post"
                                style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

            @if (request()->has('bulan') && request()->has('tahun'))
                <div>
                    <h6 class="text-danger">
                        Rekapitulasi Absensi Pada Bulan {{ date('F', mktime(0, 0, 0, request('bulan'), 1)) }} Tahun
                        {{ request('tahun') }}
                    </h6>
                </div>
            @endif
        </table>
    @elseif(!request()->has('bulan') || !request()->has('tahun'))
        <div class="alert alert-info">
            Pilih Bulan dan Tahun untuk melihat data.
        </div>
    @else
        <div class="alert alert-info">
            Tidak ada data untuk ditampilkan.
        </div>
    @endif

    <script>
        // Mendapatkan elemen-elemen yang diperlukan
        const bulanSelect = document.getElementById('bulan');
        const tahunSelect = document.getElementById('tahun');
        const lihatButton = document.querySelector('button[type="submit"]');

        // Mendengarkan perubahan pada kedua dropdown bulan dan tahun
        bulanSelect.addEventListener('change', toggleLihatButton);
        tahunSelect.addEventListener('change', toggleLihatButton);

        // Fungsi untuk mengatur status tombol "Lihat"
        function toggleLihatButton() {
            if (bulanSelect.value && tahunSelect.value) {
                lihatButton.removeAttribute('disabled');
            } else {
                lihatButton.setAttribute('disabled', 'disabled');
            }
        }

        // Memastikan status awal saat halaman dimuat
        toggleLihatButton();
    </script>
@endsection
