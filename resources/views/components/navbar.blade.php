<nav class="fixed top-0 left-0 right-0 z-50 h-20 border-b border-border/50 bg-white/80 backdrop-blur-xl transition-all duration-300 dark:border-gray-700/50 dark:bg-dark-bg/80">
    <div class="mx-auto flex h-full max-w-[1600px] items-center justify-between px-6 lg:px-8">
        <a href="/" class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo-kursus-hobi.svg') }}" alt="Kursus Hobi" class="h-10 w-auto dark:brightness-125">
            <span class="text-2xl font-bold text-primary-start dark:text-primary-light">Kursus Hobi</span>
        </a>

        <div class="hidden items-center gap-10 md:flex">
            <a href="/" class="text-lg font-semibold text-text-secondary transition-colors hover:text-primary dark:text-gray-300 dark:hover:text-white">Beranda</a>
            <a href="/#kursus" class="text-lg font-semibold text-text-secondary transition-colors hover:text-primary dark:text-gray-300 dark:hover:text-white">Kursus</a>
            <a href="/#tentang" class="text-lg font-semibold text-text-secondary transition-colors hover:text-primary dark:text-gray-300 dark:hover:text-white">Tentang</a>
        </div>

        <div class="flex items-center gap-4 md:gap-6">
            <button id="theme-toggle" class="rounded-full p-2.5 text-text-secondary transition-colors hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-dark-surface" aria-label="Toggle theme">
                <svg id="sun-icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                <svg id="moon-icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
            </button>

            @auth
                <div class="relative hidden md:block" id="user-dropdown">
                    <button id="user-menu-btn" class="flex items-center gap-2 rounded-full p-1 transition-colors hover:bg-gray-100 dark:hover:bg-dark-surface">
                        <div class="flex h-9 w-9 items-center justify-center overflow-hidden rounded-full bg-gray-200 dark:bg-dark-bg">
                            @if (Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="" class="h-full w-full object-cover">
                            @else
                                <span class="text-sm font-bold text-text-muted dark:text-gray-500">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            @endif
                        </div>
                    </button>
                    <div id="user-dropdown-menu" class="absolute right-0 top-full z-50 mt-2 hidden w-56 rounded-2xl border border-border bg-white p-2 shadow-lg dark:border-gray-700 dark:bg-dark-surface">
                        <div class="border-b border-border px-3 py-2 dark:border-gray-700">
                            <p class="text-sm font-semibold text-text-primary dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-text-secondary dark:text-gray-400">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ Auth::user()->role_id === 1 ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm text-text-secondary transition-colors hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-dark-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                            Dashboard
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm text-text-secondary transition-colors hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-dark-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="border-t border-border pt-1 dark:border-gray-700">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-2 rounded-xl px-3 py-2 text-sm text-danger transition-colors hover:bg-red-50 dark:hover:bg-red-900/10">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="hidden text-lg font-semibold text-text-secondary transition-colors hover:text-primary dark:text-gray-300 dark:hover:text-white md:inline">Masuk</a>
                <a href="{{ route('register') }}" class="hidden rounded-full bg-primary px-6 py-2.5 text-lg font-semibold text-white transition-all duration-150 hover:bg-primary-dark md:inline-block">
                    Daftar
                </a>
            @endauth

            <button id="mobile-menu-toggle" class="rounded-full p-2 text-text-secondary transition-colors hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-dark-surface md:hidden" aria-label="Toggle menu">
                <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="18" x2="20" y2="18"/></svg>
                <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden border-t border-border bg-white px-6 pb-6 pt-4 shadow-lg dark:border-gray-700 dark:bg-dark-bg md:hidden lg:px-8">
        <div class="flex flex-col gap-4">
            <a href="/" class="text-lg font-medium text-text-secondary hover:text-primary dark:text-gray-300 dark:hover:text-white">Beranda</a>
            <a href="/#kursus" class="text-lg font-medium text-text-secondary hover:text-primary dark:text-gray-300 dark:hover:text-white">Kursus</a>
            <a href="/#tentang" class="text-lg font-medium text-text-secondary hover:text-primary dark:text-gray-300 dark:hover:text-white">Tentang</a>
            <hr class="border-border dark:border-gray-700">
            @auth
                <a href="{{ route('dashboard') }}" class="text-lg font-medium text-text-secondary hover:text-primary dark:text-gray-300 dark:hover:text-white">Dashboard</a>
                <a href="{{ route('profile.edit') }}" class="text-lg font-medium text-text-secondary hover:text-primary dark:text-gray-300 dark:hover:text-white">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-lg font-medium text-danger hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-lg font-medium text-text-secondary hover:text-primary dark:text-gray-300 dark:hover:text-white">Masuk</a>
                <a href="{{ route('register') }}" class="rounded-full bg-primary px-6 py-3 text-center text-lg font-medium text-white transition-all duration-150 hover:bg-primary-dark">
                    Daftar
                </a>
            @endauth
        </div>
    </div>
</nav>