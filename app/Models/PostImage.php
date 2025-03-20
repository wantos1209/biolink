<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'profil_id',
        'position', 
        'deskripsi', 
        'hide', 
    ];
    protected $casts = [
        'hide' => 'boolean',
    ];

    public function profil()
    {
        return $this->belongsTo(Profil::class, 'profil_id');
    }
    public function imageposts()
    {
        return $this->hasMany(ImagePost::class, 'postimage_id', 'id');
    }
}
