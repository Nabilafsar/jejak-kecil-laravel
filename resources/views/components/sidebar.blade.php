<aside id="sidebar" class="sidebar sidebar--expanded fixed top-0 left-0 h-screen bg-[#033E8A] flex flex-col overflow-hidden z-50 shadow-xl">

    {{-- Header: Logo + Toggle Button --}}
    <div class="flex items-center justify-between px-4 py-5 min-h-[70px] border-b border-white/10 flex-shrink-0">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 overflow-hidden whitespace-nowrap no-underline">
            <span class="sidebar__brand-name text-white font-bold text-lg tracking-wide transition-all duration-300">Jejak Kecil</span>
        </a>
        <button id="sidebarToggle" title="Toggle sidebar"
            class="bg-white/10 hover:bg-white/20 border-none rounded-lg w-8 h-8 flex items-center justify-center cursor-pointer flex-shrink-0 transition-all duration-200">
            <img src="{{ asset('assets/img/grid-layout-side-outline.png') }}" class="w-5 h-5 object-contain" alt="Toggle Menu">
        </button>
    </div>

    {{-- Navigation Menu --}}
    <nav class="flex-1 overflow-y-auto overflow-x-hidden py-3 scrollbar-none">
        <ul class="list-none p-0 m-0">

            <li class="px-2 py-0.5">
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar__link flex items-center gap-3 px-3 py-2.5 rounded-xl no-underline whitespace-nowrap transition-all duration-200 relative overflow-hidden
                   {{ request()->routeIs('admin.dashboard') ? 'sidebar__link--active bg-white/20 text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <span class="flex items-center flex-shrink-0">
                        <img src="{{ asset('assets/img/icondashboardadmin.png') }}" class="w-5 h-5 object-contain" alt="">
                    </span>
                    <span class="sidebar__link-text text-sm font-medium transition-all duration-300">Dashboard</span>
                </a>
            </li>

            <li class="px-2 py-0.5">
                <a href="{{ route('admin.users.index') }}"
                   class="sidebar__link flex items-center gap-3 px-3 py-2.5 rounded-xl no-underline whitespace-nowrap transition-all duration-200 relative overflow-hidden
                   {{ request()->routeIs('admin.users.*') ? 'sidebar__link--active bg-white/20 text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <span class="flex items-center flex-shrink-0">
                        <img src="{{ asset('assets/img/iconuseradmin.png') }}" class="w-5 h-5 object-contain" alt="">
                    </span>
                    <span class="sidebar__link-text text-sm font-medium transition-all duration-300">Manajemen User</span>
                </a>
            </li>

            <li class="px-2 py-0.5">
                <a href="{{ route('admin.modules.index') }}"
                   class="sidebar__link flex items-center gap-3 px-3 py-2.5 rounded-xl no-underline whitespace-nowrap transition-all duration-200 relative overflow-hidden
                   {{ request()->routeIs('admin.modules.*') ? 'sidebar__link--active bg-white/20 text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <span class="flex items-center flex-shrink-0">
                        <img src="{{ asset('assets/img/iconmoduladmin.png') }}" class="w-5 h-5 object-contain" alt="">
                    </span>
                    <span class="sidebar__link-text text-sm font-medium transition-all duration-300">Manajemen Modul</span>
                </a>
            </li>

            <li class="px-2 py-0.5">
                <a href="{{ route('admin.quizzes.index') }}"
                   class="sidebar__link flex items-center gap-3 px-3 py-2.5 rounded-xl no-underline whitespace-nowrap transition-all duration-200 relative overflow-hidden
                   {{ request()->routeIs('admin.quizzes.*') ? 'sidebar__link--active bg-white/20 text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <span class="flex items-center flex-shrink-0">
                        <img src="{{ asset('assets/img/iconquizadmin.png') }}" class="w-5 h-5 object-contain" alt="">
                    </span>
                    <span class="sidebar__link-text text-sm font-medium transition-all duration-300">Manajemen Quiz</span>
                </a>
            </li>

            <li class="px-2 py-0.5">
                <a href="{{ route('admin.reports.index') }}"
                   class="sidebar__link flex items-center gap-3 px-3 py-2.5 rounded-xl no-underline whitespace-nowrap transition-all duration-200 relative overflow-hidden
                   {{ request()->routeIs('admin.reports.*') ? 'sidebar__link--active bg-white/20 text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
                    <span class="flex items-center flex-shrink-0">
                        <img src="{{ asset('assets/img/iconrepotsadmin.png') }}" class="w-5 h-5 object-contain" alt="">
                    </span>
                    <span class="sidebar__link-text text-sm font-medium transition-all duration-300">Laporan</span>
                </a>
            </li>

        </ul>
    </nav>

    {{-- Footer: User Info + Settings --}}
    <div class="border-t border-white/10 p-3 flex-shrink-0">
        <div class="flex items-center gap-3 px-3 py-2 mb-1 overflow-hidden">
            <span class="text-white/80 flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </span>
            <span class="sidebar__user-name text-white/85 text-sm font-medium whitespace-nowrap transition-all duration-300">
                {{ Auth::user()?->nama ?? 'Administrator' }}
            </span>
        </div>

        <a href="{{ route('admin.settings') }}"
           class="sidebar__link flex items-center gap-3 px-3 py-2.5 rounded-xl no-underline whitespace-nowrap transition-all duration-200 relative overflow-hidden
           {{ request()->routeIs('admin.settings') ? 'sidebar__link--active bg-white/20 text-white' : 'text-white/75 hover:bg-white/10 hover:text-white' }}">
            <span class="flex items-center flex-shrink-0">
                <img src="{{ asset('assets/img/iconsettingadmin.png') }}" class="w-5 h-5 object-contain" alt="">
            </span>
            <span class="sidebar__link-text text-sm font-medium transition-all duration-300">Settings</span>
        </a>
    </div>

</aside>