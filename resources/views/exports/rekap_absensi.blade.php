<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Toko</th>
            <th>Jumlah Hari Kerja</th>
            <th>Jumlah Terlambat</th>
            <th>Jumlah Pulang Cepat</th>
            <th>Jumlah Full</th>
            <th>Jumlah Off</th>
            <th>Jumlah Setengah Hari</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rekap as $data)
            <tr>
                <td>{{ $data['nama'] }}</td>
                <td>{{ $data['toko'] }}</td>
                <td>{{ $data['jumlah_hari_kerja'] }}</td>
                <td>{{ $data['jumlah_terlambat'] }}</td>
                <td>{{ $data['jumlah_pulang_cepat'] }}</td>
                <td>{{ $data['jumlah_full'] }}</td>
                <td>{{ $data['jumlah_off'] }}</td>
                <td>{{ $data['jumlah_setengah_hari'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
