<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Rapat</title>
    <style>
        body {
            font-family: sans-serif;
            color: #0f172a;
            font-size: 12px;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 4px;
        }

        h2 {
            font-size: 14px;
            margin-top: 24px;
            margin-bottom: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th,
        td {
            border: 1px solid #cbd5f5;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background: #f8fafc;
            font-size: 11px;
            text-transform: uppercase;
        }

        .meta {
            margin-top: 12px;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <h1>Laporan Kehadiran Rapat</h1>
    <div class="meta">
        <div><strong>Judul:</strong> {{ $meeting->title }}</div>
        <div><strong>Waktu:</strong> {{ $meeting->time->format('d M Y H:i') }}</div>
        <div><strong>Lokasi:</strong> {{ $meeting->location }}</div>
        <div><strong>Deskripsi:</strong> {{ $meeting->description ?? '-' }}</div>
    </div>

    <h2>Daftar Kehadiran</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 35%">Nama</th>
                <th style="width: 20%">NIM</th>
                <th style="width: 25%">Prodi</th>
                <th style="width: 20%">Tahun Angkatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($attendees as $attendee)
                <tr>
                    <td>{{ $attendee->name }}</td>
                    <td>{{ $attendee->nim }}</td>
                    <td>{{ $attendee->prodi }}</td>
                    <td>{{ $attendee->tahun_angkatan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data kehadiran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>

