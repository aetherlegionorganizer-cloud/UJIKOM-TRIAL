@extends('layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3>Pantau Alat Sedang Dipinjam &amp; Proses Pengembalian</h3>
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
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Batas Kembali</th>
                <th>Proses Pengembalian</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($peminjaman as $p)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $p->kode_peminjaman }}</td>
                  <td>{{ $p->user->nama ?? '-' }}</td>
                  <td>{{ $p->alat->nama_alat ?? '-' }}</td>
                  <td>{{ $p->jumlah }}</td>
                  <td>{{ $p->tgl_kembali_rencana }}</td>
                  <td>
                    <form action="{{ route('pengembalian.store') }}" method="POST" class="form-inline">
                      @csrf
                      <input type="hidden" name="peminjaman_id" value="{{ $p->id }}">
                      <input type="date" name="tgl_kembali_real" class="form-control form-control-sm mr-1" value="{{ now()->toDateString() }}" required>
                      <select name="kondisi_alat" class="form-control form-control-sm mr-1">
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                        <option value="Hilang">Hilang</option>
                      </select>
                      <input type="number" name="denda_kerusakan" class="form-control form-control-sm mr-1" value="0" min="0" placeholder="Denda Kerusakan" style="width:120px;">
                      <button type="submit" class="btn btn-dark btn-sm"><i class="fas fa-check"></i> Selesaikan</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          <div class="mt-3">{{ $peminjaman->links() }}</div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
