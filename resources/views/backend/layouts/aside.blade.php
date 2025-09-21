<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ url('/') }}" class="text-decoration-none text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                    <rect x="7" y="7" width="10" height="10" rx="1" ry="1" />
                </svg>
                Tabler
            </a>
        </h1>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Home</span>
                    </a>
                </li>

                <!-- Fans -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#fansMenu" role="button" aria-expanded="false" aria-controls="fansMenu">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Fans</span>
                    </a>
                    <div class="collapse" id="fansMenu">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a class="nav-link" href="{{ route('fans.index') }}">Fans Actifs</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('fans.expired') }}">Fans Supprimés</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('fansfans.inactive') }}">Fans inactive</a></li>

                        </ul>
                    </div>
                </li>

                <!-- Abonnements -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#abonmentsMenu" role="button" aria-expanded="false" aria-controls="abonmentsMenu">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                <path d="M9 9l1 0" />
                                <path d="M9 13l6 0" />
                                <path d="M9 17l6 0" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Abonnements</span>
                    </a>
                    <div class="collapse" id="abonmentsMenu">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('abonments.index') }}">Abonnements actifs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('abonments.expired') }}">Abonnements desactive</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('abonments.supprime') }}">Abonnements supprimés</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Events -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#eventsMenu" role="button" aria-expanded="false" aria-controls="eventsMenu">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <rect x="4" y="5" width="16" height="16" rx="2" />
                                <line x1="16" y1="3" x2="16" y2="7" />
                                <line x1="8" y1="3" x2="8" y2="7" />
                                <line x1="4" y1="11" x2="20" y2="11" />
                                <rect x="8" y="15" width="2" height="2" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Events</span>
                    </a>
                    <div class="collapse" id="eventsMenu">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item"><a class="nav-link" href="{{ route('events.index') }}">Liste des Events</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Statistiques</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Paimnts -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('Paimnts.index') ? 'active' : '' }}" href="{{ route('Paimnts.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 11l3 3l8 -8" />
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Paimnts</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#PaimntsMenu" role="button" aria-expanded="false" aria-controls="abonmentsMenu">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                <path d="M9 9l1 0" />
                                <path d="M9 13l6 0" />
                                <path d="M9 17l6 0" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Paimnts</span>
                    </a>
                    <div class="collapse" id="PaimntsMenu">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('Paimnts.index') }}">Paimnts actifs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('paimnts.historique') }}">Paimnts historique</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('abonments.supprime') }}">Paimnts supprimés</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Appareils -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('appareils.index') ? 'active' : '' }}" href="{{ route('appareils.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 11l3 3l8 -8" />
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
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
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 11l3 3l8 -8" />
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Présence</span>
                    </a>
                </li>

                <!-- Tracking -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('generate.card.index') ? 'active' : '' }}" href="{{ route('generate.card.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 11l3 3l8 -8" />
                                <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9" />
                            </svg>
                        </span>
                        <span class="nav-link-title">Tracking</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
