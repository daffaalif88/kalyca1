<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data pemasukan & pengeluaran, urutkan berdasarkan tanggal
        $pemasukan = Pemasukan::orderBy('tanggal', 'asc')->get();
        $pengeluaran = Pengeluaran::orderBy('tanggal', 'asc')->get();

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

        return view('home.index', compact('labels', 'dataPemasukan', 'dataPengeluaran', 'pemasukan', 'pengeluaran'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
