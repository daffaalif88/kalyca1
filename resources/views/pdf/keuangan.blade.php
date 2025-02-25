<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
        }
        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .pemasukan {
            color: green;
            font-weight: bold;
        }
        .pengeluaran {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="title">Laporan Keuangan</div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nominal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemasukan as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                    <td class="pemasukan">
                        Rp @php echo number_format($item->nominal, 0, ',', '.'); @endphp
                    </td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
            @foreach ($pengeluaran as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                    <td class="pengeluaran">
                        Rp -@php echo number_format($item->nominal, 0, ',', '.'); @endphp
                    </td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
