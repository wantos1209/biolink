@extends('main.main')
@section('main-content')
<div  id="sortableList"  class="group-header sortable-list ">
<form action="{{ route('updateprofil') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="group-design bg-white">
        <div class="child-profil  radius-4">
            <span>Profile</span>
        </div>
        <div class="child-profiltext radius-4">
            <div class="profiltext">
                <input class="mt-5"type="text" name="nama" value="{{ $profil['nama'] }}">
                <input class="mt-24" type="text" name="bio" value="{{ $profil['bio'] }}">
            </div>
            <div class="profilimg ml-32">
                <div class="profil-canvas">
                @if (is_null($profil['image']))
                    <input type="file" id="profile-img-upload" accept="image/*" class="p-b-wrap absolute opacity-0 cursor-pointer" name="images"  onchange="previewImages();">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.0245 6.06756V6.06756C18.5729 6.06756 18.1637 5.80726 17.9712 5.40047C17.6237 4.66439 17.1818 3.72369 16.9203 3.21158C16.5341 2.45007 15.9082 2.00696 15.0414 2.00091C15.0268 1.9997 9.37059 1.9997 9.35606 2.00091C8.48922 2.00696 7.86451 2.45007 7.4771 3.21158C7.2168 3.72369 6.77491 4.66439 6.42744 5.40047C6.23495 5.80726 5.82453 6.06756 5.37416 6.06756V6.06756C2.95766 6.06756 1 8.02521 1 10.4405V17.6271C1 20.0411 2.95766 22 5.37416 22H19.0245C21.4398 22 23.3974 20.0411 23.3974 17.6271V10.4405C23.3974 8.02521 21.4398 6.06756 19.0245 6.06756Z" stroke="url(#paint0_linear_331_550)" stroke-linecap="round" stroke-linejoin="round"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M8.34778 13.6033C8.34657 15.7256 10.079 17.4617 12.1977 17.4605C14.3128 17.4581 16.0404 15.7293 16.044 13.6118C16.0477 11.4859 14.3212 9.7534 12.2001 9.75098C10.0669 9.74856 8.33083 11.5101 8.34778 13.6033Z" stroke="url(#paint1_linear_331_550)" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M18.1356 10.7718C18.0186 10.7598 17.9031 10.7293 17.7737 10.6772C17.6298 10.6133 17.5052 10.532 17.3847 10.4096C17.1683 10.1794 17.043 9.87829 17.043 9.56771C17.043 9.40273 17.0767 9.23922 17.1426 9.09109C17.2086 8.94102 17.2868 8.81443 17.4282 8.67673C17.5357 8.58307 17.6459 8.5077 17.7965 8.44135C18.2431 8.26438 18.7744 8.37012 19.1064 8.70199C19.2059 8.80002 19.2897 8.91833 19.3362 9.01809L19.3637 9.08883C19.4306 9.23922 19.4643 9.40273 19.4643 9.56771C19.4643 9.88458 19.3406 10.1776 19.111 10.4216C18.9125 10.6214 18.6518 10.7443 18.3737 10.7718L18.2536 10.7778L18.1356 10.7718Z" fill="url(#paint2_linear_331_550)"></path> <defs><linearGradient id="paint0_linear_331_550" x1="1.9738" y1="12" x2="14.7268" y2="22.5155" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5858"></stop> <stop offset="1" stop-color="#C058FF"></stop></linearGradient> <linearGradient id="paint1_linear_331_550" x1="8.68228" y1="13.6058" x2="13.4618" y2="17.1188" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5858"></stop> <stop offset="1" stop-color="#C058FF"></stop></linearGradient> <linearGradient id="paint2_linear_331_550" x1="17.1482" y1="9.56712" x2="18.6501" y2="10.6729" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5858"></stop> <stop offset="1" stop-color="#C058FF"></stop></linearGradient></defs></svg>
                @else
                    <div class="profil-img">
                        <div>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer delete-icon">
                                <circle cx="12" cy="12" r="11" fill="#0D0C22" stroke="white" stroke-width="2"></circle> 
                                <g clip-path="url(#clip0)">
                                    <path d="M15.7766 8.21582L8.86487 15.1275" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M15.7823 15.1347L8.86487 8.21582" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g> 
                                <defs><clipPath id="clip0"><rect width="10.3784" height="10.3784" fill="white" transform="translate(7.13513 6.48633)"></rect></clipPath></defs>
                            </svg>
                        </div>
                        <img src="{{ env('API_URL') .'/storage/img/'. $profil['image'] }}" alt="Preview" name="img">
                        <input type="hidden" name="old_image" value="{{ $profil['image'] }}">
                    </div>
                @endif
                </div> 
            </div>
        </div>
            <button class="btnsave bl-btn text-white relative flexcenter" type="submit">
        <span>Save Profile</span></span> <span class="bl-circle-loader absolute hidden"></span>
        </button>
    </div>
</form>

@php
$sortedItems = collect($items)->sortBy(function ($item) {

    if (preg_match('/^cusher (\d+)$/', $item['position'], $matches)) {
        return (int) $matches[1]; 
    } elseif (preg_match('/^cuslink (\d+)$/', $item['position'], $matches)) {
        return (int) $matches[1] + 1000;
    } elseif (preg_match('/^cuspimg (\d+)$/', $item['position'], $matches)) {
        return (int) $matches[1] + 1000; 
    } elseif (preg_match('/^cusblog (\d+)$/', $item['position'], $matches)) {
        return (int) $matches[1] + 1000; 
    }
    
    return 9999; 
});
@endphp



@foreach ($sortedItems as $item)
    <div  class="mb-16 data-item">
        <div class=" sortable-item child-header bg-white shadow-sm relative  rounded-sm xs:rounded-md xs:shadow-xs xs:p-16 xs:pr-72"  data-id="{{ $item['id']}}" data-type="{{ $item['section']}}">
            @if($item instanceof \App\Models\Header)
                <div class="w-full px-24 text-center text-blDark font-inter data-header font-bold text-16 triggermodal"  data-target="showaddheader">
                    <span  class="addname">{{ $item['title'] }}</span>
                    <input type="hidden" class="addid" value="{{ $item['id'] }}">
                </div>
                @elseif($item instanceof \App\Models\Link)
                <div class="flexbetween triggermodal data-link" data-target="showaddlink">
                    <div class="flex">
                            @if (!empty($item['image']))
                            <div class="w-h-52 flex-shrink">
                                <div class="foto-url w-h-52" style="">
                                    {{-- <span  mode="in-out" style="height: 100%; width: 100%; position: absolute; inset: 0px;">
                                        <canvas  width="128" height="128" style="height: 100%; width: 100%; position: absolute; inset: 0px; display: none;"></canvas> --}}
                                        <img src="{{ env('API_URL') .'/storage/img/'. $item['image'] }}" alt="{{ $item['title'] }}" style="height: 100%; width: 100%; position: absolute; inset: 0px;">
                                    {{-- </span> --}}
                                </div>
                            </div> 
                            @endif
                        <div class="py-6 flex justify-between flex-col ml-16">
                                <div class="judul-link">
                                    <span>{{ $item['title'] }}</span>
                                </div> 
                            <div class="nama-url limit-one-line cursor-pointer">
                                {{ $item['url'] }}
                            </div>
                        
                            <input type="hidden" class="addid" value="{{ $item['id'] }}">
                            <input type="hidden" class="addembed" value="{{ $item['embed'] === true ? 'on' : 'off' }}">

                        </div>
                    </div>
                </div>
                @elseif($item instanceof \App\Models\PostImage)
                    <div class="w-full mb-5" >
                        <div class="img_form overflow-scroll">
                            
                            <div class="custom-file-upload">
                                @if (isset($item['imageposts']) || !empty($item['imageposts']))  
                                @php
                                $dataimg = [];
                                @endphp
                                    @foreach ($item->imageposts as $getimage)
                                        <a href="#" class="triggermodal trigger-galery-modal" data-target="showImg" data-index="{{ $loop->index }}">
                                            <img class="img-preview" src="{{ env('API_URL') .'/storage/img/'. $getimage['image'] }}" alt="{{ $getimage['image'] }}" style="max-width: 150px;margin: 5px;">
                                        </a>
                                @php
                                $dataimg[] = env('API_URL') .'/storage/img/'. $getimage['image'];
                                @endphp         
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class=" break-all triggermodal  data-posimage" data-target="showaddpostimage" data-images='@json($item->imageposts->pluck("image"))'>
                        <span >Deskripsi :</span>
                        <span class="adddeskripsi">{{ $item['deskripsi'] }}</span>
                        <input type="hidden" class="postimageid" value="{{ $item['id'] }}">
                    </div>

            @elseif($item instanceof \App\Models\PostBlog)
                    <div class="flex items-center px-16 addlogo triggermodal data-blog cursor-pointer" data-target="showaddpostblog" style="gap: 20px;"  data-id="{{ $item['id']}}"  data-deskripsi="{{ $item['deskripsi'] }}">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 13a1 1 0 1 0 0 2a1 1 0 0 0 0-2m0-9a1 1 0 0 0-.993.883L11 7v6a1 1 0 0 0 1.993.117L13 13V7a1 1 0 0 0-1-1"/></g></svg> --}}
                        <span >Title :</span>
                        <span class="blogtitle text-blBlue">{{ $item['title'] }} </span>
                        {{-- <a href="{{ route('deletepostblog',['id' =>$item['id'] ]) }}">{{ $item['id']  }}asdasdasda</a> --}}
                    </div> 
                    <div class=" font-inter mt-3 text-16 pl-16 pr-116 font-normal relative" >
                        <div  class=" addurl  data-social text-blTxtGrey limit-one-line break-all  " >
                            <span id="copyTextblog">{{ config('app.APP_URL') .  '/' . Auth::user()->username .  '/' . $item['slug'] }}</span>
                        </div>
                    </div>
            @endif
  
            <div class=" position-subchild flexcenter absolute ">
                <div class="dot_action ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12 4c4.29 0 7.863 2.429 10.665 7.154l.22.379l.045.1l.03.083l.014.055l.014.082l.011.1v.11l-.014.111a1 1 0 0 1-.026.11l-.039.108l-.036.075l-.016.03c-2.764 4.836-6.3 7.38-10.555 7.499L12 20c-4.396 0-8.037-2.549-10.868-7.504a1 1 0 0 1 0-.992C3.963 6.549 7.604 4 12 4m0 5a3 3 0 1 0 0 6a3 3 0 0 0 0-6"/></svg>
                </div>
                <div class="action_crud crud_header" id="{{ $item['id'] }}">
                    <div class="list_action justify-between" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M16 9v10H8V9zm-1.5-6h-5l-1 1H5v2h14V4h-3.5zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2z"/></svg>
                        <button class="delete{{ $item['section'] }}" data-id="{{ $item['id'] }}"> 
                            <span class="sec_label btn-user">Hapus</span>
                            </button>
                        </div>

                        <div class="list_action">
                            <span class="sec_label">Hide</span>
                            <div class="sec_togle">
                                <input type="checkbox" id="switch-{{ $item['section'] }}{{ $item['id'] }}" 
                                        class="switch-{{ $item['section'] }}" 
                                        value="on" 
                                        data-id="{{ $item['id'] }}" 
                                        {{ $item['hide'] == 'on' ? 'checked' : '' }}>
                                <label for="switch-{{ $item['section'] }}{{ $item['id'] }}" class="sec_switch"></label>
                                <input type="hidden" name="hide{{ $item['section'] }}" id="hiddenStatus-{{ $item['id'] }}" value="{{ $item['hide'] }}">
                            </div>
                        </div>
                </div>
                <div class="dragable flexcenter " >
                    <svg width="14" height="19" viewBox="0 0 14 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="2.5" cy="2.5" r="2.5" fill="#CFCED3"></circle> 
                        <circle cx="2.5" cy="9.5" r="2.5" fill="#CFCED3"></circle> 
                        <circle cx="2.5" cy="16.5" r="2.5" fill="#CFCED3"></circle> 
                        <circle cx="10.6328" cy="2.5" r="2.5" fill="#CFCED3"></circle> 
                        <circle cx="10.6328" cy="9.5" r="2.5" fill="#CFCED3"></circle> 
                        <circle cx="10.6328" cy="16.5" r="2.5" fill="#CFCED3"></circle>
                    </svg>    
                </div>
            </div>
        </div>
    </div>
@endforeach

</div>

<script>

document.addEventListener("DOMContentLoaded", function () {
    let sortableList = document.getElementById("sortableList");

    if (!sortableList) {
        console.error("❌ Error: Element `sortableList` tidak ditemukan!");
        return;
    }

    new Sortable(sortableList, {
        group: "shared",
        animation: 150,
        handle: ".dragable", 
        onEnd: function (evt) {
            updatePositions();
        }
    });

    function updatePositions() {
        let allItems = document.querySelectorAll(".sortable-item");
        let positions = [];

        allItems.forEach((item, index) => {
            positions.push({
                id: item.dataset.id,
                type: item.dataset.type,
                position: index + 1
            });
        });

        fetch("/update-position", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({ positions })
        })
        .then(response => response.json())
        .then(data => {
            const iframe = document.querySelector('iframe');
            if (iframe && iframe.contentWindow) {
                iframe.contentWindow.postMessage({
                    action: 'updatePosition123',
                    posisi: positions
                }, '*'); 
            }
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
        })
        .catch(error => console.error("❌ Error saat mengirim data ke server:", error));
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById('profile-img-upload');
    const container = document.querySelector('.profil-canvas');
    const deleteIcon = document.querySelector('.delete-icon');

    if (deleteIcon) {
        deleteIcon.addEventListener('click', function () {
            const profilImgDiv = document.querySelector('.profil-img');

            if (profilImgDiv) {
                profilImgDiv.remove(); 
            }
            const newFileInput = document.createElement('input');
            newFileInput.type = "file";
            newFileInput.id = "profile-img-upload";
            newFileInput.accept = "image/*";
            newFileInput.classList.add("p-b-wrap", "absolute", "opacity-0", "cursor-pointer");
            newFileInput.name = "images";
            newFileInput.onchange = previewImages;
            const svgIcon = document.createElement('div');
            svgIcon.innerHTML = `
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.0245 6.06756V6.06756C18.5729 6.06756 18.1637 5.80726 17.9712 5.40047C17.6237 4.66439 17.1818 3.72369 16.9203 3.21158C16.5341 2.45007 15.9082 2.00696 15.0414 2.00091C15.0268 1.9997 9.37059 1.9997 9.35606 2.00091C8.48922 2.00696 7.86451 2.45007 7.4771 3.21158C7.2168 3.72369 6.77491 4.66439 6.42744 5.40047C6.23495 5.80726 5.82453 6.06756 5.37416 6.06756V6.06756C2.95766 6.06756 1 8.02521 1 10.4405V17.6271C1 20.0411 2.95766 22 5.37416 22H19.0245C21.4398 22 23.3974 20.0411 23.3974 17.6271V10.4405C23.3974 8.02521 21.4398 6.06756 19.0245 6.06756Z" stroke="url(#paint0_linear_331_550)" stroke-linecap="round" stroke-linejoin="round"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M8.34778 13.6033C8.34657 15.7256 10.079 17.4617 12.1977 17.4605C14.3128 17.4581 16.0404 15.7293 16.044 13.6118C16.0477 11.4859 14.3212 9.7534 12.2001 9.75098C10.0669 9.74856 8.33083 11.5101 8.34778 13.6033Z" stroke="url(#paint1_linear_331_550)" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M18.1356 10.7718C18.0186 10.7598 17.9031 10.7293 17.7737 10.6772C17.6298 10.6133 17.5052 10.532 17.3847 10.4096C17.1683 10.1794 17.043 9.87829 17.043 9.56771C17.043 9.40273 17.0767 9.23922 17.1426 9.09109C17.2086 8.94102 17.2868 8.81443 17.4282 8.67673C17.5357 8.58307 17.6459 8.5077 17.7965 8.44135C18.2431 8.26438 18.7744 8.37012 19.1064 8.70199C19.2059 8.80002 19.2897 8.91833 19.3362 9.01809L19.3637 9.08883C19.4306 9.23922 19.4643 9.40273 19.4643 9.56771C19.4643 9.88458 19.3406 10.1776 19.111 10.4216C18.9125 10.6214 18.6518 10.7443 18.3737 10.7718L18.2536 10.7778L18.1356 10.7718Z" fill="url(#paint2_linear_331_550)"></path> <defs><linearGradient id="paint0_linear_331_550" x1="1.9738" y1="12" x2="14.7268" y2="22.5155" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5858"></stop> <stop offset="1" stop-color="#C058FF"></stop></linearGradient> <linearGradient id="paint1_linear_331_550" x1="8.68228" y1="13.6058" x2="13.4618" y2="17.1188" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5858"></stop> <stop offset="1" stop-color="#C058FF"></stop></linearGradient> <linearGradient id="paint2_linear_331_550" x1="17.1482" y1="9.56712" x2="18.6501" y2="10.6729" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5858"></stop> <stop offset="1" stop-color="#C058FF"></stop></linearGradient></defs></svg>
            `;

            container.appendChild(newFileInput);
            container.appendChild(svgIcon);
        });
    }
});
function previewImages() {
    const fileInput = document.getElementById('profile-img-upload');
    const container = document.querySelector('.profil-canvas');
    const existingPreview = container.querySelector('.profil-img');
    if (existingPreview) {
        existingPreview.remove();
    }

    const file = fileInput.files[0];

    if (file) {

        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
        if (!validImageTypes.includes(file.type)) {
            alert('Hanya file gambar yang diperbolehkan (JPEG, PNG, GIF, WEBP, SVG)');
            fileInput.value = ""; 
            return; 
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const profilImgDiv = document.createElement('div');
            profilImgDiv.classList.add('profil-img');

            const svgIcon = document.createElement('div');
            svgIcon.innerHTML = `
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer">
                    <circle cx="12" cy="12" r="11" fill="#0D0C22" stroke="white" stroke-width="2"></circle> 
                    <g clip-path="url(#clip0)">
                        <path d="M15.7766 8.21582L8.86487 15.1275" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.7823 15.1347L8.86487 8.21582" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g> 
                    <defs><clipPath id="clip0"><rect width="10.3784" height="10.3784" fill="white" transform="translate(7.13513 6.48633)"></rect></clipPath></defs>
                </svg>
            `;

            svgIcon.addEventListener('click', function () {
                profilImgDiv.remove();
                fileInput.value = "";  
            });
       
            const imgElement = document.createElement('img');
            imgElement.src = e.target.result; 
            imgElement.alt = "Preview";
            imgElement.name = "img";
            //imgElement.style.maxWidth = "100px"; 
     
            profilImgDiv.appendChild(svgIcon);
            // profilImgDiv.innerHTML = svgIcon;
            profilImgDiv.appendChild(imgElement);

            container.appendChild(profilImgDiv);

        };

        reader.readAsDataURL(file);
    }
}
</script>
@endsection
