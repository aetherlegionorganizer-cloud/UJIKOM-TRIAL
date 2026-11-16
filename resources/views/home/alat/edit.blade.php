@extends('layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3>Edit Alat</h3>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('alat.update', $alat->id) }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">Nama Alat</label>
              <input type="text" class="form-control" name="nama_alat" value="{{ old('nama_alat', $alat->nama_alat) }}" />
              @error('nama_alat') <div class="alert alert-secondary mt-2">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label class="form-label">Kategori</label>
              <select class="form-control" name="kategori_id">
                @foreach ($kategori as $k)
                  <option value="{{ $k->id }}" @selected($alat->kategori_id == $k->id)>{{ $k->nama_kategori }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Merk</label>
              <input type="text" class="form-control" name="merk" value="{{ old('merk', $alat->merk) }}" />
            </div>
            <div class="mb-3">
              <label class="form-label">Stok</label>
              <input type="number" class="form-control" name="stok" value="{{ old('stok', $alat->stok) }}" />
            </div>
            <div class="mb-3">
              <label class="form-label">Kondisi</label>
              <select class="form-control" name="kondisi">
                <option @selected($alat->kondisi == 'Baik')>Baik</option>
                <option @selected($alat->kondisi == 'Rusak Ringan')>Rusak Ringan</option>
                <option @selected($alat->kondisi == 'Rusak Berat')>Rusak Berat</option>
              </select>
            </div>
            <button class="btn btn-dark" type="submit">Update</button>
            <a class="btn btn-outline-dark" href="{{ route('alat.index') }}">Kembali ke Alat</a>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
