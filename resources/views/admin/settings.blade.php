@extends('admin.layoutSidebar')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#033E8A]">Settings</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola profil dan informasi aplikasi.</p>
    </div>

    <div class="grid grid-cols-2 gap-6">

        {{-- Kolom Kiri --}}
        <div class="space-y-6">

            {{-- Profil Admin --}}
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-semibold text-[#033E8A]">Profil Saya</h2>
                    <button onclick="toggleForm('form-profil')"
                        class="flex items-center gap-2 text-sm text-[#033E8A] hover:text-blue-800 font-medium border border-[#033E8A] px-3 py-1.5 rounded-lg transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        Edit Profil
                    </button>
                </div>

                {{-- Info Profil (default tampil) --}}
                <div id="info-profil">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-[#033E8A] rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white text-xl font-bold">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</span>
                        </div>
                        <div>
                            <p class="text-base font-semibold text-[#033E8A]">{{ Auth::user()->nama }}</p>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ ucfirst(Auth::user()->role) }}</p>
                        </div>
                    </div>
                </div>

                {{-- Form Edit Profil (default hidden) --}}
                <div id="form-profil" class="hidden mt-4">

                    @if(session('success_profil'))
                    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm">
                        {{ session('success_profil') }}
                    </div>
                    @endif

                    <form action="{{ route('admin.settings.profil') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama</label>
                            <input type="text" name="nama" value="{{ Auth::user()->nama }}"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]">
                            @error('nama')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3">
                            <button type="submit"
                                class="bg-[#033E8A] hover:bg-blue-800 text-white text-sm font-medium px-6 py-2.5 rounded-xl transition-all duration-200">
                                Simpan
                            </button>
                            <button type="button" onclick="toggleForm('form-profil')"
                                class="text-sm text-gray-500 hover:text-gray-700 px-4 py-2.5 rounded-xl border border-gray-200 hover:border-gray-300 transition-all duration-200">
                                Batal
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            {{-- Update Password --}}
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-semibold text-[#033E8A]">Ubah Password</h2>
                    <button onclick="toggleForm('form-password')"
                        class="flex items-center gap-2 text-sm text-[#033E8A] hover:text-blue-800 font-medium border border-[#033E8A] px-3 py-1.5 rounded-lg transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        Ubah Password
                    </button>
                </div>

                {{-- Info Password (default tampil) --}}
                <div id="info-password">
                    <p class="text-sm text-gray-500">Password terakhir diubah. Klik tombol untuk mengubah password.</p>
                </div>

                {{-- Form Ubah Password (default hidden) --}}
                <div id="form-password" class="hidden mt-4">

                    @if(session('success_password'))
                    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm">
                        {{ session('success_password') }}
                    </div>
                    @endif

                    <form action="{{ route('admin.settings.password') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru</label>
                            <input type="password" name="password_baru"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]"
                                placeholder="Minimal 6 karakter">
                            @error('password_baru')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password</label>
                            <input type="password" name="konfirmasi_password"
                                class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A]"
                                placeholder="Ulangi password baru">
                            @error('konfirmasi_password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3">
                            <button type="submit"
                                class="bg-[#033E8A] hover:bg-blue-800 text-white text-sm font-medium px-6 py-2.5 rounded-xl transition-all duration-200">
                                Simpan
                            </button>
                            <button type="button" onclick="toggleForm('form-password')"
                                class="text-sm text-gray-500 hover:text-gray-700 px-4 py-2.5 rounded-xl border border-gray-200 hover:border-gray-300 transition-all duration-200">
                                Batal
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>

        {{-- Kolom Kanan --}}
        <div class="space-y-6">

            {{-- Informasi Aplikasi --}}
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-base font-semibold text-[#033E8A] mb-4">Informasi Aplikasi</h2>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/img/logo.png') }}" class="w-16 h-16 object-contain rounded-xl border border-gray-100" alt="Logo">
                    <div>
                        <p class="text-base font-bold text-[#033E8A]">Jejak Kecil</p>
                        <p class="text-sm text-gray-500 mt-1">Platform pembelajaran anak berkebutuhan khusus berbasis gaya belajar</p>
                    </div>
                </div>
            </div>

            {{-- Logout --}}
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-base font-semibold text-[#033E8A] mb-2">Logout</h2>
                <p class="text-sm text-gray-500 mb-4">Keluar dari sesi admin saat ini.</p>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-6 py-2.5 rounded-xl transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>

<script>
function toggleForm(id) {
    const form = document.getElementById(id);
    const info = document.getElementById(id.replace('form-', 'info-'));
    form.classList.toggle('hidden');
    info.classList.toggle('hidden');
}

// Jika ada error validasi, otomatis buka form yang error
@if($errors->has('nama') || $errors->has('email') || session('success_profil'))
    document.getElementById('form-profil').classList.remove('hidden');
    document.getElementById('info-profil').classList.add('hidden');
@endif

@if($errors->has('password_baru') || $errors->has('konfirmasi_password') || session('success_password'))
    document.getElementById('form-password').classList.remove('hidden');
    document.getElementById('info-password').classList.add('hidden');
@endif
</script>

@endsection