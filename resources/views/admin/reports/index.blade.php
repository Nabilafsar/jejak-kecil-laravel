@extends('admin.layoutSidebar')

@section('content')
<div class="p-6">

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#033E8A]">Laporan & Analitik</h1>
        <p class="text-sm text-gray-500 mt-1">Pantau progres belajar dan aktivitas sistem secara real-time.</p>
    </div>

    {{-- Grafik Row 1 --}}
    <div class="grid grid-cols-3 gap-4 mb-6">

        {{-- Distribusi Penyelesaian (Donut) --}}
        <div class="bg-white rounded-2xl shadow-sm p-5">
            <h2 class="text-sm font-semibold text-[#033E8A] mb-4">Distribusi Penyelesaian</h2>
            <canvas id="distribusiChart" height="200"></canvas>
        </div>

        {{-- Modul Terpopuler (Bar) --}}
        <div class="bg-white rounded-2xl shadow-sm p-5">
            <h2 class="text-sm font-semibold text-[#033E8A] mb-4">Modul Terpopuler</h2>
            <canvas id="modulPopulerChart" height="200"></canvas>
        </div>

        {{-- Skor Rata-rata per Modul (Bar) --}}
        <div class="bg-white rounded-2xl shadow-sm p-5">
            <h2 class="text-sm font-semibold text-[#033E8A] mb-4">Skor Rata-rata per Modul</h2>
            <canvas id="skorRataChart" height="200"></canvas>
        </div>

    </div>

    {{-- Filter & Tabel Aktivitas --}}
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between flex-wrap gap-3">
            <div>
                <h2 class="text-sm font-semibold text-[#033E8A]">Laporan Aktivitas Terbaru</h2>
                <p class="text-xs text-gray-400 mt-0.5">Daftar aktivitas pengguna secara langsung.</p>
            </div>

            {{-- Form Filter --}}
            <form method="GET" action="{{ route('admin.reports.index') }}" class="flex items-center gap-2 flex-wrap">

                {{-- Filter Role --}}
                <select name="role" class="text-sm border border-gray-200 rounded-lg px-3 py-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-[#033E8A]">
                    <option value="all" {{ request('role') == 'all' || !request('role') ? 'selected' : '' }}>Semua Role</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="orang_tua" {{ request('role') == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                </select>

                {{-- Filter Periode --}}
                <select name="periode" class="text-sm border border-gray-200 rounded-lg px-3 py-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-[#033E8A]">
                    <option value="" {{ !request('periode') ? 'selected' : '' }}>Semua Waktu</option>
                    <option value="1hari" {{ request('periode') == '1hari' ? 'selected' : '' }}>1 Hari Terakhir</option>
                    <option value="1minggu" {{ request('periode') == '1minggu' ? 'selected' : '' }}>1 Minggu Terakhir</option>
                    <option value="1bulan" {{ request('periode') == '1bulan' ? 'selected' : '' }}>1 Bulan Terakhir</option>
                </select>

                {{-- Tombol Filter --}}
                <button type="submit" class="text-sm bg-[#033E8A] text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition">
                    Filter
                </button>

                {{-- Tombol Reset --}}
                <a href="{{ route('admin.reports.index') }}" class="text-sm bg-gray-100 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-200 transition">
                    Reset
                </a>

                {{-- Tombol Export --}}
                <a href="{{ route('admin.reports.export', ['role' => request('role'), 'periode' => request('periode')]) }}"
                   class="text-sm bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    Export Excel
                </a>

            </form>
        </div>

        <table class="w-full">
            <thead>
                <tr class="bg-[#033E8A]">
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">No</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Pengguna</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Role</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Aktivitas</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Tabel</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Keterangan</th>
                    <th class="text-white text-sm font-semibold px-6 py-4 text-left">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aktivitasTerbaru as $index => $log)
                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-[#033E8A]">
                        {{ $log->pengguna->nama ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-medium px-2.5 py-1 rounded-full
                            {{ ($log->pengguna->role ?? '') === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-orange-100 text-orange-700' }}">
                            {{ ($log->pengguna->role ?? '') === 'admin' ? 'Admin' : 'Orang Tua' }}
                        </span>
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
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $log->nama_tabel ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $log->deskripsi ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($log->dibuat_pada)->format('d M Y H:i') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-400">
                        Belum ada aktivitas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
</div>
@include('admin.reports.charts')
@endsection