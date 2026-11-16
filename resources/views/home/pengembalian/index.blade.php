@extends('layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3>
        Data Pengembalian
        <a class="btn btn-outline-dark btn-sm" href="{{ route('pengembalian.pantau') }}"><i class="fas fa-eye"></i> Pantau Alat Dipinjam</a>
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
                <th>Kode Kembali</th>
                <th>Kode Pinjam</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Tgl Kembali</th>
                <th>Telat</th>
                <th>Kondisi</th>
                <th>Total Denda</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pengembalian as $pg)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $pg->kode_pengembalian }}</td>
                  <td>{{ $pg->peminjaman->kode_peminjaman ?? '-' }}</td>
                  <td>{{ $pg->user->nama ?? '-' }}</td>
                  <td>{{ $pg->peminjaman->alat->nama_alat ?? '-' }}</td>
                  <td>{{ $pg->tgl_kembali_real }}</td>
                  <td>{{ $pg->terlambat_hari }} hari</td>
                  <td>{{ $pg->kondisi_alat }}</td>
                  <td>Rp {{ number_format($pg->total_denda) }}</td>
                  <td>
                    @if (auth()->user()->role === 'admin')
                      <a class="btn btn-dark btn-sm" href="{{ route('pengembalian.destroy', $pg->id) }}" onclick="return confirm('Yakin hapus data pengembalian?')"><i class="fas fa-trash"></i> Hapus</a>
                    @else
                      -
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="mt-3">{{ $pengembalian->links() }}</div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
