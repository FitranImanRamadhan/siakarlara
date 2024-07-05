<table>
    <thead>
        <tr>
            <th>Pegawai ID</th>
            <th>Nama</th>
            <th>Toko</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>Shift</th>
            <th>Jam Kerja</th>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($groupedAbsensis as $pegawaiId => $absensiPegawai)
            @foreach ($absensiPegawai as $absensi)
                <tr>
                    <td>{{ $pegawaiId }}</td>
                    <td>{{ $absensi['nama'] }}</td>
                    <td>{{ $absensi['toko'] }}</td>
                    <td>{{ $absensi['tanggal'] }}</td>
                    <td>{{ $absensi['jam_masuk'] }}</td>
                    <td>{{ $absensi['jam_keluar'] }}</td>
                    <td>{{ $absensi['shift'] }}</td>
                    <td>{{ $absensi['jam_kerja'] }}</td>
                    <td>{{ $absensi['status_shift'] }}</td>
                    <td>{{ $absensi['keterangan'] }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
