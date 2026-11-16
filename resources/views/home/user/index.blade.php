@extends('layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3>
        Tabel User
        <a class="btn btn-dark btn-sm" href="{{ route('user.create') }}"><i class="fas fa-plus"></i> Tambah User</a>
      </h3>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <table id="example1" class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>No. Telp</th>
                <th>Alamat</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($user as $u)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $u->nama }}</td>
                  <td>{{ $u->username }}</td>
                  <td>{{ strtoupper($u->role) }}</td>
                  <td>{{ $u->no_telp ?? '-' }}</td>
                  <td>{{ $u->alamat ?? '-' }}</td>
                  <td>
                    <a class="btn btn-outline-dark btn-sm" href="{{ route('user.edit', $u->id) }}"><i class="fas fa-edit"></i> Edit</a>
                    @if ($u->id !== auth()->id())
                      <a class="btn btn-dark btn-sm" href="{{ route('user.destroy', $u->id) }}" onclick="return confirm('Yakin user mau dihapus ?')"><i class="fas fa-trash"></i> Hapus</a>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="mt-3">{{ $user->links() }}</div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
