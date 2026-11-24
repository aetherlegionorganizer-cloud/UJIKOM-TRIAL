@extends('layouts.master')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h3>Log Aktivitas</h3>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Waktu</th>
                <th>User</th>
                <th>Role</th>
                <th>Aktivitas</th>
                <th>IP</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($logs as $log)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $log->created_at }}</td>
                  <td>{{ $log->nama_user ?? '-' }}</td>
                  <td>{{ strtoupper($log->role ?? '-') }}</td>
                  <td>{{ $log->aktivitas }}</td>
                  <td>{{ $log->ip_address ?? '-' }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center">Belum ada log aktivitas.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <div class="mt-3">{{ $logs->links() }}</div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
