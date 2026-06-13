<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\ProgressAnak;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Grafik
        $distribusi = ProgressAnak::selectRaw('status, count(*) as total')
                        ->groupBy('status')
                        ->get();

        $modulPopuler = ProgressAnak::selectRaw('id_modul, count(*) as total')
                        ->with('modul')
                        ->groupBy('id_modul')
                        ->orderByDesc('total')
                        ->limit(5)
                        ->get();

        $skorRataModul = ProgressAnak::selectRaw('id_modul, avg(skor) as rata_skor')
                        ->with('modul')
                        ->groupBy('id_modul')
                        ->orderByDesc('rata_skor')
                        ->limit(5)
                        ->get();

        // Query aktivitas dengan filter
        $query = LogAktivitas::with('pengguna')->orderBy('dibuat_pada', 'desc');

        // Filter role
        if ($request->filled('role') && $request->role !== 'all') {
            $query->whereHas('pengguna', function ($q) use ($request) {
                $q->where('role', $request->role);
            });
        }

        // Filter periode
        if ($request->filled('periode')) {
            $query->where('dibuat_pada', '>=', match($request->periode) {
                '1hari'   => now()->subDay(),
                '1minggu' => now()->subWeek(),
                '1bulan'  => now()->subMonth(),
                default   => now()->subYear(),
            });
        }

        $aktivitasTerbaru = $query->get();

        return view('admin.reports.index', compact(
            'distribusi',
            'modulPopuler',
            'skorRataModul',
            'aktivitasTerbaru'
        ));
    }

    public function export(Request $request)
    {
        $query = LogAktivitas::with('pengguna')->orderBy('dibuat_pada', 'desc');

        if ($request->filled('role') && $request->role !== 'all') {
            $query->whereHas('pengguna', function ($q) use ($request) {
                $q->where('role', $request->role);
            });
        }

        if ($request->filled('periode')) {
            $query->where('dibuat_pada', '>=', match($request->periode) {
                '1hari'   => now()->subDay(),
                '1minggu' => now()->subWeek(),
                '1bulan'  => now()->subMonth(),
                default   => now()->subYear(),
            });
        }

        $logs = $query->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->fromArray(
            ['No', 'Pengguna', 'Role', 'Aktivitas', 'Tabel', 'Keterangan', 'Waktu'],
            null,
            'A1'
        );

        // Isi data
        foreach ($logs as $i => $log) {
            $sheet->fromArray([
                $i + 1,
                $log->pengguna->nama ?? '-',
                $log->pengguna->role ?? '-',
                ucfirst($log->aktivitas),
                $log->nama_tabel ?? '-',
                $log->deskripsi ?? '-',
                \Carbon\Carbon::parse($log->dibuat_pada)->format('d M Y H:i'),
            ], null, 'A' . ($i + 2));
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="laporan-aktivitas.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}