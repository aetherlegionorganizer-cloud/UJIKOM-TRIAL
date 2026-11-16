@extends('layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3>Edit User</h3>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" name="nama" value="{{ old('nama', $user->nama) }}" />
              @error('nama') <div class="alert alert-secondary mt-2">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" value="{{ $user->username }}" disabled />
            </div>
            <div class="mb-3">
              <label class="form-label">Password Baru (Kosongkan jika tidak diubah)</label>
              <input type="password" class="form-control" name="password" />
            </div>
            <div class="mb-3">
              <label class="form-label">Role</label>
              <select class="form-control" name="role">
                <option value="peminjam" @selected($user->role == 'peminjam')>Peminjam</option>
                <option value="petugas" @selected($user->role == 'petugas')>Petugas</option>
                <option value="admin" @selected($user->role == 'admin')>Admin</option>
              </select>
              @error('role') <div class="alert alert-secondary mt-2">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">No. Telp</label>
              <input type="text" class="form-control" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" />
            </div>
            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <textarea class="form-control" name="alamat" rows="2">{{ old('alamat', $user->alamat) }}</textarea>
            </div>
            <button class="btn btn-dark" type="submit">Update</button>
            <a class="btn btn-outline-dark" href="{{ route('user.index') }}">Kembali ke User</a>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
