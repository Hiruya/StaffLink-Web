<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h2>Laporan Absensi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
                <th>Lokasi Masuk</th>
                <th>Lokasi Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->waktu_masuk }}</td>
                    <td>{{ $item->waktu_keluar ?? '-' }}</td>
                    <td>{{ $item->lokasi_masuk }}</td>
                    <td>{{ $item->lokasi_keluar ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
