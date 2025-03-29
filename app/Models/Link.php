<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'profil_id', 
        'section',
        'position',
        'title', 
        'url', 
        'image', 
        'hide', 
        'embed', 
    ];

    protected $casts = [
        'embed' => 'boolean',
        'hide' => 'boolean',
    ];

    public function profil()
    {
        return $this->belongsTo(Profil::class, 'profil_id');
    }
}
