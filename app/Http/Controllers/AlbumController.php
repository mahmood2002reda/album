<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    protected function saveImage($photo, $folder)
    {
        // Save photo in folder
        $file_extension = $photo->getClientOriginalExtension();
        $file_name = time() . '.' . $file_extension;
        $path = $folder;
        $photo->move($path, $file_name);

        return $file_name;
    }

    public function index()
    {
        $userId = Auth::id();

        $albums = Album::where('user_id', $userId)->get();

        return view('album.album', compact('albums'));
    }

    public function create()
    {
        return view('album.newalbum');
    }

    public function store(Request $request)
    {
        $file_name = $this->saveImage($request->image, 'images/album');

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $userId = Auth::id();

        Album::create([
            'user_id' => $userId,
            'name' => $request->name,
            'image' => $file_name,
        ]);

        return redirect()->route('album.index')->with('success', 'Album created successfully.');
    }

    public function albumDetails($id)
    {
        $userId=Auth::id();
        $albums=Album::where('user_id',$userId)->get();
    
        $pictures = Picture::where('album_id', $id)->with('album')->get();

        return view('picture.picture', compact('pictures','albums'));
    }
    public function edit( $id)
    {
        $album = Album::find($id);
        return view('album.edit', compact('album'));
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $album = Album::findOrFail($id);

    // Store the current image file name
    $image = $album->image;

    if ($request->hasFile('image')) {
        Storage::delete('images/album/' . $image);

        $file_name = $this->saveImage($request->file('image'), 'images/album');
        $album->image = $file_name;
    }

    $album->name = $request->name;
    $album->save();

    return redirect()->route('album.index')->with('success', 'Album updated successfully.');
}

public function delete(string $id)
{
    $userId=Auth::id();
    $album = Album::where('user_id',$userId)->with('pictures')->find($id);

    if ($album->pictures->isNotEmpty()) {
        return view('album.delete', ['album' => $album]);
    }

    $album->delete();
    return redirect()->route('album.index')->with('success', 'Album deleted successfully.');
}

public function destroy_pictures($albumId)
{
    $album = Album::find($albumId);
    $album->pictures()->delete(); 
    $album->delete(); 
    return redirect()->route('album.index')->with('success', 'Album and all its pictures deleted successfully.');
}

public function move_pictures(Request $request, $albumId)
{
    $targetAlbumId = $request->input('target_album_id');

    
    $album = Album::find($albumId);
    foreach ($album->pictures as $picture) {
        $picture->album_id = $targetAlbumId;
        $picture->save();
    }

    $album->delete(); 
    return redirect()->route('album.index')->with('success', 'Pictures moved and album deleted successfully.');
}


}