@extends('layouts.apps')

@section('title', 'Edit Project')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Project</h3>
                </div>
                <div class="card-body">
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
    <form action="{{ route('projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama Proyek</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $project->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi Proyek</label>
            <textarea class="form-control" id="description" name="deskripsi">{{ $project->deskripsi }}</textarea>
        </div>
        <div class="form-group">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $project->start_date }}">
        </div>
        <div class="form-group">
            <label for="end_date">Tanggal Selesai</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $project->end_date }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
            </div>
        </div>
    </div>
</div> 
@endsection