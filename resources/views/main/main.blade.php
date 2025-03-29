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

    @extends('index')
    @section('content')
 
    {{-- @if (session()->has('message'))
        <p>{{ session('message') }}</p>
    @endif --}}
    {{-- <div class="container"> --}}

        
            <aside id="sidebar" class="sidebar bg-gold ">
                <section class="p-b-wrap  pr-64 flex absolute">

                            <div class="inline-block ml-auto mt-32 phone-inner-wrap">
                            
                            <div id="toggleSidebar" class="fixed bl-phone-main z-50 cursor-pointer"></div>
                                    <div class="bl-phone-view-main overflow-hidden relative draggable-sidebar">
                                <iframe  src="{{ route ( 'haluser', ['username' => Auth::user()->username]) }}" height="100%" width="100%" frameborder="0" class="bg-white"></iframe>
                            </div>
                        </div>
                </section>
            </aside>

            <section class="content bg-black">
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
                        <a  href="{{ route ('settings')}}"> 
                            <div class="btnmenu cursor-pointer {{ request()->routeIs('settings') ? 'selected' : '' }}" onclick="toggleBOKE('Settings', this)" id="Settings-btn">
                            <span>Settings</span>
                            </div>
                        </a>
                        
                        <a  href="{{ route ('design')}}"> 
                            <div class="btnmenu cursor-pointer {{ request()->routeIs('design') ? 'selected' : '' }}" onclick="toggleBOKE('Design', this)" id="Design-btn">
                            <span>Design</span>
                            </div>
                        </a>
                    </div>
        
                    @yield('main-content')

                </div>
            </section>
          
    @livewireScripts
   
    <script>
    window.addEventListener("resize", function () {
    const sidebar = document.getElementById("sidebar");
    if (window.innerWidth <= 700) {
        sidebar.style.left = "0px";
        sidebar.style.top = "60px";
    }
    });
    const sidebar = document.getElementById("sidebar");
    const header = document.getElementById("toggleSidebar");

    let offsetX = 0, offsetY = 0;
    let isDragging = false;
    let dragStarted = false;


    header.addEventListener("mousedown", function (e) {
        dragStarted = true;
        offsetX = e.clientX - sidebar.offsetLeft;
        offsetY = e.clientY - sidebar.offsetTop;
        sidebar.style.transition = "none";
    });

    document.addEventListener("mousemove", function (e) {
        if (dragStarted) {
            isDragging = true;
            sidebar.style.left = e.clientX - offsetX + "px";
            sidebar.style.top = e.clientY - offsetY + "px";
        }
    });
    document.addEventListener("mouseup", function () {
        if (isDragging) {
            setTimeout(() => isDragging = false, 100);
        }
        dragStarted = false;
    });

    header.addEventListener("touchstart", function (e) {
        dragStarted = true;
        const touch = e.touches[0];
        offsetX = touch.clientX - sidebar.offsetLeft;
        offsetY = touch.clientY - sidebar.offsetTop;
        sidebar.style.transition = "none";
    });

    document.addEventListener("touchmove", function (e) {
        if (dragStarted) {
            isDragging = true;
            const touch = e.touches[0];
            sidebar.style.left = touch.clientX - offsetX + "px";
            sidebar.style.top = touch.clientY - offsetY + "px";
        }
    }, { passive: false });

    document.addEventListener("touchend", function () {
        if (isDragging) {
            setTimeout(() => isDragging = false, 100);
        }
        dragStarted = false;
    });

    header.addEventListener("click", function (e) {
        e.stopPropagation();
        if (isDragging) return;

        sidebar.classList.toggle("show-sidebar");
        document.querySelector(".bl-phone-view-main").classList.toggle("bl-phone-edit");
        this.classList.toggle("hidden");
    });


    document.addEventListener("click", function (e) {
        if (
            sidebar.classList.contains("show-sidebar") &&
            !sidebar.contains(e.target) &&
            !header.contains(e.target)
        ) {
            sidebar.classList.remove("show-sidebar");
            document.querySelector(".bl-phone-view-main").classList.remove("bl-phone-edit");
            header.classList.remove("hidden");
        }
    });

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

    setTimeout(() => {
        document.getElementById('colorBackground').addEventListener('input', function() {
        let selectedColor = this.value;
        Livewire.dispatch('updateColorBackground', { color: selectedColor }); 
        });

        document.getElementById('colorButton').addEventListener('input', function() {
        let selectedColor = this.value;
        Livewire.dispatch('updateColorButton', { color: selectedColor }); 
        });

        document.getElementById('colorFont').addEventListener('input', function() {
        let selectedColor = this.value;
        Livewire.dispatch('updateColorFont', { color: selectedColor });
        });

    }, 2000);


    Livewire.on('ColorFontChanged', (newColorFont) => {
        let iframe = document.querySelector("iframe");
        if (iframe) {
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
        Livewire.on('ProfileImageUpdated', (newBackground) => {
            let iframe = document.querySelector("iframe");
            if (iframe) {
                iframe.contentWindow.postMessage({ 
                    type: 'update1-image', 
                    x: newBackground 
                }, '*'); 
            }
        });
    //----------------------------------------------10
    Livewire.on('themaChanged', (newthema) => {
        let iframe = document.querySelector("iframe");
        if (iframe) {
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

    Livewire.on('updateOrder', (positions) => {
        let iframe = document.querySelector("iframe");
        if (iframe) {
            iframe.contentWindow.postMessage({ 
                type: 'updatePosition', 
                positions: positions 
            }, '*');
        }
    });

    </script>
@endsection