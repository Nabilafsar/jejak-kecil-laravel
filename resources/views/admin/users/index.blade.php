@extends('admin.layoutSidebar')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-[#033E8A]">Manajemen User</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola data pengguna, hak akses, dan informasi akun dalam sistem.</p>
        </div>
        <a href="{{ route('admin.users.create') }}"
           class="flex items-center gap-2 bg-[#033E8A] hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Buat Pengguna Baru
        </a>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm">
        {{ session('success') }}
    </div>
    @endif

    {{-- Tabel --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="bg-[#033E8A]">
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left rounded-tl-2xl">ID</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Nama User</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Email</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Password</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left rounded-tr-2xl">Role</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengguna as $user)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 text-sm text-[#033E8A] font-medium">{{ $user->id }}</td>
                    <td class="px-6 py-4 text-sm text-[#033E8A]">{{ $user->nama }}</td>
                    <td class="px-6 py-4 text-sm text-[#033E8A]">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-sm text-[#033E8A] tracking-widest">••••••••</td>
                    <td class="px-6 py-4 text-sm font-semibold
                        {{ $user->role === 'admin' ? 'text-[#033E8A]' : 'text-[#033E8A]' }}">
                        {{ ucfirst($user->role) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-400">
                        Belum ada pengguna.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection