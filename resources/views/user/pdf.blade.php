<!DOCTYPE html>
<html>
<head>
    <title>Export Presensi</title>
</head>
<body>
    <h1>Data Presensi</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID Siswa</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presensi as $data)
            <tr>
                <td>{{ $data->id_siswa }}</td>
                <td>{{ $data->tanggal }}</td>
                <td>{{ $data->jam_masuk }}</td>
                <td>{{ $data->jam_keluar }}</td>
                <td>{{ $data->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
