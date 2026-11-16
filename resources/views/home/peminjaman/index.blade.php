@extends('layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3>Data Peminjaman</h3>
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
                <th>Tgl Pinjam</th>
                <th>Rencana Kembali</th>
                <th>Status</th>
                <th>Action</th>
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
                  <td>{{ $p->tgl_pinjam }}</td>
                  <td>{{ $p->tgl_kembali_rencana }}</td>
                  <td><span class="badge badge-secondary">{{ strtoupper($p->status) }}</span></td>
                  <td>
                    @if ($p->status === 'menunggu')
                      <form action="{{ route('peminjaman.setujui', $p->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-dark btn-sm"><i class="fas fa-check"></i> Setujui</button>
                      </form>
                    @endif
                    @if (auth()->user()->role === 'admin')
                      <a class="btn btn-outline-dark btn-sm" href="{{ route('peminjaman.destroy', $p->id) }}" onclick="return confirm('Yakin hapus data peminjaman?')"><i class="fas fa-trash"></i> Hapus</a>
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
