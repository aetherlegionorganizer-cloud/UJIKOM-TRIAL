@extends('layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3>Daftar Alat Tersedia</h3>
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
                <th>Ajukan Peminjaman</th>
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
                    <form action="{{ route('peminjaman.ajukan.store') }}" method="POST" class="form-inline">
                      @csrf
                      <input type="hidden" name="alat_id" value="{{ $a->id }}">
                      <input type="number" name="jumlah" class="form-control form-control-sm mr-2" min="1" max="{{ $a->stok }}" value="1" style="width:70px;" required>
                      <input type="date" name="tgl_kembali_rencana" class="form-control form-control-sm mr-2" value="{{ now()->addDays(3)->toDateString() }}" required>
                      <button type="submit" class="btn btn-dark btn-sm"><i class="fas fa-paper-plane"></i> Pinjam</button>
                    </form>
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
