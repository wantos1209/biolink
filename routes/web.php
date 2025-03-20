<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ProfilController;
use App\Http\Middleware\ProfilUser;
use App\Models\Textfont;

Route::get('/', function () {
    return view('layouts.main');
});

Route::get('/login', function () {
    return view('layouts.login');
})->name('login');

Route::get('/daftarpage', function () {
    return view('layouts.daftar');
})->name('daftar');

// Route::view('/links', 'main.link')->name('links');
// Route::view('/posts', 'main.postimage')->name('posts');
Route::view('/design', 'main.design')->name('design');
Route::GET('/posts', [ProfilController::class, 'posts'])->name('posts');
Route::post('/upload-image', [ProfilController::class, 'uploadImage'])->name('upload.image');
Route::post('/delete-image', [ProfilController::class, 'deleteImage'])->name('deleteImage.image');

// Route::view('/settings', 'main.setting')->name('settings');
//Route::view('/accountsetting', 'main.accountsetting')->name('accountsetting');

// Route::get('/user', function () {
//     return view('userview');
// })->name('user');
Route::get('/modal', function () {
    return view('modals.modal-changepassword');
})->name('modal');
// .input-main-wrap:has(.image) 
// Route::POST('/update-status', [ProfilController::class, 'updateStatus'])->name('update.status');
Route::POST('/login', [ProfilController::class, 'login'])->name('login');
Route::POST('/createdaftar', [ProfilController::class, 'createdaftar'])->name('createdaftar');

Route::middleware('auth')->group(function () {
Route::POST('/createprofil', [ProfilController::class, 'createprofil'])->name('createprofil');
Route::get('/profilpage', function () {
    return view('layouts.profil');
})->name('profil');

    Route::middleware([ProfilUser::class])->group(function () {
        Route::get('/index', function () {
            return view('index');
        })->name('index');
    Route::GET('/settings', [ProfilController::class, 'settings'])->name('settings');
    Route::GET('/accountsetting', [ProfilController::class, 'accountsetting'])->name('accountsetting');
    Route::PUT('/updateprofil', [ProfilController::class, 'updateprofil'])->name('updateprofil');
    Route::PUT('/updateacount', [ProfilController::class, 'updateacount'])->name('updateacount');
    Route::PUT('/updateusername', [ProfilController::class, 'updateusername'])->name('updateusername');
    Route::PUT('/changepassword', [ProfilController::class, 'changepassword'])->name('changepassword');
    Route::DELETE('/deleteprofil/{id}', [ProfilController::class, 'deleteprofil'])->name('deleteprofil');
    Route::GET('/links', [ProfilController::class, 'links'])->name('links');
    Route::POST('/createlink', [ProfilController::class, 'createlink'])->name('createlink');
    Route::POST('/createblog', [ProfilController::class, 'createblog'])->name('createblog');
    Route::POST('/createpostimage', [ProfilController::class, 'createpostimage'])->name('createpostimage');
    Route::POST('/updatelink', [ProfilController::class, 'updatelink'])->name('updatelink');
    Route::POST('/update-position', [ProfilController::class, 'updatePosition'])->name('update.position');
    Route::POST('/createsocials', [ProfilController::class, 'createsocials'])->name('createsocials');
    Route::POST('/updatesocials', [ProfilController::class, 'updatesocials'])->name('updatesocials');
    Route::POST('/createheader', [ProfilController::class, 'createheader'])->name('createheader');
    Route::POST('/updateheader', [ProfilController::class, 'updateheader'])->name('updateheader');
    Route::POST('/hidelink/{id}', [ProfilController::class, 'hidelink'])->name('hidelink');
    Route::POST('/hideheader/{id}', [ProfilController::class, 'hideheader'])->name('hideheader');
    Route::POST('/hidesocial/{id}', [ProfilController::class, 'hidesocial'])->name('hidesocial');
    Route::GET('/switchaccount/{id}', [ProfilController::class, 'switchaccount'])->name('switchaccount');
    Route::DELETE('/deletelink/{id}', [ProfilController::class, 'deletelink'])->name('deletelink');
    Route::DELETE('/deleteheader/{id}', [ProfilController::class, 'deleteheader'])->name('deleteheader');
    Route::DELETE('/deletesocial/{id}', [ProfilController::class, 'deletesocial'])->name('deletesocial');
    });
    Route::GET('/logout', [ProfilController::class, 'logout'])->name('logout');
});
// Route::PUT('/updateheader', [ProfilController::class, 'updateacount'])->name('updateacount');
// Route::PUT('/updatelink', [ProfilController::class, 'updateusername'])->name('updateusername');
// Route::PUT('/updatesocials', [ProfilController::class, 'changepassword'])->name('changepassword');

// Route::DEL('/dellink/{id}', [ProfilController::class, 'dellink'])->name('del-link');
// Route::DEL('/delhead/{id}', [ProfilController::class, 'delhead'])->name('del-head');
// Route::DEL('/delsocial/{id}', [ProfilController::class, 'delsocial'])->name('delsocial');

Route::GET('/{username}', [ProfilController::class, 'haluser'])->name('haluser');
Route::GET('/{username}/{blog}', [ProfilController::class, 'bloguser'])->name('bloguser');

Route::POST('/update-font', [LinkController::class, 'updateSetting']);
Route::get('/get-font', function () {
    return response()->json([
        'font_family' => Textfont::getSetting('page_font_family') ?? 'Poppins'
    ]);
});

// $id =  Auth::user()->id;
// $user = User::with(['profil' => function ($query) {
//     $query->where('status', 'on')
//     ->with(['link', 'design','header','socialmedia']);
// }])->where('id', $id)->firstOrFail();
// // Ambil profil dengan relasi header & link
// // $profil = Profil::with(['header', 'link'])->where('id', $profil_id)->firstOrFail();
// $profil = $user->profil->first();
// // Gabungkan `headers` dan `links` lalu urutkan berdasarkan `position`
// $items = collect($profil->header)
//         ->merge($profil->link)
//         ->sortBy('position')
//         ->values(); // Reset indeks array
     
//         return view('main.link', compact('profil', 'items'));