<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\KasEntry;
use App\Models\Expense;
use Barryvdh\DomPDF\Facade\Pdf;

class KasController extends Controller
{
    public function index(Request $request)
    {
        $bulanDipilih = (int) $request->get('bulan', date('n'));
        $tahunDipilih = (int) $request->get('tahun', date('Y'));

        $students = Student::with(['kasEntries' => function ($query) use ($bulanDipilih, $tahunDipilih) {
            $query->where('bulan', $bulanDipilih)->where('tahun', $tahunDipilih);
        }])->orderBy('nama', 'asc')->get();

        $jumlahLunas = $students->filter(function ($s) {
            return $s->kasEntries->count() >= 4;
        })->count();
        $jumlahBelumLunas = $students->count() - $jumlahLunas;

        $totalPemasukan = (float) KasEntry::sum('jumlah');
        $totalPengeluaran = (float) Expense::sum('jumlah');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        $daftarPengeluaran = Expense::orderBy('tanggal', 'desc')->take(10)->get();

        return view('kas.index', compact(
            'students',
            'bulanDipilih',
            'tahunDipilih',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas',
            'daftarPengeluaran',
            'jumlahLunas',
            'jumlahBelumLunas'
        ));
    }

    public function bayarMingguan(Request $request)
    {
        KasEntry::firstOrCreate(
            [
                'student_id' => (int) $request->student_id,
                'minggu_ke'  => (int) $request->minggu_ke,
                'bulan'      => (int) $request->bulan,
                'tahun'      => (int) $request->tahun,
            ],
            [
                'jumlah'        => 5000,
                'tanggal_bayar' => now()->toDateString(),
            ]
        );

        return back()->with('success', 'Pembayaran kas Rp5.000 berhasil disimpan.');
    }

    public function bayarBulanan(Request $request)
    {
        $studentId = (int) $request->student_id;
        $bulan     = (int) $request->bulan;
        $tahun     = (int) $request->tahun;

        for ($w = 1; $w <= 4; $w++) {
            KasEntry::firstOrCreate(
                [
                    'student_id' => $studentId,
                    'minggu_ke'  => $w,
                    'bulan'      => $bulan,
                    'tahun'      => $tahun,
                ],
                [
                    'jumlah'        => 5000,
                    'tanggal_bayar' => now()->toDateString(),
                ]
            );
        }

        return back()->with('success', 'Pembayaran kas 1 bulan (Rp20.000) berhasil dicatat lunas.');
    }

    public function storeExpense(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string|max:255',
            'jumlah'    => 'required|numeric|min:500',
            'tanggal'   => 'required|date',
        ]);

        Expense::create([
            'deskripsi' => $request->deskripsi,
            'jumlah'    => $request->jumlah,
            'tanggal'   => $request->tanggal,
            'kategori'  => $request->kategori ?? 'Operasional Kelas',
        ]);

        return back()->with('success', 'Catatan pengeluaran kas berhasil disimpan.');
    }

    public function batalBayar($id)
    {
        $kas = KasEntry::findOrFail($id);
        $kas->delete();

        return back()->with('success', 'Pembayaran kas berhasil dibatalkan.');
    }

    // Hanya Wali Kelas yang boleh menghapus catatan pengeluaran belanja
    public function destroyExpense($id)
    {
        if (Auth::user()->role !== 'walas') {
            return back()->withErrors(['Akses ditolak: Hanya Wali Kelas yang memiliki wewenang menghapus catatan pengeluaran.']);
        }

        $expense = Expense::findOrFail($id);
        $expense->delete();

        return back()->with('success', 'Catatan pengeluaran berhasil dihapus oleh Wali Kelas.');
    }

    public function cetakLaporan(Request $request)
    {
        $bulanDipilih = (int) $request->get('bulan', date('n'));
        $tahunDipilih = (int) $request->get('tahun', date('Y'));
        $bendahara = $request->get('bendahara', 'Cinta Putri Aypal');

        $students = Student::with(['kasEntries' => function ($query) use ($bulanDipilih, $tahunDipilih) {
            $query->where('bulan', $bulanDipilih)->where('tahun', $tahunDipilih);
        }])->orderBy('nama', 'asc')->get();

        $totalPemasukanBulanIni = (float) KasEntry::where('bulan', $bulanDipilih)
            ->where('tahun', $tahunDipilih)
            ->sum('jumlah');

        $pengeluaranBulanIni = Expense::whereMonth('tanggal', $bulanDipilih)
            ->whereYear('tanggal', $tahunDipilih)
            ->orderBy('tanggal', 'asc')
            ->get();

        $totalPengeluaranBulanIni = (float) $pengeluaranBulanIni->sum('jumlah');

        $totalPemasukanSemua = (float) KasEntry::sum('jumlah');
        $totalPengeluaranSemua = (float) Expense::sum('jumlah');
        $saldoKas = $totalPemasukanSemua - $totalPengeluaranSemua;

        return view('kas.cetak', compact(
            'students',
            'bulanDipilih',
            'tahunDipilih',
            'totalPemasukanBulanIni',
            'pengeluaranBulanIni',
            'totalPengeluaranBulanIni',
            'saldoKas',
            'bendahara'
        ));
    }

    public function downloadPdf(Request $request)
    {
        $bulanDipilih = (int) $request->get('bulan', date('n'));
        $tahunDipilih = (int) $request->get('tahun', date('Y'));
        $bendahara = $request->get('bendahara', 'Cinta Putri Aypal');

        $students = Student::with(['kasEntries' => function ($query) use ($bulanDipilih, $tahunDipilih) {
            $query->where('bulan', $bulanDipilih)->where('tahun', $tahunDipilih);
        }])->orderBy('nama', 'asc')->get();

        $totalPemasukanBulanIni = (float) KasEntry::where('bulan', $bulanDipilih)
            ->where('tahun', $tahunDipilih)
            ->sum('jumlah');

        $pengeluaranBulanIni = Expense::whereMonth('tanggal', $bulanDipilih)
            ->whereYear('tanggal', $tahunDipilih)
            ->orderBy('tanggal', 'asc')
            ->get();

        $totalPengeluaranBulanIni = (float) $pengeluaranBulanIni->sum('jumlah');

        $totalPemasukanSemua = (float) KasEntry::sum('jumlah');
        $totalPengeluaranSemua = (float) Expense::sum('jumlah');
        $saldoKas = $totalPemasukanSemua - $totalPengeluaranSemua;

        $namaBulan = \Carbon\Carbon::create()->month($bulanDipilih)->translatedFormat('F');
        $namaFile = "Laporan_Kas_VIIIB_{$namaBulan}_{$tahunDipilih}.pdf";

        $pdf = Pdf::loadView('kas.cetak', compact(
            'students',
            'bulanDipilih',
            'tahunDipilih',
            'totalPemasukanBulanIni',
            'pengeluaranBulanIni',
            'totalPengeluaranBulanIni',
            'saldoKas',
            'bendahara'
        ))->setPaper('a4', 'portrait');

        return $pdf->download($namaFile);
    }

    public function rekapTahunan(Request $request)
    {
        $tahunDipilih = (int) $request->get('tahun', date('Y'));

        $students = Student::with(['kasEntries' => function ($query) use ($tahunDipilih) {
            $query->where('tahun', $tahunDipilih);
        }])->orderBy('nama', 'asc')->get();

        $totalPemasukanTahun = (float) KasEntry::where('tahun', $tahunDipilih)->sum('jumlah');
        $totalPengeluaranTahun = (float) Expense::whereYear('tanggal', $tahunDipilih)->sum('jumlah');
        $saldoTahun = $totalPemasukanTahun - $totalPengeluaranTahun;

        $chartPemasukan = [];
        $chartPengeluaran = [];
        for ($m = 1; $m <= 12; $m++) {
            $chartPemasukan[] = (float) KasEntry::where('tahun', $tahunDipilih)->where('bulan', $m)->sum('jumlah');
            $chartPengeluaran[] = (float) Expense::whereYear('tanggal', $tahunDipilih)->whereMonth('tanggal', $m)->sum('jumlah');
        }

        $kategoriExpenses = Expense::whereYear('tanggal', $tahunDipilih)
            ->selectRaw('kategori, sum(jumlah) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        return view('kas.tahunan', compact(
            'students', 
            'tahunDipilih', 
            'totalPemasukanTahun', 
            'totalPengeluaranTahun', 
            'saldoTahun',
            'chartPemasukan',
            'chartPengeluaran',
            'kategoriExpenses'
        ));
    }

    // Hanya Wali Kelas yang boleh mengunduh backup data kas
    public function backupData()
    {
        if (Auth::user()->role !== 'walas') {
            abort(403, 'Akses ditolak: Hanya Wali Kelas yang diizinkan mengunduh file cadangan database.');
        }

        $data = [
            'backup_date' => now()->toDateTimeString(),
            'students'    => Student::all(),
            'kas_entries' => KasEntry::all(),
            'expenses'    => Expense::all(),
        ];

        $filename = "backup_kas_VIIIB_" . date('Y-m-d_His') . ".json";

        return response()->streamDownload(function () use ($data) {
            echo json_encode($data, JSON_PRETTY_PRINT);
        }, $filename, [
            'Content-Type' => 'application/json',
        ]);
    }
}