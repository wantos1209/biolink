<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;
    protected $fillable = [
        'profil_id', 
        'font', 
        'font_color', 
        'border_button', 
        'background_button', 
        'bordir_button', 
        'color_button',
        'background_page', 
        'theme',
    ];
    public function profil()
    {
        return $this->belongsTo(Profil::class, 'profil_id');
    }
    public static function ChangeFont($id, $font)
    {
        return self::updateOrCreate(
            ['id' => $id], 
            ['font' => $font],
        );
    }
    public static function ChangeButton($id, $border, $background, $border_radius,$customeColor)
    {
  
        return self::updateOrCreate(
            ['id' => $id], 
            [ 
                'border_button' => $border,
                'background_button' => $background,
                'bordir_button' => $border_radius,
                'color_button' => $customeColor
            ]
        );
    }
    public static function ChangeBackground($id, $color)
    {
    
        return self::updateOrCreate(
            ['id' => $id], 
            ['background_page' => $color],
        );
    }
    public static function ChangeColorButton($id, $color, $colorbutton)
    {
        return self::updateOrCreate(
            ['id' => $id], 
            ['background_button' => $color,'color_button' => $colorbutton],
        );
    }
    public static function ChangeColorBorder($id, $border, $background, $colorbutton )
    {
      
        return self::updateOrCreate(
            ['id' => $id], 
            ['border_button' => $border,'background_button' => $background,'color_button' => $colorbutton],
        );
    }
    public static function ChangeColorFont($id, $color)
    {
        return self::updateOrCreate(
            ['id' => $id], 
            ['font_color' => $color,'color_button' => $color],
        );
    }
    public static function getSetting($id)
    {
        // return self::where('key', $key)->value('value');
        return self::where('id', $id)->first();
    }
    public static function ChangegroundImage($id, $imagePath)
    {
        self::updateOrCreate(
            ['id' => $id],
            ['background_page' => $imagePath]
        );
    }
    public static function ChangeThema($id, $thema, $profilid)
    {
     
        if ($thema === "Basics") {
           
            return self::updateOrCreate(
                ['id' => $id], 
                [   'profil_id' => $profilid,
                    'font' => 'Inter',
                    'font_color' => '#0D0C22',
                    'border_button' => '0px solid #FFFFFF',
                    'background_button' => ' #FFFFFF',
                    'bordir_button' => '30px',
                    'color_button' =>'#0D0C22',
                    'background_page' => '#FFFFFF',
                    'theme' => 'Basics',
                ]
            );
        }
        elseif ($thema === "Carbon") {
           
            return self::updateOrCreate(
                ['id' => $id], 
                [   'profil_id' => $profilid,
                    'font' => 'Inter',
                    'font_color' => '#FFFFFF',
                    'border_button' => '0px solid transparent',
                    'background_button' => '#212121',
                    'bordir_button' => '8px',
                    'color_button' =>'#FFFFFF',
                    'background_page' => '#131212',
                    'theme' => 'Carbon',
                ]
            );
        }
        elseif ($thema === "Autumn") {
            return self::updateOrCreate(
                ['id' => $id], 
                [   'profil_id' => $profilid,
                    'font' => 'DM Sans',
                    'font_color' => '#0D0C22',
                    'border_button' => '0px solid #FF9877',
                    'background_button' => '#FF9877',
                    'bordir_button' => '30px',
                    'color_button' =>'#0D0C22',
                    'background_page' => '#fff4f1',
                    'theme' => 'Autumn',
                ]
            );
        }
        elseif ($thema === "Blush") {
            return self::updateOrCreate(
                ['id' => $id], 
                [   'profil_id' => $profilid,
                    'font' => 'DM Sans',
                    'font_color' => '#0D0C22',
                    'border_button' => '0px solid #FF9877',
                    'background_button' => '#A6EB99',
                    'bordir_button' => '30px',
                    'color_button' =>'#0D0C22',
                    'background_page' => '#f5fdf4',
                    'theme' => 'Blush',
                ]
            );
        }
        elseif ($thema === "Leaf") {
            return self::updateOrCreate(
                ['id' => $id], 
                [   'profil_id' => $profilid,
                    'font' => 'DM Sans',
                    'font_color' => '#0D0C22',
                    'border_button' => '0px solid #FF9877',
                    'background_button' => '#FF90E8',
                    'bordir_button' => '8px',
                    'color_button' =>'#0D0C22',
                    'background_page' => '#fff3fc',
                    'theme' => 'Leaf',
                ]
            );
        }
        elseif ($thema === "Custom") {
            return self::updateOrCreate(
                ['id' => $id], 
                [   'profil_id' => $profilid,
                    'font' => 'Inter',
                    'font_color' => '#000000',
                    'border_button' => '0px solid transparent',
                    'background_button' => '#000000',
                    'bordir_button' => '30px',
                    'color_button' =>'#FFFFFF',
                    'background_page' => '#FFFFFF',
                    'theme' => 'Custom',
                ]
            );
        }
    }

}
