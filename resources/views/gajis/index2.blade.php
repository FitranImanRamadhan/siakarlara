@extends('tmp')
@section('content')
    <title>Gaji Saya</title>

    <?php 
    function formatAngka($angka)
    {
        return 'Rp. ' . number_format($angka, 0, ',', '.');
    } 
    ?>
</head>
<div class="row">
    <div class="card">
        <div class="card-header">
            Gaji Saya
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="" class="table">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Pegawai</td>
                            <td>Tahun</td>
                            <td>Bulan</td>
                            <td>Total Gaji</td>
                            <td>Insentif Absen</td>
                            <td>Uang Lembur</td>
                            <td>Gaji Kotor</td>
                            <td>BPJS TK</td>
                            <td>BPJS KES</td>
                            <td>Gaji Bersih</td>
                            <td>Gaji Diterima</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @foreach ($gajis as $gaji)
                            <tr>
                                <td style="width: 5%">{{ $no++ }}</td>
                                <td style="width: 10%">{{ $gaji->nama }}</td>
                                <td style="width: 5%">{{ $gaji->tahun }}</td>
                                <td style="width: 10%">{{ date('F', mktime(0, 0, 0, $gaji->bulan, 1)) }}</td>
                                <td>{{ formatAngka($gaji->total_gaji) }}</td>
                                <td>{{ formatAngka($gaji->insentif_absen) }}</td>
                                <td>{{ formatAngka($gaji->uang_lembur) }}</td>
                                <td>{{ formatAngka($gaji->gaji_kotor) }}</td>
                                <td>{{ formatAngka($gaji->bpjs_tk) }}</td>
                                <td>{{ formatAngka($gaji->bpjs_kes) }}</td>
                                <td>{{ formatAngka($gaji->gaji_bersih) }}</td>
                                <td>{{ formatAngka($gaji->gaji_diterima) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
