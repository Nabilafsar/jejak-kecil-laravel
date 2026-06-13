@extends('admin.layoutSidebar')

@section('content')
<div class="p-6 max-w-xl">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#033E8A]">Buat Pengguna Baru</h1>
        <p class="text-sm text-gray-500 mt-1">Tambahkan pengguna baru ke dalam sistem.</p>
    </div>

    {{-- Form --}}
    <div class="bg-white rounded-2xl shadow-sm p-6">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A] transition-all"
                    placeholder="Masukkan nama lengkap">
                @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A] transition-all"
                    placeholder="Masukkan email">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                <input type="password" name="password"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#033E8A]/30 focus:border-[#033E8A] transition-all"
                    placeholder="Minimal 6 karakter">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex items-center gap-3">
                <button type="submit"
                    class="bg-[#033E8A] hover:bg-blue-800 text-white text-sm font-medium px-6 py-2.5 rounded-xl transition-all duration-200">
                    Simpan
                </button>
                <a href="{{ route('admin.users.index') }}"
                    class="text-sm text-gray-500 hover:text-gray-700 px-4 py-2.5 rounded-xl border border-gray-200 hover:border-gray-300 transition-all duration-200">
                    Batal
                </a>
            </div>

        </form>
    </div>

</div>
@endsection