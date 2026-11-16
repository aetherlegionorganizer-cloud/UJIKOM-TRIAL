@extends('layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3>
        Tabel Kategori
        <a class="btn btn-dark btn-sm" href="{{ route('kategori.create') }}"><i class="fas fa-plus"></i> Tambah Kategori</a>
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
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($kategori as $k)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $k->nama_kategori }}</td>
                  <td>{{ $k->deskripsi ?? '-' }}</td>
                  <td>
                    <a class="btn btn-outline-dark btn-sm" href="{{ route('kategori.edit', $k->id) }}"><i class="fas fa-edit"></i> Edit</a>
                    <a class="btn btn-dark btn-sm" href="{{ route('kategori.destroy', $k->id) }}" onclick="return confirm('Yakin kategori mau dihapus ?')"><i class="fas fa-trash"></i> Hapus</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="mt-3">{{ $kategori->links() }}</div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
