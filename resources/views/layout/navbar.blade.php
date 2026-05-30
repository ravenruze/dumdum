<nav class="navbar">
    <div class="navbar-brand">
        <!-- Tombol hamburger -->
        <div class="menu-toggle" onclick="toggleMobileMenu()" style="display: none; cursor: pointer; font-size: 24px; user-select: none;">☰</div>
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
            {{ Auth::user()->name }} 
        </div>

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

    @media (max-width: 768px) {
        /* 1. Navbar Utama */
        .navbar {
            position: relative !important;
            flex-direction: row !important;
            flex-wrap: wrap !important;
            justify-content: space-between !important;
            align-items: center !important;
            padding: 10px 15px !important;
            z-index: 99999 !important; 
        }

        .navbar-brand {
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
            flex: 1 !important;
        }

        /* Hamburger muncul di paling kiri sebelum Logo */
        .menu-toggle {
            display: inline-block !important;
            order: -1 !important; 
            color: #1e4d2b !important;
            margin-right: 5px !important;
        }

        .user-section {
            display: flex !important;
            align-items: center !important;
            gap: 10px !important;
            margin-left: auto !important;
        }

        .user-name {
            display: inline-block !important;
            color: #1e4d2b !important;
            font-size: 14px !important;
            font-weight: 700 !important;
        }

        .nav-links {
            display: none; 
            flex-direction: column !important;
            align-items: flex-start !important; 
            width: 100% !important;
            order: 3 !important; 
            margin-top: 10px !important;
            
            padding: 15px 0 25px 0 !important; 
            gap: 20px !important; 
            
            background: #d1e7dd !important; 
            
            margin-left: -15px !important;
            margin-right: -15px !important;
            width: calc(100% + 30px) !important;
            
            z-index: 99999 !important;
        }

        .nav-links.show {
            display: flex !important;
        }

        .nav-links a {
            width: 100% !important;
            display: block !important;
            padding: 5px 0 5px 25px !important; 
            text-align: left !important;
            font-size: 16px !important;
            font-weight: 700 !important;
            color: #1e4d2b !important; 
            text-decoration: none !important;
            border-left: 4px solid transparent !important;
            background: transparent !important;
        }

        .nav-links a.active {
            color: #1e4d2b !important;
            border-left: 4px solid #1e4d2b !important; 
            padding-left: 25px !important;
            background: transparent !important;
        }

        /* Posisi dropdown logout */
        .dropdown-logout {
            position: absolute !important;
            right: 15px !important;
            top: 50px !important;
            z-index: 100000 !important;
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