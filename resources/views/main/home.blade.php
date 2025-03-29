    @extends('index')
    @section('content')



            <section class="main-home flexcenter">
                <div class="secton-content home-content flexcenter flex-col relative">
                    <div class="flexcenter flex-col text-center mx-auto  w-full  px-24 py-16 xs:pt-90 xs:pb-0 mt-40 z-20 " >
                        <div class=" font-medium text-pengguna  text-18 mx-auto mb-8 mt-48 ">
                            <span>Pengguna sebanyank 600,000+ creators</span>
                        </div>
                        <div class="texthome">
                            <h1>Buat Situs Pribadi Anda dalam hitungan detik</h1>
                        </div>
                        <div class="mt-16 text-16 ">
                            <span>ini layanan gratis dan setup hanya kurang dari satu menit</span>
                        </div>
                        <div class="mt-32 ">
                            <a href="{{ route('register') }}">
                                <div class="daftarhome align-center  px-24 py-8 text-white bg-merah hover:bg-black-2 hover:text-blDanger" >
                                    <span>Daftar Sekarang Juga</span>
                                </div> 
                            </a>
                        </div>
                    
                    </div>
                  
                <div class="menu floating flexbetween gambar-home">
                    <div class="" style="perspective: 1000px; opacity: 1; transform: scale(0.95) rotate(12deg) translateX(30%);">
                        {{-- <div style="transition: transform 0.15s; transform-style: preserve-3d; width: 400px; height: 400px; transform: rotateY(0deg) translateX(25%);"> --}}
                            <div class="img-hover-flip" style="">
                            <img class="img-home" src="{{ env('API_URL') .'/storage/img/myuser.png' }}" alt="myuser" >
                        </div>
                       
                    </div>
                    <div class="" style="perspective: 1000px;opacity: 1;transform: scale(0.95) rotate(-12deg) translateX(-30%);">
                        {{-- <div style="transition: transform 0.15s; transform-style: preserve-3d; width: 400px; height: 400px; transform: rotateY(180deg) translateX(-25%);"> --}}
                            <div class="img-hover-flip" style="">
                            <img class="img-home" src="{{ env('API_URL') .'/storage/img/g21blog.png'}}" alt="g21blog" >
                        </div>
                        
                    </div>
                </div>
                                
                    
                </div>
            </section>

@endsection