<?php

namespace App\Http\Controllers;
use App\Models\Profil;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Design;
use App\Models\Header;
use App\Models\SocialMedia;
use App\Models\PostImage;
use App\Models\PostBlog;
use App\Models\ImagePost;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\PostInc;
use Illuminate\Support\Str;
class ProfilController extends Controller
{
    //
    protected $images;
    protected $deleteimages;
    public function createdaftar(Request $request){
       
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username|max:200',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'min:8', 'regex:/[A-Z]/'],
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah terdaftar.',
            'username.max' => 'Username maksimal 200 karakter.',

            'email.required' => 'Username wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Username sudah terdaftar.',

            // (?=.*[a-z]) → Minimal 1 huruf kecil.
            // (?=.*[A-Z]) → Minimal 1 huruf besar.
            // (?=.*\d) → Minimal 1 angka.
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung setidaknya 1 huruf besar.',
        ]);
       
       if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
            }
        
        try {
        
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password), 
            ]);
            Auth::login($user);
            return redirect()->route('profil')->with('success', 'Register berhasil! Data berhasil disimpan.');
            // return back()->with('success', 'Pendaftaran berhasil');

        } catch (\Exception $e) {
        
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }    
    }
public function uploadImage(Request $request) 
{
    // if ($request->hasFile('image')) {
    //     $file = $request->file('image');
    //     $path = $file->store('uploads/quill', 'public'); // Simpan di storage/app/public/uploads/quill
    //     // Format path agar hanya menyimpan relatif path
    //     $relativePath = "/storage/" . $path;
    //     return response()->json(['url' => $relativePath]);
    //     // return response()->json(['url' => asset('storage/' . $path)]);
    // }
    // return response()->json(['error' => 'Gagal mengunggah gambar'], 400);
    $profil = Profil::with('postimage')->where('user_id', Auth::id())->where('status', 'on')->first();

    if (!$profil) {
        return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.']);
    }

    if ($request->hasFile('image')) {

        //$userId = auth()->id(); // Ambil ID pengguna yang sedang login
        $file = $request->file('image');
        // Simpan di storage/app/public/uploads/{id_profil}
        $path = $file->store("postblog/{$profil->id}", 'public');
        // Format path agar hanya menyimpan relatif path
        $relativePath = "/storage/" . $path;
        return response()->json(['url' => $relativePath]);
    }

    return response()->json(['error' => 'Gagal mengunggah gambar'], 400);
}
public function deleteImage(Request $request)
{
    $imagePath = str_replace('/storage/', '', $request->image);

    if (Storage::disk('public')->exists($imagePath)) {
        Storage::disk('public')->delete($imagePath);
        return response()->json(['message' => 'Gambar berhasil dihapus']);
    }

    return response()->json(['error' => 'Gambar tidak ditemukan'], 404);
}

    public function createpostimage(Request $request) {
        // dd(session()->get('dataimg')['id']);
        try {
            $validator = Validator::make($request->all(), [
                'deskripsi' => 'required|string|max:255',
                'images.*' => 'file|mimes:jpeg,png,jpg,gif,webp|max:10240',
            ], [
                'deskripsi.required' => 'deskripsi wajib diisi.',
                'deskripsi.max' => 'title maksimal 255 karakter.',
                'images.*.file' => 'Terdapat file yang tidak valid.', // Pesan jika file tidak valid
                'images.*.mimes' => 'format: JPEG, PNG, JPG, GIF dan WEBP yang diizinkan.', // Pesan jika tipe file tidak valid
                'images.*.max' => 'Ukuran file maksimal adalah 10MB.', // Pesan jika ukuran file terlalu besar
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
                    }

            $profil = Profil::with('postimage')->where('user_id', Auth::id())->where('status', 'on')->first();
    
            if (!$profil) {
                return redirect()->back()->with("error", "Profil tidak ditemukan.");
            }

            $maxHeaderPos = PostImage::where('profil_id', $profil->id)
            ->where('position', 'LIKE', 'cuspimg%')
            ->orderByRaw("CAST(SUBSTRING_INDEX(position, ' ', -1) AS UNSIGNED) DESC")
            ->value('position');
          
            // Ekstrak angka dari format 'custom 1', 'custom 2', dst.
            $nextPosition = 1;
            if ($maxHeaderPos) {
                preg_match('/\d+$/', $maxHeaderPos, $matches);
                $nextPosition = $matches ? intval($matches[0]) + 1 : 1;
            }
           
            $postimg = PostImage::create([
                'profil_id' => $profil->id,
                'position' => "cuspimg $nextPosition",
                'deskripsi' => $request->deskripsi,
                'hide' => true,
                'created_at' => now(),
            ]);
         
            if ($request->file('images')) {
                    $filePaths = []; // Array untuk menyimpan path file
                    foreach ($request->file('images') as $img) {
                    
                        $image = new \Imagick($img->getPathname()); 
                        $image->setImageFormat('webp'); 
                        $image->setImageCompressionQuality(80);
                        $image->stripImage(); 
                        $width = 800;
                        $image->resizeImage($width, 0, \Imagick::FILTER_LANCZOS, 1);
                        
                        $fileName = time() . '_' . uniqid() . '.webp';
                        $directoryPath = storage_path('app/public/img');
                        // Buat folder jika belum ada
                        if (!file_exists($directoryPath)) {
                            mkdir($directoryPath, 0755, true);
                        }
                        // Simpan file ke direktori
                        $filePath = $directoryPath . '/' . $fileName;
                        $image->writeImage($filePath); // Simpan gambar ke path

                        $filePaths[] = [
                            'postimage_id' => $postimg->id,
                            'image' => $fileName,
                            'created_at' => now(),
                        ];
                        $image->clear();
                        $image->destroy(); // Hapus dari memori untuk optimasi
                    } 
                    ImagePost::insert($filePaths);

                }
  
            return redirect()->back()->with('success', 'Post berhasil disimpan!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function createblog(Request $request) {
   
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ], [
                'content.required' => 'content wajib diisi.',
                'title.required' => 'title wajib diisi.',
                'title.max' => 'title maksimal 255 karakter.',
            ]);
           
           if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
                }
            
                // $content = $request->input('content');
                // // Ambil semua gambar yang ada di dalam konten
                // preg_match_all('/<img.*?src="(.*?)"/', $content, $matches);
                // $usedImages = $matches[1] ?? [];
                // // Ubah path relatif agar cocok dengan penyimpanan di storage
                // $usedImages = array_map(function ($image) {
                //     return str_replace('/storage/', '', $image);
                // }, $usedImages);
                // // Ambil semua gambar di storage
                // $storedImages = Storage::disk('public')->files('uploads/quill');
                // // Cari gambar yang tidak digunakan dalam konten
                // $unusedImages = array_diff($storedImages, $usedImages);
                // // Hapus gambar yang tidak digunakan
                // foreach ($unusedImages as $image) {
                //     Storage::disk('public')->delete($image);
                // }
            

            $profil = Profil::with('postblog')->where('user_id', Auth::id())->where('status', 'on')->first();

            if (!$profil) {
                return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.']);
            }

            $baseSlug = Str::slug($request['title']); 

            $validslug = $profil->postblog->where('slug', $baseSlug)->first();
            if ($validslug) {
                // Jika sudah ada, cari slug dengan penomoran yang sesuai
                $counter = 2;
                while ($profil->postblog->where('slug', $baseSlug . '-' . $counter)->first()) {
                    $counter++;
                }
                $slug = $baseSlug . '-' . $counter; // Tambahkan nomor jika sudah ada
            } else {
                $slug = $baseSlug; // Jika belum ada, gunakan slug dasar tanpa nomor
            }
           
            // $generatenumber = $validslug ? $validslug + 1 : 1; 
            // $slug =  Str::slug($request['title']) . '-' . $generatenumber; 
            // $validslug ? Str::slug($request['title']) . '-' . time(); 
            // $lastPosition = Link::where('profil_id', $newProfil->id)->max('position');
            // $nextPosition = $lastPosition ? $lastPosition + 1 : 1; // Jika kosong, mulai dari 1

            // $userId = auth()->id(); // Ambil ID user
            $content = $request->input('content');
           
                // Ambil semua gambar yang ada di dalam konten baru
            preg_match_all('/<img.*?src="(.*?)"/', $content, $matches);
            $usedImages = $matches[1] ?? [];
            // Ubah path relatif agar cocok dengan penyimpanan di storage
            $usedImages = array_map(function ($image) {
                return str_replace('/storage/', '', $image);
            }, $usedImages);
            // **Ambil semua gambar dari konten post sebelumnya milik user ini**
            $previousPosts = $profil->postblog->pluck('deskripsi');
        
            $previousImages = [];
            foreach ($previousPosts as $postContent) {
                preg_match_all('/<img.*?src="(.*?)"/', $postContent, $matches);
                $previousImages = array_merge($previousImages, $matches[1] ?? []);
            }
            // Ubah path relatif untuk gambar sebelumnya juga
            $previousImages = array_map(function ($image) {
                return str_replace('/storage/', '', $image);
            }, $previousImages);
            // **Gabungkan gambar yang baru dengan gambar yang sudah digunakan sebelumnya**
            $allUsedImages = array_unique(array_merge($previousImages, $usedImages));
            // Ambil semua gambar dalam folder user
            $storedImages = Storage::disk('public')->files("postblog/{$profil->id}");
            // Cari gambar yang benar-benar tidak digunakan dalam semua post user ini
            $unusedImages = array_diff($storedImages, $allUsedImages);
            // Hapus gambar yang tidak digunakan
            foreach ($unusedImages as $image) {
                Storage::disk('public')->delete($image);
            }
            // Hapus folder user jika kosong
            if (count(Storage::disk('public')->files("postblog/{$profil->id}")) === 0) {
                Storage::disk('public')->deleteDirectory("postblog/{$profil->id}");
            }
            // Ambil semua gambar yang ada di dalam konten
            // preg_match_all('/<img.*?src="(.*?)"/', $content, $matches);
            // $usedImages = $matches[1] ?? [];
            // // Ubah path relatif agar cocok dengan penyimpanan di storage
            // $usedImages = array_map(function ($image) {
            //     return str_replace('/storage/', '', $image);
            // }, $usedImages);
            // // Ambil semua gambar hanya dalam folder user
            // $storedImages = Storage::disk('public')->files("uploads/{$profil->id}");
            // // Cari gambar yang tidak digunakan dalam konten
            // $unusedImages = array_diff($storedImages, $usedImages);
            // // Hapus gambar yang tidak digunakan
            // foreach ($unusedImages as $image) {
            //     Storage::disk('public')->delete($image);
            // }
            // // Hapus folder user jika kosong
            // if (empty(Storage::disk('public')->files("uploads/{$profil->id}"))) {
            //     Storage::disk('public')->deleteDirectory("uploads/{$profil->id}");
            // }
           
            $maxHeaderPos = PostBlog::where('profil_id', $profil->id)
            ->where('position', 'LIKE', 'cusblog%')
            ->orderByRaw("CAST(SUBSTRING_INDEX(position, ' ', -1) AS UNSIGNED) DESC")
            ->value('position');
            
            // Ekstrak angka dari format 'custom 1', 'custom 2', dst.
            $nextPosition = 1;
            if ($maxHeaderPos) {
                preg_match('/\d+$/', $maxHeaderPos, $matches);
                $nextPosition = $matches ? intval($matches[0]) + 1 : 1;
            }
            // $fileName = $this->images($request->file('images'));
            PostBlog::create([
                // 'image' => $fileName,
                'profil_id' => $profil->id,
                'position' => "cusblog $nextPosition",
                'title' => $request->title,
                'slug' => $slug,
                'deskripsi' => $request->content,
                'hide' => true,
            ]);

            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }
    public function updatePosition(Request $request)
    {
        $positions = $request->positions;
    
        foreach ($positions as $position) {
            if ($position['type'] == 'header') {
                Header::where('id', $position['id'])->update(['position' => $position['position']]);
            } else {
                Link::where('id', $position['id'])->update(['position' => $position['position']]);
            }
        }
    
        return response()->json(['success' => true, 'message' => 'Posisi diperbarui!']);
    }

    public function switchaccount(Request $request, $id)
    {
     
        // Update status profil: set semua 'off' kecuali yang sesuai dengan $id
        Profil::where('user_id', Auth::id())->update([
            'status' => DB::raw("CASE WHEN id = $id THEN 'on' ELSE 'off' END")
        ]);

        // Ambil data profil yang baru diaktifkan
        // $profil = Profil::where('id', $id)->first();
        $id =  Auth::user()->id;
        $user = User::with('profil')->where('id', $id)->firstOrFail();


        if (!$user) {
            return redirect()->back()->with("error", "Profil tidak ditemukan.");
        }

        // Regenerate session tanpa menghapus seluruh session
    //    session()->forget('profil');
    //    session()->forget('dataimg');
    //    session()->put('profil',  $user['profil']->toArray());
    //    session()->put('dataimg',  $user['profil']->where('status', 'on')->toArray());
    //    session()->regenerateToken();
        
        return redirect()->back()->with("success", "Profil berhasil diperbarui!");
    }

    public function createprofil(Request $request){

        try { 

            $request->validate([
                'nama' => 'required|string|min:3',
                'bio' => 'nullable|string', 
                'images.*' => 'file|mimes:jpeg,png,jpg,gif,webp|max:10240',
                'namalink' => 'required|array',
                'namalink.*' => 'required|string|max:20',
                'url' => 'required|array',
                'url.*' => 'required|url|max:255',
            ], [
                'images.*.file' => 'Terdapat file yang tidak valid.', // Pesan jika file tidak valid
                'images.*.mimes' => 'format: JPEG, PNG, JPG, GIF dan WEBP yang diizinkan.', // Pesan jika tipe file tidak valid
                'images.*.max' => 'Ukuran file maksimal adalah 10MB.', // Pesan jika ukuran file terlalu besar
                
                'nama.required' => 'Nama Profil wajib diisi.',
                'nama.min' => 'Nama Profil minimal 3 karakter.',

                'namalink.required' => 'Nama link wajib diisi.',
                'namalink.max' => 'Nama link maksimal 20 karakter.',

                'url.required' => 'URL wajib diisi.',
                'url.url' => 'Format URL tidak valid.',
                'url.max' => 'URL maksimal 255 karakter.',
            ]);
            // $user = Auth::user(); User::find($id);
            // $user = user::all()->firstOrFail();
            $user = Auth::user();
        
            $statusnew = Profil::where('user_id', $user->id)->exists();
            // $statusnew = Profil::where('user_id', $user->id)->count();
            // dd($user);
            // $job = new Datauser();
            // $this->dispatch($job);
            $fileName = $this->images($request->file('images'));
            DB::transaction(function () use ($user, $request, $fileName) {
            // Update semua profil user menjadi "off"
            Profil::where('user_id', $user->id)->where('status', 'on')->update(['status' => 'off']);
                $newProfil = Profil::create([
                    'user_id' => $user->id,
                    'nama' => $request->nama,
                    'bio' => $request->bio,
                    'image' => $fileName,
                    'status' => "on",
                    // 'created_at' => now(),
                    // 'updated_at' => now(),
                ]);
            // $request->url as $url
            // Simpan link jika ada
            // $lastPosition = Link::where('profil_id', $newProfil->id)->max('position');
            // $nextPosition = $lastPosition ? $lastPosition + 1 : 1; // Jika kosong, mulai dari 1
            //--------------------------------------------------------------------------------------------------
            // $maxHeaderPos = Header::where('profil_id', $newProfil->id)->max('position');
            // $maxLinkPos = Link::where('profil_id', $newProfil->id)->max('position');
            // $nextPosition = max($maxHeaderPos, $maxLinkPos) ? max($maxHeaderPos, $maxLinkPos) + 1 : 1;

            $maxHeaderPos = Link::where('profil_id', $newProfil->id)
            ->where('position', 'LIKE', 'cuslink%')
            ->orderByRaw("CAST(SUBSTRING_INDEX(position, ' ', -1) AS UNSIGNED) DESC")
            ->value('position');
        
            // Ekstrak angka dari format 'custom 1', 'custom 2', dst.
            $nextPosition = 1;
            if ($maxHeaderPos) {
                preg_match('/\d+$/', $maxHeaderPos, $matches);
                $nextPosition = $matches ? intval($matches[0]) + 1 : 1;
            }

            if ($request->namalink && $request->url) {
                $filePaths = []; // Array untuk menyimpan link
                foreach ($request->namalink as $index => $namalink) {
                    $filePaths[] = [
                        'profil_id' => $newProfil->id,
                        'title' => $namalink,
                        'url' => $request->url[$index],
                        'position' => "cuslink".' '. $nextPosition++,
                        'embed' => false,
                        'hide' => true,
                        'created_at' => now(),
                        //'updated_at' => now(),
                    ];
                }
                Link::insert($filePaths);
            }
            Design::ChangeThema('', "Basics",$newProfil->id);
        });  
        // session()->forget('profil');
        // session()->forget('dataimg');
        // session()->put('profil',  $user['profil']->toArray());
        // session()->put('dataimg',  $user['profil']->where('status', 'on')->toArray());
        // session()->regenerateToken();
        // if ($statusnew > 0) {
        if ($statusnew) {
            return redirect()->route('links')->with('success', 'Data berhasil disimpan!');
        } else {
            return redirect()->route('links')->with('successwithcontent', 'Selamat untuk Pengguna Baru!');
        }
            // return redirect()->route('profil')->with('success', 'Register berhasil! Data berhasil disimpan.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }    
    }
    public function createlink(Request $request)
    {
    try {
        $user = Auth::user();
        $profil = Profil::where('user_id', $user->id)->where('status', 'on')->first();

        if (!$profil) {
            return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.']);
        }

        // ✅ 1. Cek Duplikasi Link
        $existingLink = Link::where('profil_id', $profil->id)
                            ->where('url', trim($request->url))
                            ->first();

        if ($existingLink) {
            return response()->json(['success' => false, 'message' => 'Link sudah ada dalam database.']);
        }

        // ✅ 2. Simpan Gambar Jika Ada
        $fileName = null;
        if ($request->hasFile('images')) {
            $fileName = $this->images($request->file('images'));
        }
        // $lastPosition = Link::where('profil_id', $profil->id)->max('position');
        // $nextPosition = $lastPosition ? $lastPosition + 1 : 1; // Jika kosong, mulai dari 1
       // 🔥 Ambil posisi terbesar dari `headers` dan `links`
        // $maxHeaderPos = Header::where('profil_id', $profil->id)->max('position');
        // $maxLinkPos = Link::where('profil_id', $profil->id)->max('position');
       
        // // 🔥 Cari angka terbesar dari keduanya, lalu tambahkan 1
        // $nextPosition = max($maxHeaderPos, $maxLinkPos) ? max($maxHeaderPos, $maxLinkPos) + 1 : 1;
        
        // ✅ 3. Pastikan Embed Bernilai Boolean
        $embedValue = ($request->embed === "on") ? true : false;

        $maxHeaderPos = Link::where('profil_id', $profil->id)
        ->where('position', 'LIKE', 'cuslink%')
        ->orderByRaw("CAST(SUBSTRING_INDEX(position, ' ', -1) AS UNSIGNED) DESC")
        ->value('position');
    
        // Ekstrak angka dari format 'custom 1', 'custom 2', dst.
        $nextPosition = 1;
        if ($maxHeaderPos) {
            preg_match('/\d+$/', $maxHeaderPos, $matches);
            $nextPosition = $matches ? intval($matches[0]) + 1 : 1;
        }

        // ✅ 3. Simpan Data ke Database
        Link::create([
            'profil_id' => $profil->id,
            'title' => $request->title,
            'url' => $request->url,
            'image' => $fileName,
            'position' => "cuslink $nextPosition",
            // 'embed' => $request->embed === "on", // 🔥 Simpan boolean
            'embed' => $embedValue, // 🔥 Simpan sebagai boolean
            'hide' => true,
        ]);

    //     return redirect()->back()->with("success", "Data berhasil disimpan!");

    // } catch (\Exception $e) {
            
    //     return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
    // }   
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
    
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data.']);
    }
}
public function updatelink(Request $request)
{
    try {
        \Log::info("Updating ID: Data:", $request->all());
        $user = Auth::user();
        $profil = Profil::where('user_id', $user->id)->where('status', 'on')->first();

        if (!$profil) {
            return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.']);
        }
        $embedValue = ($request->embed === "on") ? true : false;
        // ✅ 1. Cek Duplikasi Link
        $existingLink = Link::where('profil_id', $profil->id)
                            ->where("title", $request->title)
                            ->where('url', trim($request->url))
                            ->where('embed', $embedValue)
                            ->first();

        if ($existingLink && !$request->hasFile('images')) {
            return response()->json(['success' => false, 'message' => 'Link dengan title yang sama sudah ada dalam database.']);
        }

        // ✅ 2. Simpan Gambar Jika Ada
    

        $Link = Link::where('profil_id', $profil->id)->findOrFail($request->idlink);


        $fileName = null;
        if ($request->hasFile('images')) {
            $fileName = $this->images($request->file('images'));
            if (!empty($Link->image) && file_exists(public_path('storage/img/' . $Link->image))) {
                unlink(public_path('storage/img/' . $Link->image));
            }
        }
        $updateData = [
            'title' => $request->title,
            'url' => $request->url,
            'embed' => $embedValue, // Simpan sebagai boolean
        ];
        if ($fileName) {
            $updateData['image'] = $fileName;
        }

        $Link->update($updateData);
    
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data.']);
    }
}
    // public function creatlink(Request $request){

    //     try { 

    //         // ✅ 1. Validasi Input
    //         $request->validate([
    //             'images' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10240',
    //             'title' => 'required|string|max:20',
    //             'url' => 'required|url|max:255',
    //         ], [
    //             'images.file' => 'File tidak valid.',
    //             'images.mimes' => 'Format yang diizinkan: JPEG, PNG, JPG, GIF, WEBP.',
    //             'images.max' => 'Ukuran file maksimal 10MB.',

    //             'title.required' => 'Nama link wajib diisi.',
    //             'title.max' => 'Nama link maksimal 20 karakter.',

    //             'url.required' => 'URL wajib diisi.',
    //             'url.url' => 'Format URL tidak valid.',
    //             'url.max' => 'URL maksimal 255 karakter.',
    //         ]);
    //         // ✅ 2. Ambil User & Profil Aktif
    //         $user = Auth::user();
    //         $profil = Profil::where('user_id', $user->id)->first(); // Ambil profil pertama user

    //         if (!$profil) {
    //             return redirect()->back()->with('error', 'Profil tidak ditemukan.')->withInput();
    //         }

    //         // ✅ 3. Cek Apakah Link dengan URL yang Sama Sudah Ada di Profil Ini
    //         $existingLink = Link::where('profil_id', $profil->id)
    //         ->where('url', $request->url)
    //         ->first();

    //         if ($existingLink) {
    //         return redirect()->back()->with('error', 'Link sudah ada dalam database.')->withInput();
    //         }
    //         // ✅ 4. Upload Gambar Jika Ada
    //         $fileName = null;
    //         if ($request->hasFile('images')) {
    //             $fileName = $this->images($request->file('images'));
    //         }

    //         // ✅ 5. Simpan Data ke Database
    //         Link::create([
    //             'profil_id' => $profil->id,
    //             'title' => $request->title,
    //             'url' => $request->url,
    //             'image' => $fileName,
    //             'hide' => 'on',
    //         ]);

    //         return redirect()->route('links')->with('success', 'Data berhasil disimpan!');
    
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
    //     } 
    // }
    public function deleteprofil(Request $request, $id)
    {
        try {
           
            $user = User::with('profil')->where('id', Auth::id())->firstOrFail();
            if (!$user) {
                return redirect()->back()->with("error", "Profil tidak ditemukan.");
            }

            $profil = optional($user->profil)->where('id', $id)->first();
            if (!$profil) {
                return redirect()->back()->with("error", "Profil tidak ditemukan.");
            }

            // Hapus gambar jika ada
            if ($profil->image && Storage::disk('public')->exists('img/' . $profil->image)) {
                Storage::disk('public')->delete('img/' . $profil->image);
            }
            // if ($profil['image'] && file_exists(public_path('storage/img/' . $profil['image']))) {
            //     unlink(public_path('storage/img/' .  $profil['image']));
            // }
            $profil->delete();

        // **Perbarui session dengan data terbaru setelah penghapusan**
        //  session()->forget('profil');
        //  session()->forget('dataimg');

        // Ambil profil terbaru yang masih aktif
        // $newProfil = Profil::where('user_id', $user->id)->where('status', 'on')->first();
        // $newDataImg = Profil::where('user_id', $user->id)->where('status', 'on')->get()->toArray();
        // // Simpan ke session hanya jika ada data baru
        // if ($newProfil) {
        //     session()->put('profil', $newProfil->toArray());
        // }
        // if (!empty($newDataImg)) {
        //     session()->put('dataimg', $newDataImg);
        // }
        // session()->regenerateToken();
        
            return redirect()->back()->with('success', "Data berhasil dihapus!");

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.')->withInput();
        } 
    }
    public function deletelink(Request $request, $id)
    {
        try {
        
            $deletelink = Link::findOrFail($id);
       
            if ($deletelink['image'] && file_exists(public_path('storage/img/' . $deletelink['image']))) {
                unlink(public_path('storage/img/' .  $deletelink['image']));
            }

            $deletelink->delete();
    
            return response()->json([
                'message' => 'Data berhasil dihapus!',
                // 'id' => $update->id,
                //'hide' => $update->hide
            ], 200);
        } catch (\Exception $e) {
            \Log::error("Data Delete Error:", ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Terjadi kesalahan server.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function deleteheader(Request $request, $id)
    {
        try {
        
            $deleteheader = Header::findOrFail($id);
            $deleteheader->delete();
    
            return response()->json([
                'message' => 'Data berhasil dihapus!',
                // 'id' => $update->id,
                //'hide' => $update->hide
            ], 200);
        } catch (\Exception $e) {
            \Log::error("Data Delete Error:", ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Terjadi kesalahan server.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function deletesocial(Request $request, $id)
    {
        try {
        
            $deletesocial = SocialMedia::findOrFail($id);
            $deletesocial->delete();
    
            return response()->json([
                'message' => 'Data berhasil dihapus!',
                // 'id' => $update->id,
                //'hide' => $update->hide
            ], 200);
        } catch (\Exception $e) {
            \Log::error("Data Delete Error:", ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Terjadi kesalahan server.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function hidelink(Request $request, $id)
    {
        try {
        
           // Log::info("Request diterima:", $id); // Debugging
           \Log::info("Updating ID: $id, Data:", $request->all());
            // Validasi request
            $request->validate([
                'hide' => 'required|string|in:on,off',
            ]);
            // $header = Header::find($id);
            // if (!$header) {
            //     return response()->json(['error' => 'Data tidak ditemukan.'], 404);
            // }
            // Update status berdasarkan ID
            // Konversi nilai "on" ke true dan "off" ke false
            $hideValue = $request->hide === 'on' ? true : false;

            $update = Link::findOrFail($id);
            $update->update(['hide' => $hideValue]);
    
            return response()->json([
                'message' => 'Status berhasil diperbarui!',
                'id' => $update->id,
                //'hide' => $update->hide
            ], 200);
        } catch (\Exception $e) {
            \Log::error("Update Status Error:", ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Terjadi kesalahan server.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function hideheader(Request $request, $id)
    {
        try {
            // Log::info('Updating ID', ['id' => $id, 'status' => $request->hide]);

            // Validasi request
            $request->validate([
                'hide' => 'required|string|in:on,off',
            ]);
            // $header = Header::find($id);
            // if (!$header) {
            //     return response()->json(['error' => 'Data tidak ditemukan.'], 404);
            // }
            // Update status berdasarkan ID
            // Konversi nilai "on" ke true dan "off" ke false
            $hideValue = $request->hide === 'on' ? true : false;

            $update = Header::findOrFail($id);
            $update->update(['hide' => $hideValue]);
    
            return response()->json([
                'message' => 'Status berhasil diperbarui!',
                'id' => $update->id,
                // 'status' => $hideValue
            ], 200);
        } catch (\Exception $e) {
            \Log::error("Update Status Error:", ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Terjadi kesalahan server.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function hidesocial(Request $request, $id)
    {
        try {
        
           // Log::info("Request diterima:", $id); // Debugging
           \Log::info("Updating ID: $id, Data:", $request->all());
            // Validasi request
            $request->validate([
                'hide' => 'required|string|in:on,off',
            ]);
   
            $hideValue = $request->hide === 'on' ? true : false;

            $update = SocialMedia::findOrFail($id);
            $update->update(['hide' => $hideValue]);
    
            return response()->json([
                'message' => 'Status berhasil diperbarui!',
                'id' => $update->id,
            //    'status' => $hideValue
            ], 200);
        } catch (\Exception $e) {
            \Log::error("Update Status Error:", ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Terjadi kesalahan server.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function bloguser(Request $Request, $username, $blog){

    try {
        if (!preg_match('/^[a-zA-Z0-9._]{3,}$/', $username)) {
            abort(404, 'Username blog tidak valid');
        }
        $user = User::with(['profil' => function ($query) {
            $query->where('status', 'on')
            ->with('postblog','socialmedia');
        }])->where('username', $username)->firstOrFail();

        $profil = $user->profil->first();
        if (!$profil) {
            abort(404, 'Profil User tidak ditemukan atau tidak aktif');
        }
        $slug = $profil->postblog->where('slug', $blog)->firstOrFail();

        return view('user.userblog',[
            'profil' => $profil,
            'social' => $profil->socialmedia,
            'slug' => $slug,
        ]);

        } catch (ModelNotFoundException $e) {
            abort(404, 'User tidak ditemukan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba lagi nanti.');
        }
    }

    public function haluser(Request $Request, $username){
      
        try {

            if (!preg_match('/^[a-zA-Z0-9._]{3,}$/', $username)) {
                abort(404, 'Username tidak valid');
            }
            // if (!filter_var($username, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
            //     abort(404);
            // }
            // $profil = Profil::where('user_id', $id)
            // ->where('status', 'on')
            // ->firstOrFail();
            // $settings = Design::getSetting($profil->id)->first();
            //-----------------------------------
            // $user = User::where('username', $username)->firstOrFail();
            // $profil = Profil::with('Design') // jika relasi 'design' ada
            //      ->where('user_id', $user->id)
            //      ->where('status', 'on')
            //      ->firstOrFail();
            // $settings = $profil->design;

            // Query User beserta relasi Profil dan Design dalam satu query
            $user = User::with(['profil' => function ($query) {
                $query->where('status', 'on')
                // ->with('link')
                // ->with('design');
                ->with(['link', 'design','header','socialmedia','postblog','postimage.imageposts']);
            }])->where('username', $username)->firstOrFail();

            //$postimage = $user->profil->postimage;
            
            // Ambil profil aktif pertama
            $profil = $user->profil->first();

            
            if (!$profil) {
                abort(404, 'Profil tidak ditemukan atau tidak aktif');
            }
              // Pastikan desain ada
            // $design = $profil->design;
            if ($profil->design->isEmpty()) {
                abort(404, 'Desain tidak ditemukan');
            }

            if ($profil->design[0]["theme"] !== "Custom"){
                $box_shadow = "0px 6px 14px -6px rgba(24, 39, 75, 0.12), 0px 10px 32px -4px rgba(24, 39, 75, 0.1), inset 0px 0px 2px 1px rgba(255, 255, 255, 0.05)" ;
            }
            $postimage = $profil->postimage;
            
            $items = collect($profil->header)
            ->merge($profil->link)
            ->sortBy('position')
            ->values(); // Reset indeks array

            return view('user.user', compact('items'),[
                'profil' => $profil,
                'design' => $profil->design,
                'postblog' => $profil->postblog,
                'postimage' => $profil->postimage,
                'imageposts' => $postimage,
                'social' => $profil->socialmedia,
                'box_shadow' => $box_shadow ?? [],
                // 'iconname' => 'Jadwal Saya',
                'username' => $user->username,
            ]);

        } catch (ModelNotFoundException $e) {
            abort(404, 'User tidak ditemukan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba lagi nanti.');
        }
    }
    // Route::
    public function settings(Request $request) {

            $id =  Auth::user()->id;
            $user = User::with('profil')->where('id', $id)->firstOrFail();

        return view('main.setting',[
            'user' => $user,
        
        ]);

    }
    public function posts(Request $request) {

     
        // Cara mengambil profil dengan relasi nested (postimage dengan imageposts)
            $profil = Profil::with(['postimage.imageposts', 'postblog'])
            ->where('user_id', Auth::id())
            ->where('status', 'on')
            ->first();
          
            // Ambil data postimage beserta relasi imageposts-nya dari profil
            $postimage = $profil->postimage;

            // contoh mengakses imageposts dari postimage
          //  $imageposts = $postimage ? $postimage->imageposts : collect();

        return view('main.postimage',[
            'postblog' => $profil['postblog'],
            'postimage' => $profil['postimage'],
            'imageposts' => $postimage,
        ]);

    }
    public function createsocials(Request $request) {
        try {
        // ✅ 1. Validasi Input
        $validator = Validator::make($request->all(), [
            "url" => "required|string",
            "svg" => "required|string"
        ], [
            "url.required" => "Nama sosial media wajib diisi.",
            // "url.max" => "Nama maksimal 50 karakter.",
            "svg.required" => "Ikon sosial media tidak boleh kosong."
        ]);
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()
            ], 422);
        }
        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        //         }
        // ✅ 2. Ambil Profil yang Aktif
        $user = Auth::user();
        $profil = Profil::where('user_id', $user->id)->where('status', 'on')->first();
    
        if (!$profil) {
            return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.']);
            // return redirect()->back()->with("error", "Profil tidak ditemukan atau tidak aktif.");
        }
    
        // ✅ 3. Cek Apakah Social Media Sudah Ada
        $existingSocialMedia = $profil->socialmedia()->where('profil_id', $profil->id)
                                    ->where("title", $request->title)
                                    ->where("url", $request->url)
                                    ->first();
        if ($existingSocialMedia) {
            return response()->json(['success' => false, 'message' => 'Social media sudah ada.']);
            // return redirect()->back()->with("error", "Social media sudah ada.");
        }
       
     
        // ✅ 4. Simpan Data ke Database
        SocialMedia::create([
            'profil_id' => $profil->id, // 🔥 Simpan dengan profil_id
            'title' => $request->title,
            'url' => $request->url,
            'svg' => $request->svg,
            'hide' => true,
        ]);
    
        // return redirect()->back()->with("success", "Data berhasil disimpan!");

        // } catch (\Exception $e) {
                
        //     return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        // }    
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
    
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data.']);
    }

    }
    public function updatesocials(Request $request) {
        try {
            // ✅ 1. Validasi Input
            $validator = Validator::make($request->all(), [
                'idsocial' => 'required|integer|exists:social_media,id',
                "title" => "required|string",
                "url" => "required|string",
                "svg" => "required|string"
            ], [
                "url.required" => "Nama sosial media wajib diisi.",
                "svg.required" => "Ikon sosial media tidak boleh kosong.",
                "idsocial.required" => "ID tidak terbaca, harap hubungi pembuat sistem.",
                "title.required" => "Title tidak terbaca, harap hubungi pembuat sistem."
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    "success" => false,
                    "errors" => $validator->errors()
                ], 422);
            }
    
            // ✅ 2. Ambil Profil yang Aktif
            $user = Auth::user();
            $profil = Profil::where('user_id', $user->id)->where('status', 'on')->first();
    
            if (!$profil) {
                return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.'], 404);
            }
    
            // ✅ 3. Cek Apakah Social Media Sudah Ada
            $existingSocialMedia = SocialMedia::where('profil_id', $profil->id)
                                    ->where("title", $request->title)
                                    ->where("url", $request->url)
                                    ->first();
    
            if ($existingSocialMedia) {
                return response()->json(['success' => false, 'message' => 'Social media sudah ada.'], 409);
            }
    
            // ✅ 4. Cari Data Sosial Media Berdasarkan `profil_id` (Cegah update data lain)
            $social = SocialMedia::where('profil_id', $profil->id)->findOrFail($request->idsocial);
    
            // ✅ 5. Simpan Data ke Database
            $social->update([
                'title' => $request->title,
                'url' => $request->url,
                'svg' => $request->svg,
            ]);
    
            return response()->json(['success' => true, 'message' => 'Data berhasil diubah!'], 200);
    
        } catch (\Exception $e) {
            \Log::error("❌ Error di updatesocials:", ['error' => $e->getMessage()]);
    
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.',
                'error_details' => $e->getMessage() // Untuk debugging
            ], 500);
        }
    }
    
    public function createheader(Request $request) {
        try {
        // ✅ 1. Validasi Input
        $validator = Validator::make($request->all(), [
            "title" => "required|string"
        ], [
            "title.required" => "Title tidak boleh kosong."
        ]);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        //         }
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()
            ], 422);
        }  
        // ✅ 2. Ambil Profil yang Aktif
        $user = Auth::user();
        $profil = Profil::where('user_id', $user->id)->where('status', 'on')->first();
    
        if (!$profil) {
            return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.']);
            // return redirect()->back()->with("error", "Profil tidak ditemukan atau tidak aktif.");
        }
    
        // ✅ 3. Cek Apakah Social Media Sudah Ada
        // $existingSocialMedia = $profil->socialmedia()->where('profil_id', $profil->id)
        //                             ->where("title", $request->title)
        //                             ->where("url", $request->url)
        //                             ->first();
        // if ($existingSocialMedia) {
        //     return redirect()->back()->with("error", "Social media sudah ada.");
        // }
        $maxHeaderPos = Header::where('profil_id', $profil->id)
        ->where('position', 'LIKE', 'cusher%')
        ->orderByRaw("CAST(SUBSTRING_INDEX(position, ' ', -1) AS UNSIGNED) DESC")
        ->value('position');
    
        // Ekstrak angka dari format 'custom 1', 'custom 2', dst.
        $nextPosition = 1;
        if ($maxHeaderPos) {
            preg_match('/\d+$/', $maxHeaderPos, $matches);
            $nextPosition = $matches ? intval($matches[0]) + 1 : 1;
        }

      
        // ✅ 4. Simpan Data ke Database
        Header::create([
            'profil_id' => $profil->id, // 🔥 Simpan dengan profil_id
            'position' => "cusher $nextPosition",
            'title' => $request->title,
            'hide' => true,
        ]);
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
    
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data.']);
    }
        // return redirect()->back()->with("success", "Data berhasil disimpan!");

        // } catch (\Exception $e) {
                
        //     return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        // }    

    }
    public function updateheader(Request $request) {
        try {
        // ✅ 1. Validasi Input
        $validator = Validator::make($request->all(), [
            "title" => "required|string"
        ], [
            "title.required" => "Title tidak boleh kosong."
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()
            ], 422);
        }  
        // ✅ 2. Ambil Profil yang Aktif
        $user = Auth::user();
        $profil = Profil::where('user_id', $user->id)->where('status', 'on')->first();
    
        if (!$profil) {
            return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.']);
            // return redirect()->back()->with("error", "Profil tidak ditemukan atau tidak aktif.");
        }

        $Header = Header::where('profil_id', $profil->id)->findOrFail($request->idheader);

        $Header->update([
            'title' => $request->title,
        ]);

        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
    
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data.']);
    }

    }
    public function accountsetting(Request $request) {

        $id =  Auth::user()->id;
        $user = User::with(['profil' => function ($query) {
            $query->where('status', 'on');
        }])->where('id', $id)->firstOrFail();
       
        return view('main.accountsetting',[
            'user' => $user,
        ]);

    }

    public function links(Request $request) {


        $id =  Auth::user()->id;
        $user = User::with(['profil' => function ($query) {
            $query->where('status', 'on')
            ->with(['link', 'design','header','socialmedia']);
        }])->where('id', $id)->firstOrFail();
       // Ambil profil dengan relasi header & link
    // $profil = Profil::with(['header', 'link'])->where('id', $profil_id)->firstOrFail();
    $profil = $user->profil->first();
   
    // Gabungkan `headers` dan `links` lalu urutkan berdasarkan `position`
    $items = collect($profil->header)
                ->merge($profil->link)
                ->sortBy('position')
                ->values(); // Reset indeks array
              //  dd( session()->all()); 
                return view('main.link', compact('profil', 'items'));
                // return view('main.link', compact('profil'));
        // return view('main.link',[
        //     'user' => $user,
        // ]);

    }
    public function updateprofil(Request $request) {
        try {
            $id = Auth::user()->id;
            $user = User::with('profil')->where('id', $id)->firstOrFail();

            if (!$user) {
                return redirect()->back()->with("error", "Profil tidak ditemukan.");
            }
            
            $profil = $user->profil->where('status', 'on')->firstOrFail();

            // **Cek apakah ada file yang diunggah**
            $isNewImageUploaded = $request->hasFile('images');
    
            // **Validasi Data**
            $validatorRules = [
                'nama' => 'required|string|min:3',
                'bio' => 'nullable|string',
            ];
    
            if (!$isNewImageUploaded) {
                // **Jika tidak ada gambar baru, pastikan `old_image` ada**
                $validatorRules['old_image'] = 'required|string';
            } else {
                // **Jika ada gambar baru, validasi file gambar**
                $validatorRules['images.*'] = 'file|mimes:jpeg,png,jpg,gif,webp|max:10240';
            }
    
            $validator = Validator::make($request->all(), $validatorRules, [
                'old_image.required' => 'Gambar tidak boleh kosong jika tidak ada gambar baru.',
    
                'nama.required' => 'Nama Profil wajib diisi.',
                'nama.min' => 'Nama Profil minimal 3 karakter.',
    
                'images.*.file' => 'File tidak valid.',
                'images.*.mimes' => 'Format gambar harus JPEG, PNG, JPG, GIF, atau WEBP.',
                'images.*.max' => 'Ukuran file maksimal adalah 10MB.',
            ]);
    
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
    
            // **Jika ada file baru, simpan dan hapus gambar lama**
            if ($isNewImageUploaded) {
                $fileName = $this->images($request->file('images'));
    
                // **Hapus gambar lama jika ada**
                if (!empty($profil->image) && file_exists(public_path('storage/img/' . $profil->image))) {
                    unlink(public_path('storage/img/' . $profil->image));
                }
            } else {
                // **Gunakan gambar lama jika tidak ada file baru**
                $fileName = $request->old_image ?? $profil->image;
            }

            // **Update profil user**
            $profil->update([
                'nama' => $request->nama,
                'bio' => $request->bio,
                'image' => $fileName, // Gunakan gambar baru jika ada, jika tidak gunakan old_image
            ]);

            // session()->forget('profil');
            // session()->forget('dataimg');
            // session()->put('profil',  $user['profil']->toArray());
            // session()->put('dataimg',  $user['profil']->where('status', 'on')->toArray());
            // session()->regenerateToken();

            return redirect()->back()->with('success', 'Data berhasil diupdate!');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }
    
    // public function updateprofil(Request $request) {
  
    // try{
    //     $id =  Auth::user()->id;

    //     $user = User::with(['profil' => function ($query) {
    //         $query->where('status', 'on');
    //     }])->where('id', $id)->firstOrFail();

    //     if ($request->hasFile('images')) {
    //         $validator = Validator::make($request->all(), [
    //             'nama' => 'required|string|min:3',
    //             'bio' => 'nullable|string', 
    //             'images.*' => 'file|mimes:jpeg,png,jpg,gif,webp|max:10240',
    //         ], [
    //             'images.*.file' => 'Terdapat file yang tidak valid.', // Pesan jika file tidak valid
    //             'images.*.mimes' => 'format: JPEG, PNG, JPG, GIF dan WEBP yang diizinkan.', // Pesan jika tipe file tidak valid
    //             'images.*.max' => 'Ukuran file maksimal adalah 10MB.', // Pesan jika ukuran file terlalu besar
                
    //         ]);
    //         if ($validator->fails()) {
    //             throw new ValidationException($validator);
    //         }
    //         $fileName = $this->images($request->file('images'));

    //         if ($user['profil'][0]->image && file_exists(public_path('storage/img/' . $user['profil'][0]->image))) {
    //             unlink(public_path('storage/img/' .  $user['profil'][0]->image));
    //         }
    //     }

    //     // $request->validate([
    //     $validator = Validator::make($request->all(), [
    //         'nama' => 'required|string|min:3',
    //         'bio' => 'nullable|string', 
    //         'old_image'=> 'required|string',
    //     ], [
    //         'old_image.required' => 'gambar tidak boleh kosong.',

    //         'nama.required' => 'Nama Profil wajib diisi.',
    //         'nama.min' => 'Nama Profil minimal 3 karakter.',

    //         'namalink.required' => 'Nama link wajib diisi.',
    //         'namalink.max' => 'Nama link maksimal 20 karakter.',
    //     ]);
    //     if ($validator->fails()) {
    //         throw new ValidationException($validator);
    //     }
    //      $user->profil()->update([
    //         'nama' => $request->nama,
    //         'bio' => $request->bio,
    //         'image' => $fileName ?? $request->old_image ?? $user['profil'][0]->image,
    //     ]);

    //     return redirect()->back()->with('success', 'data berhasil diupdate!');
    //     // return redirect()->route('profil')->with('success', 'Register berhasil! Data berhasil disimpan.');

    //     // catch (\Exception $e) {
    //     } catch (ValidationException  $e) {
    //         //  return back()->withErrors('error', 'Terjadi kesalahan saat menyimpan data.', $e->validator->errors())->withInput();
    //         //    return back()->withErrors($e->validator->errors())->withInput();
    //     return back()->with('error', $e->getMessage());
    //         //    return back()->with('error', $e->getMessage());
    //     }   

    // }

    public function updateacount(Request $request) {

        $request->validate([
            'email' => 'required|string|unique:users,email,' . $request->email,
        ]);
        try {
            DB::beginTransaction();
           
            // Mengunci baris user saat ini
            $id =  Auth::user()->id;
            $user = User::with(['profil' => function ($query) {
                $query->where('status', 'on');
            }])->where('id', $id)->lockForUpdate()->firstOrFail();
            $user->email = $request->email;
            $user->save();

            DB::commit();
    
            return redirect()->back()->with('success', 'Account berhasil diupdate!');
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->with(['error' => 'Account sudah digunakan']);
        }

    }

    public function updateusername(Request $request) {

        $request->validate([
            'username' => 'required|string|unique:users,username,' . $request->username,
        ]);
        try {
            DB::beginTransaction();
           
            // Mengunci baris user saat ini
            $id =  Auth::user()->id;
            $user = User::with(['profil' => function ($query) {
                $query->where('status', 'on');
            }])->where('id', $id)->lockForUpdate()->firstOrFail();
            $user->username = $request->username;
            $user->save();

            DB::commit();
    
            return redirect()->back()->with('success', 'Username berhasil diupdate!');
        } catch (QueryException $e) {
            DB::rollBack();
            return back()->with(['error' => 'Username sudah digunakan']);
        }

    }

    public function changepassword(Request $request) {
    try {
        $validator = Validator::make($request->all(), [
            'old' => ['required', 'min:8', 'regex:/[A-Z]/'],
            'new' => ['required', 'min:8', 'regex:/[A-Z]/'],
            'confirm' => 'required|same:new',
        ], [
      
            'old.required' => 'Password lama wajib diisi.',
            'old.min' => 'Password lama minimal 8 karakter.',
            'old.regex' => 'Password lama harus mengandung setidaknya 1 huruf besar.',

            'new.required' => 'Password baru wajib diisi.',
            'new.min' => 'Password baru minimal 8 karakter.',
            'new.regex' => 'Password baru harus mengandung setidaknya 1 huruf besar.',

            'confirm.required' => 'Confirm wajib diisi.',
            'confirm.same' => 'Confirm Password  harus sama dengan Password Baru.',
        ]);
       
       if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
            }

            $user = Auth::user();
            if (!Hash::check($request->old, $user->password)) {
                return redirect()->back()->with('error', 'Password saat ini salah!');
            }
            $user->password = Hash::make($request->new);
            $user->save();

            return redirect()->back()->with('success', 'Password berhasil diupdate!');
   
        } catch (\Exception $e) {
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }    

    }
    
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);
     
        $user = User::with('profil')->where('username', $request->username)->firstOrFail();
        // $user->password = Hash::make('Csman123'); 
        // $user->save();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['error', 'Login failed: '  => 'Username atau password salah!']);
        }
        // if ($user->role === 'pending') {
        //     return back()->withErrors(['errorlogin', 'Login failed: '  => 'Akun Anda belum disetujui oleh admin. Silakan tunggu persetujuan.']);
        // }
        // if ($user->role === 'nonaktif') {
        //     return back()->withErrors(['errorlogin', 'Login failed: '  => 'Akun Anda dinonaktif.']);
        // }
     
        // "id" => 1
        // "user_id" => 1
        // "nama" => "nama profil"
        // "bio" => "nama bio"
        // "image" => "1741168301_67c81ead64f68.jpg"
        // "status" => "on"
        // "created_at" => "2025-03-02 06:04:48"
        // "updated_at" => "2025-03-05 09:51:41"
        Auth::login($user);
        // session([
        //     'profil ' => $user['profil'],
        // ]);
        // session()->put('profil',  $user['profil']->toArray());
        // session()->put('dataimg',  $user['profil']->where('status', 'on')->toArray());
        if (!$user->profil) {
            return redirect()->route('profil');
        }
        return redirect()->route('links')->with('success', 'Login berhasil!');
    }

    public function logout(Request $request){
        if (!Auth::check()) {
            return redirect()->route('login')->with('errorlogout', 'Anda belum login.');
        }
        Auth::logout();
        session()->flush();
        session()->regenerateToken();

        return redirect()->route('login')->with('successlogout', 'Logout berhasil!');
    }
    
    public function images($file){
        // Pastikan file ada
        if (!$file) {
            return null;
        }

        try {
            // Buat objek gambar menggunakan Imagick
            $image = new \Imagick($file->getPathname());

            // Set format gambar ke JPG
            $image->setImageFormat('jpg');

            // Kompresi gambar dengan kualitas 80%
            $image->setImageCompression(\Imagick::COMPRESSION_JPEG);
            $image->setImageCompressionQuality(80);

            // Hapus metadata untuk mengurangi ukuran file
            $image->stripImage();

            // Resize gambar ke lebar 800px sambil menjaga aspek rasio
            $width = 800;
            $image->resizeImage($width, 0, \Imagick::FILTER_LANCZOS, 1);

            // Buat nama file unik
            $fileName = time() . '_' . uniqid() . '.jpg';

            // Tentukan direktori penyimpanan
            $directoryPath = storage_path('app/public/img');
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true);
            }

            // Simpan gambar ke direktori
            $image->writeImage($directoryPath . '/' . $fileName);

            // Bersihkan memori
            $image->clear();
            $image->destroy();

            // Return nama file untuk disimpan di database
            return $fileName;

        } catch (\ImagickException $e) {
            // Tangani error jika ada masalah dengan Imagick
            \Log::error('Imagick Error: ' . $e->getMessage());
            return null;
        }
    }
}
