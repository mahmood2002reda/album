@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 text-center">
            <a href="{{ route('album.index') }}">
                <img src="{{ asset('images/website/photo-album-logo-vector-34017464.jpg') }}" class="img-fluid" alt="Responsive image">
            </a>
            <h5 class="card-title">My Albums</h5>

          </div>
      <div class="col-md-4 text-center">
        <a href="{{ route('album.create') }}">
            <img src="{{ asset('images/website/5946379.png') }}" class="img-fluid" alt="Responsive image">
        </a>
        <h5 class="card-title">Create Album</h5>

      </div>
    </div>
  </div>
  
@endsection
