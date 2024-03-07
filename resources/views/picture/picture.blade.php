@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f4f7f6; /* Light background for contrast */
    }
    .picture-card {
        position: relative;
        overflow: hidden;
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }
    .picture-card img {
        transition: transform .3s ease-in-out;
        border-radius: 10px; /* Match parent's border-radius */
    }
    .picture-card:hover .card-img-top {
        transform: scale(1.05); /* Subtle zoom effect */
    }
    .picture-details {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.6); /* Slightly lighter overlay for better text readability */
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        opacity: 0;
        visibility: hidden;
        transition: opacity .3s ease-in-out, visibility .3s ease-in-out;
    }
    .picture-card:hover .picture-details {
        opacity: 1;
        visibility: visible;
    }
    .btn-modern {
        border: none;
        background-color: #007bff; /* Bootstrap primary */
        color: white;
        border-radius: 20px;
        padding: 8px 15px;
        margin-top: 10px;
        transition: background-color .3s ease-in-out;
    }
    .btn-modern:hover {
        background-color: #0056b3; /* Darker shade for hover effect */
    }
    .container {
        padding-top: 2rem;
    }
</style>

<div class="container mt-4">
    <div class="row">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($pictures->isEmpty())
            <div class="alert alert-info">No pictures found in this album.</div>
        @else
            @foreach ($pictures as $item)
                <div class="col-md-3 mb-4">
                    <div class="card picture-card">
                        <img src="{{ asset('images/album/'.$item->image) }}" class="card-img-top" alt="{{ $item->name }}">
                        <div class="picture-details">
                            <p>{{ $item->name }}</p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <!-- Trigger modal button -->
                           

                            <!-- Modal -->
                            <div class="modal fade" id="moveModal{{ $item->id }}" tabindex="-1" aria-labelledby="moveModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="moveModalLabel{{ $item->id }}">Move Image</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Select an album to move the image to:
                                            <form action="{{ route('picture.move', ['pictureId' => $item->id]) }}" method="POST">
                                                @csrf
                                                <select name="album_id" class="form-control mt-2">
                                                    @foreach($albums as $album)
                                                        <option value="{{ $album->id }}">{{ $album->name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-primary mt-3">Move</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-modern" data-toggle="modal" data-target="#moveModal{{ $item->id }}">
                        Move to another Album
                    </button>
                </div>
            @endforeach
        @endif

        <div class="mt-4">
            @php
            $albumId = request()->route('id');
            @endphp
            <a href="{{ route('picture.create', $albumId) }}" class="btn btn-primary">Add new picture</a>
            <a href="{{ route('album.index') }}" class="btn btn-warning">Back to Albums</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
