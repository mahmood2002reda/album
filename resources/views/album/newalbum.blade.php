@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Form Title
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('album.store') }}" enctype="multipart/form-data">
                        @csrf                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Album Name</label>
                            <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Album Name">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">album cover </label>
                            <input type="file" name="image" class="form-control" id="formGroupExampleInput2" placeholder="cover">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
