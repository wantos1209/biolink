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
use Mews\Purifier\Facades\Purifier;
class ProfilController extends Controller
{
    //
    protected $images;
    protected $deleteimages;
    public function createdaftar(Request $request){
      
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username|max:200',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'min:8','regex:/[a-z]/', 'regex:/[A-Z]/','regex:/[0-9]/'],
            'konfirmasipassword' => 'required|same:password',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah terdaftar.',
            'username.max' => 'Username maksimal 200 karakter.',

            'email.required' => 'Username wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Username sudah terdaftar.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.regex' => 'Password harus mengandung huruf kecil, huruf besar, dan angka.',

            'konfirmasipassword.required' => 'Konfirmasi password wajib diisi.',
            'konfirmasipassword.same' => 'Konfirmasi password tidak cocok dengan password.',
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

        } catch (\Exception $e) {
        
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }    
    }
public function uploadImage(Request $request) 
{
 
    $validator = Validator::make($request->all(), [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
    ], [
        'image.required' => 'Gambar wajib diunggah.',
        'image.image' => 'File harus berupa gambar.',
        'image.mimes' => 'Format gambar harus JPEG, PNG, JPG, GIF atau WEBP.',
        'image.max' => 'Ukuran gambar maksimal 10MB.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            "success" => false,
            "errors" => $validator->errors()
        ], 422);
    }
    $profil = Profil::with('postimage')->where('user_id', Auth::id())->where('status', 'on')->first();

    if (!$profil) {
        return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.']);
    }

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $path = $file->store("postblog/{$profil->id}", 'public');
        $relativePath = "/storage/" . $path;
        return response()->json(['url' => $relativePath]);
    }

    if ($request->hasFile('image')) {
        $file = $request->file('image');
    
 
        $mime = $file->getMimeType();
        if (!in_array($mime, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
            $content = Purifier::clean($request->input('content')); 
            return response()->json([
                'error' => 'Tipe file tidak valid',
                'cleaned_content' => $content 
            ], 400);
        }
        $path = $file->store("postblog/{$profil->id}", 'public');
        $relativePath = "/storage/" . $path;
        return response()->json(['url' => $relativePath]);

    }
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
    public function updatepostimage(Request $request) {
     

        try {
            
            $validator = Validator::make($request->all(), [
                'idpostimage' => 'required|exists:post_images,id',
                'deskripsi' => 'required|string|max:255',
                'images.*' => 'file|mimes:jpeg,png,jpg,gif,webp|max:10240',
            ], [
                'deskripsi.required' => 'deskripsi wajib diisi.',
                'deskripsi.max' => 'title maksimal 255 karakter.',
                'images.*.file' => 'Terdapat file yang tidak valid.', 
                'images.*.mimes' => 'format: JPEG, PNG, JPG, GIF dan WEBP yang diizinkan.',
                'images.*.max' => 'Ukuran file maksimal adalah 10MB.', 
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

            $postimg = PostImage::with('imageposts')->where('id', $request->idpostimage)->where('profil_id', $profil->id)->firstOrFail();
           
            $oldImages = $postimg->imageposts->pluck('image')->toArray();
         
            $newFileNames = [];
            if ($request->file('images')) {
                foreach ($request->file('images') as $img) {
                    $image = new \Imagick($img->getPathname());
                    $image->setImageFormat('webp');
                    $image->setImageCompressionQuality(80);
                    $image->stripImage();
                    $image->resizeImage(800, 0, \Imagick::FILTER_LANCZOS, 1);

                    $fileName = time() . '_' . uniqid() . '.webp';
                    $image->writeImage(storage_path('app/public/img/' . $fileName));

                    $newFileNames[] = $fileName;

                    ImagePost::create([
                        'postimage_id' => $postimg->id,
                        'image' => $fileName,
                    ]);

                    $image->clear();
                    $image->destroy();
                }
            }
            $datapostimage = $request->has('datapostimage') ? $request->datapostimage : [];

            $imagesToDelete = array_diff($oldImages, $datapostimage);
          
                if (!empty($imagesToDelete)) {
                    foreach ($imagesToDelete as $filename) {

                        $filename = basename($filename);

                        $filePath = storage_path('app/public/img/' . $filename);
                        if (file_exists($filePath)) {
              
                            Storage::disk('public')->delete('img/' . $filename);
                        }
                       
                        ImagePost::where('postimage_id', $postimg->id)->where('image', $filename)->delete();
                    }
                }
                $postimg->update([
                    'deskripsi' => $request->deskripsi
                ]);
                

            return redirect()->back()->with('success', 'Post berhasil disimpan!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function createpostimage(Request $request) {

        try {
            $validator = Validator::make($request->all(), [
                'deskripsi' => 'required|string|max:255',
                'images.*' => 'file|mimes:jpeg,png,jpg,gif,webp|max:10240',
            ], [
                'deskripsi.required' => 'deskripsi wajib diisi.',
                'deskripsi.max' => 'title maksimal 255 karakter.',
                'images.*.file' => 'Terdapat file yang tidak valid.',
                'images.*.mimes' => 'format: JPEG, PNG, JPG, GIF dan WEBP yang diizinkan.',
                'images.*.max' => 'Ukuran file maksimal adalah 10MB.', 
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
          
            $nextPosition = 1;
            if ($maxHeaderPos) {
                preg_match('/\d+$/', $maxHeaderPos, $matches);
                $nextPosition = $matches ? intval($matches[0]) + 1 : 1;
            }
           
            $postimg = PostImage::create([
                'profil_id' => $profil->id,
                'position' => "cuspimg $nextPosition",
                'section' => 'postimage',
                'deskripsi' => $request->deskripsi,
                'hide' => true,
                'created_at' => now(),
            ]);
         
            if ($request->file('images')) {
                    $filePaths = []; 
                    foreach ($request->file('images') as $img) {
                    
                        $image = new \Imagick($img->getPathname()); 
                        $image->setImageFormat('webp'); 
                        $image->setImageCompressionQuality(80);
                        $image->stripImage(); 
                        $width = 800;
                        $image->resizeImage($width, 0, \Imagick::FILTER_LANCZOS, 1);
                        
                        $fileName = time() . '_' . uniqid() . '.webp';
                        $directoryPath = storage_path('app/public/img');

                        if (!file_exists($directoryPath)) {
                            mkdir($directoryPath, 0755, true);
                        }
                        $filePath = $directoryPath . '/' . $fileName;
                        $image->writeImage($filePath); 

                        $filePaths[] = [
                            'postimage_id' => $postimg->id,
                            'image' => $fileName,
                            'created_at' => now(),
                        ];
                        $image->clear();
                        $image->destroy(); 
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
            

            $profil = Profil::with('postblog')->where('user_id', Auth::id())->where('status', 'on')->first();

            if (!$profil) {
                return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.']);
            }
             

            $cleanContent = Purifier::clean($request->input('content'), 'quill');

            preg_match_all('/<img.*?src="(.*?)"/', $cleanContent, $matches);
            $usedImages = array_map(fn($img) => str_replace('/storage/', '', $img), $matches[1] ?? []);
    
            $previousImages = [];
            foreach ($profil->postblog->pluck('deskripsi') as $postContent) {
                preg_match_all('/<img.*?src="(.*?)"/', $postContent, $matches);
                $previousImages = array_merge($previousImages, $matches[1] ?? []);
            }
            $previousImages = array_map(fn($img) => str_replace('/storage/', '', $img), $previousImages);
    
            $allUsedImages = array_unique(array_merge($previousImages, $usedImages));
            $storedImages = Storage::disk('public')->files("postblog/{$profil->id}");
            $unusedImages = array_diff($storedImages, $allUsedImages);
    
            foreach ($unusedImages as $image) {
                Storage::disk('public')->delete($image);
            }
    
            if (empty(Storage::disk('public')->files("postblog/{$profil->id}"))) {
                Storage::disk('public')->deleteDirectory("postblog/{$profil->id}");
            }    

        if ($request->filled('idpostblog')) {
            $blog = PostBlog::where('id', $request->idpostblog)->where('profil_id', $profil->id)->firstOrFail();
            $blog->update([
                'title' => $request->title,
                'deskripsi' => $cleanContent,
            ]);
        } else {
            $baseSlug = Str::slug($request['title']); 

            $validslug = $profil->postblog->where('slug', $baseSlug)->first();
            if ($validslug) {

                $counter = 2;
                while ($profil->postblog->where('slug', $baseSlug . '-' . $counter)->first()) {
                    $counter++;
                }
                $slug = $baseSlug . '-' . $counter;
            } else {
                $slug = $baseSlug;
            }

            $maxHeaderPos = PostBlog::where('profil_id', $profil->id)
            ->where('position', 'LIKE', 'cusblog%')
            ->orderByRaw("CAST(SUBSTRING_INDEX(position, ' ', -1) AS UNSIGNED) DESC")
            ->value('position');
            
            $nextPosition = 1;
            if ($maxHeaderPos) {
                preg_match('/\d+$/', $maxHeaderPos, $matches);
                $nextPosition = $matches ? intval($matches[0]) + 1 : 1;
            }
        
            PostBlog::create([
                'profil_id' => $profil->id,
                'position' => "cusblog $nextPosition",
                'section' => 'postblog',
                'title' => $request->title,
                'slug' => $slug,
                'deskripsi' => $cleanContent,
                'hide' => true,
            ]);
        }
            return redirect()->back()->with('success', 'Blog berhasil disimpan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

    }
    public function updatePosition(Request $request)
    {
        $positions = $request->positions;
    
        foreach ($positions as $position) {
            if ($position['type'] == 'header') {
                Header::where('id', $position['id'])->update(['position' => $position['position']]);
            } elseif ($position['type'] == 'link') {
                Link::where('id', $position['id'])->update(['position' => $position['position']]);
            } elseif ($position['type'] == 'postimage') {
                PostImage::where('id', $position['id'])->update(['position' => $position['position']]);
            } elseif ($position['type'] == 'postblog') {
                PostBlog::where('id', $position['id'])->update(['position' => $position['position']]);
            }
        }
    
        return response()->json(['success' => true, 'message' => 'Posisi diperbarui!']);
    }

    public function switchaccount(Request $request, $id)
    {
     
        Profil::where('user_id', Auth::id())->update([
            'status' => DB::raw("CASE WHEN id = $id THEN 'on' ELSE 'off' END")
        ]);

        $id =  Auth::user()->id;
        $user = User::with('profil')->where('id', $id)->firstOrFail();


        if (!$user) {
            return redirect()->back()->with("error", "Profil tidak ditemukan.");
        }

        return redirect()->back()->with("success", "Profil berhasil diperbarui!");
    }

    public function createprofil(Request $request){

        try { 
        
             $validator = Validator::make($request->all(), [
                'nama' => 'required|string|min:3',
                'bio' => 'nullable|string', 
                'images.*' => 'file|mimes:jpeg,png,jpg,gif,webp|max:10240',
                'namalink' => 'required|array',
                'namalink.*' => 'required|string|max:20',
                'url' => 'required|array',
                'url.*' => 'required|url|max:255|distinct',
            ], [
                'images.*.file' => 'Terdapat file yang tidak valid.', 
                'images.*.mimes' => 'format: JPEG, PNG, JPG, GIF dan WEBP yang diizinkan.',
                'images.*.max' => 'Ukuran file maksimal adalah 10MB.', 
                
                'nama.required' => 'Nama Profil wajib diisi.',
                'nama.min' => 'Nama Profil minimal 3 karakter.',

                'namalink.required' => 'Nama link wajib diisi.',
                'namalink.*.required' => 'Nama link wajib diisi.',
                'namalink.*.max' => 'Nama link maksimal 20 karakter.',

                'url.required' => 'URL wajib diisi.',
                'url.*.required' => 'URL wajib diisi.',
                'url.*.url' => 'Format URL tidak valid.',
                'url.*.max' => 'URL maksimal 255 karakter.',
                'url.*.distinct' => 'Setiap URL harus berbeda.',
            ]);
            $validator->after(function ($validator) use ($request) {
                $urls = $request->input('url', []);
                $namalinks = $request->input('namalink', []);
            
                $dupes = array_keys(array_filter(array_count_values($urls), function ($count) {
                    return $count > 1;
                }));
            
                foreach ($urls as $i => $url) {
                    if (in_array($url, $dupes)) {
                        $label = $namalinks[$i] ?? "Link ke-" . ($i + 1);
                        $validator->errors()->add("url.$i", "URL untuk \"$label\" harus berbeda.");
                    }
                }
            });
            
            if ($validator->fails()) {
                    if ($request->hasFile('images')) {
                        $file = $request->file('images');
                        $tempFileName = $file->hashName();
                        $file->storeAs('temp_images', $tempFileName, 'public');

                        session(['old_image' => 'temp_images/' . $tempFileName]);
                    }
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
                    }

            $user = Auth::user();
        
            $statusnew = Profil::where('user_id', $user->id)->exists();

            $fileName = null;

            if ($request->hasFile('images')) {

                $file = $request->file('images');
                $tempFileName = $file->hashName();
                $file->storeAs('temp_images', $tempFileName, 'public');
                session(['old_image' => 'temp_images/' . $tempFileName]);

                $fileName = $this->images($file);

            } elseif (session()->has('old_image')) {

                $oldImagePath = session('old_image');

                if (Storage::disk('public')->exists($oldImagePath)) {

                    $absolutePath = Storage::disk('public')->path($oldImagePath);

                    $file = new \Illuminate\Http\File($absolutePath);

                    $fileName = $this->images($file);

                    Storage::disk('public')->delete($oldImagePath);
                    session()->forget('old_image');
                }
            }
            
            DB::transaction(function () use ($user, $request, $fileName) {
            Profil::where('user_id', $user->id)->where('status', 'on')->update(['status' => 'off']);
                $newProfil = Profil::create([
                    'user_id' => $user->id,
                    'nama' => $request->nama,
                    'bio' => $request->bio,
                    'image' => $fileName,
                    'status' => "on",

                ]);

            $maxHeaderPos = Link::where('profil_id', $newProfil->id)
            ->where('position', 'LIKE', 'cuslink%')
            ->orderByRaw("CAST(SUBSTRING_INDEX(position, ' ', -1) AS UNSIGNED) DESC")
            ->value('position');
        
            $nextPosition = 1;
            if ($maxHeaderPos) {
                preg_match('/\d+$/', $maxHeaderPos, $matches);
                $nextPosition = $matches ? intval($matches[0]) + 1 : 1;
            }

            if ($request->namalink && $request->url) {
                $filePaths = []; 
                foreach ($request->namalink as $index => $namalink) {
                    $filePaths[] = [
                        'profil_id' => $newProfil->id,
                        'title' => $namalink,
                        'url' => $request->url[$index],
                        'position' => "cuslink".' '. $nextPosition++,
                        'section' => 'link',
                        'embed' => false,
                        'hide' => true,
                        'created_at' => now(),
                    ];
                }
                Link::insert($filePaths);
            }
            Design::ChangeThema('', "Basics",$newProfil->id);
        });  

        if ($statusnew) {

            return redirect()->route('links')->with('success', 'Data berhasil disimpan!');
        } else {

            return redirect()->route('links')->with('successwithcontent', 'Selamat untuk Pengguna Baru!');
        }

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

        $existingLink = Link::where('profil_id', $profil->id)
                            ->where('url', trim($request->url))
                            ->first();

        if ($existingLink) {
            return response()->json(['success' => false, 'message' => 'Link sudah ada dalam database.']);
        }

        $fileName = null;
        if ($request->hasFile('images')) {
            $fileName = $this->images($request->file('images'));
        }

        $embedValue = ($request->embed === "on") ? true : false;

        $maxHeaderPos = Link::where('profil_id', $profil->id)
        ->where('position', 'LIKE', 'cuslink%')
        ->orderByRaw("CAST(SUBSTRING_INDEX(position, ' ', -1) AS UNSIGNED) DESC")
        ->value('position');
    
        $nextPosition = 1;
        if ($maxHeaderPos) {
            preg_match('/\d+$/', $maxHeaderPos, $matches);
            $nextPosition = $matches ? intval($matches[0]) + 1 : 1;
        }

        Link::create([
            'profil_id' => $profil->id,
            'title' => $request->title,
            'url' => $request->url,
            'image' => $fileName,
            'position' => "cuslink $nextPosition",
            'section' => 'link',
            'embed' => $embedValue,
            'hide' => true,
        ]);
  
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
       
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data.']);
    }
}
public function updatelink(Request $request)
{
    try {

        $user = Auth::user();
        $profil = Profil::where('user_id', $user->id)->where('status', 'on')->first();

        if (!$profil) {
            return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.']);
        }
        $embedValue = ($request->embed === "on") ? true : false;

        $existingLink = Link::where('profil_id', $profil->id)
                            ->where("title", $request->title)
                            ->where('url', trim($request->url))
                            ->where('embed', $embedValue)
                            ->first();

        if ($existingLink && !$request->hasFile('images')) {
            return response()->json(['success' => false, 'message' => 'Link dengan title yang sama sudah ada dalam database.']);
        }

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
            'embed' => $embedValue,
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

            if ($profil->image && Storage::disk('public')->exists('img/' . $profil->image)) {
                Storage::disk('public')->delete('img/' . $profil->image);
            }

            $profil->delete();

        
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
            ], 200);
        } catch (\Exception $e) {
            \Log::error("Data Delete Error:", ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Terjadi kesalahan server.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function deletepostimage(Request $request, $id)
    {
        try {
        
            $deletepostimage = PostImage::with('ImagePost')->findOrFail($id);
            $deleteimage = $deletepostimage->ImagePost->first();
            if ($deleteimage['image'] && file_exists(public_path('storage/img/' . $deleteimage['image']))) {
                unlink(public_path('storage/img/' .  $deleteimage['image']));
            }
            $deletepostimage->delete();

            return response()->json([
                'message' => 'Data berhasil dihapus!',
            ], 200);
        } catch (\Exception $e) {
            \Log::error("Data Delete Error:", ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Terjadi kesalahan server.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function deletepostblog(Request $request, $id)
    {    
        try {
            $profil = Profil::with('postblog')->where('user_id', Auth::id())->where('status', 'on')->first();
            if (!$profil) {
                return response()->json(['error' => 'Profil tidak ditemukan.'], 404);
            }
            $deletepostblog = $profil->postblog->find($id);
           
            if (!$deletepostblog) {
                return response()->json(['error' => 'Post blog tidak ditemukan.'], 404);
            }
            
            $deletepostblog->delete();

            $profil->load('postblog');

            $previousPosts = $profil->postblog->pluck('deskripsi');
            $previousImages = [];
   
            foreach ($previousPosts as $postContent) {
                preg_match_all('/<img.*?src="(.*?)"/', $postContent, $matches);
                $previousImages = array_merge($previousImages, $matches[1] ?? []);
            }
    
            $previousImages = array_map(function ($image) {
                return str_replace('/storage/', '', $image);
            }, $previousImages);
           
            $storedImages = Storage::disk('public')->files("postblog/{$profil->id}");
            
            $unusedImages = array_diff($storedImages, $previousImages);
       
            foreach ($unusedImages as $image) {
                Storage::disk('public')->delete($image);
            }
          
            if (count(Storage::disk('public')->files("postblog/{$profil->id}")) === 0) {
                Storage::disk('public')->deleteDirectory("postblog/{$profil->id}");
            }
            return response()->json([
                'message' => 'Data berhasil dihapus!',
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
        
            $request->validate([
                'hide' => 'required|string|in:on,off',
            ]);

            $hideValue = $request->hide === 'on' ? true : false;

            $update = Link::findOrFail($id);
            $update->update(['hide' => $hideValue]);
    
            return response()->json([
                'message' => 'Status berhasil diperbarui!',
                'id' => $update->id,
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

            $request->validate([
                'hide' => 'required|string|in:on,off',
            ]);

            $hideValue = $request->hide === 'on' ? true : false;

            $update = Header::findOrFail($id);
            $update->update(['hide' => $hideValue]);
    
            return response()->json([
                'message' => 'Status berhasil diperbarui!',
                'id' => $update->id,
            ], 200);
        } catch (\Exception $e) {
            \Log::error("Update Status Error:", ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Terjadi kesalahan server.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function hidepostimage(Request $request, $id)
    {
        try {
        
            $request->validate([
                'hide' => 'required|string|in:on,off',
            ]);
   
            $hideValue = $request->hide === 'on' ? true : false;

            $update = PostImage::findOrFail($id);
            $update->update(['hide' => $hideValue]);
    
            return response()->json([
                'message' => 'Status berhasil diperbarui!',
                'id' => $update->id,
            ], 200);
        } catch (\Exception $e) {
            \Log::error("Update Status Error:", ['error' => $e->getMessage()]);
            return response()->json([
                'error' => 'Terjadi kesalahan server.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
    public function hidepostblog(Request $request, $id)
    {
        try {
        
            $request->validate([
                'hide' => 'required|string|in:on,off',
            ]);
   
            $hideValue = $request->hide === 'on' ? true : false;

            $update = PostBlog::findOrFail($id);
            $update->update(['hide' => $hideValue]);
    
            return response()->json([
                'message' => 'Status berhasil diperbarui!',
                'id' => $update->id,
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

            $request->validate([
                'hide' => 'required|string|in:on,off',
            ]);
   
            $hideValue = $request->hide === 'on' ? true : false;

            $update = SocialMedia::findOrFail($id);
            $update->update(['hide' => $hideValue]);
    
            return response()->json([
                'message' => 'Status berhasil diperbarui!',
                'id' => $update->id,

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

            $user = User::with(['profil' => function ($query) {
                $query->where('status', 'on')

                ->with(['link', 'design','header','socialmedia','postblog','postimage.imageposts']);
            }])->where('username', $username)->firstOrFail();

            $profil = $user->profil->first();

            if (!$profil) {
                abort(404, 'Profil tidak ditemukan atau tidak aktif');
            }

            if ($profil->design->isEmpty()) {
                abort(404, 'Desain tidak ditemukan');
            }

            if ($profil->design[0]["theme"] !== "Custom"){
                $box_shadow = "0px 6px 14px -6px rgba(24, 39, 75, 0.12), 0px 10px 32px -4px rgba(24, 39, 75, 0.1), inset 0px 0px 2px 1px rgba(255, 255, 255, 0.05)" ;
            }
            $postimage = $profil->postimage;

            $items = collect($profil->header)
            ->merge($profil->link)
            ->merge($profil->postimage)
            ->merge($profil->postblog)
            ->sortBy('position')
            ->values();

            return view('user.user', compact('items'),[
                'profil' => $profil,
                'design' => $profil->design,
                'postblog' => $profil->postblog,
                'postimage' => $profil->postimage,
                'imageposts' => $postimage,
                'social' => $profil->socialmedia,
                'box_shadow' => $box_shadow ?? [],
                'username' => $user->username,
            ]);

        } catch (ModelNotFoundException $e) {
            abort(404, 'User tidak ditemukan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan, coba lagi nanti.');
        }
    }

    public function settings(Request $request) {

        $id =  Auth::user()->id;
        $user = User::with(['profil' => function ($query) {
            $query->where('status', 'on')
            ->with(['link','header','postimage', 'postblog']);
        }])->where('id', $id)->firstOrFail();

    $profil = $user->profil->first();

    $items = collect($profil->header)
                ->merge($profil->link)
                ->merge($profil->postimage)
                ->merge($profil->postblog)
                ->sortBy('position')
                ->values(); 

                return view('main.setting', compact('profil', 'items'));
    }

    public function posts(Request $request) {

            $profil = Profil::with(['postimage.imageposts', 'postblog'])
            ->where('user_id', Auth::id())
            ->where('status', 'on')
            ->first();
          
            $postimage = $profil->postimage;

        return view('main.postimage',[
            'postblog' => $profil['postblog'],
            'postimage' => $profil['postimage'],
            'imageposts' => $postimage,
        ]);

    }
    public function createsocials(Request $request) {
        try {

        $rules = [
            'title' => 'required|string',
            'url' => 'required|string',
            'svg' => 'required|string'
        ];
        
        $messages = [
            'title.required' => 'Nama sosial media wajib diisi.',
            'url.required' => 'URL atau data wajib diisi.',
            'svg.required' => 'Ikon sosial media tidak boleh kosong.',
        ];
        
        $title = strtolower($request->input('title'));
        
        if (in_array($title, ['email', 'github', 'linkedin'])) {
            $rules['url'] .= '|email';
            $messages['url.email'] = 'Format email tidak valid.';
        } elseif (in_array($title, ['whatsapp', 'telegram'])) {
            $rules['url'] .= '|regex:/^\+62\d{9,15}$/';
            $messages['url.regex'] = 'Nomor harus diawali dengan +62 dan minimal 9 digit.';
        } else {
            $rules['url'] .= '|url|max:255';
            $messages['url.url'] = 'Format URL tidak valid.';
            $messages['url.max'] = 'URL maksimal 255 karakter.';
        }
        
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "errors" => $validator->errors()
            ], 422);
        }

        $user = Auth::user();
        $profil = Profil::where('user_id', $user->id)->where('status', 'on')->first();
        
        if (!$profil) {
            return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.']);
        }
        $socialMedia = $profil->socialmedia;
        if ($socialMedia->count() >= 5) {
            return response()->json(['success' => false, 'message' => 'Social media sudah melebihi batas.']);
        }

        $existingSocialMedia = $profil->socialmedia
                                    ->where("title", $request->title)
                                    ->where("url", $request->url)
                                    ->first();

        if ($existingSocialMedia) {
            return response()->json(['success' => false, 'message' => 'Social media sudah ada.']);
        }
       
        SocialMedia::create([
            'profil_id' => $profil->id, 
            'title' => $request->title,
            'url' => $request->url,
            'svg' => $request->svg,
            'hide' => true,
        ]);

        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
    
    } catch (\Exception $e) {

        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data.']);
    }

    }
    public function updatesocials(Request $request) {
        try {

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
    
            $user = Auth::user();
            $profil = Profil::where('user_id', $user->id)->where('status', 'on')->first();
    
            if (!$profil) {
                return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.'], 404);
            }

            $existingSocialMedia = SocialMedia::where('profil_id', $profil->id)
                                    ->where("title", $request->title)
                                    ->where("url", $request->url)
                                    ->first();
    
            if ($existingSocialMedia) {
                return response()->json(['success' => false, 'message' => 'Social media sudah ada.'], 409);
            }
    
            $social = SocialMedia::where('profil_id', $profil->id)->findOrFail($request->idsocial);
    
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

        $user = Auth::user();
        $profil = Profil::where('user_id', $user->id)->where('status', 'on')->first();
    
        if (!$profil) {
            return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.']);
        }
    
        $maxHeaderPos = Header::where('profil_id', $profil->id)
        ->where('position', 'LIKE', 'cusher%')
        ->orderByRaw("CAST(SUBSTRING_INDEX(position, ' ', -1) AS UNSIGNED) DESC")
        ->value('position');
    
        $nextPosition = 1;
        if ($maxHeaderPos) {
            preg_match('/\d+$/', $maxHeaderPos, $matches);
            $nextPosition = $matches ? intval($matches[0]) + 1 : 1;
        }

        Header::create([
            'profil_id' => $profil->id,
            'position' => "cusher $nextPosition",
            'title' => $request->title,
            'section' => 'header',
            'hide' => true,
        ]);
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
    
    } catch (\Exception $e) {

        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data.']);
    }

    }
    public function updateheader(Request $request) {
        try {

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
        $user = Auth::user();
        $profil = Profil::where('user_id', $user->id)->where('status', 'on')->first();
    
        if (!$profil) {
            return response()->json(['success' => false, 'message' => 'Profil tidak ditemukan.']);
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
        $user = User::with('profil')->where('id', $id)->firstOrFail();

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

        $profil = $user->profil->first();

        $items = collect($profil->header)
                    ->merge($profil->link)
                    ->sortBy('position')
                    ->values(); 
             
                return view('main.link', compact('profil', 'items'));

    }
    public function updateprofil(Request $request) {
        try {
            $id = Auth::user()->id;
            $user = User::with('profil')->where('id', $id)->firstOrFail();

            if (!$user) {
                return redirect()->back()->with("error", "Profil tidak ditemukan.");
            }
            
            $profil = $user->profil->where('status', 'on')->firstOrFail();

            $isNewImageUploaded = $request->hasFile('images');
    
            $validatorRules = [
                'nama' => 'required|string|min:3',
                'bio' => 'nullable|string',
            ];
    
            if (!$isNewImageUploaded) {
                $validatorRules['old_image'] = 'required|string';
            } else {
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
    
            if ($isNewImageUploaded) {
                $fileName = $this->images($request->file('images'));
    
                if (!empty($profil->image) && file_exists(public_path('storage/img/' . $profil->image))) {
                    unlink(public_path('storage/img/' . $profil->image));
                }
            } else {
                $fileName = $request->old_image ?? $profil->image;
            }

            $profil->update([
                'nama' => $request->nama,
                'bio' => $request->bio,
                'image' => $fileName, 
            ]);


            return redirect()->back()->with('success', 'Data berhasil diupdate!');
        } catch (ValidationException $e) {
            return back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }
    
    public function updateacount(Request $request) {

        $request->validate([
            'email' => 'required|string|unique:users,email,' . $request->email,
        ]);
        try {
            DB::beginTransaction();
           
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
            'old' => ['required', 'min:8','regex:/[a-z]/', 'regex:/[A-Z]/','regex:/[0-9]/'],
            'new' => ['required', 'min:8','regex:/[a-z]/', 'regex:/[A-Z]/','regex:/[0-9]/'],
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
    
    public function login(Request $request) {
        try {
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
        } catch (\Exception $e) {   
            return back()->withErrors(['error', 'Login failed: '  => 'Username atau password tidak terdaftar!']);
        }  
    }

    public function logout(Request $request){
        if (!Auth::check()) {
            return redirect()->route('login')->with('errorlogout', 'Anda belum login.');
        }
        Auth::logout();
        session()->flush();
        session()->regenerateToken();

        return redirect()->route('home')->with('successlogout', 'Logout berhasil!');
    }
    
    public function images($file){
        if (!$file) {
            return null;
        }

        try {

            $image = new \Imagick($file->getPathname());

            $image->setImageFormat('jpg');

            $image->setImageCompression(\Imagick::COMPRESSION_JPEG);
            $image->setImageCompressionQuality(80);

            $image->stripImage();

            $width = 800;
            $image->resizeImage($width, 0, \Imagick::FILTER_LANCZOS, 1);

            $fileName = time() . '_' . uniqid() . '.jpg';

            $directoryPath = storage_path('app/public/img');
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true);
            }

            $image->writeImage($directoryPath . '/' . $fileName);

            $image->clear();
            $image->destroy();

            return $fileName;

        } catch (\ImagickException $e) {
            \Log::error('Imagick Error: ' . $e->getMessage());
            return null;
        }
    }
}
