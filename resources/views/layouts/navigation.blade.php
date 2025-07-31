<nav x-data="{ open: false }" class="modern-navbar">
    <style>
        .modern-navbar {
            background: linear-gradient(135deg, #ff416c 0%, #ff4757 100%);
            border: none;
            box-shadow: 0 4px 20px rgba(255, 65, 108, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 70px;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 40px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .logo-text {
            color: white;
            font-size: 1.4rem;
            font-weight: 800;
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .logo-text:hover {
            color: white;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            text-decoration: none;
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-dropdown {
            position: relative;
        }

        .user-trigger {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 8px 16px;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-trigger:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-1px);
        }

        .user-trigger:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
        }

        .user-avatar {
            width: 28px;
            height: 28px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
        }

        .dropdown-arrow {
            width: 16px;
            height: 16px;
            transition: transform 0.3s ease;
        }

        .dropdown-content {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(255, 65, 108, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.3);
            min-width: 200px;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .dropdown-content.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-item {
            display: block;
            padding: 12px 20px;
            color: #2d3436;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border-bottom: 1px solid rgba(255, 65, 108, 0.1);
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background: rgba(255, 65, 108, 0.1);
            color: #ff416c;
            text-decoration: none;
        }

        .mobile-menu-btn {
            display: none;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 8px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .mobile-menu-btn:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .mobile-menu-btn:focus {
            outline: none;
        }

        .mobile-menu {
            display: none;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            padding: 20px;
        }

        .mobile-menu.show {
            display: block;
        }

        .mobile-nav-links {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 20px;
        }

        .mobile-nav-link {
            color: #2d3436;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .mobile-nav-link:hover,
        .mobile-nav-link.active {
            background: rgba(255, 65, 108, 0.1);
            color: #ff416c;
            text-decoration: none;
        }

        .mobile-user-section {
            border-top: 1px solid rgba(255, 65, 108, 0.1);
            padding-top: 20px;
        }

        .mobile-user-info {
            padding: 16px;
            background: rgba(255, 65, 108, 0.05);
            border-radius: 12px;
            margin-bottom: 12px;
        }

        .mobile-user-name {
            font-weight: 700;
            color: #2d3436;
            font-size: 1rem;
        }

        .mobile-user-email {
            font-size: 0.85rem;
            color: #636e72;
            margin-top: 2px;
        }

        .mobile-user-links {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        @media (max-width: 768px) {
            .nav-links,
            .user-section {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .navbar-content {
                height: 60px;
            }

            .logo-text {
                font-size: 1.2rem;
            }

            .logo-icon {
                width: 35px;
                height: 35px;
                font-size: 18px;
            }
        }
    </style>

    <!-- Navigation principale -->
    <div class="navbar-container">
        <div class="navbar-content">
            <div class="navbar-left">
                <!-- Logo -->
                <div class="logo-section">
                    <div class="logo-icon">🍔</div>
                    <a href="{{ route('dashboard') }}" class="logo-text">
                        BurgerApp
                    </a>
                </div>

                <!-- Liens de navigation -->
                <div class="nav-links">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Tableau de bord
                    </a>
                    <a href="{{ route('burger') }}"
                       class="nav-link {{ request()->routeIs('burger*') ? 'active' : '' }}">
                        Burgers
                    </a>
                    @if(Auth::check() && Auth::user()->role === 'gestionnaire')
                    <a href="{{ route('addBurger') }}"
                       class="nav-link">
                        Ajouter
                    </a>
                    @endif
                </div>
            </div>

            <!-- Section utilisateur -->
            <div class="user-section">
                <div class="user-dropdown" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen"
                            class="user-trigger">
                        <div class="user-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="dropdown-arrow" :class="{'rotate-180': dropdownOpen}"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div class="dropdown-content" :class="{'show': dropdownOpen}"
                         @click.away="dropdownOpen = false">
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            Mon Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                               class="dropdown-item"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                Se déconnecter
                            </a>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Bouton menu mobile -->
            <button @click="open = !open" class="mobile-menu-btn">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open }"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': !open, 'inline-flex': open }"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Menu mobile -->
    <div class="mobile-menu" :class="{'show': open}">
        <div class="mobile-nav-links">
            <a href="{{ route('dashboard') }}"
               class="mobile-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Tableau de bord
            </a>
            <a href="{{ route('burger') }}"
               class="mobile-nav-link {{ request()->routeIs('burger*') ? 'active' : '' }}">
                Burgers
            </a>
            @if(Auth::check() && Auth::user()->role === 'gestionnaire')
            <a href="{{ route('addBurger') }}"
               class="mobile-nav-link">
                Ajouter un Burger
            </a>
            @endif
        </div>

        <!-- Section utilisateur mobile -->
        <div class="mobile-user-section">
            <div class="mobile-user-info">
                <div class="mobile-user-name">{{ Auth::user()->name }}</div>
                <div class="mobile-user-email">{{ Auth::user()->email }}</div>
            </div>

            <div class="mobile-user-links">
                <a href="{{ route('profile.edit') }}" class="mobile-nav-link">
                    Mon Profil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       class="mobile-nav-link"
                       onclick="event.preventDefault(); this.closest('form').submit();">
                        Se déconnecter
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
