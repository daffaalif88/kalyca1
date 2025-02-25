@extends('admin.dashboard')

@section('content')

<div class="container mt-4">
    <h2 class="text-center mb-4">Laporan Keuangan</h2>
    <form action="{{ route('laporan.index_laporan') }}">
        <div class="row mb-3">
        
            <div class="col-md-4">
                <label for="startDate" class="form-label">Tanggal Awal:</label>
                <input type="date" class="form-control" id="startDate" name="tgl1" value="{{ $tgl1}}">
            </div>
            <div class="col-md-4">
                <label for="endDate" class="form-label">Tanggal Akhir:</label>
                <input type="date" class="form-control" id="endDate" name="tgl2" value="{{$tgl2}}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2" >Cari</button>
                <a href="{{ route('laporan.print', ['tgl1' => $tgl1, 'tgl2' => $tgl2]) }}" class="btn btn-success" target="_blank">Cetak</a>
            </div>
        
        </div>
    </form>
    <div class="table-responsive">
        <table class="table" id="laporanTable">
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

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#laporanTable').DataTable({
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
