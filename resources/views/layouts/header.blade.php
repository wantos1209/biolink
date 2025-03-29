@if (session('success'))
<script>
    sessionStorage.setItem('success', "{{ session('success') }}");
</script>
    <div id="shownotifsuccess" class="sec_content">
        <div class="modalcontainer">
            <div class="formnotif bg-white">
                <div class="judul_modal flex-h-between"> 
                    <h1>Pesan Notif</h1>
                    <span class="closemodal" onclick="closeModal()">X</span>
                </div>
                <hr class="garis">
                <div class="formsubnotif">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024"><path fill="currentColor" d="M512 64a448 448 0 1 1 0 896a448 448 0 0 1 0-896m-55.808 536.384l-99.52-99.584a38.4 38.4 0 1 0-54.336 54.336l126.72 126.72a38.27 38.27 0 0 0 54.336 0l262.4-262.464a38.4 38.4 0 1 0-54.272-54.336z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        </div>
    </div>
@endif

@if ($errors->any() || session('error'))
<script>
    sessionStorage.setItem('error', "{{ session('error') }}");
</script>
<div id="shownotifwrong" class="sec_content">
    <div class="modalcontainer">
        <div class="formnotif bg-white">
            <div class="judul_modal flex-h-between"> 
                <h1>Pesan Notif</h1>
                <span class="closemodal" onclick="closeModal()">X</span>
            </div>
            <hr class="garis">
            <div class="formsubnotif">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 13a1 1 0 1 0 0 2a1 1 0 0 0 0-2m0-9a1 1 0 0 0-.993.883L11 7v6a1 1 0 0 0 1.993.117L13 13V7a1 1 0 0 0-1-1"/></g></svg>
                @if (session('error'))
                    <span>{{ session('error') }}</span>
                @endif
                @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span>
                        @endforeach
                
                @endif
            </div>
        </div>
    </div>
</div>
@endif

@if (session('successwithcontent'))
<script>
    sessionStorage.setItem('successwithcontent', "{{ session('successwithcontent') }}");
</script>
@include('modals.modal-content')
@endif
{{-- @dd(session()->all()) --}}
{{-- @foreach (session('profil', []) as $getlink) --}}
@if (Route::is('home'))
<section class="navbarhome">
    <div class="nav-home px-24 mx-auto nav-home py-16  bg-white">
        <a href="{{ env('API_URL') }}">
            <img class="image-nav m-auto" src="{{ env('API_URL') .'/storage/img/mylink.png' }}" alt="" role="presentation"></a>
           @else
           <section class="navbarlogin">
            <div class="secnavbarlogin px-64  bg-coklat">
                <a href="{{ route('links') }}">
                    <img class="image-nav m-auto" src="{{ env('API_URL') .'/storage/img/mylink.png' }}" alt="" role="presentation"></a>
                @endif
            @if (Route::is('register'))
                <div class="text-14 align-center">
                <span>Apakah kamu mempuyai account ? --></span>
                <a href="{{ route('login') }}" class="text-blPrimary underline">Login</a>
                </div>  
                    @elseif (Route::is('login'))
                    <div class="text-14 align-center">
                        <span>Register Disini --></span>
                        <a href="{{ route('register') }}" class="text-blPrimary underline">Daftar</a>
                    </div> 
                    @elseif (Route::is('profil'))
                    <div class="relative">
                        <div class="flexcenter">
                            <div class="mr-16 text-14">
                                <span>{{ Auth::user()->email }}</span>
                            </div>
                
                            <div class="flex items-center gap-12 cursor-pointer select-none">
                                <div class="imgprofil flexcenter">
                                    <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.25 10C13.8467 10 14.419 10.2371 14.841 10.659C15.2629 11.081 15.5 11.6533 15.5 12.25V13C15.5 15.9565 12.71 19 8 19C3.29 19 0.5 15.9565 0.5 13V12.25C0.5 11.6533 0.737053 11.081 1.15901 10.659C1.58097 10.2371 2.15326 10 2.75 10H13.25ZM8 0.25C9.09402 0.25 10.1432 0.684597 10.9168 1.45818C11.6904 2.23177 12.125 3.28098 12.125 4.375C12.125 5.46902 11.6904 6.51823 10.9168 7.29182C10.1432 8.0654 9.09402 8.5 8 8.5C6.90598 8.5 5.85677 8.0654 5.08318 7.29182C4.3096 6.51823 3.875 5.46902 3.875 4.375C3.875 3.28098 4.3096 2.23177 5.08318 1.45818C5.85677 0.684597 6.90598 0.25 8 0.25Z" fill="#171717"/>
                                    </svg>
                                </div> 
                                <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1L5.09091 5.5L9.18182 1" stroke="black" stroke-width="1.56" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </div> 
                        <div class="menu-setup"><!---->
                            <a href="{{ route('index') }}" class="">
                                <div class="sub-menu-setup">
                                    <span>Dashboard</span>
                                    </div>
                                </a>
                            <a href="{{ route('logout') }}" class="">
                                <div class="sub-menu-setup">
                                    <span>Logout</span>
                                    </div>
                                </a>
                        </div>
                    </div>
                    @elseif (Route::is('home'))
                    <div class="menu-home"><!---->
                        <a href="{{ route('login') }}" class="">
                            <div class="daftarhome text-white mr-16 align-center hover:text-blDanger">
                                <span>Login</span>
                            </div> 
                        </a>
                        <a href="{{ route('register') }}" class="">
                            <div class="daftarhome align-center px-24 py-8 text-white bg-merah hover:bg-white hover:text-blDanger" >
                                <span>Daftar</span>
                            </div> 
                        </a>
                    </div>
                    @else (Route::is('index'))
                    {{-- <div class="nav-right flex gap-16"> --}}
                    <div class="nav-right flex gap-16 relative">
                        <div class="btn-user align-center">
                           
                            <a id="copyText" href="{{ env('API_URL') . Auth::user()->username }}"> {{ config('app.APP_URL') .  '/' . Auth::user()->username }}</a>
                        </div>
                
        <div class="btn-share  px-12 py-6 select-two">
        <span>Share</span>
        <svg  xmlns="http://www.w3.org/2000/svg"  width="14"  height="14"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-share"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M18 6m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M8.7 10.7l6.6 -3.4" /><path d="M8.7 13.3l6.6 3.4" /></svg>
        </div>    
            <div class="group-share rounded-sm popUp absolute z-50 ">
                <div class="py-24 xs:pb-48 share-base-one"><!----> 

                <div>
                    <div class="flex items-center px-24 h-48 xs:h-64 cursor-pointer relative hover:bg-gray-100">
                        <div>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.6667 3H5.66667C4.75 3 4 3.75 4 4.66667V16.3333H5.66667V4.66667H15.6667V3ZM18.1667 6.33333H9C8.08333 6.33333 7.33333 7.08333 7.33333 8V19.6667C7.33333 20.5833 8.08333 21.3333 9 21.3333H18.1667C19.0833 21.3333 19.8333 20.5833 19.8333 19.6667V8C19.8333 7.08333 19.0833 6.33333 18.1667 6.33333ZM18.1667 19.6667H9V8H18.1667V19.6667Z" fill="#0D0C22"></path>
                            </svg>
                        </div> 
                        <div id="copylink" class="text-left ml-16" onclick="copyToClipboard()">Copy link</div>
                       
                    </div> 
                    <input type="text" readonly="readonly" class="absolute opacity-0">
               
                <div class="share-item">
                    <div class="flex items-center px-24 h-48 xs:h-64 hover:bg-gray-100 cursor-pointer relative target-modal">
                        <div>
                            <svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.6109 1.35559V8.90764C20.6109 10.2347 19.5469 11.3106 18.2344 11.3106C16.9219 11.3106 15.8579 10.2347 15.8579 8.90764C15.8579 7.58054 16.9219 6.50472 18.2344 6.50472M23.6663 5.13162C21.9788 5.13162 20.6109 3.74841 20.6109 2.04214" stroke="#0D0C22" stroke-width="1.5"></path>
                                <path d="M4.16453 2.10559H8.38399V0.605591H4.16453V2.10559ZM10.447 4.19987V8.46629H11.947V4.19987H10.447ZM8.38399 10.5606H4.16453V12.0606H8.38399V10.5606ZM2.10156 8.46629V4.19987H0.601562V8.46629H2.10156ZM4.16453 10.5606C3.03299 10.5606 2.10156 9.63077 2.10156 8.46629H0.601562C0.601562 10.4435 2.18895 12.0606 4.16453 12.0606V10.5606ZM10.447 8.46629C10.447 9.63077 9.51553 10.5606 8.38399 10.5606V12.0606C10.3596 12.0606 11.947 10.4435 11.947 8.46629H10.447ZM8.38399 2.10559C9.51553 2.10559 10.447 3.03538 10.447 4.19987H11.947C11.947 2.22265 10.3596 0.605591 8.38399 0.605591V2.10559ZM4.16453 0.605591C2.18895 0.605591 0.601562 2.22265 0.601562 4.19987H2.10156C2.10156 3.03538 3.03299 2.10559 4.16453 2.10559V0.605591ZM6.27426 7.71629C5.53111 7.71629 4.91453 7.10485 4.91453 6.33308H3.41453C3.41453 7.91758 4.68707 9.21629 6.27426 9.21629V7.71629ZM7.63399 6.33308C7.63399 7.10485 7.01741 7.71629 6.27426 7.71629V9.21629C7.86145 9.21629 9.13399 7.91758 9.13399 6.33308H7.63399ZM6.27426 4.94987C7.01741 4.94987 7.63399 5.5613 7.63399 6.33308H9.13399C9.13399 4.74857 7.86145 3.44987 6.27426 3.44987V4.94987ZM6.27426 3.44987C4.68707 3.44987 3.41453 4.74857 3.41453 6.33308H4.91453C4.91453 5.5613 5.53111 4.94987 6.27426 4.94987V3.44987ZM8.73561 4.2388H9.43885V2.7388H8.73561V4.2388Z" fill="url(#paint0_linear_405_4907)"></path>
                                <path d="M24.1603 16.5738C24.1034 16.3438 23.9874 16.133 23.8241 15.9627C23.6607 15.7925 23.4559 15.6688 23.2302 15.6042C22.4055 15.4006 19.1068 15.4006 19.1068 15.4006C19.1068 15.4006 15.8082 15.4006 14.9835 15.6236C14.7578 15.6882 14.5529 15.8119 14.3896 15.9821C14.2263 16.1523 14.1103 16.3632 14.0533 16.5932C13.9024 17.4395 13.8286 18.2979 13.8328 19.1578C13.8274 20.0241 13.9012 20.8891 14.0533 21.7418C14.1161 21.9647 14.2347 22.1675 14.3977 22.3305C14.5606 22.4936 14.7624 22.6114 14.9835 22.6726C15.8082 22.8956 19.1068 22.8956 19.1068 22.8956C19.1068 22.8956 22.4055 22.8956 23.2302 22.6726C23.4559 22.608 23.6607 22.4843 23.8241 22.3141C23.9874 22.1439 24.1034 21.933 24.1603 21.703C24.3101 20.8631 24.3839 20.0112 24.3809 19.1578C24.3863 18.2914 24.3124 17.4264 24.1603 16.5738V16.5738Z" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M18.0278 20.7434L20.7847 19.1582L18.0278 17.5729V20.7434Z" fill="#FF0000"></path>
                                <path d="M11.2054 15.0001L11.8772 15.3335C12.0442 14.997 11.9364 14.5888 11.6251 14.3785C11.3137 14.1683 10.8948 14.2209 10.645 14.5016L11.2054 15.0001ZM10.5471 17.4585H11.2971V17.4196L11.293 17.3809L10.5471 17.4585ZM11.1414 15.9226C11.0986 15.5106 10.7299 15.2113 10.3179 15.2541C9.90591 15.297 9.60664 15.6657 9.64947 16.0777L11.1414 15.9226ZM6.59719 17.0275L5.84719 17.0275L5.84719 17.0275L6.59719 17.0275ZM6.59719 17.6668V18.4168H7.34719L7.34719 17.6668L6.59719 17.6668ZM1.98901 22.3335V21.5835C1.65932 21.5835 1.36829 21.7988 1.27183 22.114C1.17537 22.4293 1.29611 22.7706 1.56935 22.9551L1.98901 22.3335ZM2.64732 15.0001L3.35065 14.7397C3.24663 14.4588 2.98544 14.2667 2.6863 14.2511C2.38716 14.2356 2.10744 14.3995 1.97483 14.6681L2.64732 15.0001ZM5.28057 21.0001L5.81424 21.5271C5.99592 21.3431 6.07001 21.0785 6.01029 20.8269C5.95056 20.5753 5.76544 20.3722 5.52044 20.2895L5.28057 21.0001ZM10.0434 15.649L9.48434 16.149L9.75523 16.4519L10.1569 16.3904L10.0434 15.649ZM11.2054 15.0001C10.5335 14.6667 10.5336 14.6666 10.5337 14.6664C10.5337 14.6664 10.5338 14.6663 10.5338 14.6662C10.5339 14.666 10.534 14.6658 10.5341 14.6657C10.5342 14.6654 10.5344 14.6651 10.5345 14.6648C10.5347 14.6643 10.5349 14.6639 10.5351 14.6636C10.5353 14.6631 10.5354 14.6631 10.5352 14.6635C10.5347 14.6643 10.5334 14.667 10.531 14.6714C10.5263 14.6802 10.5178 14.6959 10.5054 14.7175C10.4807 14.7607 10.4408 14.827 10.3856 14.9087C10.2744 15.0733 10.1057 15.2938 9.87897 15.5135L10.9227 16.5908C11.24 16.2834 11.4735 15.9779 11.6286 15.7482C11.7066 15.6328 11.7658 15.535 11.8069 15.4633C11.8274 15.4274 11.8435 15.398 11.8552 15.376C11.861 15.3651 11.8658 15.3559 11.8694 15.3488C11.8713 15.3453 11.8728 15.3422 11.8741 15.3396C11.8748 15.3384 11.8753 15.3372 11.8759 15.3362C11.8761 15.3357 11.8763 15.3352 11.8766 15.3348C11.8767 15.3345 11.8768 15.3343 11.8769 15.3341C11.8769 15.334 11.877 15.3339 11.877 15.3338C11.8771 15.3337 11.8772 15.3335 11.2054 15.0001ZM11.293 17.3809L11.1414 15.9226L9.64947 16.0777L9.80107 17.536L11.293 17.3809ZM5.84719 17.0275L5.84719 17.6668L7.34719 17.6668L7.34719 17.0275L5.84719 17.0275ZM8.59918 14.2501C7.0704 14.2501 5.84719 15.5026 5.84719 17.0275H7.34719C7.34719 16.3131 7.91661 15.7501 8.59918 15.7501V14.2501ZM9.79705 17.4585C9.79705 20.1138 7.67396 22.2501 5.07484 22.2501V23.7501C8.52016 23.7501 11.2971 20.9243 11.2971 17.4585H9.79705ZM1.944 15.2606C2.33728 16.3226 3.80157 18.4168 6.59719 18.4168V16.9168C4.65297 16.9168 3.61568 15.4554 3.35065 14.7397L1.944 15.2606ZM1.97483 14.6681C1.24534 16.1456 1.1096 17.6309 1.67144 18.924C2.23131 20.2126 3.42029 21.1637 5.04069 21.7107L5.52044 20.2895C4.17844 19.8365 3.39249 19.121 3.04719 18.3262C2.70384 17.536 2.73269 16.5213 3.31982 15.3322L1.97483 14.6681ZM4.7469 20.4732C4.4024 20.822 3.31066 21.5835 1.98901 21.5835V23.0835C3.82726 23.0835 5.281 22.0671 5.81424 21.5271L4.7469 20.4732ZM10.6025 15.1491C10.111 14.5995 9.39594 14.2501 8.59918 14.2501V15.7501C8.94798 15.7501 9.26304 15.9015 9.48434 16.149L10.6025 15.1491ZM10.1569 16.3904C10.7604 16.298 11.337 15.9805 11.7657 15.4987L10.645 14.5016C10.4378 14.7345 10.1725 14.8705 9.92988 14.9077L10.1569 16.3904ZM1.56935 22.9551C2.77237 23.7672 4.03563 23.7501 5.07484 23.7501V22.2501C3.98652 22.2501 3.18059 22.233 2.40867 21.7119L1.56935 22.9551Z" fill="#03A9F4"></path>
                                <defs>
                                <linearGradient id="paint0_linear_405_4907" x1="2.0126" y1="10.662" x2="11.2214" y2="2.77808" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FFDD55"></stop>
                                <stop offset="0.5" stop-color="#FF543E"></stop>
                                <stop offset="1" stop-color="#C837AB"></stop>
                                </linearGradient>
                                </defs>
                                </svg>
                         </div> 
                         <div class="text-left font-inter ml-16 target-modal">Share to my socials</div> 
                         <div class=" absolute right-16">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="target-modal">
                                <path d="M10.0001 6L8.59009 7.41L13.1701 12L8.59009 16.59L10.0001 18L16.0001 12L10.0001 6Z" fill="#6E6D7A" class="target-modal"></path>
                            </svg>
                            </div>
                        </div>
                    </div>
                </div>  <!----> <!---->
            </div>
            <div class="py-24 xs:pb-48 share-base-two">
                <div class="flex justify-center items-center px-16 mb-16 relative">
                    <div class="absolute left-16 cursor-pointer rounded-full p-2 hover:bg-gray-50 back-modal">
                        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="target-modal">
                            <path d="M18.6669 8L20.5469 9.88L14.4402 16L20.5469 22.12L18.6669 24L10.6669 16L18.6669 8Z" fill="#6E6D7A"></path>
                        </svg>
                    </div> 
                    <div class="font-inter font-semibold">Share link to</div>
                </div> <!---->  
                <div class="share-social">
                    <div class="share-wa">
                        <div class="flex items-center px-24 h-48 xs:h-64 hover:bg-gray-100 cursor-pointer relative target-modal">
                            <div>
                                <svg width="30" height="29.99876" viewBox="0 0 72.75 72.747" xmlns="http://www.w3.org/2000/svg"> <g transform="translate(-1519 -2710.148)"> <path id="Path_136707" data-name="Path 136707" d="M36.375,72.747a36.187,36.187,0,0,1-18.143-4.884L4.061,72.747,6.971,57.74A35.974,35.974,0,0,1,0,36.375,36.375,36.375,0,1,1,36.375,72.747" transform="translate(1519 2710.148)" fill="#29a71a"></path> <path id="Path_136708" data-name="Path 136708" d="M36.375,72.747a36.2,36.2,0,0,1-18.143-4.884L4.061,72.747,6.974,57.74A35.956,35.956,0,0,1,0,36.375,36.375,36.375,0,1,1,36.375,72.747M18.887,61.915l1.1.686a31.012,31.012,0,1,0-7.991-7.2l.759.972-1.592,8.2Z" transform="translate(1519 2710.148)" fill="#fff"></path> <path id="Path_136709" data-name="Path 136709" d="M6.421,9.827S8.553,6.1,10.294,5.884s3.981-.216,4.585.921,3.3,7.747,3.3,7.747a2.6,2.6,0,0,1-.251,2.24,22.113,22.113,0,0,1-2.307,2.7,1.978,1.978,0,0,0,0,2.348,42.622,42.622,0,0,0,5.116,6.275c2.847,2.85,8.315,4.881,8.315,4.881a1.668,1.668,0,0,0,1.277-.391c.5-.5,3.2-3.873,3.2-3.873a1.9,1.9,0,0,1,2.313-.461c1.433.658,7.667,3.765,7.667,3.765a1.35,1.35,0,0,1,.734,1.366c0,1.1-.448,3.8-1.357,4.709S39.311,41.83,35.31,41.83s-13.539-3.257-18.62-8.338S7.095,23.258,6.03,18.569s-.925-6.809.391-8.741" transform="translate(1530.589 2722.719)" fill="#fff"></path> </g> 
                                </svg>
                            </div> 
                            <div class="text-left font-inter ml-16 target-modal">Share via WhatsApp</div> 
                            <div class=" absolute right-16">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="target-modal">
                                <path d="M10.0001 6L8.59009 7.41L13.1701 12L8.59009 16.59L10.0001 18L16.0001 12L10.0001 6Z" fill="#6E6D7A" class="target-modal"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="share-telegram">
                        <div class="flex items-center px-24 h-48 xs:h-64 hover:bg-gray-100 cursor-pointer relative target-modal">
                            <div>
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M15 30C23.2843 30 30 23.2843 30 15C30 6.71573 23.2843 0 15 0C6.71573 0 0 6.71573 0 15C0 23.2843 6.71573 30 15 30Z" fill="url(#paint0_linear_402_408)"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M6.78987 14.8417C11.1627 12.9365 14.0786 11.6805 15.5375 11.0737C19.7032 9.34105 20.5688 9.04007 21.133 9.03014C21.257 9.02795 21.5345 9.0587 21.7142 9.20453C21.866 9.32767 21.9077 9.494 21.9277 9.61075C21.9477 9.72749 21.9725 9.99344 21.9528 10.2012C21.727 12.5731 20.7503 18.329 20.2533 20.9855C20.0431 22.1096 19.6291 22.4865 19.2282 22.5233C18.3572 22.6035 17.6957 21.9477 16.852 21.3946C15.5318 20.5292 14.786 19.9905 13.5045 19.146C12.0235 18.1701 12.9836 17.6337 13.8276 16.7571C14.0485 16.5277 17.8865 13.0367 17.9607 12.72C17.97 12.6804 17.9787 12.5328 17.891 12.4548C17.8032 12.3769 17.6738 12.4035 17.5804 12.4247C17.448 12.4548 15.3389 13.8488 11.2533 16.6067C10.6547 17.0178 10.1124 17.2181 9.62661 17.2076C9.09103 17.196 8.0608 16.9048 7.29492 16.6558C6.35555 16.3504 5.60895 16.189 5.67396 15.6704C5.70782 15.4003 6.07979 15.1241 6.78987 14.8417Z" fill="white"></path> <defs> <linearGradient id="paint0_linear_402_408" x1="15" y1="0" x2="15" y2="29.7775" gradientUnits="userSpaceOnUse"> <stop stop-color="#2AABEE"></stop> <stop offset="1" stop-color="#229ED9"></stop> </linearGradient> </defs> 
                                </svg>
                            </div> 
                            <div class="text-left font-inter ml-16 target-modal">Share via Telegram</div> 
                            <div class=" absolute right-16">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="target-modal">
                                <path d="M10.0001 6L8.59009 7.41L13.1701 12L8.59009 16.59L10.0001 18L16.0001 12L10.0001 6Z" fill="#6E6D7A" class="target-modal"></path>
                                </svg>
                            </div>
                        </div>
                    </div>  
                    <div class="share-facebook">
                        <div class="flex items-center px-24 h-48 xs:h-64 hover:bg-gray-100 cursor-pointer relative target-modal">
                            <div>
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M30 15C30 6.71572 23.2843 0 15 0C6.71572 0 0 6.71572 0 15C0 22.4868 5.48525 28.6925 12.6562 29.8178V19.3359H8.84766V15H12.6562V11.6953C12.6562 7.93594 14.8957 5.85938 18.322 5.85938C19.9626 5.85938 21.6797 6.15234 21.6797 6.15234V9.84375H19.7883C17.925 9.84375 17.3438 11.0001 17.3438 12.1875V15H21.5039L20.8389 19.3359H17.3438V29.8178C24.5147 28.6925 30 22.4868 30 15Z" fill="#1877F2"></path> <path d="M20.8389 19.3359L21.5039 15H17.3438V12.1875C17.3438 11.0013 17.925 9.84375 19.7883 9.84375H21.6797V6.15234C21.6797 6.15234 19.9632 5.85938 18.322 5.85938C14.8957 5.85938 12.6562 7.93594 12.6562 11.6953V15H8.84766V19.3359H12.6562V29.8178C14.2093 30.0607 15.7907 30.0607 17.3438 29.8178V19.3359H20.8389Z" fill="white"></path> 
                                </svg>
                            </div> 
                            <div class="text-left font-inter ml-16 target-modal">Share via Facebook</div> 
                            <div class=" absolute right-16">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="target-modal">
                                <path d="M10.0001 6L8.59009 7.41L13.1701 12L8.59009 16.59L10.0001 18L16.0001 12L10.0001 6Z" fill="#6E6D7A" class="target-modal"></path>
                                </svg>
                            </div>
                        </div>
                    </div> 
                    <div class="share-twitter">
                        <div class="flex items-center px-24 h-48 xs:h-64 hover:bg-gray-100 cursor-pointer relative target-modal">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none"> <path d="M5 0C2.23857 0 0 2.23857 0 5V25C0 27.7614 2.23857 30 5 30H25C27.7614 30 30 27.7614 30 25V5C30 2.23857 27.7614 0 25 0H5ZM6.48996 6.42857H12.1596L16.1858 12.1498L21.0714 6.42857H22.8571L16.9922 13.2952L24.2243 23.5714H18.5561L13.8839 16.9336L8.21429 23.5714H6.42857L13.0776 15.7882L6.48996 6.42857ZM9.22433 7.85714L19.3011 22.1429H21.49L11.4132 7.85714H9.22433Z" fill="black"></path> 
                                </svg>
                            </div> 
                            <div class="text-left font-inter ml-16 target-modal">Share via Twitter</div> 
                            <div class=" absolute right-16">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="target-modal">
                                <path d="M10.0001 6L8.59009 7.41L13.1701 12L8.59009 16.59L10.0001 18L16.0001 12L10.0001 6Z" fill="#6E6D7A" class="target-modal"></path>
                                </svg>
                            </div>
                        </div>
                    </div> 
                    <div class="share-linked">
                        <div class="flex items-center px-24 h-48 xs:h-64 hover:bg-gray-100 cursor-pointer relative target-modal">
                            <div>
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M27.7854 0H2.21458C1.62724 0 1.06395 0.233322 0.648637 0.648637C0.233322 1.06395 0 1.62724 0 2.21458V27.7854C0 28.3728 0.233322 28.9361 0.648637 29.3514C1.06395 29.7667 1.62724 30 2.21458 30H27.7854C28.3728 30 28.9361 29.7667 29.3514 29.3514C29.7667 28.9361 30 28.3728 30 27.7854V2.21458C30 1.62724 29.7667 1.06395 29.3514 0.648637C28.9361 0.233322 28.3728 0 27.7854 0ZM8.94167 25.5562H4.43125V11.2292H8.94167V25.5562ZM6.68333 9.24375C6.17171 9.24087 5.67239 9.08649 5.24842 8.80011C4.82444 8.51372 4.4948 8.10816 4.3011 7.63461C4.10739 7.16106 4.05831 6.64074 4.16004 6.13932C4.26177 5.6379 4.50975 5.17785 4.87269 4.81723C5.23564 4.45661 5.69727 4.21158 6.19933 4.11308C6.7014 4.01457 7.22139 4.06699 7.69369 4.26373C8.16599 4.46047 8.56942 4.79271 8.85308 5.21852C9.13674 5.64432 9.2879 6.14461 9.2875 6.65625C9.29233 6.99879 9.22814 7.3388 9.09877 7.65601C8.96939 7.97321 8.77748 8.26113 8.53446 8.50258C8.29145 8.74404 8.00231 8.9341 7.68428 9.06144C7.36625 9.18877 7.02584 9.25078 6.68333 9.24375ZM25.5667 25.5688H21.0583V17.7417C21.0583 15.4333 20.0771 14.7208 18.8104 14.7208C17.4729 14.7208 16.1604 15.7292 16.1604 17.8V25.5688H11.65V11.2396H15.9875V13.225H16.0458C16.4813 12.3438 18.0063 10.8375 20.3333 10.8375C22.85 10.8375 25.5688 12.3313 25.5688 16.7063L25.5667 25.5688Z" fill="#0A66C2"></path> 
                                </svg>
                            </div> 
                            <div class="text-left font-inter ml-16 target-modal">Share via LinkedIn</div> 
                            <div class=" absolute right-16">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="target-modal">
                                <path d="M10.0001 6L8.59009 7.41L13.1701 12L8.59009 16.59L10.0001 18L16.0001 12L10.0001 6Z" fill="#6E6D7A" class="target-modal"></path>
                                </svg>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            
        </div>
                        <div class="flex items-center"><!----> 
                            <div class="flex items-center gap-12 cursor-pointer select-none"> 
                                <div class="imgprofil flexcenter">
                                    {{-- <div alt="jeddy kosasih" class=" bl-user-pic object-cover w-h-36 ml-auto image-loader-wrap rounded-full transform cursor-pointer scale-105 cursor-pointer hover:scale-90 duration-100" style="position: relative; padding-bottom: 0px; --transition-duration: 0.5s;"> --}}
                                        {{-- <span  mode="in-out" style="height: 100%; width: 100%; position: absolute; inset: 0px;"> --}}
                                            {{-- <canvas  width="128" height="128" style="height: 100%; width: 100%; position: absolute; inset: 0px; display: flex;"></canvas> --}}
                                        @php
                                            $dataimg = session('dataimg');
                                            // $image = reset($dataimg)['image'] ?? null;  jika data dalam benrtuk array
                                            // reset($dataimg) → Mengambil elemen pertama dari array (baik associative maupun numerik).
                                            $image = $dataimg['image'] ?? null;
                                        @endphp
                                 
                                        @if($image)
                                        <img src="{{ env('API_URL') .'/storage/img/'. $image }}" alt="{{ $image }}" style="height: 100%; width: 100%; inset: 0px;">
                                        @else
                                        <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13.25 10C13.8467 10 14.419 10.2371 14.841 10.659C15.2629 11.081 15.5 11.6533 15.5 12.25V13C15.5 15.9565 12.71 19 8 19C3.29 19 0.5 15.9565 0.5 13V12.25C0.5 11.6533 0.737053 11.081 1.15901 10.659C1.58097 10.2371 2.15326 10 2.75 10H13.25ZM8 0.25C9.09402 0.25 10.1432 0.684597 10.9168 1.45818C11.6904 2.23177 12.125 3.28098 12.125 4.375C12.125 5.46902 11.6904 6.51823 10.9168 7.29182C10.1432 8.0654 9.09402 8.5 8 8.5C6.90598 8.5 5.85677 8.0654 5.08318 7.29182C4.3096 6.51823 3.875 5.46902 3.875 4.375C3.875 3.28098 4.3096 2.23177 5.08318 1.45818C5.85677 0.684597 6.90598 0.25 8 0.25Z" fill="#171717"/>
                                        </svg>
                                        @endif
                                        {{-- </span> --}}
                                    {{-- </div> <!----> --}}
                                </div>
                                    <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 1L5.09091 5.5L9.18182 1" stroke="black" stroke-width="1.56" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                            </div>
                

                        <div class="menu-setup"><!---->
                            <div class="switch-account hover:bg-transparent">
                                <span class="text-xs font-inter font-bold text-blGrey">Switch accounts</span> 

                                <div class="max-h-200 overflow-auto transparent-scroll">
                                    @foreach (session('profil', []) as $getlink)
                                    {{-- @foreach (collect(session('profil')) as $item) --}}
                                    <a href="{{ route('switchaccount', ['id'=> $getlink['id'] ]) }}">
                                     
                                        <div class="cursor-pointer switch-item relative flex hover:bg-blDark05 bg-blDark05">
                                            <div class="mr-8 flex-shrink-0">
                                                <div alt="jeddy kosasih" class="bl-user-pic object-cover w-h-36 ml-auto image-loader-wrap rounded-full transform cursor-pointer flex-shrink-0 cursor-pointer hover:scale-90 duration-100" style="position: relative; padding-bottom: 0px; --transition-duration: 0.5s;">
                                                    <canvas width="128" height="128" style="height: 100%; width: 100%; position: absolute; inset: 0px; display: none;"></canvas>
                                                    <img src="{{ env('API_URL') .'/storage/img/'. $getlink['image'] }}" alt="{{ $getlink['nama'] }}" style="height: 100%; width: 100%; position: absolute; inset: 0px;">
                                                </div>
                                            </div> 
                                            <div class="text-xs font-inter font-medium flex items-center flex-wrap w-4/5">
                                                <div class="mb-0.5 text-blDark truncate font-medium w-full">{{ $getlink['nama'] }}</div> 
                                                <div class="text-blGrey truncate w-full">{{ config('app.APP_URL') .  '/' . Auth::user()->username }}</div>
                                            </div> 
                                            @if ($getlink['status'] === 'on')
                                            <input class="user-on" type="hidden" value="{{ $getlink['nama'] }}">
                                            <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute top-16 right-10">
                                                <path d="M10 1.46405L3.58975 8L0 4.36602L1.46156 2.90198L3.58975 5.04578L8.53849 0L10 1.46405Z" fill="#0095F6"></path>
                                            </svg>
                                            @endif
                                        </div> </a>
                                    @endforeach
                                </div> 
                            {{-- <div class="block cursor-pointer text-blBlue text-sm font-inter font-semibold mt-12 ml-4 hover:underline">+ Add a new page </div> <!----> --}}
                    </div>     
                            <a href="{{ route('profil') }}" class="">
                                <div class="sub-menu-setup">
                                    <span>+ Add a new Template</span>
                                    </div>
                                </a>
                            @if (Route::is('accountsetting'))     
                            <a href="{{ route('links') }}" class="">
                                <div class="sub-menu-setup">
                                    <span>Dashboard</span>
                                    </div>
                                </a>
                            @else     
                            <a href="{{ route('accountsetting') }}" class="">
                                <div class="sub-menu-setup">
                                    <span>Account Settings</span>
                                    </div>
                                </a>
                            @endif   
                            <a href="{{ route('logout') }}" class="">
                                <div class="sub-menu-setup">
                                    <span>Logout</span>
                                    </div>
                                </a>
                        </div>
                    </div>
                    {{-- <span>Register Disini --></span>
                        <a href="{{ route('daftar') }}" class="text-blPrimary underline">Daftar</a> --}}
                @endif
           
    </div>
</section>


<script>


document.addEventListener("DOMContentLoaded", function () {

    const dropdownTogglesMain = document.querySelectorAll('.select-none'); 
    const dropdownMenusMain = document.querySelectorAll('.menu-setup');
    const dropdownTogglesShare = document.querySelectorAll('.select-two'); 
    const dropdownMenusShare = document.querySelectorAll('.group-share');
    const shareBaseOne = document.querySelector('.share-base-one');
    const shareBaseTwo = document.querySelector('.share-base-two'); 
    const shareItem = document.querySelector('.share-item'); 
    const targetModal = document.querySelector('.back-modal');

    dropdownMenusMain.forEach(menu => menu.style.display = 'none');
    dropdownMenusShare.forEach(menu => menu.style.display = 'none');

    if (shareBaseOne) shareBaseOne.style.display = 'block'; 
    if (shareBaseTwo) shareBaseTwo.style.display = 'none'; 
    if (shareItem) {
        shareItem.addEventListener("click", function (e) {
            e.stopPropagation();
            shareBaseOne.style.display = 'none';
            shareBaseTwo.style.display = 'block';
        });
    }

    if (targetModal) {
        targetModal.addEventListener("click", function (e) {
            e.stopPropagation();
            shareBaseOne.style.display = 'block';
            shareBaseTwo.style.display = 'none';
        });
    }

    function setupDropdown(toggles, menus, otherMenus) {
        toggles.forEach((toggle, index) => {
            const menu = menus[index];

            toggle.addEventListener('click', function (e) {
                e.stopPropagation(); 

                [...menus, ...otherMenus].forEach(otherMenu => {
                    if (otherMenu !== menu) {
                        otherMenu.style.display = 'none';
                    }
                });

                menu.style.display = (menu.style.display === 'none') ? 'block' : 'none';
            });
        });
    }

    setupDropdown(dropdownTogglesMain, dropdownMenusMain, dropdownMenusShare);
    setupDropdown(dropdownTogglesShare, dropdownMenusShare, dropdownMenusMain);

    document.addEventListener('click', function (e) {
        const isClickInsideDropdown = e.target.closest(".menu-setup, .group-share, .select-none, .select-two, .share-item");
        
        if (!isClickInsideDropdown) {
            dropdownMenusMain.forEach(menu => menu.style.display = 'none');
            dropdownMenusShare.forEach(menu => menu.style.display = 'none');
            if (shareBaseTwo) shareBaseTwo.style.display = 'none'; 
        }
    });
});

    function shareViaWhatsApp() {
        const textToShare = document.getElementById("copyText").innerText;
        const userOn = document.querySelector(".user-on").value
        const message = `Hallo Salam Kenal..!
        Perkenalkan nama saya *${userOn}*
        Silahkan kunjungi link bio saya di bawah ini:
        ${textToShare}`;

        const encodedText = encodeURIComponent(message);
        const whatsappURL = `https://wa.me/?text=${encodedText}`;

        window.open(whatsappURL, '_blank');
    }
    function shareViaTelegran() {
        const textToShare = document.getElementById("copyText").innerText; 
        const userOn = document.querySelector(".user-on").value
        const message = `Hallo Salam Kenal..!
        Perkenalkan nama saya *${userOn}*
        Silahkan kunjungi link bio saya di bawah ini:
        ${textToShare}`;

        const encodedText = encodeURIComponent(message);
        const telegramURL = `https://t.me/share/url?url=${encodedText}`;

        window.open(telegramURL, '_blank');
    }

    function shareViafacebook() {
        const textToShare = document.getElementById("copyText").innerText; 
        const userOn = document.querySelector(".user-on").value

        const message = `Hallo Salam Kenal..!
        Perkenalkan nama saya *${userOn}*
        Silahkan kunjungi link bio saya di bawah ini:
        ${textToShare}`;

        const encodedText = encodeURIComponent(message);
        const facebookURL = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(textToShare)}`;

        window.open(facebookURL, '_blank');
    }

    function shareViatwitter() {
        const textToShare = document.getElementById("copyText").innerText; 
        const userOn = document.querySelector(".user-on").value

        const message = `Hallo Salam Kenal..!
        Perkenalkan nama saya *${userOn}*
        Silahkan kunjungi link bio saya di bawah ini:
        ${textToShare}`;

        const encodedText = encodeURIComponent(message);
        const twitterURL = `https://twitter.com/intent/tweet?text=${encodedText}`;

        window.open(twitterURL, '_blank');
    }

    function shareVialinked() {
        const textToShare = document.getElementById("copyText").innerText;
        const userOn = document.querySelector(".user-on").value

        const message = `Hallo Salam Kenal..!
        Perkenalkan nama saya *${userOn}*
        Silahkan kunjungi link bio saya di bawah ini:
        ${textToShare}`;

        const encodedText = encodeURIComponent(message);
        const linkedinURL = `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(textToShare)}&title=${encodeURIComponent(userOn)}`;

        window.open(linkedinURL, '_blank');
    }

    document.querySelector(".share-wa").addEventListener("click", function () {
        shareViaWhatsApp();
    }); 
    document.querySelector(".share-telegram").addEventListener("click", function () {
        shareViaTelegran();
    });
    document.querySelector(".share-facebook").addEventListener("click", function () {
        shareViafacebook();
    });
    document.querySelector(".share-twitter").addEventListener("click", function () {
        shareViatwitter();
    });
    document.querySelector(".share-linked").addEventListener("click", function () {
        shareVialinked();
    });


function copyToClipboard() {

    const textToCopy = document.getElementById("copyText").innerText; 

    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(textToCopy).then(() => {
            showSuccessMessage();
        }).catch(err => {
            console.error('Gagal menyalin teks: ', err);
        });
    } else {
        const tempInput = document.createElement('input');
        tempInput.value = textToCopy;
        document.body.appendChild(tempInput);
        tempInput.select();
        try {
            document.execCommand('copy');
            showSuccessMessage();
        } catch (err) {
            console.error('Fallback: Gagal menyalin teks', err);
        }
        document.body.removeChild(tempInput);
    }
}

function showSuccessMessage() {
    const successcopylink = document.getElementById('copylink');
    successcopylink.innerText = 'Copied';
    setTimeout(() => {
        successcopylink.innerText = 'Copy link';
    }, 2000);
}


</script>