@extends('layouts.apps')

@section('title', 'Create Client')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Create Project</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div style="color: red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Proyek</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi Proyek</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
        </div>
        <div class="form-group">
            <label for="start_date">Tanggal Mulai</label>
            <input type="date" class="form-control" id="start_date" name="start_date">
        </div>
        <div class="form-group">
            <label for="end_date">Tanggal Selesai</label>
            <input type="date" class="form-control" id="end_date" name="end_date">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
            </div>
        </div>
    </div>
</div>
@endsection
