<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Peminjaman::with(['user', 'alat', 'pengembalian'])->latest()->get();

        return view('home.laporan.cetak', compact('laporans'));
    }

    public function cetak()
    {
        $laporans = Peminjaman::with(['user', 'alat', 'pengembalian'])->latest()->get();

        return view('home.laporan.cetak', compact('laporans'));
    }
}
