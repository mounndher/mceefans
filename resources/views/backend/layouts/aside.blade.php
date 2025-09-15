<!-- Sidebar Component - Compatible with Tabler Framework -->

<style>
    /* Override Tabler's default sidebar styling */
    .navbar-vertical {
        background-color: #1a5a26 !important;
    }

    .navbar-vertical .navbar-brand {
        background-color: #1a5a26 !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: #ffffff !important;
    }

    .navbar-vertical .navbar-brand:hover {
        color: #ffffff !important;
    }

    /* Navigation links */
    .navbar-vertical .nav-link {
        color: #ffffff !important;
        transition: background-color 0.15s ease-in-out;
    }

    .navbar-vertical .nav-link:hover,
    .navbar-vertical .nav-link:focus {
        background-color: rgba(255, 255, 255, 0.1) !important;
        color: #ffffff !important;
    }

    .navbar-vertical .nav-link.active {
        background-color: rgba(255, 255, 255, 0.15) !important;
        color: #ffffff !important;
        font-weight: 500;
    }

    /* Dropdown menu styling */
    .navbar-vertical .dropdown-menu {
        background-color: #0f3d16 !important;
        border: none;
        margin-left: 0;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .navbar-vertical .dropdown-item {
        color: #ffffff !important;
        padding-left: 3rem;
        font-size: 0.9rem;
    }

    .navbar-vertical .dropdown-item:hover,
    .navbar-vertical .dropdown-item:focus {
        background-color: rgba(255, 255, 255, 0.08) !important;
        color: #ffffff !important;
    }

    /* Icons */
    .navbar-vertical .nav-link-icon svg {
        stroke: #ffffff !important;
    }

    /* Dropdown arrow */
    .navbar-vertical .dropdown-toggle::after {
        border-top-color: #ffffff;
        border-right-color: transparent;
        border-left-color: transparent;
    }
</style>

<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ url('/') }}" class="text-decoration-none text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <rect x="7" y="7" width="10" height="10" rx="1" ry="1"/>
                </svg>
                Tabler
            </a>
        </h1>
        
        <div class="navbar-nav flex-row d-lg-none">
            <!-- Mobile menu items can go here -->
        </div>
        
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0"/>
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/>
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"/>
                            </svg>
                        </span>
                        <span class="nav-link-title">Home</span>
                    </a>
                </li>

                <!-- Fans Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"/>
                            </svg>
                        </span>
                        <span class="nav-link-title">Fans</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('fans.index') }}"> fans actifs</a>
                        <a class="dropdown-item" href="{{ route('fans.expired') }}"> fans supprimés</a>
                    </div>
                </li>

                <!-- Abonnements Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4"/>
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"/>
                                <path d="M9 9l1 0"/>
                                <path d="M9 13l6 0"/>
                                <path d="M9 17l6 0"/>
                            </svg>
                        </span>
                        <span class="nav-link-title">Abonnements</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('abonments.index') }}"> Abonnements actifs</a>
                        <a class="dropdown-item" href="{{ route('abonments.expired') }}"> Abonnements historiques</a>
                    </div>
                </li>

                <!-- Events Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <rect x="4" y="5" width="16" height="16" rx="2"/>
                                <line x1="16" y1="3" x2="16" y2="7"/>
                                <line x1="8" y1="3" x2="8" y2="7"/>
                                <line x1="4" y1="11" x2="20" y2="11"/>
                                <rect x="8" y="15" width="2" height="2"/>
                            </svg>
                        </span>
                        <span class="nav-link-title">Events</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('events.index') }}">Liste des Events</a>
                        <a class="dropdown-item" href="#">Statistiques</a>
                    </div>
                </li>

                <!-- Paimnts -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('Paimnts.index') ? 'active' : '' }}" href="{{ route('Paimnts.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 11l3 3l8 -8"/>
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"/>
                            </svg>
                        </span>
                        <span class="nav-link-title">Paimnts</span>
                    </a>
                </li>

                <!-- Événement -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}" href="{{ route('events.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 11l3 3l8 -8"/>
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"/>
                            </svg>
                        </span>
                        <span class="nav-link-title">Événement</span>
                    </a>
                </li>

                <!-- Tracking -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('generate.card.index') ? 'active' : '' }}" href="{{ route('generate.card.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 11l3 3l8 -8"/>
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"/>
                            </svg>
                        </span>
                        <span class="nav-link-title">Tracking</span>
                    </a>
                </li>

                <!-- Appareils -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('appareils.index') ? 'active' : '' }}" href="{{ route('appareils.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 11l3 3l8 -8"/>
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"/>
                            </svg>
                        </span>
                        <span class="nav-link-title">Appareils</span>
                    </a>
                </li>

                <!-- Présence -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('attendances.index') ? 'active' : '' }}" href="{{ route('attendances.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 11l3 3l8 -8"/>
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"/>
                            </svg>
                        </span>
                        <span class="nav-link-title">Présence</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>