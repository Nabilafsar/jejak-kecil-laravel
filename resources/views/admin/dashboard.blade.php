@extends('admin.layoutSidebar')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#033E8A]">Dashboard</h1>
        <p class="text-sm text-gray-500 mt-1">Selamat datang! Berikut ringkasan aktivitas sistem.</p>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-5 gap-4 mb-6">

        <div class="bg-white rounded-2xl shadow-sm p-5">
            <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Total Users</p>
            <p class="text-3xl font-bold text-[#033E8A] mt-1">{{ $totalUsers }}</p>
            <p class="text-xs text-gray-400 mt-1">Orang tua terdaftar</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-5">
            <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Active Users</p>
            <p class="text-3xl font-bold text-[#033E8A] mt-1">{{ $activeUsers }}</p>
            <p class="text-xs text-gray-400 mt-1">Pengguna pernah aktif</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-5">
            <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Total Modul</p>
            <p class="text-3xl font-bold text-[#033E8A] mt-1">{{ $totalModul }}</p>
            <p class="text-xs text-gray-400 mt-1">Modul tersedia</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-5">
            <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Total Kuis</p>
            <p class="text-3xl font-bold text-[#033E8A] mt-1">{{ $totalKuis }}</p>
            <p class="text-xs text-gray-400 mt-1">Soal kuis tersedia</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-5">
            <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Completion Rate</p>
            <p class="text-3xl font-bold text-[#033E8A] mt-1">{{ $completionRate }}%</p>
            <p class="text-xs text-gray-400 mt-1">Modul diselesaikan</p>
        </div>

    </div>

    {{-- Recent Activity --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-sm font-semibold text-[#033E8A]">Aktivitas Terbaru</h2>
            <p class="text-xs text-gray-400 mt-0.5">5 aktivitas terakhir dalam sistem.</p>
        </div>
        <table class="w-full">
            <thead>
                <tr class="bg-[#033E8A]">
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">No</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Pengguna</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Aktivitas</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Keterangan</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentActivity as $index => $log)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-[#033E8A]">
                        {{ $log->pengguna->nama ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-medium px-2.5 py-1 rounded-full
                            {{ $log->aktivitas === 'tambah' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $log->aktivitas === 'update' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $log->aktivitas === 'hapus' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $log->aktivitas === 'login' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $log->aktivitas === 'logout' ? 'bg-gray-100 text-gray-700' : '' }}">
                            {{ ucfirst($log->aktivitas) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $log->deskripsi ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($log->dibuat_pada)->format('d M Y H:i') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-400">
                        Belum ada aktivitas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection