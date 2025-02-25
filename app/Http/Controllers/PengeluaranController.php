<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pengeluaran = Pengeluaran::all();
        return view('pengeluaran.index')
            ->with('pengeluaran', $pengeluaran);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pengeluaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $pengeluaran = new Pengeluaran();
        $pengeluaran->tanggal = $request->tanggal;
        $pengeluaran->nominal = $request->nominal;
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->save();

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pemasukan berhasil ditambahkan');
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
        $pengeluaran = Pengeluaran::find($id);
        return view('pengeluaran.edit')
            ->with('pengeluaran', $pengeluaran);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->tanggal = $request->tanggal;
        $pengeluaran->nominal = $request->nominal;
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->save();

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pemasukan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();
        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil dihapus!');
    }
}
