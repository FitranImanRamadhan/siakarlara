<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji</title>
    <style>
        @page {
            size: A4 landscape; /* Mengubah orientasi menjadi landscape */
            margin: 0; /* Menghapus margin */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 48%; /* Mengubah lebar kontainer agar 2 slip gaji per baris */
            height: auto;
            float: left;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-left: 10px;
            margin-right: 5px; /* Margin antara slip */
            margin-bottom: 20px; /* Margin di bawah slip */
            page-break-inside: avoid; /* Mencegah pemisahan slip gaji ke halaman berikutnya */
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 20px; /* Mengurangi ukuran font judul */
            margin: 5px 0;
        }

        .info-pegawai {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .info-pegawai .item {
            text-align: left;
        }

        .info-pegawai .label {
            font-weight: bold;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        .table th {
            text-align: left;
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
            text-align: right;
        }

        .total-pembayaran {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    function formatRupiah($value)
    {
        if (is_numeric($value)) {
            return 'Rp ' . number_format($value, 0, ',', '.');
        } else {
            return $value;
        }
    }
    ?>
    
    <?php $counter = 0; ?>
    <?php foreach ($penggajians as $penggajian): ?>
    <?php if ($counter % 2 == 0 && $counter != 0): ?>
    <div style="clear:both;"></div>
    <?php endif; ?>
    <div class="container">
        <div class="header">
            <h1>TB UTAMA</h1>
            <h2>SLIP GAJI</h2>
        </div>

        <div class="info-pegawai">
            <div class="item">
                <span class="label">Periode Gaji Untuk Tahun:</span>
                <span><?= $penggajian->tahun ?></span>
            </div>

            <div class="item">
                <span class="label">Periode Absen:</span>
                <span>{{ date('F', mktime(0, 0, 0, $penggajian->bulan, 1)) ?: '(blank)' }}</span>
            </div>

            <div class="item">
                <span class="label">Nama Pegawai:</span>
                <span><?= $penggajian->absensi->pegawai->nama ?? '(blank)' ?></span>
            </div>

            <div class="item">
                <span class="label">Posisi:</span>
                <span><?= $penggajian->absensi->pegawai->position->jabatan ?? '(blank)' ?></span>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Pendapatan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gaji Perhari</td>
                    <td><?= formatRupiah($penggajian->absensi->pegawai->position->gaji_perhari) ?></td>
                </tr>
                <tr>
                    <td>Uang Makan</td>
                    <td><?= formatRupiah($penggajian->absensi->pegawai->position->uang_makan) ?></td>
                </tr>
                <tr>
                    <td>Total Uang Makan dan Gaji Perhari</td>
                    <td><?= formatRupiah($penggajian->total_gaji) ?></td>
                </tr>
                <tr>
                    <td>Insentif Absen</td>
                    <td><?= formatRupiah($penggajian->insentif_absen) ?></td>
                </tr>
                <tr>
                    <td>Tunjangan Jabatan</td>
                    <td><?= formatRupiah($penggajian->absensi->pegawai->position->tunjangan_jabatan) ?></td>
                </tr>
                <tr>
                    <td>Uang Lembur</td>
                    <td><?= formatRupiah($penggajian->uang_lembur) ?></td>
                </tr>
                <tr>
                    <td class="total">Gaji Kotor</td>
                    <td class="total"><?= formatRupiah($penggajian->gaji_kotor) ?></td>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>Potongan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>BPJS Ketenagakerjaan</td>
                    <td><?= formatRupiah($penggajian->bpjs_tk) ?></td>
                </tr>
                <tr>
                    <td>BPJS Kesehatan</td>
                    <td><?= formatRupiah($penggajian->bpjs_kes) ?></td>
                </tr>
                <tr>
                    <td class="total">Gaji Bersih</td>
                    <td class="total"><?= formatRupiah($penggajian->gaji_bersih) ?></td>
                </tr>
            </tbody>
        </table>

        <div class="total-pembayaran">
            <span>Total Pembayaran Diterima: <?= formatRupiah($penggajian->gaji_diterima) ?></span>
        </div>
    </div>
    <?php $counter++; ?>
    <?php endforeach; ?>
</body>

</html>
