<nav class="navbar">
    <div class="navbar-brand">
        <div class="menu-toggle" onclick="toggleMobileMenu()" style="display: none; cursor: pointer; font-size: 24px; margin-right: 10px; user-select: none;">☰</div>
        <img src="{{ asset('img/logo-istana-qurban.png') }}" alt="Logo Istana Qurban"> 
        <span>Istana Qurban</span>
    </div>

    <div class="nav-links" id="navLinks">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('sapi.index') }}" class="{{ request()->routeIs('sapi.*') ? 'active' : '' }}">Katalog Sapi</a>
        <a href="{{ route('pesanan.index') }}" class="{{ request()->routeIs('pesanan.*') ? 'active' : '' }}">Registrasi & Booking</a>
        <a href="{{ route('pembayaran.index') }}" class="{{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">Transaksi</a>
        <a href="{{ route('laporan.index') }}" class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}">Laporan</a>
    </div>

    <div class="user-section">
        <div class="user-name">
            {{ Auth::user()->name }} </div>

        <div class="user-profile-container">
            <div class="user-profile" onclick="toggleLogout(event)">
                👤
            </div>
            
            <div class="dropdown-logout" id="logoutMenu">
                <form action="/logout" method="POST" onsubmit="return confirm('Yakin ingin keluar dari sistem?')">
                    @csrf
                    <button type="submit">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Tambahan khusus responsif tanpa menyentuh atau menimpa CSS asli kamu */
    @media (max-width: 768px) {
        .navbar {
            flex-wrap: wrap !important; /* Biar menu nav-links bisa turun ke bawah */
        }
        .menu-toggle {
            display: inline-block !important; /* Memunculkan tombol tombol garis tiga di HP */
        }
        .nav-links {
            display: none; /* Sembunyikan menu landscape desktop di HP */
            flex-direction: column !important;
            width: 100% !important;
            order: 3; /* Memaksa menu drop bawah berada di paling bawah navbar */
            margin-top: 15px;
            gap: 8px !important;
        }
        .nav-links.show {
            display: flex !important; /* Muncul jika tombol hamburger di-klik */
        }
        .nav-links a {
            width: 100% !important;
            display: block !important;
        }
        .user-name {
            display: none !important; /* Sembunyikan teks nama di HP biar tidak penuh */
        }
    }
</style>

<script>
    function toggleMobileMenu() {
        document.getElementById('navLinks').classList.toggle('show');
        document.getElementById('logoutMenu').classList.remove('show');
    }

    function toggleLogout(event) {
        event.stopPropagation();
        document.getElementById('logoutMenu').classList.toggle('show');
        document.getElementById('navLinks').classList.remove('show');
    }

    window.onclick = function(event) {
        if (!event.target.matches('.user-profile') && !event.target.matches('.menu-toggle')) {
            var dropdowns = document.getElementsByClassName("dropdown-logout");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
            var navLinks = document.getElementById("navLinks");
            if (navLinks.classList.contains('show')) {
                navLinks.classList.remove('show');
            }
        }
    }
</script>