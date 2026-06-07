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
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </div>
            
            <div class="dropdown-logout" id="logoutMenu">
                <form action="/logout" method="POST" onsubmit="return confirm('Yakin ingin keluar dari sistem?')">
                    @csrf
                    <button type="submit" class="btn-logout-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>

    .user-section {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-name {
        color: #1e4d2b !important;
        font-weight: 800;
        font-size: 14px;
    }

    .user-profile-container {
        position: relative;
    }

    .user-profile {
        width: 34px;
        height: 34px;
        color: #1e4d2b; 
        background: #eaf5ee; 
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .user-profile:hover {
        background: #1e4d2b;
        color: white; 
    }

    .dropdown-logout {
        display: none;
        position: absolute;
        right: 0;
        top: 42px;
        background: #ffffff;
        min-width: 110px; 
        border-radius: 6px;
        border: 1px solid #d1e7dd;
        box-shadow: 0 4px 12px rgba(30, 77, 43, 0.08); 
        z-index: 100000;
        padding: 4px 0;
        animation: slideDown 0.15s ease-out;
    }

    .dropdown-logout.show {
        display: block !important;
    }

    .btn-logout-item {
        width: 100%;
        background: none;
        border: none;
        padding: 8px 12px;
        font-size: 13px;
        font-weight: 700;
        color: #e53e3e; 
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
        border-radius: 4px;
    }

    .btn-logout-item:hover {
        background: #fff5f5; 
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
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

        .menu-toggle {
            display: inline-block !important;
            order: -1 !important; 
            color: #1e4d2b !important;
            margin-right: 5px !important;
        }

        .user-section {
            margin-left: auto !important;
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

        .dropdown-logout {
            right: 0 !important;
            top: 42px !important;
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