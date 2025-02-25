<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        // Ambil tanggal awal dan akhir bulan jika tidak ada input dari request
        $tgl1 = $request->tgl1 ?? date('Y-m-01');
        $tgl2 = $request->tgl2 ?? date('Y-m-t');

        // Ambil data pemasukan & pengeluaran berdasarkan rentang tanggal
        $pemasukan = Pemasukan::whereBetween('tanggal', [$tgl1, $tgl2])->orderBy('tanggal', 'asc')->get();
        $pengeluaran = Pengeluaran::whereBetween('tanggal', [$tgl1, $tgl2])->orderBy('tanggal', 'asc')->get();

        // Gabungkan tanggal unik dari pemasukan & pengeluaran
        $allDates = $pemasukan->pluck('tanggal')->merge($pengeluaran->pluck('tanggal'))->unique()->sort();

        $labels = [];  // Tanggal
        $dataPemasukan = [];
        $dataPengeluaran = [];

        foreach ($allDates as $tanggal) {
            $labels[] = date('d M Y', strtotime($tanggal));

            // Pastikan nilai dalam bentuk angka (integer/float)
            $totalPemasukan = (int) $pemasukan->where('tanggal', $tanggal)->sum('nominal');
            $totalPengeluaran = (int) $pengeluaran->where('tanggal', $tanggal)->sum('nominal');

            $dataPemasukan[] = $totalPemasukan;
            $dataPengeluaran[] = $totalPengeluaran;
        }
        return view('laporan.index', compact('labels', 'dataPemasukan', 'dataPengeluaran', 'pemasukan', 'pengeluaran', 'tgl1', 'tgl2'));
    }

    public function print(Request $request)
    {
        $tgl1 = $request->tgl1 ?? date('Y-m-01');
        $tgl2 = $request->tgl2 ?? date('Y-m-t');

        // Ambil data pemasukan dan pengeluaran berdasarkan rentang tanggal
        $pemasukan = Pemasukan::whereBetween('tanggal', [$tgl1, $tgl2])->orderBy('tanggal', 'asc')->get();
        $pengeluaran = Pengeluaran::whereBetween('tanggal', [$tgl1, $tgl2])->orderBy('tanggal', 'asc')->get();

        // Gabungkan data pemasukan & pengeluaran
        $transaksi = collect([...$pemasukan, ...$pengeluaran])->sortBy('tanggal');

        // Load view ke dalam PDF
        $pdf = Pdf::loadView('laporan.print', compact('transaksi', 'tgl1', 'tgl2'));

        // Download file PDF
        return $pdf->stream('laporan_keuangan.pdf');
    }
}
