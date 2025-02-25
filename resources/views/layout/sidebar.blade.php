
<div class="bg-dark text-white p-3 vh-100" style="width: 250px; position:fixed">
    <h4 class="text-center">GUDANGNYA BAJU ANAK</h4>
    <hr>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('home.index') }}" 
               class="nav-link text-white load-page {{ Request::is('home*') ? 'active bg-primary' : '' }}">
                <i class="bi bi-house-fill"></i> Home
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pemasukan.index') }}" 
               class="nav-link text-white load-page {{ Request::is('pemasukan*') ? 'active bg-primary' : '' }}">
                <i class="bi bi-cash-coin"></i> Pemasukan 
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pengeluaran.index') }}" 
               class="nav-link text-white load-page {{ Request::is('pengeluaran*') ? 'active bg-primary' : '' }}">
                <i class="bi bi-cart-dash"></i> Pengeluaran 
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('laporan.index_laporan') }}" 
               class="nav-link text-white load-page {{ Request::is('laporan*') ? 'active bg-primary' : '' }}">
                <i class="bi bi-bank"></i> Laporan 
            </a>
        </li>
        <li class="nav-item mt-3">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <button type="button" class="btn btn-danger w-100" id="logout-button">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </li>
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logout-button').addEventListener('click', function (event) {
        event.preventDefault(); // Mencegah submit otomatis

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan keluar dari akun ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Logout!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit(); // Submit form jika dikonfirmasi
            }
        });
    });
</script>

