@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          @foreach ($cards as $card)
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box {{ $card['color'] }}">
              <div class="inner">
                <h3>{{ $card['value'] }}</h3>

                <p>{{ $card['label'] }}</p>
              </div>
              <div class="icon">
                <i class="{{ $card['icon'] }}"></i>
              </div>
              <a href="{{ $card['route'] }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          @endforeach
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $tableTitle }}</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      @foreach ($tableHeaders as $th)
                        <th>{{ $th }}</th>
                      @endforeach
                      <th style="width: 120px">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($tableRows as $row)
                      @php
                        $badge = match ($row['status']) {
                          'disetujui' => 'bg-success',
                          'menunggu' => 'bg-warning',
                          'selesai' => 'bg-info',
                          'ditolak' => 'bg-danger',
                          default => 'bg-secondary',
                        };
                      @endphp
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        @foreach ($row['cols'] as $col)
                          <td>{{ $col }}</td>
                        @endforeach
                        <td><span class="badge {{ $badge }}">{{ strtoupper($row['status']) }}</span></td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="{{ count($tableHeaders) + 2 }}" class="text-center">Belum ada data.</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

</div>
@endsection
