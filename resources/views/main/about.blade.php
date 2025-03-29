    @extends('index')
    @section('content')



            <section class="main-home flexcenter">
                <div class="secton-content ">
                    <div class="flexcenter about-content flex-col text-center mx-auto  w-full  px-24 py-16 xs:pt-90 xs:pb-0 mt-40 z-20 " >
                    
                        <div class="text-about">
                            <h1>About MyLink21</h1>
                        </div>
                        <div class="font-medium text-pengguna text-18 mx-auto mb-40  ">
                            <p>Kami Penyedia Platform yang menyediakan kebutuhan konten pribadi seperti data link pribadi anda,
                            foto ataupun blog pribadi anda, Kami berkomitmen untuk memberikan pengalaman terbaik untuk anda
                            dengan keamanan dan kenyamanan bagi seluruh pengguna.
                            ini merupakan layanan gratis berkualitas premium jika dibandingkan platform lainnya.
                        </p>
                        </div>

                        <div class="flexcenter subsec-about gap-32 text-white">
                            <div class="section-about bg-black">
                                <div class="text-about">
                                    <h3>Tim Support</h3>
                                    <div class=" about-svg bg-merah">
                                    <svg class="text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z">
                                        </path>
                                    </svg>
                                    </div>
                                </div>
                             
                                <div class="font-medium text-pengguna  text-18 mx-auto p-32">
                                    <p>Tim support kami siap membantu Anda 24/7 dengan pelayanan yang ramah dan profesional.
                                    </p>
                                </div>
                            </div>
                            <div class="section-about bg-black">
                            <div class="text-about">
                                <h3>Sistem Keamanan</h3>
                                <div class=" about-svg bg-merah">
                                <svg class="text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z">
                                        </path>
                                    </svg>
                                </div>
                            </div>

                            <div class="font-medium text-pengguna text-18 mx-auto p-32">
                                <p>Keamanan data Anda adalah prioritas yang diutamakan dan sistem yang kami lakukan adalah dengan enkripsi data.
                                </p>
                            </div>
                        </div>
                    </div>


                        <div class="text-about">
                            <h2>Visi Kami</h2>
                        </div>
                        <div class="flexcenter font-medium text-pengguna  text-18 mx-auto mb-24 ">
                            <p>Menjadi penyedia platform link pribadi terdepan yang dikenal dengan keamanan, 
                                dan pelayanan terbaik untuk seluruh pengguna.
                            </p>
                        </div>
                        <div class="text-about">
                            <h2>Misi Kami</h2>
                        </div>
                        <div class="flexcenter font-medium text-pengguna  text-18 mx-auto mb-24  ">
                            <p>Memberikan pengalaman terbaik dengan keamanan yang baik dan nyaman serta terpercaya.
                        </p>
                        </div>
                        <div class="flexcenter mt-32 ">
                            <a href="{{ route('register') }}">
                                <div class="daftarhome align-center  px-24 py-8 text-white bg-merah hover:bg-black-2 hover:text-blDanger" >
                                    <span>Daftar Sekarang Juga</span>
                                </div> 
                            </a>
                        </div>
                    
                    </div>
     
                </div>
            </section>

@endsection