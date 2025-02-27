<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data pemasukan
        $pemasukan = Pemasukan::select('tanggal', 'nominal', 'keterangan')
            ->get()
            ->map(function ($item) {
                return [
                    'tanggal' => Carbon::parse($item->tanggal)->format('Y-m-d'),
                    'nominal' => $item->nominal,
                    'keterangan' => $item->keterangan
                ];
            });

        // Ambil data pengeluaran
        $pengeluaran = Pengeluaran::select('tanggal', 'nominal', 'keterangan')
            ->get()
            ->map(function ($item) {
                return [
                    'tanggal' => Carbon::parse($item->tanggal)->format('Y-m-d'),
                    'nominal' => -abs($item->nominal), // Buat negatif
                    'keterangan' => $item->keterangan
                ];
            });

        // Gabungkan data pemasukan & pengeluaran
        $transaksi = collect($pemasukan)->merge($pengeluaran)->sortBy('tanggal')->values();

        return view('home.index', compact('transaksi'));
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
