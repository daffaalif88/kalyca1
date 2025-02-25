<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pemasukan = Pemasukan::all();
        return view('pemasukan.index')
            ->with('pemasukan', $pemasukan);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pemasukan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $pemasukan = new Pemasukan();
        $pemasukan->tanggal = $request->tanggal;
        $pemasukan->nominal = $request->nominal;
        $pemasukan->keterangan = $request->keterangan;
        $pemasukan->save();

        return redirect()->route('pemasukan.index')
            ->with('success', 'Pemasukan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Pastikan user dengan ID yang diberikan ada
        if (!auth()->check() || auth()->user()->id != $id) {
            abort(403, 'Unauthorized action.');
        }

        // Ambil semua data pemasukan & pengeluaran berdasarkan ID
        $pemasukan = Pemasukan::where('user_id', $id)->orderBy('tanggal', 'asc')->get();
        $pengeluaran = Pengeluaran::where('user_id', $id)->orderBy('tanggal', 'asc')->get();

        // Load view PDF dan kirim data pemasukan & pengeluaran
        $pdf = Pdf::loadView('pdf.keuangan', compact('pemasukan', 'pengeluaran'))->setPaper('A4', 'portrait');

        // Download PDF dengan nama file 'laporan-keuangan.pdf'
        return $pdf->download('laporan-keuangan.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $pemasukan = Pemasukan::find($id);
        return view('pemasukan.edit')
            ->with('pemasukan', $pemasukan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $pemasukan = Pemasukan::find($id);
        $pemasukan->tanggal = $request->tanggal;
        $pemasukan->nominal = $request->nominal;
        $pemasukan->keterangan = $request->keterangan;
        $pemasukan->save();

        return redirect()->route('pemasukan.index')
            ->with('success', 'Pemasukan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pemasukan = Pemasukan::find($id);
        $pemasukan->delete();

        return redirect()->route('pemasukan.index')
            ->with('success', 'Pemasukan berhasil dihapus');
    }
}
