<!DOCTYPE html>
<html>
<head>
    <title>Data Penggajian</title>
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
                <th>Total Gaji</th>
                <th>Insentif Absen</th>
                <th>Tunjangan Jabatan</th>
                <th>Uang Lembur</th>
                <th>Gaji Kotor</th>
                <th>BPJS TK</th>
                <th>BPJS Kes</th>
                <th>Gaji Bersih</th>
                <th>Gaji Diterima</th>
                <!-- Tambahkan kolom lain jika diperlukan -->
            </tr>
        </thead>
        <tbody>
            @foreach($penggajians as $penggajian)
            <tr>
                <td>{{ $penggajian['ID'] }}</td>
                <td>{{ $penggajian['Nama'] }}</td>
                <td>{{ $penggajian['Jabatan'] }}</td>
                <td>{{ $penggajian['Bulan'] }}</td>
                <td>{{ $penggajian['Tahun'] }}</td>
                <td>{{ $penggajian['total_gaji'] }}</td>
                <td>{{ $penggajian['insentif_absen'] }}</td>
                <td>{{ $penggajian['tunjangan_jabatan'] }}</td>
                <td>{{ $penggajian['uang_lembur'] }}</td>
                <td>{{ $penggajian['gaji_kotor'] }}</td>
                <td>{{ $penggajian['bpjs_tk'] }}</td>
                <td>{{ $penggajian['bpjs_kes'] }}</td>
                <td>{{ $penggajian['gaji_bersih'] }}</td>
                <td>{{ $penggajian['gaji_diterima'] }}</td>
                <!-- Tambahkan sel lain jika diperlukan -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
