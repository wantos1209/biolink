<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'profil_id',
        'title',
        'url', 
        'svg',  
        'hide', 
    ];
    protected $casts = [
        'hide' => 'boolean',
    ];
    public function profil()
    {
        return $this->belongsTo(Profil::class, 'profil_id');
    }
}
