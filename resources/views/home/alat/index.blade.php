@extends('layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3>
        Tabel Alat
        <a class="btn btn-dark btn-sm" href="{{ route('alat.create') }}"><i class="fas fa-plus"></i> Tambah Alat</a>
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
                <th>Kode</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Kondisi</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($alat as $a)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $a->kode_alat }}</td>
                  <td>{{ $a->nama_alat }}</td>
                  <td>{{ $a->kategori->nama_kategori ?? '-' }}</td>
                  <td>{{ $a->stok }}</td>
                  <td>{{ $a->kondisi }}</td>
                  <td>
                    <a class="btn btn-outline-dark btn-sm" href="{{ route('alat.edit', $a->id) }}"><i class="fas fa-edit"></i> Edit</a>
                    <a class="btn btn-dark btn-sm" href="{{ route('alat.destroy', $a->id) }}" onclick="return confirm('Yakin alat mau dihapus ?')"><i class="fas fa-trash"></i> Hapus</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="mt-3">{{ $alat->links() }}</div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
