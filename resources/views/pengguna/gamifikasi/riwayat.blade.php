@extends('layouts.app')

@section('content')
    @include('layouts.headerPengguna')

    <div class="px-12 py-10 max-w-4xl mx-auto">

        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('pengguna.gamifikasi.index') }}"
               class="text-[#033E8A] hover:opacity-70">
                ← Kembali
            </a>
            <div>
                <h1 class="text-3xl font-bold text-[#033E8A]">Riwayat Transaksi</h1>
                <p class="text-gray-500">Semua aktivitas poin {{ $anak->nama_panggilan }}</p>
            </div>
        </div>

        {{-- RINGKASAN --}}
        <div class="grid grid-cols-3 gap-4 mb-8">
            <div class="bg-[#033E8A] text-white rounded-2xl p-5 text-center shadow">
                <p class="text-sm opacity-70">Saldo Poin</p>
                <p class="text-3xl font-bold mt-1">{{ number_format($anak->total_poin) }}</p>
            </div>
            <div class="bg-green-50 rounded-2xl p-5 text-center shadow">
                <p class="text-sm text-gray-500">Total Masuk</p>
                <p class="text-3xl font-bold text-green-600 mt-1">
                    +{{ number_format($riwayatTransaksi->where('tipe','kredit')->sum('jumlah_poin')) }}
                </p>
            </div>
            <div class="bg-red-50 rounded-2xl p-5 text-center shadow">
                <p class="text-sm text-gray-500">Total Keluar</p>
                <p class="text-3xl font-bold text-red-500 mt-1">
                    -{{ number_format($riwayatTransaksi->where('tipe','debit')->sum('jumlah_poin')) }}
                </p>
            </div>
        </div>

        {{-- TABEL TRANSAKSI --}}
        <div class="bg-white rounded-3xl shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-gray-600">Keterangan</th>
                        <th class="text-center px-6 py-4 text-sm font-semibold text-gray-600">Tipe</th>
                        <th class="text-right px-6 py-4 text-sm font-semibold text-gray-600">Poin</th>
                        <th class="text-right px-6 py-4 text-sm font-semibold text-gray-600">Saldo</th>
                        <th class="text-right px-6 py-4 text-sm font-semibold text-gray-600">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($riwayatTransaksi as $trx)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full flex items-center justify-center
                                        {{ $trx->tipe === 'kredit' ? 'bg-green-100' : 'bg-red-100' }}">
                                        {{ $trx->tipe === 'kredit' ? '⬆️' : '⬇️' }}
                                    </div>
                                    <span class="font-medium text-gray-700 text-sm">{{ $trx->keterangan }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-xs font-semibold px-3 py-1 rounded-full
                                    {{ $trx->tipe === 'kredit' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                    {{ $trx->tipe === 'kredit' ? 'Masuk' : 'Keluar' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-sm
                                {{ $trx->tipe === 'kredit' ? 'text-green-600' : 'text-red-500' }}">
                                {{ $trx->tipe === 'kredit' ? '+' : '-' }}{{ number_format($trx->jumlah_poin) }}
                            </td>
                            <td class="px-6 py-4 text-right text-sm text-gray-500 font-medium">
                                {{ number_format($trx->saldo_setelah) }}
                            </td>
                            <td class="px-6 py-4 text-right text-xs text-gray-400">
                                {{ $trx->created_at->format('d M Y, H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                Belum ada riwayat transaksi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- PAGINATION --}}
            @if($riwayatTransaksi->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $riwayatTransaksi->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection