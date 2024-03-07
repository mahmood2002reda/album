@extends('layouts.app')

@section('content')
<style>
    .card:hover {
        transform: scale(1.05);
        transition: transform .3s ease-in-out;
    }
    .btn-outline-custom {
        border-color: #007bff; /* Primary color */
        color: #007bff;
    }
    .btn-outline-custom:hover {
        background-color: #007bff;
        color: #fff;
    }
    .back-to-home {
        margin-top: 20px;
    }
</style>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-4">
        @foreach ($albums as $album)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('images/album/'.$album->image) }}" class="card-img-top" alt="Album Image" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $album->name }}</h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('album.details', $album->id) }}" class="btn btn-outline-custom"><i class="bi bi-info-circle me-1"></i> Details</a>
                            <a href="#" class="btn btn-outline-danger" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this album?')) document.getElementById('delete-album-form-{{ $album->id }}').submit();">
                                <i class="bi bi-trash me-1"></i> Delete
                            </a>
                            <a href="{{ route('album.edit', $album->id) }}" class="btn btn-outline-secondary"><i class="bi bi-pencil me-1"></i> Edit</a>
                        </div>
                    </div>
                </div>
                <form id="delete-album-form-{{ $album->id }}" action="{{ route('album.delete', $album->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        @endforeach
    </div>
    <div class="back-to-home">
        <a href="{{ route('home') }}" class="btn btn-outline-custom">Back to Home</a>
    </div>
</div>
@endsection
