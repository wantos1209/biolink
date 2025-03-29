<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'profil_id',
        'section',
        'position', 
        'title', 
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
