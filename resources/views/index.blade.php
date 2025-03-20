{{-- <!DOCTYPE html>
<html lang="en">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <style>
        :root {
        --primary-color: #0095f6;
        --secondary-color: #e0c088;
        --text-color: #ffffff;
        --sidebar-width: 50%;
        }
    </style>
    <link rel="stylesheet" href="css/style.css">
</head>
<body> --}}

    @extends('layouts.main')
    @section('content')
 
    {{-- @if (session()->has('message'))
        <p>{{ session('message') }}</p>
    @endif --}}
    {{-- <div class="container"> --}}

        
            <aside class="sidebar">
                <section class="p-b-wrap  pr-64 flex absolute">
                    {{-- <div> --}}
                {{-- <section class="py-32 dash-side-wrap">
                    <div class="p-b-wrap pr-64 flex absolute"> --}}
                        {{-- <div class="inline-block ml-auto mt-32 phone-inner-wrap" style="width: 335.612px;"> --}}
                            <div class="inline-block ml-auto mt-32 phone-inner-wrap">
                                {{-- <div class="bl-phone-view-main overflow-hidden relative" style="transform: scale(0.95889);"> --}}
                            <div class="bl-phone-view-main overflow-hidden relative">
                                <iframe  src="{{ route ( 'haluser', ['username' => Auth::user()->username]) }}" height="100%" width="100%" frameborder="0" class="bg-white"></iframe>
                            </div>
                        </div>
                    {{-- </div> --}}
                </section>
            </aside>

            <section class="content">
                <div class="secton-content w-600">
                    <div class="menu flexcenter">
                        <a  href="{{ route ('links')}}"> 
                            <div class="btnmenu cursor-pointer {{ request()->routeIs('links') ? 'selected' : '' }}" onclick="toggleBOKE('Links', this)" id="Links-btn">
                            <span>Links</span>
                            </div>
                        </a>
                        <a href="{{ route ('posts')}}"> 
                            <div class="btnmenu cursor-pointer {{ request()->routeIs('posts') ? 'selected' : '' }}" onclick="toggleBOKE('Posts', this)" id="Posts-btn">
                            <span>Posts</span>
                            </div>
                        </a>
                        <a  href="{{ route ('design')}}"> 
                            <div class="btnmenu cursor-pointer {{ request()->routeIs('design') ? 'selected' : '' }}" onclick="toggleBOKE('Design', this)" id="Design-btn">
                            <span>Design</span>
                            </div>
                        </a>
                        {{-- <a  href="javascript:void(0)">  --}}
                        <a  href="{{ route ('settings')}}"> 
                            <div class="btnmenu cursor-pointer {{ request()->routeIs('settings') ? 'selected' : '' }}" onclick="toggleBOKE('Settings', this)" id="Settings-btn">
                            <span>Settings</span>
                            </div>
                        </a>
                    </div>
                    
                @yield('main-content')
            </div>
{{--             
                <div id="Links">
                    @include('main.link')
                </div> 
                <div id="Posts" class="hidden">
                    @include('main.postimage')
                </div> 
                <div id="Settings" class="hidden">
                    @include('main.setting')
                </div> 
                <div id="Design" class="hidden">
                    @include('main.design')
                </div>  --}}
           
                {{-- <div class="group-posts">
                    <div class="child-posts bg-white radius-4 cursor-pointer">
                        <label for="header">Header</label>
                        <input type="text" name="header" readonly>
                    </div>
                    <div class="child-posts bg-white radius-4 cursor-pointer">
                        <label for="header">Header</label>
                        <input type="text" name="header" readonly>
                    </div>
                </div> --}}



            </section>

    {{-- </div> --}}
    @livewireScripts
   
    <script>
const iframe = document.querySelector("iframe");
iframe.onload = function () {
    const style = document.createElement("style");
    style.innerHTML = `
        .show-embed-item {
        max-height: 217px !important;
        }
    `;
    iframe.contentDocument.head.appendChild(style);
};
    // function toggleBOKE(type, element) {
    //     const Links = document.getElementById('Links');
    //     const Posts = document.getElementById('Posts');
    //     const Design = document.getElementById('Design');
    //     const Settings = document.getElementById('Settings');

    //     if  (type === 'Links'){
    //         Links.classList.remove('hidden');
    //         Posts.classList.add('hidden');
    //         Design.classList.add('hidden');
    //         Settings.classList.add('hidden');
    //     }
    //     else if (type === 'Posts'){
    //         Posts.classList.remove('hidden');
    //         Links.classList.add('hidden');
    //         Design.classList.add('hidden');
    //         Settings.classList.add('hidden');
    //     }
    //     else if (type === 'Design'){
    //         Design.classList.remove('hidden');
    //         Posts.classList.add('hidden');
    //         Links.classList.add('hidden');
    //         Settings.classList.add('hidden');
    //     }
    //     else if (type === 'Settings'){
    //         Settings.classList.remove('hidden');
    //         Links.classList.add('hidden');
    //         Posts.classList.add('hidden');
    //         Design.classList.add('hidden');
    //     }
    //     document.querySelectorAll('.btnmenu').forEach(el => el.classList.remove('selected'));
    //     element.classList.add('selected');
    // }

setTimeout(() => {




    document.getElementById('colorBackground').addEventListener('input', function() {
    let selectedColor = this.value;
    Livewire.dispatch('updateColorBackground', { color: selectedColor }); // Gunakan dispatch() untuk Livewire v3
    });

    document.getElementById('colorButton').addEventListener('input', function() {
    let selectedColor = this.value;
    Livewire.dispatch('updateColorButton', { color: selectedColor }); // Gunakan dispatch() untuk Livewire v3
    });

    document.getElementById('colorFont').addEventListener('input', function() {
    let selectedColor = this.value;
    Livewire.dispatch('updateColorFont', { color: selectedColor }); // Gunakan dispatch() untuk Livewire v3
    });


}, 2000); // Tunggu 0.5 detik agar Livewire siapthemaChanged


Livewire.on('ColorFontChanged', (newColorFont) => {
    console.log('Background page diubah menjadi:', newColorFont);
   
    let iframe = document.querySelector("iframe");
    if (iframe) {
        // Kirim perubahan font ke iframe
        iframe.contentWindow.postMessage({ 
            type: 'update3-color', x: newColorFont[0]
        }, '*');
    }
});
//----------------------------------------------1,2
Livewire.on('fontChanged', (newFont) => {
    let iframe = document.querySelector("iframe");
        if (iframe) {
            iframe.contentWindow.postMessage({ type: 'updateFont', font: newFont }, '*');
        }
});
//----------------------------------------------3
Livewire.on('ButtonColorChanged', (newButtonColor) => {
    let iframe = document.querySelector("iframe");
    if (iframe) {
        iframe.contentWindow.postMessage({ 
            type: 'update2-color', 
            x: newButtonColor[0],
            y: newButtonColor[1],  
        }, '*');
    }
});
Livewire.on('BorderColorChanged', (newButtonColor) => {
    let iframe = document.querySelector("iframe");
    if (iframe) {
        iframe.contentWindow.postMessage({ 
            type: 'update4-color', 
            x: newButtonColor[0],
            y: newButtonColor[1],  
            z: newButtonColor[2],  
        }, '*');
    }
});
//----------------------------------------------4,5
Livewire.on('buttonChanged', (data) => {
    if (Array.isArray(data) && data.length > 0) {
        data = data[0]; 
    }
    let iframe = document.querySelector("iframe");
    if (iframe) {
        iframe.contentWindow.postMessage({
            type: 'updateButton',
            border: data[0]|| "0px solid transparent",
            background: data[1] || "#970a4e",
            radius: data[2] || "30px",
            btnpage_color: data[3] || "#FFFFFF"
        }, '*');
    }
});  
//----------------------------------------------6
Livewire.on('BackgroundChanged', (newBackground) => {
    let iframe = document.querySelector("iframe");
    if (iframe) {
        iframe.contentWindow.postMessage({ type: 'update1-color', x: newBackground }, '*');
    }
});
//----------------------------------------------7,8,9
    // document.addEventListener("DOMContentLoaded", function () {
        Livewire.on('ProfileImageUpdated', (newBackground) => {
            let iframe = document.querySelector("iframe");
            if (iframe) {
                iframe.contentWindow.postMessage({ 
                    type: 'update1-image', 
                    x: newBackground 
                }, '*'); 
            }
        });
    // });
//----------------------------------------------10
Livewire.on('themaChanged', (newthema) => {
    console.log('Background page diubah menjadi:', newthema);
  
    let iframe = document.querySelector("iframe");
    if (iframe) {
        // Kirim perubahan font ke iframe
        iframe.contentWindow.postMessage({ 
            type: 'update-thema', 
            x: newthema[0],
            y: newthema[1],  
            w: newthema[2],  
            z: newthema[3],  
            t: newthema[4],  
            u: newthema[5],  
            v: newthema[6],  
            s: newthema[7],  
        }, '*');
    }
});
//----------------------------------------------11











// Livewire.on('colorChanged', (color) => {
//     console.log("Warna yang dipilih:", color);
//  //  document.documentElement.style.setProperty('--btnpage_color',color);
//  let iframe = document.querySelector("iframe");
//     if (iframe) {
//         // Kirim perubahan font ke iframe
//         iframe.contentWindow.postMessage({ type: 'ColorFont', ColorFont: color }, '*');
//     }
// });
//----------------------------------------------2

            // document.getElementById('colorPicker').addEventListener('input', function() {
            //     let selectedColor = this.value; // Ambil nilai warna yang dipilih
            //     Livewire.emit('updateColorLive', selectedColor); // Kirim event ke Livewire
            // });
  
    // Livewire.on('fontChanged', (newFont) => {
    //     let iframe = document.querySelector("iframe");
    //     if (iframe) {
    //         iframe.contentWindow.postMessage({ type: 'updateFont', font: newFont }, '*');
    //     }
    // });

    // window.addEventListener('message', (event) => {
    //     if (event.data.type === 'updateFont') {
    //         document.documentElement.style.setProperty('--page-font-family', event.data.font);
    //         document.querySelector('.page-text-font').style.fontFamily = `"${event.data.font}", sans-serif`;
    //     }
    // });









Livewire.on('updateOrder', (positions) => {
    console.log("🟢 Update posisi diterima dari Livewire:", positions);

    let iframe = document.querySelector("iframe");
    if (iframe) {
        iframe.contentWindow.postMessage({ 
            type: 'updatePosition', 
            positions: positions 
        }, '*');
    }
});






// Menangkap pesan dari iframe untuk memperbarui font di dalamnya
// window.addEventListener('message', (event) => {
//     if (event.data && event.data.type === 'updateFont') {
//         document.documentElement.style.setProperty('--page-font-family', event.data.font);
//         document.querySelector('.page-text-font').style.fontFamily = `"${event.data.font}", sans-serif`;

//         console.log('Font dalam iframe diperbarui ke123123:', event.data.font);
//     }
// });
// function saveFont(element) {
//     let fontFamily = element.querySelector('.font-option').style.fontFamily;

//     fetch('/update-font', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({
//             key: 'page_font_family',
//             value: fontFamily
//         })
//     })
//     .then(response => response.json())
//     .then(data => {
//         console.log('Font berhasil diperbarui:', data);

//         // **Kirim data ke halaman dalam iframe**
//         const iframe = document.querySelector('iframe');
//         if (iframe && iframe.contentWindow) {
//             iframe.contentWindow.postMessage({
//                 action: 'updateFont',
//                 font: fontFamily
//             }, '*'); // Kirim ke semua domain (atau spesifik seperti 'http://example.com')
//         }
//     })
//     .catch(error => {
//         console.error('Terjadi kesalahan:', error);
//     });
// }
//----------------------------------------
// function saveFont(element) {
//     let fontFamily = element.querySelector('.font-option').style.fontFamily;
//     localStorage.setItem('selectedFont', fontFamily);

//     fetch('/update-font', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({
//             key: 'page_font_family',
//             value: fontFamily
//         })
//     })
//     .then(() => {
//         // Kirim event ke semua tab dan iframe
//         window.dispatchEvent(new Event('fontUpdated'));
//     });
// }

    </script>
{{-- </body>
</html> --}}
@endsection