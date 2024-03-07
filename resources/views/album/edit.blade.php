@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Book</h1>

           <form method='POST' action="{{route('album.update',$album->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">book Name</label>
                <input value="{{$album->name}}" type="text" class="form-control" name="name" placeholder="book Name">

                @error('name')
                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>

            
           
            
            
          
            <div class="form-group">
                
                <label for="price">book image</label>
                <div class="form-group">
                <img src="{{asset('images/album/'.$album->image)}}"with='100' height="100">
                </div>
                <input value="" type="file" class="form-control" name="image" placeholder="book image">

                @error('image')
                    <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
                @enderror
            </div>
        </br>
            <div class="form-group">

            <button type="submit" class="btn btn-primary">update album</button>
        </div>
        </form>
    </div>
@endsection