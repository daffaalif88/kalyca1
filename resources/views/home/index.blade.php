@extends('admin.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Grafik Pemasukan & Pengeluaran</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <canvas id="chartKeuangan"></canvas>
        </div>
    </div>

    <h3 class="text-center mb-3">Tabel Data Keuangan</h3>

    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="tablehome">
            <thead class="table-dark">
                <tr class="text-center">
                    <th class="text-center">No</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Nominal</th>
                    <th class="text-center">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($pemasukan as $item)
                    <tr>
                        <td class="text-center">{{ $no++}}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                        <td class="text-success fw-bold">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                @endforeach
                @foreach ($pengeluaran as $item)
                    <tr>
                        <td class="text-center">{{ $no++}}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                        <td class="text-danger fw-bold">Rp -{{ number_format($item->nominal, 0, ',', '.') }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Load ApexCharts -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
//     document.addEventListener("DOMContentLoaded", function () {
//     var ctx = document.getElementById('chartKeuangan').getContext('2d');

//     var dataPemasukan = @json($pemasukan->map(fn($item) => ['tanggal' => $item->tanggal, 'nominal' => $item->nominal]));
//     var dataPengeluaran = @json($pengeluaran->map(fn($item) => ['tanggal' => $item->tanggal, 'nominal' => -$item->nominal]));

//     // Gabungkan data pemasukan & pengeluaran
//     var transaksi = [...dataPemasukan, ...dataPengeluaran];

//     // Urutkan berdasarkan tanggal
//     transaksi.sort((a, b) => new Date(a.tanggal) - new Date(b.tanggal));

//     // Hitung saldo berjalan (cumulative sum)
//     var saldo = 0;
//     var labels = [];
//     var saldoData = [];

//     transaksi.forEach(item => {
//         saldo += item.nominal;
//         labels.push(new Date(item.tanggal).toLocaleDateString('id-ID', { day: 'numeric', month: 'short' }));
//         saldoData.push(saldo);
//     });

//     var chart = new Chart(ctx, {
//         type: 'line',
//         data: {
//             labels: labels,
//             datasets: [{
//                 label: 'Saldo Berjalan',
//                 data: saldoData,
//                 backgroundColor: 'rgba(0, 123, 255, 0.2)',
//                 borderColor: 'rgba(0, 123, 255, 1)',
//                 borderWidth: 2,
//                 fill: true,
//                 tension: 0.3, // Agar garis lebih smooth
//                 pointRadius: 5
//             }]
//         },
//         options: {
//             responsive: true,
//             scales: {
//                 y: {
//                     title: {
//                         display: true,
//                         text: 'Saldo (Rp)'
//                     }
//                 }
//             }
//         }
//     });
// });

    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById('chartKeuangan').getContext('2d');

        var pemasukanData = @json($pemasukan->pluck('nominal'));
        var pengeluaranData = @json($pengeluaran->pluck('nominal'));
        var labels = @json($pemasukan->pluck('tanggal')->map(fn($date) => \Carbon\Carbon::parse($date)->format('d M')));

        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: pemasukanData,
                        backgroundColor: 'rgba(40, 167, 69, 0.6)', // Hijau
                        borderColor: 'rgba(40, 167, 69, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Pengeluaran',
                        data: pengeluaranData.map(val => -val), // Buat nilai negatif agar turun
                        backgroundColor: 'rgba(220, 53, 69, 0.6)', // Merah
                        borderColor: 'rgba(220, 53, 69, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nominal (Rp)'
                        }
                    }
                }
            }
        });
    });

    $(document).ready(function() {
        $('#tablehome').DataTable({
            "pageLength": 10,  // Maksimal data per halaman
            "lengthMenu": [5, 10, 25, 50, 100],  // Opsi jumlah data yang bisa ditampilkan
            "language": {
                "search": "Cari Data:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "paginate": {
                    "first": "Awal",
                    "last": "Akhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>

@endsection
