<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Textfont;
use App\Models\Design;
use App\Models\Profil;
use Hamcrest\Core\IsNot;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

class FontSetting extends Component
{
    use WithFileUploads;
    public $image;
    public $imagePreview;

    public $fontFamily;
    public $border;
    public $background;
    public $backgroundpage;
    public $border_radius;
    public $font_color;
    public $selectedColor; 
    public $profilid; 
    public $designid; 
    public $selectedTheme = null;
    public $selectedbackground;


    // public $previousColor;
 // Listener untuk menangkap perubahan font dari Livewire
    protected $listeners = [
        'updateButton' => 'changeButton',
        'updateFont' => 'changeFont',
        'updatebackground' => 'changeBackground',


        // 'updateProfileImage' => 'setProfileImage',
        'updateColorBackground' => 'DisplaychangeBackground',
        'updateColorButton' => 'DisplaychangeColorButton',
        'updateColorFont' => 'DisplaychangeColorFont',
        
    ];

    public function mount()
    {
  
        $profil = Profil::with('design')->where('user_id', Auth::id())
        ->where('status', 'on')
        ->first();

        $design = $profil ? $profil->design->first() : null;

        $settings = Design::getSetting($design->id);

        // $profil = Profil::with(['design' => function ($query) {
        //     $query->first(); // Tidak berfungsi, lebih baik pakai di luar
        // }])->where('user_id', Auth::id())
        //     ->where('status', 'on')
        //     ->first();
        // $design = $profil ? $profil->design->first() : null; // Mengambil satu objek

        // $user = Auth::user();
        // $profil = Profil::where('user_id', $user->id)
        //     ->where('status', 'on')
        //     ->with('design') // Gunakan eager loading untuk mengambil data design
        //     ->firstOrFail();

        // $settings = $profil->design[0];

        

        
        $this->designid =  $settings['id'];
        // if ($settings) {
        //     $this->fontFamily = [
        //         'font' => $settings->font,
        //         'border_button' => $settings->border_button,
        //         'background_button' => $settings->background_button,
        //         'bordir_button' => $settings->bordir_button,
        //     ];
        // } else {
        //     // Penanganan jika data tidak ditemukan
        //     $this->fontFamily = null;
        // }

        $this->fontFamily = $settings['font'];

        $border = $settings['border_button'];
        preg_match('/^([\d\w\s]+) #/', $border, $matches);
        $this->border = isset($matches[1]) ? trim($matches[1]) : $border;

        $this->background = ($settings['background_button'] !== 'transparent') ? '' : 'transparent';
      
        $this->border_radius = $settings['bordir_button'];
        $this->font_color = $settings['font_color'];
        $this->selectedTheme = $settings['theme'];
        $this->backgroundpage = $settings['background_page'];
        if ($settings['theme'] !== 'Custom'){
            $box_shadow ='0px 6px 14px -6px rgba(24, 39, 75, 0.12), 0px 10px 32px -4px rgba(24, 39, 75, 0.1), inset 0px 0px 2px 1px rgba(255, 255, 255, 0.05)' ;
        }
        // $backgroundPage = $settings['background_page'] ? asset($settings['background_page']) : '';
     
        $this->dispatch('themaChanged', 
            $settings['font'], 
            $settings['font_color'],
            $settings['border_button'],
            $settings['background_button'],
            $settings['bordir_button'],
            $settings['color_button'],
            $settings['background_page'],
            $settings['theme'],  // Mengirimkan tema saat ini
            $box_shadow ?? ""
    );
        // $this->border = Design::getSetting($profil->id)->value('border_button') ?? "0px solid transparent";
        // $this->background = Design::getSetting($profil->id)->value('background_button') ?? "#970a4e";
        // $this->border_radius = Design::getSetting($profil->id)->value('bordir_button') ?? "30px";
//=====================================================================================================================

        // $setting = TextFont::first();
        // $this->border = $setting->border ?? "0px solid transparent";
        // $this->background = $setting->background ?? "#970a4e";
        // $this->border_radius = $setting->border_radius ?? "30px";
       // $this->btnpage_color = $this->isDark($setting->background) ? "#FFFFFF" : "#000000";

        //$this->backgroundpage = $setting->background_page;
        //$this->dispatch('updatebackground', $this->backgroundpage);

        // $this->dispatch('buttonChanged', [
        //     'border' => $this->border,
        //     'background' => $this->background,
        //     'border_radius' => $this->border_radius,
        //     'btnpage_color' => $this->selectedColor,
        // ]);
    }
    public function changeThema($thema)// -- 11
    {
   
        $this->selectedTheme = $thema;
        if ($thema !== "Custom"){
            $box_shadow ='0px 6px 14px -6px rgba(24, 39, 75, 0.12), 0px 10px 32px -4px rgba(24, 39, 75, 0.1), inset 0px 0px 2px 1px rgba(255, 255, 255, 0.05)' ;
        }
        $profil = Profil::with('design')->firstWhere([
            'user_id' => Auth::id(),
            'status' => 'on'
        ]);

        $design = optional($profil->design)->first();
        
        if (!empty($design->background_page)) {
            // Periksa apakah nilai background_page adalah warna (hex, rgb, atau nama warna)
            if (!isColorOrImage($design->background_page)) {
                $filePath = storage_path('app/public/backgrounds/' . $design->background_page);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
        $data = Design::ChangeThema($this->designid, $thema, $profil['id']);
       
        $this->dispatch('themaChanged', $data["font"], $data["font_color"],$data["border_button"],$data["background_button"],$data["bordir_button"],$data["color_button"],$data["background_page"],$box_shadow ?? "");
    }

    public function updatedImage() // -- 10
    {   
        // **Validasi file gambar**
        $this->validate([
            'image' => 'file|mimes:jpeg,png,jpg,webp|max:10240',
        ], [
            'image.file' => 'Terdapat file yang tidak valid.', 
            'image.mimes' => 'Format yang diizinkan: JPEG, PNG, JPG, dan WEBP.', 
            'image.max' => 'Ukuran file maksimal adalah 10MB.',
        ]);
        if ($this->image) {
        // **Periksa apakah ada file yang diunggah**
        // if ($this->hasFile('image')) {
            $file = $this->image;
            
            // **Buat objek gambar menggunakan Imagick**
            $image = new \Imagick($file->getPathname());
    
            // **Set format gambar ke JPG untuk efisiensi**
            $image->setImageFormat('webp');
    
            // **Kompresi gambar dengan kualitas 80%**
            $image->setImageCompression(\Imagick::COMPRESSION_JPEG);
            $image->setImageCompressionQuality(80);
    
            // **Hapus metadata untuk mengurangi ukuran file**
            $image->stripImage();
    
            // **Resize gambar ke lebar 800px sambil menjaga aspek rasio**
            $width = 800;
            $image->resizeImage($width, 0, \Imagick::FILTER_LANCZOS, 1);
    
            // **Buat nama file unik**
            $fileName = time() . '_' . uniqid() . '.webp';
    
            // **Tentukan direktori penyimpanan**
            $directoryPath = storage_path('app/public/backgrounds');
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true);
            }
    
            // **Simpan gambar ke direktori**
            $image->writeImage($directoryPath . '/' . $fileName);
    
            // **Bersihkan memori**
            $image->clear();
            $image->destroy();
    
            // **Hapus gambar lama jika ada**
            // $id = Auth::user()->id;
            // $profil = Profil::with(['design'])->where('user_id', $id)->where('status', 'on')->firstOrFail();
            // $design = $profil->design->first();
            $profil = Profil::with('design')->firstWhere([
                'user_id' => Auth::id(),
                'status' => 'on'
            ]);
            $design = optional($profil->design)->first();
            
            if (!empty($design->background_page)) {
                // Periksa apakah nilai background_page adalah warna (hex, rgb, atau nama warna)
                if (!isColorOrImage($design->background_page)) {
                    $filePath = storage_path('app/public/backgrounds/' . $design->background_page);
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }
            
    
            // **Simpan ke database menggunakan metode ChangeBackground**
            Design::ChangeBackground($this->designid, $fileName);
            // $this->backgroundpage = asset('storage/backgrounds/' . $fileName);
            // $this->backgroundpage = env('API_URL') . '/storage/backgrounds/' . $fileName;

            $this->backgroundpage = $fileName;
            $this->image = null;
         
            // **Perbarui tampilan gambar**
            //  $this->backgroundpage = asset('storage/backgrounds/' . $fileName);
            // // **Pastikan perubahan terdeteksi oleh Livewire**
            // $this->emitSelf('refreshComponent');
            // **Kirim event ke front-end**
     
            $this->dispatch('ProfileImageUpdated', $this->backgroundpage);
            // $this->dispatch('ProfileImageUpdated', env('API_URL') . '/storage/backgrounds/' . $this->backgroundpage);
            // $this->dispatch('refresh');

        }
    }
  
    //   // Simpan gambar ke storage
        //   $path = $this->image->store('uploads', 'public');
        //   $imageUrl = asset('storage/' . $path); // Konversi path ke URL
        //   // Simpan ke database menggunakan metode ChangeBackground
        //   Design::ChangegroundImage($this->profilid, $path);
        //   // Perbarui tampilan gambar
        // //$this->imagePreview = asset('storage/' . $path);
        // // Perbarui tampilan gambar
        // $this->backgroundpage = $imageUrl;
        //   // Kirim event jika diperlukan
        //   $this->dispatch('ProfileImageUpdated', $this->backgroundpage);
        // // $this->backgroundpage = $backgroundpage;
        // // Design::ChangeBackground($this->profilid, $this->backgroundpage);
        // // $this->dispatch('BackgroundChanged', $this->backgroundpage );
        
    public function DisplaychangeBackground()//-- 9
    {  
        $this->backgroundpage=$this->selectedColor;
        $this->dispatch('BackgroundChanged', $this->backgroundpage );
    }
    public function changeBackground()//-- 8
    {
        $this->backgroundpage=$this->selectedColor;
        Design::ChangeBackground($this->designid, $this->backgroundpage  );
        $this->dispatch('BackgroundChanged', $this->backgroundpage );
    }
    public function changeColorBackground($backgroundpage)//-- 7
    {
        $this->backgroundpage = $backgroundpage;

        $profil = Profil::with('design')->firstWhere([
            'user_id' => Auth::id(),
            'status' => 'on'
        ]);
        $design = optional($profil->design)->first();
        
        if (!empty($design->background_page)) {
            // Periksa apakah nilai background_page adalah warna (hex, rgb, atau nama warna)
            if (!isColorOrImage($design->background_page)) {
                $filePath = storage_path('app/public/backgrounds/' . $design->background_page);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        Design::ChangeBackground($this->designid, $this->backgroundpage);
        $this->dispatch('BackgroundChanged', $this->backgroundpage );
    }
    public function changeButton($border, $background, $border_radius)//-- 6
    {
     
        $this->border = $border;
        $this->background = $background;
        $this->border_radius = $border_radius;
    
        if ($background !== 'transparent') {
            $borderValue = Design::getSetting($this->designid)->value('border_button');
            preg_match('/#([a-fA-F0-9]{3,6})/', $borderValue, $matches);
            $color = $matches[0] ?? null;
            $customeColor = $this->isDark($color) ? "#FFFFFF" : "#000000";

            if (is_null($color)) {
                $colorbtn = Design::getSetting($this->designid);
                Design::ChangeButton($this->designid, $border, $colorbtn['background_button'] , $border_radius , $colorbtn['color_button']);
                $this->dispatch('buttonChanged', [$this->border, $colorbtn['background_button'] , $this->border_radius , $colorbtn['color_button'] ]);
            }
            else {
                Design::ChangeButton($this->designid, $border, $color, $this->border_radius, $customeColor);
                $this->dispatch('buttonChanged', [$this->border, $color, $this->border_radius, $customeColor]);
            }
        }

        else {
           
            $borderValue = Design::getSetting($this->designid)->value('border_button');
            preg_match('/#([a-fA-F0-9]{3,6})/', $borderValue, $matches);
            $color = $matches[0] ?? null;
  
            if (is_null($color)) {
                $color = Design::getSetting($this->designid)->value('background_button') ?? '#0000';
                Design::ChangeButton($this->designid,$border .' '. $color, $background, $border_radius, $this->font_color);
                $this->dispatch('buttonChanged', [$this->border .' '. $color, $this->background, $this->border_radius, $this->font_color]);
            }

            else {
                $colorbtn = Design::getSetting($this->designid)->value('color_button');
                Design::ChangeButton($this->designid,$border .' '. $color, $background, $border_radius,$colorbtn);
                $this->dispatch('buttonChanged', [ $this->border .' '. $color, $this->background, $this->border_radius, $colorbtn]);
            }
        } 
    }

    public function changeColorButton()//-- 5
    {
       
        if ($this->background !== 'transparent') {
            $customeColor = $this->isDark($this->selectedColor) ? "#FFFFFF" : "#000000";
            Design::ChangeColorButton($this->designid, $this->selectedColor, $customeColor);
            $this->dispatch('ButtonColorChanged', $this->selectedColor, $customeColor);
        }
        else {

            Design::ChangeColorBorder($this->designid,  $this->border.' '. $this->selectedColor, $this->background,  $this->font_color);
            $this->dispatch('BorderColorChanged', $this->border.' '. $this->selectedColor, $this->background,  $this->font_color);
        }
    }

    public function DisplaychangeColorButton()//-- 4
    {  
        if ($this->background !== 'transparent') {
            $customeColor = $this->isDark($this->selectedColor) ? "#FFFFFF" : "#000000";
            $this->dispatch('ButtonColorChanged', $this->selectedColor, $customeColor);
        }
        else {
            $this->dispatch('BorderColorChanged', $this->border.' '. $this->selectedColor, $this->background,  $this->font_color);
        }
    } 

    public function changeFont($Font)//-- 3
    {
        $this->fontFamily = $Font;
        Design::ChangeFont($this->designid, $Font);
        $this->dispatch('fontChanged', $Font );
    }

    public function changeColorFont()//-- 2
    {
        Design::ChangeColorFont($this->designid, $this->selectedColor);
        $this->dispatch('ColorFontChanged',$this->selectedColor);
    }

    public function DisplaychangeColorFont()//-- 1
    {
        $this->dispatch('ColorFontChanged', $this->selectedColor );
    }

    public function isDark($color)
{
    // Konversi hex ke RGB
    $color = str_replace('#', '', $color);
    $r = hexdec(substr($color, 0, 2));
    $g = hexdec(substr($color, 2, 2));
    $b = hexdec(substr($color, 4, 2));

    // Algoritma luminance untuk menentukan kecerahan warna
    $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;

    return $luminance < 0.5; // Jika kurang dari 0.5, anggap warna gelap
}

    // private function isDark($hex)
    // {
    //     // Konversi HEX ke RGB
    //     list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    
    //     // Hitung kecerahan (luminance) berdasarkan rumus W3C
    //     $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
    
    //     // Jika luminance < 0.5, warna dianggap gelap
    //     return $luminance < 0.5;
    // }
//     public function beforeChangeColor()
// {
//     $this->previousColor = $this->btnpage_color; // Simpan warna lama sebelum diubah
// }
// public function updateLiveColor($color)
// {
//     $this->selectedColor = $color;
//     $this->dispatch('colorChanged', $this->selectedColor);
// }

    public function render()
    {
        return view('livewire.font-setting');
    }
}
         // Update nilai font di dalam komponen
        //$this->fontFamily = $Font;
        // Simpan perubahan font ke database
            // Kirim event ke semua komponen Livewire agar diperbarui di semua halaman
        // Broadcast perubahan ke semua komponen Livewire di halaman
        //----------------------------------------------------------
        // TextFont::updateOrCreate([], [
        //     'border' => $border,
        //     'background' => $background,
        //     'border_radius' => $border_radius
        // ]);

        // Perbarui tampilan Livewire langsung

       // $this->border = $border;
       // $this->background = $background;
      //  $this->border_radius = $border_radius;
      //  $this->btnpage_color = $this->isDark($background) ? "#FFFFFF" : "#000000";

        // Broadcast perubahan ke semua komponen Livewire di halaman
         // Kirim event ke front-end
       //  $this->dispatch('buttonChanged', [
         //   'border' => $this->border,
          //  'background' => $this->background,
        ////   'border_radius' => $this->border_radius,
           // 'btnpage_color' => $this->btnpage_color,
      //  ]);
   
      //  session()->flash('message', 'Pengaturan tombol berhasil disimpan!');