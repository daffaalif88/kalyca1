@extends('admin.dashboard')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Tambah Data Pemasukan</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('pemasukan.store') }}" method="POST">
                @csrf

                <!-- Input Tanggal -->
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Input Nominal -->
                <div class="mb-3">
                    <label for="nominal" class="form-label">Nominal</label>
                    <input type="number" class="form-control @error('nominal') is-invalid @enderror" name="nominal" id="nominal" value="{{ old('nominal') }}" required>
                    @error('nominal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <!-- Input Keterangan -->
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" rows="3" required>{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tombol Simpan -->
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan Data
                </button>

                <!-- Tombol Kembali -->
                <a href="{{ route('pemasukan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
