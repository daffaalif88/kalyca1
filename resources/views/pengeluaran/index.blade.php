@extends('admin.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Data Pengeluaran</h2>

    <!-- Tombol Tambah Pemasukan -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('pengeluaran.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Pemasukan
        </a>
    </div>
    
    <div class="table-responsive">
        <table id="pemasukanTable" class="table">
            <thead class="table-dark">
                <tr class="text-center">
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Nominal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($pengeluaran as $item)
                    <tr>
                        <td class="text-center">{{ $no++}}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td class="fw-bold text-success text-center">
                            Rp {{ number_format($item->nominal, 0, ',', '.') }}
                        </td>
                        <td class="text-center" style="width: 200px">
                            <div class="btn-group" role="group">
                                <a href="{{ route('pengeluaran.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('pengeluaran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Tambahkan DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#pemasukanTable').DataTable({
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
