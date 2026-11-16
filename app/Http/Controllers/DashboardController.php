<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $cards = [
                [
                    'color' => 'bg-info',
                    'value' => Alat::count(),
                    'label' => 'Total Alat',
                    'icon' => 'fas fa-tools',
                    'route' => route('alat.index'),
                ],
                [
                    'color' => 'bg-success',
                    'value' => Peminjaman::where('status', 'disetujui')->count(),
                    'label' => 'Sedang Dipinjam',
                    'icon' => 'fas fa-clipboard-check',
                    'route' => route('peminjaman.index'),
                ],
                [
                    'color' => 'bg-warning',
                    'value' => Peminjaman::where('status', 'menunggu')->count(),
                    'label' => 'Menunggu ACC',
                    'icon' => 'fas fa-clock',
                    'route' => route('peminjaman.index'),
                ],
                [
                    'color' => 'bg-danger',
                    'value' => User::count(),
                    'label' => 'Total User',
                    'icon' => 'fas fa-users',
                    'route' => route('user.index'),
                ],
            ];
        } elseif ($user->role === 'petugas') {
            $cards = [
                [
                    'color' => 'bg-info',
                    'value' => Peminjaman::where('status', 'menunggu')->count(),
                    'label' => 'Menunggu ACC',
                    'icon' => 'fas fa-clock',
                    'route' => route('peminjaman.index'),
                ],
                [
                    'color' => 'bg-success',
                    'value' => Peminjaman::where('status', 'disetujui')->count(),
                    'label' => 'Sedang Dipinjam',
                    'icon' => 'fas fa-clipboard-list',
                    'route' => route('pengembalian.pantau'),
                ],
                [
                    'color' => 'bg-warning',
                    'value' => Pengembalian::count(),
                    'label' => 'Total Pengembalian',
                    'icon' => 'fas fa-undo',
                    'route' => route('pengembalian.index'),
                ],
                [
                    'color' => 'bg-danger',
                    'value' => 'Rp ' . number_format(Pengembalian::sum('total_denda')),
                    'label' => 'Total Denda',
                    'icon' => 'fas fa-money-bill-wave',
                    'route' => route('laporan.index'),
                ],
            ];
        } else {
            $cards = [
                [
                    'color' => 'bg-info',
                    'value' => Alat::where('stok', '>', 0)->count(),
                    'label' => 'Alat Tersedia',
                    'icon' => 'fas fa-tools',
                    'route' => route('peminjaman.katalog'),
                ],
                [
                    'color' => 'bg-success',
                    'value' => Peminjaman::where('user_id', $user->id)->where('status', 'disetujui')->count(),
                    'label' => 'Sedang Saya Pinjam',
                    'icon' => 'fas fa-clipboard-list',
                    'route' => route('peminjaman.saya'),
                ],
                [
                    'color' => 'bg-warning',
                    'value' => Peminjaman::where('user_id', $user->id)->where('status', 'menunggu')->count(),
                    'label' => 'Menunggu ACC',
                    'icon' => 'fas fa-clock',
                    'route' => route('peminjaman.saya'),
                ],
                [
                    'color' => 'bg-danger',
                    'value' => 'Rp ' . number_format(Pengembalian::where('user_id', $user->id)->sum('total_denda')),
                    'label' => 'Total Denda Saya',
                    'icon' => 'fas fa-money-bill-wave',
                    'route' => route('peminjaman.saya'),
                ],
            ];
        }

        return view('home.dashboard', compact('cards'));
    }
}
