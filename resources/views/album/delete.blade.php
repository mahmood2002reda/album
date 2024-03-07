@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Delete Album: {{ $album->name }}</h1>
    <p>This album contains pictures. Do you want to delete all pictures or move them to another album?</p>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Option 1: Delete all pictures</h5>
            <p class="card-text">This will delete all pictures in the album.</p>
            <form action="{{ route('albums.destroy_pictures', $album->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all pictures in this album?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete All Pictures</button>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Option 2: Move pictures to another album</h5>
            <p class="card-text">Select the album to which you want to move the pictures:</p>
            <form action="{{ route('albums.move_pictures', $album->id) }}" method="POST">
                @csrf
                {{-- Here you would need a select dropdown to choose which album to move the pictures to --}}
                <div class="form-group">
                    <label for="targetAlbum">Target Album</label>
                    <select name="target_album_id" id="targetAlbum" class="form-control">
                        @php
                            $userId=Auth::id();
                        @endphp
                        @foreach(App\Models\Album::where('user_id', $userId)->get() as $otherAlbum)
                            <option value="{{ $otherAlbum->id }}">{{ $otherAlbum->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Move Pictures</button>
            </form>
        </div>
    </div>

    <a href="{{ route('album.index') }}" class="btn btn-secondary mt-4">Cancel</a>
</div>
@endsection