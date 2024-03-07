<?php

use App\Http\Controllers\Album;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PictureController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('picture/create/{id}', [PictureController::class, 'create'])->name('picture.create');
    Route::post('picture/store/{id}', [PictureController::class, 'store'])->name('picture.store');
    Route::post('picture/move/{pictureId}', [PictureController::class, 'move'])->name('picture.move');    
});

Route::middleware('auth')->group(function () {
    Route::get('album/edit/{id}', [AlbumController::class, 'edit'])->name('album.edit');
    Route::put('album/update/{id}', [AlbumController::class, 'update'])->name('album.update');
    Route::get('album', [AlbumController::class, 'index'])->name('album.index');
    Route::get('album/create', [AlbumController::class, 'create'])->name('album.create');
   
    Route::post('album/store', [AlbumController::class, 'store'])->name('album.store');


Route::delete('album/delete/{id}', [AlbumController::class, 'delete'])->name('album.delete');
Route::delete('album/{id}/destroy_pictures', [AlbumController::class, 'destroy_pictures'])->name('albums.destroy_pictures');
Route::post('album/{id}/move_pictures', [AlbumController::class, 'move_pictures'])->name('albums.move_pictures');
Route::get('album/{id}', [AlbumController::class, 'albumDetails'])->name('album.details');
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
