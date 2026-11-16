<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pengembalian::with(['peminjaman.alat', 'user'])->latest()->paginate(15);

        return view('home.pengembalian.index', compact('pengembalian'));
    }

    public function pantau()
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])
            ->where('status', 'disetujui')
            ->latest()
            ->paginate(15);

        return view('home.pengembalian.pantau', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required',
            'tgl_kembali_real' => 'required|date',
            'kondisi_alat' => 'required',
        ]);

        DB::beginTransaction();
        try {
            Peminjaman::where('id', $request->peminjaman_id)->where('status', 'disetujui')->firstOrFail();

            DB::statement('CALL sp_kembalikan_alat(?, ?, ?, ?, ?, @total_denda)', [
                $request->peminjaman_id,
                Auth::id(),
                $request->tgl_kembali_real,
                $request->kondisi_alat,
                (float) ($request->denda_kerusakan ?? 0),
            ]);

            $hasil = DB::select('SELECT @total_denda AS total');
            DB::commit();

            return redirect()->route('pengembalian.index')->with('success', 'Pengembalian selesai! Total Denda: Rp ' . number_format($hasil[0]->total));
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Transaksi dibatalkan (Rollback): ' . $e->getMessage());
        }
    }

    public function peminjamKembalikan(string $id)
    {
        DB::beginTransaction();
        try {
            $pinjam = Peminjaman::where('id', $id)->where('user_id', Auth::id())->where('status', 'disetujui')->firstOrFail();

            DB::statement("CALL sp_kembalikan_alat(?, NULL, ?, 'Baik', 0, @total_denda)", [
                $pinjam->id,
                now()->toDateString(),
            ]);

            DB::commit();

            return redirect()->route('peminjaman.saya')->with('success', 'Alat berhasil dikembalikan!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        Pengembalian::findOrFail($id)->delete();

        return redirect()->route('pengembalian.index')->with('success', 'Data pengembalian berhasil dihapus');
    }
}
