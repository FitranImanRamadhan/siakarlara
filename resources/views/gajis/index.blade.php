@extends('tmp')
@section('content')
    <style>
        
        

        /* Class untuk membuat teks berada di tengah secara horizontal */
        .text-center {
            text-align: center;
        }

        .angka {
            display: flex;
            align-items: center;
        }

        .angka span {
            margin-right: 5px;
            /* Jarak antara simbol "Rp" dan angka */
        }

        .angka {
            display: grid;
            grid-template-columns: auto auto;
            /* Dua kolom, pertama dengan lebar otomatis, kedua untuk simbol "Rp" */
            align-items: center;
            /* Mengatur vertikal alignment ke tengah */
            justify-content: flex-start;
            /* Mengatur horizontal alignment ke mulai dari kiri */
        }

        .angka span {
            margin-right: 5px;
            /* Jarak antara simbol "Rp" dan angka */
        }
    </style>
    <?php
    
    function formatAngka($angka)
    {
        $angka = 'Rp. ' . number_format($angka, 0, ',', '.');
        return $angka;
    }
    
    ?>

    @if (session('success'))
        <div class="alert alert-primary alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <br>
    <div class="mb-2">
        <a class="btn btn-success float-end" href="{{ route('gajis.create') }}">Add Penggajian</a>
    </div>
    <br><br>
    <form id="filterForm" method="GET" action="{{ route('getDataForTableGaji') }}">
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
    <div style="overflow-x: auto;">
        @if (isset($gajis) && $gajis->count() > 0 && request()->has('bulan') && request()->has('tahun'))
            <table id="example" class="table table-striped table-responsive table-hover" style="width: 135%;">
                <thead role="rowgroup">
                    <tr role="row">
                        <th role='columnheader'>Nama Pegawai</th>
                        <th role='columnheader'>Tahun</th>
                        <th role='columnheader'>Bulan</th>
                        <th role='columnheader'>Total Gaji</th>
                        <th role='columnheader'>Insentif Absen</th>
                        <th role='columnheader'>Uang Lembur</th>
                        <th role='columnheader'>Gaji Kotor</th>
                        <th role='columnheader'>Bpjs Tk</th>
                        <th role='columnheader'>Bpjs Kes</th>
                        <th role='columnheader'>Gaji Bersih</th>
                        <th role='columnheader'>Gaji Diterima</th>
                        <th scope="col" data-label="Actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gajis as $gaji)
                        <tr>
                            @php
                                $absensi = App\Models\Absensi::where('pegawai_id', $gaji->kode)->first();
                                $nama_pegawai = $absensi ? $absensi->pegawai->nama : '(blank)';
                            @endphp
                            <td class="text-left" data-label="Pegawai">{{ $nama_pegawai }}</td>
                            <td data-label="Tahun">{{ $gaji->tahun ?: '(blank)' }}</td>
                            <td data-label="Bulan">{{ date('F', mktime(0, 0, 0, $gaji->bulan, 1)) }}</td>
                            <td class="text-left" data-label="Total Gaji">{{ formatAngka($gaji->total_gaji ?: 0) }}</td>
                            <td class="text-left" data-label="Insentif Absen">
                                {{ formatAngka($gaji->insentif_absen ?: 0) }}</td>
                            <td class="text-left" data-label="Uang Lembur">{{ formatAngka($gaji->uang_lembur ?: 0) }}</td>
                            <td class="text-left" data-label="Gaji Kotor">{{ formatAngka($gaji->gaji_kotor ?: 0) }}</td>
                            <td class="text-left" data-label="Bpjs Tk">{{ formatAngka($gaji->bpjs_tk ?: 0) }}</td>
                            <td class="text-left" data-label="Bpjs Kes">{{ formatAngka($gaji->bpjs_kes ?: 0) }}</td>
                            <td class="text-left" data-label="Gaji Bersih">{{ formatAngka($gaji->gaji_bersih ?: 0) }}</td>
                            <td class="text-left" data-label="Gaji Diterima">{{ formatAngka($gaji->gaji_diterima ?: 0) }}
                            </td>
                            <td data-label="Actions:" class="text-nowrap">
                                <a href="{{ route('gajis.show', compact('gaji')) }}" type="button"
                                    class="btn btn-primary btn-sm me-1">@lang('Show')</a>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false"><i class="fa fa-cog"></i></button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                                href="{{ route('gajis.edit', compact('gaji')) }}">@lang('Edit')</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('gajis.destroy', compact('gaji')) }}" method="POST"
                                                style="display: inline;" class="m-0 p-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">@lang('Delete')</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

                @if (request()->has('bulan') && request()->has('tahun'))
                    <div>
                        <h6 class="text-danger">
                            Data Gaji Pada Bulan {{ date('F', mktime(0, 0, 0, request('bulan'), 1)) }} Tahun
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
    </div>
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


