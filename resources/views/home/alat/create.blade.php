@extends('layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3>Tambah Alat</h3>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('alat.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">Kode Alat</label>
              <input type="text" class="form-control" name="kode_alat" value="{{ old('kode_alat') }}" />
              @error('kode_alat') <div class="alert alert-secondary mt-2">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Nama Alat</label>
              <input type="text" class="form-control" name="nama_alat" value="{{ old('nama_alat') }}" />
              @error('nama_alat') <div class="alert alert-secondary mt-2">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Kategori</label>
              <select class="form-control" name="kategori_id">
                <option value="">Pilih Kategori</option>
                @foreach ($kategori as $k)
                  <option value="{{ $k->id }}" @selected(old('kategori_id') == $k->id)>{{ $k->nama_kategori }}</option>
                @endforeach
              </select>
              @error('kategori_id') <div class="alert alert-secondary mt-2">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Merk</label>
              <input type="text" class="form-control" name="merk" value="{{ old('merk') }}" />
            </div>
            <div class="mb-3">
              <label class="form-label">Stok</label>
              <input type="number" class="form-control" name="stok" value="{{ old('stok', 1) }}" />
            </div>
            <div class="mb-3">
              <label class="form-label">Kondisi</label>
              <select class="form-control" name="kondisi">
                <option>Baik</option>
                <option>Rusak Ringan</option>
                <option>Rusak Berat</option>
              </select>
            </div>
            <button class="btn btn-dark" type="submit">Simpan</button>
            <a class="btn btn-outline-dark" href="{{ route('alat.index') }}">Kembali ke Alat</a>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
