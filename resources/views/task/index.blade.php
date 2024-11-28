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
              <h6 class="card-title">Task</h6>
          </div>
        
          <div style="float: right;">
              <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">
                  <i class="fas fa-plus"></i> Tambah
              </a>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered" id="table">
              <thead>
            <tr>
                <th>Judul</th>
                <th>Proyek</th>
                <th>Tanggal Tenggat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->project->name }}</td>
                <td>{{ $task->due_date }}</td>
                <td>{{ $task->status }}</td>
                <td>
                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tasks->links() }}
</div>
@endsection