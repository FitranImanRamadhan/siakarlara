    @extends('tmp')
    @section('content')
    <style>
        th, td {
            text-align: center;
            vertical-align: middle; /* Mengatur teks ke tengah secara vertikal */
        }

        /* Class untuk membuat teks berada di tengah secara horizontal */
        .text-center {
            text-align: center;
        }

        .rupiah {
            display: flex;
            align-items: center;
        }

        .rupiah span {
            margin-right: 5px; /* Jarak antara simbol "Rp" dan angka */
        }
    </style>
    <?php

    function formatRupiah($angka)
    {
        $rupiah = "" . number_format($angka, 0, ',', '.');
        return $rupiah;
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
            <a class="btn btn-success float-end" href="{{ route('penggajians.create') }}">Add Penggajian</a>
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
            @if (isset($penggajians) && $penggajians->count() > 0 && request()->has('bulan') && request()->has('tahun'))
                <table class="table table-bordered">
                    <thead role="rowgroup">
                        <tr role="row">
                            <th role='columnheader'>Absensi</th>
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
                        @foreach ($penggajians as $penggajian)
                            <tr>
                                <td data-label="Absensi"><a
                                        href="{{ implode('/', ['', 'absenses', $penggajian->absensi_id ?: 0]) }}"
                                        class="text-dark">{{ $penggajian?->absensi?->pegawai->nama ?: '(blank)' }}</a></td>
                                <td data-label="Tahun">{{ $penggajian->tahun ?: '(blank)' }}</td>
                                <td data-label="Bulan">{{ date('F', mktime(0, 0, 0, $penggajian->bulan, 1)) ?: '(blank)' }}</td>
                                <td data-label="Total Gaji" class="text-center">
                                    <div class="rupiah">
                                        <span>Rp</span>
                                        {{ formatRupiah($penggajian->total_gaji ?: '(blank)') }}
                                    </div>
                                </td>
                                <td data-label="Insentif Absen" class="text-center">
                                    <div class="rupiah">
                                        <span>Rp</span>
                                        {{ formatRupiah($penggajian->insentif_absen ?: '(blank)') }}
                                    </div>
                                </td>
                                <td data-label="Uang Lembur" class="text-center">
                                    <div class="rupiah">
                                        <span>Rp</span>
                                        {{ formatRupiah($penggajian->uang_lembur ?: '(blank)') }}
                                    </div>
                                </td>
                                <td data-label="Gaji Kotor" class="text-center">
                                    <div class="rupiah">
                                        <span>Rp</span>
                                        {{ formatRupiah($penggajian->gaji_kotor ?: '(blank)') }}
                                    </div>
                                </td>
                                <td data-label="Bpjs Tk" class="text-center">
                                    <div class="rupiah">
                                        <span>Rp</span>
                                        {{ formatRupiah($penggajian->bpjs_tk ?: '(blank)') }}
                                    </div>
                                </td>
                                <td data-label="Bpjs Kes" class="text-center">
                                    <div class="rupiah">
                                        <span>Rp</span>
                                        {{ formatRupiah($penggajian->bpjs_kes ?: '(blank)') }}
                                    </div>
                                </td>
                                <td data-label="Gaji Bersih" class="text-center">
                                    <div class="rupiah">
                                        <span>Rp</span>
                                        {{ formatRupiah($penggajian->gaji_bersih ?: '(blank)') }}
                                    </div>
                                </td>
                                <td data-label="Gaji Diterima" class="text-center">
                                    <div class="rupiah">
                                        <span>Rp</span>
                                        {{ formatRupiah($penggajian->gaji_diterima ?: '(blank)') }}
                                    </div>
                                </td>

                                <td data-label="Actions:" class="text-nowrap">
                                    <a href="{{ route('penggajians.show', compact('penggajian')) }}" type="button"
                                        class="btn btn-primary btn-sm me-1">@lang('Show')</a>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fa fa-cog"></i></button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('penggajians.edit', compact('penggajian')) }}">@lang('Edit')</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('penggajians.destroy', compact('penggajian')) }}"
                                                    method="POST" style="display: inline;" class="m-0 p-0">
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
