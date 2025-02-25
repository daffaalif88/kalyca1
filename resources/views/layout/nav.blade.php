<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom px-4">
    {{-- <a class="navbar-brand" href="#">adw</a> --}}
    
    <div class="ms-auto d-flex align-items-center" >
        @if(Auth::check())
            <span class="me-3">{{ Auth::user()->name }}</span>
            <span class="me-3">({{ Auth::user()->role }})</span>
        @else
            <span class="me-3">Guest</span>
        @endif
        <i class="bi bi-person-circle fs-4"></i>
    </div>
    
</nav>