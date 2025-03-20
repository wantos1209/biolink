<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagePost extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'postimage_id',
        'image', 
    ];

    public function postimage()
    {
        return $this->belongsTo(PostImage::class, 'postimage_id', 'id');
    }
}
