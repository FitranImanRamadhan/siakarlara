<!DOCTYPE html>
<html>
<head>
    <title>Surat Cuti</title>
    <style>
        /* Tambahkan style jika diperlukan */
    </style>
</head>
<body>
    <h1>Surat Cuti</h1>
    <p><strong>Nama:</strong> {{ $cuti->nama }}</p>
    <p><strong>Date Cuti:</strong> {{ $cuti->date_cuti }}</p>
    <p><strong>End Cuti:</strong> {{ $cuti->end_cuti }}</p>
    <p><strong>Jumlah Cuti:</strong> {{ $cuti->jumlah_cuti }}</p>
    <p><strong>Toko:</strong> {{ $cuti->toko }}</p>
    <p><strong>Jabatan:</strong> {{ $cuti->jabatan }}</p>
    <p><strong>Jenis Cuti:</strong> {{ $cuti->jenis_cuti }}</p>
    <p><strong>Alasan Cuti:</strong> {{ $cuti->alasan_cuti }}</p>
    <p><strong>Ambil Tugas:</strong> {{ $cuti->ambil_tugas }}</p>
    <p><strong>Filename:</strong> {{ $cuti->filename }}</p>
    <p><strong>Status:</strong> {{ $cuti->status }}</p>
    <p><strong>Kode:</strong> {{ $cuti->kode }}</p>
    <p><strong>Date Acc:</strong> {{ $cuti->date_acc }}</p>
</body>
</html>
