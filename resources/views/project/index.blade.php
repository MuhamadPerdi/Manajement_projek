@extends('layouts.apps')

@section('title', 'Project')

@section('header', 'Project')
@section('breadcrumb')
<div class="breadcrumb-item active"><a href="{{route('dashboard')}}">Dashboard</a></div>
<div class="breadcrumb-item">Client</div>
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      @if(Session::has('success'))
          <div class="alert alert-success" role="alert">
              {{ Session::get('success') }}
          </div>
      @endif
      @if(Session::has('error'))
          <div class="alert alert-danger" role="alert">
              {{ Session::get('error') }}
          </div>
      @endif
      <div class="card-body">
          <div style="float: left">
              <h6 class="card-title">Client</h6>
          </div>
        
          <div style="float: right;">
              <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">
                  <i class="fas fa-plus"></i> Tambah
              </a>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered" id="table">
              <thead>
            <tr>
                <th>Nama Proyek</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>{{ $project->name }}</td>
                <td>{{ $project->start_date }}</td>
                <td>{{ $project->end_date }}</td>
                <td>
                    <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
      </div>
    </div>
  </div>
</div>
@endsection





