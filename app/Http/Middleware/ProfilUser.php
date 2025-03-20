<?php

namespace App\Http\Middleware;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class ProfilUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
 
        if (Auth::check()) {
            $userId = Auth::id();

            // Ambil profil terbaru yang masih aktif
            $newProfil = User::with('profil')->where('id', $userId)->first();
            $newDataImg = $newProfil->profil->where('status', 'on')->values()->toArray();

            //Perbarui session hanya jika ada perubahan
            $currentProfil = Session::get('profil');
            $currentDataImg = Session::get('dataimg');

            // Periksa apakah user memiliki profil yang aktif
            if (!$newProfil || $newProfil->profil->isEmpty()) {
                return redirect()->route('profil')->with('error', 'Data Profil Anda Belum ada. Mohon selesaikan penyimpanan data profil!');
            }
            if ($currentProfil !== ($newDataImg[0] ?? null)) {
                Session::put('profil', $newProfil->profil->toArray() ?? null);
            }

            if ($currentDataImg !== $newDataImg) {
                Session::put('dataimg', $newDataImg[0]);
            }
            // if (!empty($newDataImg)) {
            //     // Simpan profil pertama yang aktif ke session
            //     Session::put('profil', $newProfil); 
        
            //     // Simpan semua profil yang aktif ke session dataimg
            //     Session::put('dataimg', $newDataImg[0]);
            // }
            // if ($newProfil) {
            //     Session::put('profil', $newProfil->toArray());
            // }

            // if (!empty($newDataImg)) {
            //     Session::put('dataimg', $newDataImg);
            // }
        }
     
        // $statusnew = Profil::where('user_id',  Auth::user()->id)->first();

        // if (!$statusnew) {
        //     return redirect()->route('profil')->with('error', 'Data Profil Anda Belum ada. mohon selesaikan penyimpanan data profil!');
        // }

        return $next($request);
    }
}
