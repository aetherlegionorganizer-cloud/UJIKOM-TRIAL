<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])->latest()->paginate(15);

        return view('home.peminjaman.index', compact('peminjaman'));
    }

    public function katalog()
    {
        $alat = Alat::with('kategori')->where('stok', '>', 0)->latest()->paginate(15);

        return view('home.peminjaman.katalog', compact('alat'));
    }

    public function riwayatSaya()
    {
        $peminjaman = Peminjaman::with(['alat', 'pengembalian'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(15);

        return view('home.peminjaman.saya', compact('peminjaman'));
    }

    public function ajukanStore(Request $request)
    {
        $request->validate([
            'alat_id' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'tgl_kembali_rencana' => 'required|date',
        ]);

        $alat = Alat::findOrFail($request->alat_id);
        if ($alat->stok < $request->jumlah) {
            return redirect()->route('peminjaman.katalog')->with('error', 'Stok alat tidak mencukupi!');
        }

        Peminjaman::create([
            'kode_peminjaman' => 'PJ-' . time(),
            'user_id' => Auth::id(),
            'alat_id' => $alat->id,
            'jumlah' => $request->jumlah,
            'tgl_pinjam' => now()->toDateString(),
            'tgl_kembali_rencana' => $request->tgl_kembali_rencana,
            'status' => 'menunggu',
        ]);

        return redirect()->route('peminjaman.saya')->with('success', 'Pengajuan peminjaman berhasil dikirim');
    }

    public function setujui(string $id)
    {
        DB::beginTransaction();
        try {
            $pinjam = Peminjaman::findOrFail($id);
            $pinjam->update(['status' => 'disetujui', 'petugas_id' => Auth::id()]);
            DB::commit();

            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman disetujui & stok berkurang');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('peminjaman.index')->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        Peminjaman::findOrFail($id)->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus');
    }
}
