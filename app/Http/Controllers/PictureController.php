<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $albumId = $id; 
        return view('picture.newpicture', compact('albumId'));
    }
    /**
     * Store a newly created resource in storage.
     */
 
     public function store(Request $request, $id)
     {
         $file_name = $this->saveImage($request->image, 'images/album');
     
         $request->validate([
             'name' => 'required|string|max:255',
         ]);
     
         Picture::create([
             'album_id' => $id, // Use the provided $id directly
             'name' => $request->name,
             'image' => $file_name,
         ]);
     
         return redirect()->route('album.details', ['id' => $id])->with('success', 'Picture created successfully.');
     }

    
     public function move(Request $request, $pictureId)
{
    $request->validate([
        'album_id' => 'required|exists:albums,id',
    ]);

    $picture = Picture::findOrFail($pictureId);

    $picture->album_id = $request->album_id;
    $picture->save();

    return redirect()->route('album.details', ['id' => $picture->album_id])->with('success', 'Picture moved successfully.');
}
}
