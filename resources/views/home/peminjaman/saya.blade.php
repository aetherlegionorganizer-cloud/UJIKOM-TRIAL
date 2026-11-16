@extends('layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3>Peminjaman Saya</h3>
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
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tgl Pinjam</th>
                <th>Rencana Kembali</th>
                <th>Status</th>
                <th>Total Denda</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($peminjaman as $p)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $p->kode_peminjaman }}</td>
                  <td>{{ $p->alat->nama_alat ?? '-' }}</td>
                  <td>{{ $p->jumlah }}</td>
                  <td>{{ $p->tgl_pinjam }}</td>
                  <td>{{ $p->tgl_kembali_rencana }}</td>
                  <td><span class="badge badge-secondary">{{ strtoupper($p->status) }}</span></td>
                  <td>Rp {{ number_format($p->pengembalian->total_denda ?? 0) }}</td>
                  <td>
                    @if ($p->status === 'disetujui')
                      <form action="{{ route('peminjaman.kembalikan', $p->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-dark btn-sm" onclick="return confirm('Ajukan pengembalian alat ini?')"><i class="fas fa-undo"></i> Kembalikan</button>
                      </form>
                    @else
                      -
                    @endif
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
