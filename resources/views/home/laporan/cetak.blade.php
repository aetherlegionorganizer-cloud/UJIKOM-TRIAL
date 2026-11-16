@extends('layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <h3>Laporan Peminjaman &amp; Pengembalian Alat</h3>
      <button onclick="window.print()" class="btn btn-dark btn-sm d-print-none"><i class="fas fa-print"></i> Cetak Laporan</button>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Kode Pinjam</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Total Denda</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($laporans as $l)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $l->kode_peminjaman }}</td>
                  <td>{{ $l->user->nama ?? '-' }}</td>
                  <td>{{ $l->alat->nama_alat ?? '-' }}</td>
                  <td>{{ $l->jumlah }}</td>
                  <td>{{ $l->tgl_pinjam }}</td>
                  <td>{{ $l->pengembalian->tgl_kembali_real ?? '-' }}</td>
                  <td>{{ strtoupper($l->status) }}</td>
                  <td>Rp {{ number_format($l->pengembalian->total_denda ?? 0) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
