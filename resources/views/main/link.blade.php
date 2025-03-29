
@extends('main.main')
@section('main-content')
@include('modals.modal-addheader')
@include('modals.modal-addlink')
@include('modals.modal-addsocials')
@include('modals.modal-searchsocials')

@php
$sortedItems = collect($items)->sortBy(function ($item) {
    if (preg_match('/^cusher (\d+)$/', $item['position'], $matches)) {
        return (int) $matches[1];
    } elseif (preg_match('/^cuslink (\d+)$/', $item['position'], $matches)) {
        return (int) $matches[1] + 1000; 
    }
    return 9999;
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




<div  id="sortableList"  class="group-header sortable-list ">
    @foreach ($sortedItems as $item)
        <div  class="mb-16 data-item">
            <div class=" sortable-item child-header bg-white shadow-sm relative  rounded-sm xs:rounded-md xs:shadow-xs xs:p-16 xs:pr-72"  data-id="{{ $item['id']}}" data-type="{{ $item instanceof \App\Models\Header ? 'header' : 'link' }}">
                
                @if (!isset($item['url']) || empty($item['url']))  
                    <div class="w-full px-24 text-center text-blDark font-inter data-header font-bold text-16"  >
                        <span  class="addname">{{ $item['title'] }}</span>
                        <input type="hidden" class="addid" value="{{ $item['id'] }}">
                        <div class=" position-subchild flexend absolute ">
                            <button class="triggermodal" data-target="showaddheader"> 
                                <span class="sec_label btn-user">Edit</span>
                            </button>
                        </div>
                    </div>
                @else
                    <div class="flexbetween data-link">
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
                                <div class="nama-url limit-one-line">
                                    {{ $item['url'] }}
                                </div>
                            
                                <input type="hidden" class="addid" value="{{ $item['id'] }}">
                                <input type="hidden" class="addembed" value="{{ $item['embed'] === true ? 'on' : 'off' }}">

                            </div>
                        </div>
                        <div class=" position-subchild flexend absolute ">
                            <button class="triggermodal" data-target="showaddlink"> 
                                <span class="sec_label btn-user">Edit</span>
                            </button>
                        </div>
                    </div>
                @endif
            </div> 
        </div>
    @endforeach
</div>


    <div class="socials-header">
        <h2>Socials</h2>
    </div>
   
    <div class="group-socials">
    @foreach($profil['socialmedia'] as $getlink)
        <div class=" child-socials flexbetween bg-white radius-4 cursor-pointer data-item "  data-id="{{ $item['id']}}"  data-type="{{ $item instanceof \App\Models\Header ? 'header' : ($item instanceof \App\Models\SocialMedia ? 'social' : 'link') }}">
            <div class="flex items-center addlogo" style="gap: 10px; padding-left: 16px;">
                {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 13a1 1 0 1 0 0 2a1 1 0 0 0 0-2m0-9a1 1 0 0 0-.993.883L11 7v6a1 1 0 0 0 1.993.117L13 13V7a1 1 0 0 0-1-1"/></g></svg> --}}
                {!! $getlink['svg'] !!}
                <span class="addname">{{ $getlink['title'] }}</span>
            </div>  
            <input type="hidden" class="addid" value="{{ $getlink['id'] }}">
                <div class="font-inter text-16 addurl font-normal  text-blTxtGrey limit-one-line break-all pl-12 triggermodal" data-target="showaddsocials">
                    {{ $getlink['url'] }}
                </div>

                <div class=" flexcenter relative gap-5 pr-10">
                    <div class=" flexend  ">
                        <button class="triggermodal data-social" data-target="showaddsocials"> 
                            <span class="sec_label btn-user">Edit</span>
                        </button>
                    </div>
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
                                    <input type="checkbox" id="switch-socials{{ $getlink['id'] }}" 
                                            class="switch-socials" 
                                            value="on" 
                                            data-id="{{ $getlink['id'] }}" 
                                            {{ $getlink['hide'] == 'on' ? 'checked' : '' }}>
                                    <label for="switch-socials{{ $getlink['id'] }}" class="sec_switch"></label>
                    
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
    document.querySelectorAll(".open-modal").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const socialContainer = this.closest(".add-socials");

            if (socialContainer) {
                const svgElement = socialContainer.querySelector(".addlogo").firstElementChild.outerHTML;
                const socialName = socialContainer.querySelector(".addname").textContent.trim();
                const modalToShow = document.getElementById("showaddsocials");
                const modalToClose = document.getElementById("showsearchsocials");
                const specialEmailTypes = ["Email", "Github", "Linkedin"];
                const specialPhoneTypes = ["Whatsapp", "Telegram"];
                if (modalToShow) {
                    if (specialEmailTypes.includes(socialName)) {
                        document.querySelector("#showaddsocials #Urlnput").placeholder = "Email (youraccount@domain)";
                    } else if (specialPhoneTypes.includes(socialName)) {
                        document.querySelector("#showaddsocials #Urlnput").placeholder = "Phone Number (+62xxyournumber)";
                    } else {
                        document.querySelector("#showaddsocials #Urlnput").placeholder = "URL (https://domain/youraccount)";
                    }
                    modalToShow.style.display = "flex"; 
                }
                if (modalToClose) {
                    modalToClose.style.display = "none"; 
                }

                document.querySelector("#showaddsocials  .icon-svg").innerHTML = svgElement;
                document.querySelector("#showaddsocials .span-name-atas span").textContent = socialName;
                document.querySelector("#showaddsocials .span-name-bawah span").textContent = socialName;
                document.querySelector("#showaddsocials #TitleInput").value = socialName;
                document.getElementById("svgInput").value = svgElement;
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
           
            document.querySelector("#showaddsocials .icon-svg").innerHTML = svgElement;
            document.querySelector("#showaddsocials .span-name-atas span").textContent = socialName;
            document.querySelector("#showaddsocials .span-name-bawah span").textContent = socialName;
            document.querySelector("#showaddsocials #TitleInput").value = socialName;
            document.querySelector("#showaddsocials #Urlnput").value = socialurl;
            document.querySelector("#showaddsocials #idInput").value = socialId;
            document.querySelector("#showaddsocials #submitFormsocials span").textContent = "Update";
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
            const fotoElement = linkContainer.querySelector(".foto-url img")?.currentSrc || '';
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
            const existingPreview = imgContainer.querySelector(".img-addlink");

            if (existingPreview) {
                existingPreview.remove();
            }

            if (fotoElement) {
            const profilImgDiv = document.createElement('div');
            profilImgDiv.classList.add('img-addlink');

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

            svgIcon.addEventListener('click', function (event) {
                event.stopPropagation();
                profilImgDiv.remove(); 
            });

            const imgElement = document.createElement("img");
            imgElement.src = fotoElement;
            imgElement.alt = "Preview";
            imgElement.name = "img";

            profilImgDiv.appendChild(svgIcon);
            profilImgDiv.appendChild(imgElement);
            imgContainer.appendChild(profilImgDiv);
            }
        }
    });
});


        document.querySelector("#showaddsocials .back").addEventListener("click", function () {
        document.getElementById("showaddsocials").style.display = "none";
        document.getElementById("showsearchsocials").style.display = "flex";

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

            document.querySelector("#showaddsocials .icon-svg").innerHTML = "";
            document.querySelector("#showaddsocials .span-name-atas span").textContent = "";
            document.querySelector("#showaddsocials .span-name-bawah span").textContent = "";
            document.querySelector("#showaddsocials #TitleInput").value = "";
            document.querySelector("#showaddsocials #Urlnput").value = "";
            document.querySelector("#showaddsocials #idInput").value = "";
            document.getElementById("svgInput").value = "";
    
        });
        document.querySelector(".addlink").addEventListener("click", function (event) {
            event.preventDefault();

            document.querySelector("#showaddlink h1").textContent = "Add Link";
            document.querySelector("#showaddlink #submitFormlink span").textContent = "Save";
            document.querySelector("#showaddlink #title").value = "";
            document.querySelector("#showaddlink #url").value = "";
            document.querySelector("#showaddlink #idInput").value = "";
            document.querySelector("#showaddlink #switch-embed").checked = false;
            document.querySelector("#showaddlink #hiddenStatus").value = "off";

            const imgContainer = document.querySelector("#showaddlink .profil-addlink");
            const existingPreview = imgContainer.querySelector(".img-addlink");
            if (existingPreview) {
                existingPreview.remove();
            }
        });

    document.querySelectorAll(".closemodal").forEach(button => {
        button.addEventListener("click", function () {
            this.closest(".sec_modal").style.display = "none";
        });
    });

    document.addEventListener("click", function (event) {
        if (!event.target.closest(".modalcontainer") && !event.target.closest(".open-modal")) {
            document.querySelectorAll(".sec_modal").forEach(modal => {
                modal.style.display = "none";
            });
        }
    });

    const searchInput = document.getElementById("searchInput");
    const socialItems = document.querySelectorAll(".add-socials"); 

    searchInput.addEventListener("input", function () {
        const searchValue = this.value.toLowerCase().trim();

        socialItems.forEach(item => {
            const nameElement = item.querySelector(".addname");
            if (nameElement) {
                const text = nameElement.textContent.toLowerCase();
                if (text.includes(searchValue)) {
                    item.style.display = "flex";
                } else {
                    item.style.display = "none";
                }
            }
        });
    });
});

</script>
@endsection