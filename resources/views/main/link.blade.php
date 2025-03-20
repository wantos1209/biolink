
@extends('index')
@section('main-content')
@include('modals.modal-addheader')
@include('modals.modal-addlink')
@include('modals.modal-addsocials')
@include('modals.modal-searchsocials')

{{-- @include('modals.modal-updateheader')
@include('modals.modal-updatelink')
@include('modals.modal-updatesocials') --}}

{{-- @php
// Pastikan urutan: 'custom 1' di posisi pertama, 'customlink 1' di posisi kedua
$sortedItems = collect($items)->sortBy(function ($item) {
    if ($item['position'] === 'custom') {
        return 0; // ✅ Custom 1 paling atas (prioritas 1)
    } elseif ($item['position'] === 'customlink') {
        return 1; // ✅ Customlink 1 setelahnya (prioritas 2)
    }
    return 2; // ✅ Sisanya tetap urut sesuai data
});
@endphp --}}
@php
$sortedItems = collect($items)->sortBy(function ($item) {
    // Cek apakah posisi mengandung "custom"
    if (preg_match('/^cusher (\d+)$/', $item['position'], $matches)) {
        return (int) $matches[1]; // Mengurutkan berdasarkan angka setelah "custom"
    } elseif (preg_match('/^cuslink (\d+)$/', $item['position'], $matches)) {
        return (int) $matches[1] + 1000; // Memberikan offset agar "custom" lebih prioritas dari "customlink"
    }
    return 9999; // Item lain tetap di bawah
});
@endphp

<div class="flexcenter mb-32">
    <button class="triggermodal addlink cursor-pointer text-white radius-4 flexcenter " data-target="showaddlink" data-index="index1">

        <span>+ Add Link</span>
   
    </button>
    <button class="triggermodal addheader cursor-pointer text-white radius-4 flexcenter " data-target="showaddheader" data-index="index2">
   
        <span>+ Add Header</span>
   
    </button>

</div>

{{-- <div class="container">
    <h3>Items (Header & Links Berurutan)</h3>
    <div id="sortableList" class="sortable-list">
        @foreach ($items as $item)
            <div class="sortable-item" data-id="{{ $item->id }}" data-type="{{ $item instanceof \App\Models\Header ? 'header' : 'link' }}">
                {{ $item->position }} - {{ $item->title }}
            </div>
        @endforeach
    </div>
</div> --}}



<div  id="sortableList"  class="group-header sortable-list ">
    {{-- <div class="child-header bg-white radius-4 cursor-pointer">
        <label for="header">Header</label>
        <input type="text" name="header" readonly>
    </div> --}}
@foreach ($sortedItems as $item)
    <div  class="mb-16 data-item">
        <div class=" sortable-item child-header bg-white shadow-sm relative  rounded-sm xs:rounded-md xs:shadow-xs xs:p-16 xs:pr-72"  data-id="{{ $item['id']}}" data-type="{{ $item instanceof \App\Models\Header ? 'header' : 'link' }}">
        {{-- <a href="{{ route('profil') }}" class=""> </a> --}}

        {{-- <div class="sortable-item child-header bg-white shadow-sm relative rounded-sm xs:rounded-md xs:shadow-xs xs:p-16 xs:pr-72"
    data-id="{{ $item['id'] }}" 
    data-type="{{ $item['type'] }}"> --}}

        {{-- <div class="sortable-item child-header bg-white shadow-sm relative rounded-sm xs:rounded-md xs:shadow-xs xs:p-16 xs:pr-72" --}}
        {{-- data-id="{{ $item['id'] }}" data-type="{{ isset($item['url']) ? 'link' : 'header' }}"> --}}
        @if (!isset($item['url']) || empty($item['url']))  
        
        {{-- Jika tidak ada URL, berarti ini adalah HEADER --}}
        <div class="w-full px-24 text-center text-blDark font-inter data-header font-bold text-16 triggermodal"  data-target="showaddheader">
            <span  class="addname">{{ $item['title'] }}</span>
            <input type="hidden" class="addid" value="{{ $item['id'] }}">
        </div>
        <div class=" position-subchild flexcenter absolute ">
            <div class="dot_action ">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12 4c4.29 0 7.863 2.429 10.665 7.154l.22.379l.045.1l.03.083l.014.055l.014.082l.011.1v.11l-.014.111a1 1 0 0 1-.026.11l-.039.108l-.036.075l-.016.03c-2.764 4.836-6.3 7.38-10.555 7.499L12 20c-4.396 0-8.037-2.549-10.868-7.504a1 1 0 0 1 0-.992C3.963 6.549 7.604 4 12 4m0 5a3 3 0 1 0 0 6a3 3 0 0 0 0-6"/></svg>
            </div>
            <div class="action_crud crud_header" id="2">
                <div class="list_action justify-between" >
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M16 9v10H8V9zm-1.5-6h-5l-1 1H5v2h14V4h-3.5zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2z"/></svg>
                     <button class="deleteheader" data-id="{{ $item['id'] }}"> 
                         <span class="sec_label btn-user">Hapus</span>
                        </button>
                     </div>

                     <div class="list_action">
                         <span class="sec_label">Hide</span>
                         <div class="sec_togle">
                             {{-- Gunakan ID unik untuk setiap switch berdasarkan ID link --}}
                             <input type="checkbox" id="switch-header{{ $item['id'] }}" 
                                    class="switch-header" 
                                    value="on" 
                                    data-id="{{ $item['id'] }}" 
                                    {{ $item['hide'] == 'on' ? 'checked' : '' }}>
                             <label for="switch-header{{ $item['id'] }}" class="sec_switch"></label>
                 
                             {{-- Input hidden untuk menyimpan status --}}
                             <input type="hidden" name="hideheader" id="hiddenStatus-{{ $item['id'] }}" value="{{ $item['hide'] }}">
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
        @else
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
            <div class=" position-subchild flexcenter absolute ">
                <div class="dot_action ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12 4c4.29 0 7.863 2.429 10.665 7.154l.22.379l.045.1l.03.083l.014.055l.014.082l.011.1v.11l-.014.111a1 1 0 0 1-.026.11l-.039.108l-.036.075l-.016.03c-2.764 4.836-6.3 7.38-10.555 7.499L12 20c-4.396 0-8.037-2.549-10.868-7.504a1 1 0 0 1 0-.992C3.963 6.549 7.604 4 12 4m0 5a3 3 0 1 0 0 6a3 3 0 0 0 0-6"/></svg>
                </div>
                <div class="action_crud crud_link" id="2">
                    <div class="list_action justify-between" >
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M16 9v10H8V9zm-1.5-6h-5l-1 1H5v2h14V4h-3.5zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2z"/></svg>
                         <button class="deletelink" data-id="{{ $item['id'] }}"> 
                             <span class="sec_label btn-user">Hapus</span>
                        </button>
                         </div>
                         
                         <div class="list_action">
                             <span class="sec_label">Hide</span>
                             <div class="sec_togle">
                                 {{-- Gunakan ID unik untuk setiap switch berdasarkan ID link --}}
                                 <input type="checkbox" id="switch-link{{ $item['id'] }}" 
                                        class="switch-link" 
                                        value="on" 
                                        data-id="{{ $item['id'] }}" 
                                        {{ $item['hide'] == 'on' ? 'checked' : '' }}>
                                 <label for="switch-link{{ $item['id'] }}" class="sec_switch"></label>
                     
                                 {{-- Input hidden untuk menyimpan status --}}
                                 <input type="hidden" name="hidelink" id="hiddenStatus-{{ $item['id'] }}" value="{{ $item['hide'] }}">
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
           
        @endif
  

        </div> <!----> <!----> <!---->
    </div>
@endforeach

</div>


    <div class="socials-header">
        <h2>Socials</h2>
    </div>
   
    <div class="group-socials">
    @foreach($profil['socialmedia'] as $getlink)
        <div class=" child-socials flexbetween bg-white radius-4 cursor-pointer data-item"  data-id="{{ $item['id']}}"  data-type="{{ $item instanceof \App\Models\Header ? 'header' : ($item instanceof \App\Models\SocialMedia ? 'social' : 'link') }}">
            <div class="flex items-center addlogo" style="gap: 20px; padding-left: 16px;">
                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 13a1 1 0 1 0 0 2a1 1 0 0 0 0-2m0-9a1 1 0 0 0-.993.883L11 7v6a1 1 0 0 0 1.993.117L13 13V7a1 1 0 0 0-1-1"/></g></svg> --}}
                {!! $getlink['svg'] !!}
                <span class="addname">{{ $getlink['title'] }}</span>
            </div>  
            <input type="hidden" class="addid" value="{{ $getlink['id'] }}">
            <div class="font-inter text-16 addurl font-normal data-social text-blTxtGrey limit-one-line break-all pl-32 pr-24 triggermodal" data-target="showaddsocials">
                {{ $getlink['url'] }}</div>
                <div class=" position-subsocials flexcenter relative">
                    <div class="dot_action ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12 4c4.29 0 7.863 2.429 10.665 7.154l.22.379l.045.1l.03.083l.014.055l.014.082l.011.1v.11l-.014.111a1 1 0 0 1-.026.11l-.039.108l-.036.075l-.016.03c-2.764 4.836-6.3 7.38-10.555 7.499L12 20c-4.396 0-8.037-2.549-10.868-7.504a1 1 0 0 1 0-.992C3.963 6.549 7.604 4 12 4m0 5a3 3 0 1 0 0 6a3 3 0 0 0 0-6"/></svg>
                    </div>
                    <div class="action_crud crud_socials" id="2">
                        <div class="list_action justify-between" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M16 9v10H8V9zm-1.5-6h-5l-1 1H5v2h14V4h-3.5zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2z"/></svg>
                            <button class="deletesocials" data-id="{{ $getlink['id'] }}"> 
                                <span class="sec_label btn-user">Hapus</span>
                            </button>
                            </div>
                        
                            <div class="list_action">
                                <span class="sec_label">Hide</span>
                                <div class="sec_togle">
                                    {{-- Gunakan ID unik untuk setiap switch berdasarkan ID link --}}
                                    <input type="checkbox" id="switch-socials{{ $getlink['id'] }}" 
                                            class="switch-socials" 
                                            value="on" 
                                            data-id="{{ $getlink['id'] }}" 
                                            {{ $getlink['hide'] == 'on' ? 'checked' : '' }}>
                                    <label for="switch-socials{{ $getlink['id'] }}" class="sec_switch"></label>
                        
                                    {{-- Input hidden untuk menyimpan status --}}
                                    <input type="hidden" name="hidesocials" id="hiddenStatus-{{ $getlink['id'] }}" value="{{ $getlink['hide'] }}">
                                </div>
                            </div>
                    </div>
                </div>

        </div>
    @endforeach
        <a href="#" class="triggermodal" data-target="showsearchsocials" data-index="index3">
            <div class=" addsocials align-center bg-white radius-4 cursor-pointer">
            <span>+ Add Socials</span>
            </div>
        </a>
    </div>

<script>

    document.addEventListener("DOMContentLoaded", function () {
    // ✅ Event listener untuk tombol "Add"
    document.querySelectorAll(".open-modal").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            // Cari parent terdekat yang memiliki class "add-socials"
            const socialContainer = this.closest(".add-socials");

            if (socialContainer) {
                // ✅ Ambil SVG dari .addlogo
                // const svgElement = socialContainer.querySelector(".addlogo").innerHTML;
                const svgElement = socialContainer.querySelector(".addlogo").firstElementChild.outerHTML;
                // ✅ Ambil teks dari .addname
                const socialName = socialContainer.querySelector(".addname").textContent.trim();
                // ✅ Masukkan data ke dalam modal kedua (showaddsocials)
                const modalToShow = document.getElementById("showaddsocials");
                const modalToClose = document.getElementById("showsearchsocials");
                if (modalToShow) {
                    modalToShow.style.display = "flex"; // Tampilkan modal tujuan
                }
                if (modalToClose) {
                    modalToClose.style.display = "none"; // Sembunyikan modal awal
                }
                // ✅ Masukkan SVG ke dalam modal
                document.querySelector("#showaddsocials  .icon-svg").innerHTML = svgElement;
                // ✅ Masukkan teks ke dalam modal
                document.querySelector("#showaddsocials .span-name-atas span").textContent = socialName;
                // document.querySelector("#showaddsocials .socialstext span").textContent = socialName;
                document.querySelector("#showaddsocials .span-name-bawah span").textContent = socialName;

                document.querySelector("#showaddsocials #TitleInput").value = socialName;
                // ✅ Simpan data ke dalam input hidden (agar bisa dikirim ke backend)
                document.getElementById("svgInput").value = svgElement;
                // console.log('svgElement pada',svgElement)
            }
        });
    });
    document.querySelectorAll(".data-social").forEach(button => {
    button.addEventListener("click", function (event) {
        event.preventDefault();
        const socialContainer = this.closest(".child-socials");
        if (socialContainer) {
            const svgElement = socialContainer.querySelector(".addlogo").firstElementChild.outerHTML;  
            const socialName = socialContainer.querySelector(".addname").textContent.trim(); 
            const socialurl = socialContainer.querySelector(".addurl").textContent.trim(); 
            const socialId = socialContainer.querySelector(".addid").value.trim(); 
           
            document.querySelector("#showaddsocials  .icon-svg").innerHTML = svgElement;
            document.querySelector("#showaddsocials .span-name-atas span").textContent = socialName;
            document.querySelector("#showaddsocials .span-name-bawah span").textContent = socialName;
            document.querySelector("#showaddsocials #TitleInput").value = socialName;
            document.querySelector("#showaddsocials #Urlnput").value = socialurl;
            document.querySelector("#showaddsocials #idInput").value = socialId;
            document.getElementById("svgInput").value = svgElement;
            }
        });
    });
    document.querySelectorAll(".data-header").forEach(button => {
    button.addEventListener("click", function (event) {
        event.preventDefault();
        const headerContainer = this.closest(".data-header");
        if (headerContainer) {
           
            const headerName = headerContainer.querySelector(".addname").textContent.trim(); 
            const headerId = headerContainer.querySelector(".addid").value.trim(); 
            document.querySelector("#showaddheader h1").textContent = "Update Header";
            document.querySelector("#showaddheader #TitleInput").value = headerName;
            document.querySelector("#showaddheader #idInput").value = headerId;
            document.querySelector("#showaddheader #submitFormheader span").textContent = "Update";
            }
        });
    });
    // const fotoElement = linkContainer.querySelector(".foto-url").firstElementChild.currentSrc;  
    document.querySelectorAll(".data-link").forEach(button => {
    button.addEventListener("click", function (event) {
        event.preventDefault();
        const linkContainer = this.closest(".data-link");
        if (linkContainer) {
            const fotoElement = document.querySelector(".foto-url img")?.currentSrc || '';
            const judulName = linkContainer.querySelector(".judul-link").textContent.trim();
            const namaurl = linkContainer.querySelector(".nama-url").textContent.trim();
            const linkId = linkContainer.querySelector(".addid").value.trim();
            const linkembed = linkContainer.querySelector(".addembed").value.trim();

            document.querySelector("#showaddlink h1").textContent = "Update Link";
            document.querySelector("#showaddlink #title").value = judulName;
            document.querySelector("#showaddlink #url").value = namaurl;
            document.querySelector("#showaddlink #idInput").value = linkId;
            document.querySelector("#showaddlink #submitFormlink span").textContent = "Update";
            if (linkembed === "on") {
                document.querySelector("#showaddlink #switch-embed").checked = true;
                document.querySelector("#showaddlink #hiddenStatus").value = "on";
            } else {
                document.querySelector("#showaddlink #switch-embed").checked = false;
                document.querySelector("#showaddlink #hiddenStatus").value = "off";
            }

            const imgContainer = document.querySelector("#showaddlink .profil-addlink");

            // Hapus elemen sebelumnya agar tidak menumpuk
            const existingPreview = imgContainer.querySelector(".img-addlink");
            if (existingPreview) {
                existingPreview.remove();
            }

            // Buat elemen div untuk gambar dan ikon
            const profilImgDiv = document.createElement('div');
            profilImgDiv.classList.add('img-addlink');

            // Buat ikon SVG untuk menghapus gambar
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

            // Tambahkan event listener untuk menghapus gambar
            svgIcon.addEventListener('click', function (event) {
                event.stopPropagation();
                profilImgDiv.remove(); // Hapus gambar saat ikon diklik
            });

            // Buat elemen <img> untuk gambar
            const imgElement = document.createElement("img");
            imgElement.src = fotoElement;
            imgElement.alt = "Preview";
            imgElement.name = "img";

            // Tambahkan ikon dan gambar ke dalam container
            profilImgDiv.appendChild(svgIcon);
            profilImgDiv.appendChild(imgElement);

            // Tambahkan elemen ke dalam .profil-addlink
            imgContainer.appendChild(profilImgDiv);
        }
    });
});


        document.querySelector("#showaddsocials .back").addEventListener("click", function () {
        document.getElementById("showaddsocials").style.display = "none"; // Tutup modal saat ini
        document.getElementById("showsearchsocials").style.display = "flex"; // Buka modal sebelumnya

   
        // svgElement = document.querySelector("#showaddsocials .icon-svg").firstElementChild.outerHTML;
        // document.querySelector("#showsearchsocials .addlogo").innerHTML = svgElement;
        // console.log('svgElement pada modal pilih',svgElement)
    });
    document.querySelector(".addheader").addEventListener("click", function (event) {
    event.preventDefault();

    document.querySelector("#showaddheader h1").textContent = "Add Header";
    document.querySelector("#showaddheader #TitleInput").value = "";
    document.querySelector("#showaddheader #idInput").value = "";
    document.querySelector("#showaddheader #submitFormheader span").textContent = "Save";
    });

    document.querySelector(".addsocials").addEventListener("click", function (event) {
        event.preventDefault();

            document.querySelector("#showaddsocials  .icon-svg").innerHTML = "";
            document.querySelector("#showaddsocials .span-name-atas span").textContent = "";
            document.querySelector("#showaddsocials .span-name-bawah span").textContent = "";
            document.querySelector("#showaddsocials #TitleInput").value = "";
            document.querySelector("#showaddsocials #Urlnput").value = "";
            document.querySelector("#showaddsocials #idInput").value = "";
            document.getElementById("svgInput").value = "";
    
        });
        document.querySelector(".addlink").addEventListener("click", function (event) {
            event.preventDefault();

            // Reset teks judul
            document.querySelector("#showaddlink h1").textContent = "Add Link";
            document.querySelector("#showaddlink #submitFormlink span").textContent = "Save";
            // Kosongkan input teks
            document.querySelector("#showaddlink #title").value = "";
            document.querySelector("#showaddlink #url").value = "";
            document.querySelector("#showaddlink #idInput").value = "";

            // Reset status switch ke "off"
            document.querySelector("#showaddlink #switch-embed").checked = false;
            document.querySelector("#showaddlink #hiddenStatus").value = "off";

            // Cari elemen .profil-addlink
            const imgContainer = document.querySelector("#showaddlink .profil-addlink");

            // Hapus elemen gambar jika ada
            const existingPreview = imgContainer.querySelector(".img-addlink");
            if (existingPreview) {
                existingPreview.remove();
            }
        });

    // ✅ Event listener untuk tombol "X" (Tutup Modal)
    document.querySelectorAll(".closemodal").forEach(button => {
        button.addEventListener("click", function () {
            this.closest(".sec_modal").style.display = "none";
        });
    });

    // ✅ Klik di luar modal untuk menutupnya
    document.addEventListener("click", function (event) {
        if (!event.target.closest(".modalcontainer") && !event.target.closest(".open-modal")) {
            document.querySelectorAll(".sec_modal").forEach(modal => {
                modal.style.display = "none";
            });
        }
    });
    // const searchInput = document.getElementById('searchInput');
    // const socials = document.querySelectorAll('#add-socials addname');
    // searchInput.addEventListener('input', function () {
    //     const searchValue = this.value.toLowerCase().trim();
    //     socials.forEach
    const searchInput = document.getElementById("searchInput");
    const socialItems = document.querySelectorAll(".add-socials"); // Ambil semua elemen dengan class "add-socials"

    searchInput.addEventListener("input", function () {
        const searchValue = this.value.toLowerCase().trim();

        socialItems.forEach(item => {
            const nameElement = item.querySelector(".addname"); // Ambil elemen <span class="addname">
            if (nameElement) {
                const text = nameElement.textContent.toLowerCase();
                // Tampilkan/hilangkan berdasarkan kecocokan teks
                if (text.includes(searchValue)) {
                    item.style.display = "flex"; // Tampilkan
                } else {
                    item.style.display = "none"; // Sembunyikan jika tidak cocok
                }
            }
        });
    });
});
// document.querySelectorAll(".data-social").forEach(button => {
//     button.addEventListener("click", function (event) {
//         event.preventDefault();
//         const socialContainer = this.closest(".child-socials");
//         if (socialContainer) {
//             const svgElement = socialContainer.querySelector(".addlogo").firstElementChild.outerHTML;  
//             const socialName = socialContainer.querySelector(".addname").textContent.trim(); 
//             const socialurl = socialContainer.querySelector(".addurl").textContent.trim(); 
//             const socialId = socialContainer.querySelector(".addid").value.trim(); 
//             const modalToShow = document.getElementById("showupdatesocials");
//             document.querySelector("#showupdatesocials  .icon-svg").innerHTML = svgElement;
//             document.querySelector("#showupdatesocials .span-name-atas span").textContent = socialName;
//             document.querySelector("#showupdatesocials .span-name-bawah span").textContent = socialName;
//             document.querySelector("#showupdatesocials #TitleInput").value = socialId;
//             document.querySelector("#showupdatesocials #Urlnput").value = socialurl;
//             }
//         });
//     });
//     document.querySelector("#showupdatesocials .back").addEventListener("click", function () {
//         document.getElementById("showupdatesocials").style.display = "none"; // Tutup modal saat ini
//         document.getElementById("showsearchsocials").style.display = "flex"; // Buka modal sebelumnya
//     });
//     document.querySelectorAll(".data-social").forEach(button => {
//     button.addEventListener("click", function (event) {
//         event.preventDefault();
//         const socialContainer = this.closest(".child-socials");
//         if (socialContainer) {
//             const svgElement = socialContainer.querySelector(".addlogo").firstElementChild.outerHTML;  
//             const socialName = socialContainer.querySelector(".addname").textContent.trim(); 
//             const socialurl = socialContainer.querySelector(".addurl").textContent.trim(); 
//             const socialId = socialContainer.querySelector(".addid").value.trim(); 
//             const modalToShow = document.getElementById("showupdatesocials");
//             document.querySelector("#showupdatesocials  .icon-svg").innerHTML = svgElement;
//             document.querySelector("#showupdatesocials .span-name-atas span").textContent = socialName;
//             document.querySelector("#showupdatesocials .span-name-bawah span").textContent = socialName;
//             document.querySelector("#showupdatesocials #TitleInput").value = socialId;
//             document.querySelector("#showupdatesocials #Urlnput").value = socialurl;
//             }
//         });
//     });

// document.addEventListener("DOMContentLoaded", function () {
//     // Ambil semua tombol submit di 3 modal
//     let submitButtons = [
//         { buttonId: "submitFormlink", formId: "linkForm", type: "link" },
//         { buttonId: "submitFormheader", formId: "headerForm", type: "header" },
//         { buttonId: "submitFormsocials", formId: "socialsForm", type: "socials" }
//     ];

//     submitButtons.forEach(({ buttonId, formId, type }) => {
//         let submitButton = document.getElementById(buttonId);
//         if (submitButton) {
//             submitButton.addEventListener("click", function (event) {
//                 event.preventDefault(); // Mencegah reload halaman
//                 handleFormSubmit(formId, type);
//             });
//         } else {
//             console.error(`❌ Error: Tombol #${buttonId} tidak ditemukan!`);
//         }
//     });
// });

// // ✅ Fungsi untuk menangani submit form berdasarkan jenisnya
// function handleFormSubmit(formId, type) {
//     let form = document.getElementById(formId);
//     if (!form) {
//         console.error(`❌ Error: Form dengan ID #${formId} tidak ditemukan!`);
//         return;
//     }

//     let formData = new FormData(form);
//     let title = formData.get("title")?.trim();
//     let url = formData.get("url")?.trim();
//     let imageInput = document.getElementById("profile-img-upload");
//     let image = imageInput ? imageInput.files[0] : null;

//     // Validasi berdasarkan tipe form
//     if (type === "link") {
//         if (!title || title.length < 1) {
//             showErrorMessage("Nama link wajib diisi.");
//             return;
//         }
//         if (title.length > 20) {
//             showErrorMessage("Nama link maksimal 20 karakter.");
//             return;
//         }
//         if (!url || url.length < 1) {
//             showErrorMessage("URL wajib diisi.");
//             return;
//         }
//         if (!isValidUrl(url)) {
//             showErrorMessage("Format URL tidak valid.");
//             return;
//         }
//         if (image && image.size > 10 * 1024 * 1024) {
//             showErrorMessage("Ukuran file maksimal 10MB.");
//             return;
//         }
//     } else if (type === "header") {
//         if (!title || title.length < 1) {
//             showErrorMessage("Nama header wajib diisi.");
//             return;
//         }
//     } else if (type === "socials") {
//         if (!url || url.length < 1) {
//             showErrorMessage("URL wajib diisi.");
//             return;
//         }
//         if (!isValidUrl(url)) {
//             showErrorMessage("Format URL tidak valid.");
//             return;
//         }
//     }

//     console.log(`✅ Form ${formId} lolos validasi, mengirim ke backend...`);
//     form.submit();
// }

// // ✅ Fungsi untuk menampilkan pesan error
// function showErrorMessage(message) {
//     const errorMessage = document.getElementById("Error");
//     if (!errorMessage) {
//         console.error("❌ Error: #Error element tidak ditemukan!");
//         return;
//     }
//     errorMessage.textContent = message;
//     errorMessage.style.display = "block";
//     setTimeout(() => {
//         errorMessage.style.display = "none";
//     }, 2000);
// }

// // ✅ Fungsi untuk validasi URL
// function isValidUrl(string) {
//     let pattern = /^(https?:\/\/)?([\w.-]+)+(:\d+)?(\/([\w/_\-.,]*))*$/i;
//     return pattern.test(string);
// }



//---------------------------------------------------------------------------------
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
            console.log("🟢 Item dipindahkan:");
            console.log("Dari index:", evt.oldIndex, "Ke index:", evt.newIndex);
            updatePositions();
        }
    });

    function updatePositions() {
        let allItems = document.querySelectorAll(".sortable-item");
        let positions = [];

        allItems.forEach((item, index) => {
            positions.push({
                id: item.dataset.id,
                type: item.dataset.type, // Menentukan apakah ini dari `header` atau `link`
                position: index + 1
            });
        });

        console.log("🔄 Mengirim data posisi ke backend:", positions);

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
            console.log('Position berhasil diperbarui:', data);

            // **Kirim data ke halaman dalam iframe**
            const iframe = document.querySelector('iframe');
            if (iframe && iframe.contentWindow) {
                iframe.contentWindow.postMessage({
                    action: 'updatePosition123',
                    posisi: positions
                }, '*'); // Kirim ke semua domain (atau spesifik seperti 'http://example.com')
            }
        })
        .catch(error => {
            console.error('Terjadi kesalahan:', error);
        })
        .catch(error => console.error("❌ Error saat mengirim data ke server:", error));
    }
});
//---------------------------------------------------------------------------------
// document.addEventListener("DOMContentLoaded", function () {
//     let headersList = document.getElementById("headersList");
//     let linksList = document.getElementById("linksList");

//     new Sortable(headersList, {
//         group: "shared", // 🔥 Bisa dipindahkan antar list
//         animation: 150,
//         onEnd: function (evt) {
//             updatePositions();
//         }
//     });

//     new Sortable(linksList, {
//         group: "shared",
//         animation: 150,
//         onEnd: function (evt) {
//             updatePositions();
//         }
//     });

//     function updatePositions() {
//         let allItems = document.querySelectorAll(".sortable-item");
//         let positions = [];

//         allItems.forEach((item, index) => {
//             positions.push({
//                 id: item.dataset.id,
//                 type: item.dataset.type, // Menentukan `header` atau `link`
//                 position: index + 1
//             });
//         });

//         // Kirim ke backend dengan AJAX (Fetch API)
//         fetch("/update-position", {
//             method: "POST",
//             headers: {
//                 "Content-Type": "application/json",
//                 "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
//             },
//             body: JSON.stringify({ positions })
//         })
//         .then(response => response.json())
//         .then(data => {
//             console.log("Posisi diperbarui!", data);
//         })
//         .catch(error => console.error("Error:", error));
//     }
// });
document.querySelectorAll(".switch-link, .switch-header, .switch-socials").forEach(function (switchInput) {
    switchInput.addEventListener("change", function () {
        let id = this.getAttribute("data-id");
        let status = this.checked ? "on" : "off";

        // ✅ Tentukan `typedata` berdasarkan class tombol yang diklik
        let typedata;
        let route;

        if (this.classList.contains("switch-socials")) {
            route = `/hidesocial/${id}`;
            typedata = "social";
        } else if (this.classList.contains("switch-header")) {
            route = `/hideheader/${id}`;
            typedata = "header";
        } else {
            route = `/hidelink/${id}`;
            typedata = "link";
        }

        console.log(`🔄 FETCH ${route} → ID: ${id}, Status: ${status}, Type: ${typedata}`);

        fetch(route, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({ hide: status }) // Tidak perlu mengirim `typedata` ke backend karena sudah diketahui
        })
        .then(response => response.json())
        .then(data => {
            console.log(`✅ Data berhasil diperbarui di backend:`, data);

            // ✅ Kirim data ke halaman dalam iframe
            const iframe = document.querySelector('iframe');
            if (iframe && iframe.contentWindow) {
                iframe.contentWindow.postMessage({
                    action: 'hidestatus',
                    id: id,
                    status: status,
                    typedata: typedata // ✅ Kirim typedata berdasarkan route
                }, '*'); 
            }

        })
        .catch(error => console.error(`❌ ERROR: Fetch gagal (${route}):`, error));
    });
});

// document.querySelectorAll(".switch-link, .switch-header, .switch-socials").forEach(function (switchInput) {
//     switchInput.addEventListener("change", function () {
//         let id = this.getAttribute("data-id");
//         let status = this.checked ? "on" : "off";

//         let itemElement = document.querySelector(`.sortable-item[data-id='${id}']`);
//         let typedata = itemElement ? itemElement.getAttribute("data-type") : "unknown"; // Default ke "unknown" jika tidak ditemukan
//  // Jika tidak ditemukan, default "unknown"
//         // let route = this.classList.contains("switch-header") ? `/hideheader/${id}` : `/hidelink/${id}`;
//         // Menentukan route berdasarkan class switch
//         let route = this.classList.contains("switch-socials") 
//                     ? `/hidesocial/${id}` 
//                     : this.classList.contains("switch-header") 
//                         ? `/hideheader/${id}` 
//                         : `/hidelink/${id}`; // Default ke hide link jika bukan header atau sosial

//                         console.log(`🔄 FETCH ${route} → ID: ${id}, Status: ${status}, Type: ${typedata}`);
        
//         fetch(route, {
//             method: "POST",
//             headers: {
//                 "Content-Type": "application/json",
//                 "Accept": "application/json",
//                 "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
//             },
//             body: JSON.stringify({ hide: status }),
//         })
//         .then(response => response.json())
//         // .then(data => console.log(`✅ Response dari server (${route}):`, data))
//         .then(data => {
//             console.log('123berhasil tytperdata:', data);

//             // **Kirim data ke halaman dalam iframe**
//             const iframe = document.querySelector('iframe');
//             if (iframe && iframe.contentWindow) {
//                 iframe.contentWindow.postMessage({
//                     action: 'hidestatus',
//                     id: id,
//                     status: status,
//                     typedata: typedata
//                 }, '*'); // Kirim data hanya ke iframe yang sesuai
//             }
//             // let element = document.querySelector(`.sortable-item[data-id='${id}']`);
//             // if (element) {
//             //     element.classList.toggle('hidden', status === 'off');
//             // }
//         })
//         .catch(error => console.error(`❌ ERROR: Fetch gagal (${route}):`, error));
//     });
// });

document.querySelectorAll(".deletelink, .deleteheader, .deletesocials").forEach(function (deleteButton) {
    deleteButton.addEventListener("click", function () {
        let id = this.getAttribute("data-id");

        let typedata;
        let route;

        if (this.classList.contains("deletesocials")) {
            route = `/deletesocial/${id}`;
            typedata = "social";
        } else if (this.classList.contains("deleteheader")) {
            route = `/deleteheader/${id}`;
            typedata = "header";
        } else {
            route = `/deletelink/${id}`;
            typedata = "link";
        }

        console.log(`🔄 FETCH ${route} → ID: ${id}`);
        
        fetch(route, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            // body: JSON.stringify({ positions })
        })
        .then(response => response.json())
        // .then(data => console.log(`✅ Response dari server (${route}):`, data))
        .then(data => {
            console.log(`✅ Response dari server (${route}):`, data);

            // ✅ Hapus elemen dari tampilan tanpa refresh
            let parentElement = this.closest(".data-item"); // Sesuaikan dengan wrapper elemen
            if (parentElement) {
                parentElement.remove();
                console.log(`🗑️ Elemen dengan ID ${id} dihapus dari tampilan.`);
            }

            // **Kirim data ke halaman dalam iframe**
            const iframe = document.querySelector('iframe');
            if (iframe && iframe.contentWindow) {
                iframe.contentWindow.postMessage({
                    action: 'deleteposition',
                    id: id,
                    typedata: typedata 
                }, '*'); // Kirim ke semua domain (atau spesifik seperti 'http://example.com')
            }

        })
   
        .catch(error => console.error(`❌ ERROR: Fetch gagal (${route}):`, error));
    });
});


// document.addEventListener("DOMContentLoaded", function () { 
//     document.querySelectorAll(".switch-header").forEach(function (switchInput) {
//         switchInput.addEventListener("change", function () {
//             let id = this.getAttribute("data-id"); // Ambil ID dari data-id
//             let hideheader = this.checked ? "on" : "off"; // Ambil status on/off

//             let hiddenInput = document.getElementById(`hiddenStatus-${id}`);
//             if (hiddenInput) {
//                 hiddenInput.value = hideheader;
//             }

//             // Debugging di console untuk memastikan route benar
//             console.log(`🔵 FETCH hideheader → ID: ${id}, Status: ${hideheader}`);

//             // Kirim data ke route Laravel
//             fetch(`/hideheader/${id}`, {
//                 method: "POST",
//                 headers: {
//                     "Content-Type": "application/json",
//                     "Accept": "application/json",  // ✅ Pastikan server merespons JSON
//                     "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
//                 },
//                 body: JSON.stringify({ hide: hideheader }),
//             })
//             .then(response => {
//                 if (!response.ok) {
//                     throw new Error(`❌ HTTP error! Status: ${response.status}`);
//                 }
//                 return response.json();
//             })
//             .then(data => {
//                 console.log("✅ Response dari server (hideheader):", data);
//             })
//             .catch(error => {
//                 console.error("❌ Error di fetch hideheader:", error);
//             });
//         });
//     });

//     document.querySelectorAll(".switch-link").forEach(function (switchInput) {
//         switchInput.addEventListener("change", function () {
//             let id = this.getAttribute("data-id"); // Ambil ID dari data-id
//             let hidelink = this.checked ? "on" : "off"; // Ambil status on/off

//             let hiddenInput = document.getElementById(`hiddenStatus-${id}`);
//             if (hiddenInput) {
//                 hiddenInput.value = hidelink;
//             }

//             // Debugging di console untuk memastikan route benar
//             console.log(`🟢 FETCH hidelink → ID: ${id}, Status: ${hidelink}`);

//             // Kirim data ke route Laravel
//             fetch(`/hidelink/${id}`, {
//                 method: "POST",
//                 headers: {
//                     "Content-Type": "application/json",
//                     "Accept": "application/json",  // ✅ Pastikan server merespons JSON
//                     "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
//                 },
//                 body: JSON.stringify({ hide: hidelink }),
//             })
//             .then(response => {
//                 if (!response.ok) {
//                     throw new Error(`❌ HTTP error! Status: ${response.status}`);
//                 }
//                 return response.json();
//             })
//             .then(data => {
//                 console.log("✅ Response dari server (hidelink):", data);
//             })
//             .catch(error => {
//                 console.error("❌ Error di fetch hidelink:", error);
//             });
//         });
//     });
// });

// ✅ Debugging Click Action CRUD
$(document).ready(function () {
    $(document).on('click', '.dot_action', function () {
        var actionCrud = $(this).next('.action_crud');
        $('.action_crud').not(actionCrud).slideUp('fast');
        if (actionCrud.is(':hidden')) {
            actionCrud.slideDown('fast');
        } else {
            actionCrud.slideUp('fast');
        }
    });
    $(document).on('click', function (event) {
        if (!$(event.target).closest('.dot_action, .action_crud').length) {
            $('.action_crud').slideUp('fast');
        }
    });
});



    // $('#switch').on('change', function() {
    //     if ($(this).is(':checked')) {
    //         $('#statusText').text('Aktif').removeClass('btn_blank').addClass('btn_success');
    //         $('#hiddenStatus').val('Aktif'); // Mengatur nilai hidden input
    //     } else {
    //         $('#statusText').text('Standby').removeClass('btn_success').addClass('btn_blank');
    //         $('#hiddenStatus').val('Standby'); // Mengatur nilai hidden input
    //     }
    // });

</script>
@endsection