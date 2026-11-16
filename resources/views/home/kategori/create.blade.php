@extends('layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3>Tambah Kategori</h3>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">Nama Kategori</label>
              <input type="text" class="form-control" name="nama_kategori" value="{{ old('nama_kategori') }}" />
              @error('nama_kategori') <div class="alert alert-secondary mt-2">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Deskripsi</label>
              <textarea class="form-control" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
            </div>
            <button class="btn btn-dark" type="submit">Simpan</button>
            <a class="btn btn-outline-dark" href="{{ route('kategori.index') }}">Kembali ke Kategori</a>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
