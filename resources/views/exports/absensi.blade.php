<!DOCTYPE html>
<html>
<head>
    <title>Data Absensi</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Hadir</th>
                <th>Sakit</th>
                <th>Alpha</th>
                <!-- Tambahkan kolom lain jika diperlukan -->
            </tr>
        </thead>
        <tbody>
            @foreach($absensis as $absensi)
            <tr>
                <td>{{ $absensi->id }}</td>
                <td>{{ $absensi->user->name }}</td>
                <td>{{ $absensi->user->position->jabatan }}</td>
                <td>{{ $absensi->bulan }}</td>
                <td>{{ $absensi->tahun }}</td>
                <td>{{ $absensi->hadir }}</td>
                <td>{{ $absensi->sakit }}</td>
                <td>{{ $absensi->alpha }}</td>
                <!-- Tambahkan sel lain jika diperlukan -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
