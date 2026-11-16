<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = User::latest()->paginate(15);

        return view('home.user.index', compact('user'));
    }

    public function create()
    {
        return view('home.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'username' => 'required|max:50|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,petugas,peminjam',
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil di simpan');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('home.user.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'role' => 'required|in:admin,petugas,peminjam',
        ]);

        $user = User::findOrFail($id);
        $data = [
            'nama' => $request->nama,
            'role' => $request->role,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
    }
}
