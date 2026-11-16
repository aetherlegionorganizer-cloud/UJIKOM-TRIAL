<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $alat = Alat::with('kategori')->latest()->paginate(15);

        return view('home.alat.index', compact('alat'));
    }

    public function create()
    {
        $kategori = Kategori::all();

        return view('home.alat.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_alat' => 'required|unique:alats',
            'nama_alat' => 'required|max:150',
            'kategori_id' => 'required',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required',
        ]);

        Alat::create([
            'kode_alat' => $request->kode_alat,
            'nama_alat' => $request->nama_alat,
            'kategori_id' => $request->kategori_id,
            'merk' => $request->merk,
            'stok' => $request->stok,
            'kondisi' => $request->kondisi,
        ]);

        return redirect()->route('alat.index')->with('success', 'Alat berhasil di simpan');
    }

    public function edit(string $id)
    {
        $kategori = Kategori::all();
        $alat = Alat::findOrFail($id);

        return view('home.alat.edit', compact('alat', 'kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_alat' => 'required|max:150',
            'kategori_id' => 'required',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required',
        ]);

        $alat = Alat::findOrFail($id);
        $alat->update([
            'nama_alat' => $request->nama_alat,
            'kategori_id' => $request->kategori_id,
            'merk' => $request->merk,
            'stok' => $request->stok,
            'kondisi' => $request->kondisi,
        ]);

        return redirect()->route('alat.index')->with('success', 'Alat berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('alat.index')->with('success', 'Alat berhasil dihapus');
    }
}
