<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profil extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'nama', 
        'bio', 
        'image', 
        'status', 
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function link()
    {
        return $this->hasMany(Link::class, 'profil_id');
    }
    public function design()
    {
        return $this->hasMany(Design::class, 'profil_id');
    }
    public function header()
    {
        return $this->hasMany(Header::class, 'profil_id');
    }
    public function socialmedia()
    {
        return $this->hasMany(SocialMedia::class, 'profil_id');
    }
    public function postimage()
    {
        return $this->hasMany(PostImage::class, 'profil_id');
    }
    public function postblog()
    {
        return $this->hasMany(PostBlog::class, 'profil_id');
    }
}
