@extends('layouts.apps')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Selamat Datang, {{ Auth::user()->name }}</h1>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Proyek</h5>
                    <p class="card-text display-4">{{ $projectCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Tugas</h5>
                    <p class="card-text display-4">{{ $taskCount }}</p>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection