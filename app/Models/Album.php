<?php

namespace App\Models;

use App\Models\Picture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory;
    protected $fillable = ['name','user_id','image'];

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
