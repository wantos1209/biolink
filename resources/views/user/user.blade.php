@extends('user.index')
@section('content')
@include('modals.modal-shareuser') 

<div class="flex relative ">
    <div class="share-btn page-item triggermodal" data-target="showshareuser" data-index="index2">
        <svg class="sub-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_156_54)">
                <path d="M19 13V15.3077C19 17.3469 17.3469 19 15.3077 19H8.69231C6.65311 19 5 17.3469 5.00001 15.3077L5.00001 13" stroke="#314568" stroke-width="1.29231" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M8.25 8.76929L12 5.01929L15.75 8.76929" stroke="#314568" stroke-width="1.29231" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M12 5.01929V14.2501" stroke="#314568" stroke-width="1.29231" stroke-linecap="round" stroke-linejoin="round"></path>
            </g>
            <defs>
                <clipPath id="clip0_156_54">
                    <rect width="24" height="24" fill="white"></rect>
                </clipPath>
            </defs>
        </svg>
    </div>
 </div>
 
 
 @if (!empty($profil['image']))
 <img id="displayImage" class="display-image m-auto" src="{{ env('API_URL') .'/storage/img/'. $profil['image'] }}" alt="" role="presentation">
 @else
 <img id="displayImage" class="display-image m-auto" src="{{ env('API_URL') .'/storage/img/mylink.png' }}" alt="" role="presentation">
 @endif

 <div class="title">
    <h1 class="user-on page-text-color page-text-font">{{ $profil['nama'] }}</h1>
 </div>

 <div class="titlebio">
    <h2 class="page-text-color page-text-font text-center">{{ $profil['bio'] }}</h2>
</div>

<div class="mt-16 flex-center" >

    @foreach ($social as $getitem)
    @if ($getitem['hide'] === true)
    <div class="margin-12 hide-item" data-id="{{ trim($getitem['id']) }}" data-type="social">
            <a class="social-icon-anchor" aria-label="social-icon" rel="" href="{{ $getitem['url'] }}">
                {{-- <svg class="social-icon-fill" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.25 9C0.25 4.16751 4.16751 0.25 9 0.25H21C25.8325 0.25 29.75 4.16751 29.75 9V21C29.75 25.8325 25.8325 29.75 21 29.75H9C4.16751 29.75 0.25 25.8325 0.25 21V9ZM9 1.75C4.99594 1.75 1.75 4.99594 1.75 9V21C1.75 25.0041 4.99594 28.25 9 28.25H21C25.0041 28.25 28.25 25.0041 28.25 21V9C28.25 4.99594 25.0041 1.75 21 1.75H9ZM24 7.75H22V6.25H24V7.75ZM8.25 15C8.25 11.2721 11.2721 8.25 15 8.25C18.7279 8.25 21.75 11.2721 21.75 15C21.75 18.7279 18.7279 21.75 15 21.75C11.2721 21.75 8.25 18.7279 8.25 15ZM15 9.75C12.1005 9.75 9.75 12.1005 9.75 15C9.75 17.8995 12.1005 20.25 15 20.25C17.8995 20.25 20.25 17.8995 20.25 15C20.25 12.1005 17.8995 9.75 15 9.75Z" fill="white"></path></svg> --}}
            <span>{!! $getitem['svg'] !!}</span>
            </a>
        </div>
        @else
        <div class="margin-12 hide-item hidden" data-id="{{ trim($getitem['id']) }}" data-type="social">
            <a class="social-icon-anchor" aria-label="social-icon" rel="" href="{{ $getitem['url'] }}">
                {{-- <svg class="social-icon-fill" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.25 9C0.25 4.16751 4.16751 0.25 9 0.25H21C25.8325 0.25 29.75 4.16751 29.75 9V21C29.75 25.8325 25.8325 29.75 21 29.75H9C4.16751 29.75 0.25 25.8325 0.25 21V9ZM9 1.75C4.99594 1.75 1.75 4.99594 1.75 9V21C1.75 25.0041 4.99594 28.25 9 28.25H21C25.0041 28.25 28.25 25.0041 28.25 21V9C28.25 4.99594 25.0041 1.75 21 1.75H9ZM24 7.75H22V6.25H24V7.75ZM8.25 15C8.25 11.2721 11.2721 8.25 15 8.25C18.7279 8.25 21.75 11.2721 21.75 15C21.75 18.7279 18.7279 21.75 15 21.75C11.2721 21.75 8.25 18.7279 8.25 15ZM15 9.75C12.1005 9.75 9.75 12.1005 9.75 15C9.75 17.8995 12.1005 20.25 15 20.25C17.8995 20.25 20.25 17.8995 20.25 15C20.25 12.1005 17.8995 9.75 15 9.75Z" fill="white"></path></svg> --}}
            <span>{!! $getitem['svg'] !!}</span>
            </a>
        </div>
        @endif
    @endforeach
    {{-- <div class="margin-12">
        <a class="social-icon-anchor" aria-label="social-icon" data-id="instagram" data-type="social_link" target="_blank" rel="noopener nofollow" href="https://instagram.com/https://www.instagram.com/acong">
            <svg class="social-icon-fill" width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.25 9C0.25 4.16751 4.16751 0.25 9 0.25H21C25.8325 0.25 29.75 4.16751 29.75 9V21C29.75 25.8325 25.8325 29.75 21 29.75H9C4.16751 29.75 0.25 25.8325 0.25 21V9ZM9 1.75C4.99594 1.75 1.75 4.99594 1.75 9V21C1.75 25.0041 4.99594 28.25 9 28.25H21C25.0041 28.25 28.25 25.0041 28.25 21V9C28.25 4.99594 25.0041 1.75 21 1.75H9ZM24 7.75H22V6.25H24V7.75ZM8.25 15C8.25 11.2721 11.2721 8.25 15 8.25C18.7279 8.25 21.75 11.2721 21.75 15C21.75 18.7279 18.7279 21.75 15 21.75C11.2721 21.75 8.25 18.7279 8.25 15ZM15 9.75C12.1005 9.75 9.75 12.1005 9.75 15C9.75 17.8995 12.1005 20.25 15 20.25C17.8995 20.25 20.25 17.8995 20.25 15C20.25 12.1005 17.8995 9.75 15 9.75Z" fill="white"></path></svg>  
        </a>
    </div> --}}
</div>

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

<div class="mt-24" id="sortableContainer">
    @foreach ($sortedItems  as $item)
    @if ($item['hide']=== true)
            @if (!isset($item['url']) || empty($item['url']))  
            <div class="itemtitle sortable-item hide-item" data-id="{{ $item['id'] }}" data-type="{{ $item instanceof \App\Models\Header ? 'header' : 'link' }}">
                <span class="page-text-color page-text-font">{{ $item['title'] }}</span> 
            </div>
     
            @else
       
                @if ($item['embed']=== true)
                
                    <a target="_blank" rel="" class="sortable-item toggle-embed hide-item" href="javascript:void(0)" data-type="{{ $item instanceof \App\Models\Header ? 'header' : 'link' }}" data-id="{{ $item['id'] }}">
                        <div class="flex-center flex-col page-item-wrap page-item relative">
                      <div class="btnpage flex-center relative w-full">
                        {{-- <div class="page-item flex-both-center absolute"></div> --}}
                            @if(isset($item['image']) && !empty($item['image']))
                            <img class="link-each-image" src="{{ env('API_URL') .'/storage/img/'. $item['image'] }}" alt="{{ $item['title'] }}">
                            @endif
                            <span class=" item-title-full text-center page-text-font">{{ $item['title'] }}embed true</span>
                            <svg class="embed-ind-arrow-icon embed-ind-arrow" fill="#FFFFFF" viewBox="0 0 16 16" enable-background="new 0 0 24 24">
                                <path d="M8.006 11c.266 0 .486-.106.695-.323l4.061-4.21A.807.807 0 0013 5.87a.855.855 0 00-.846-.87.856.856 0 00-.626.276L8.006 8.957 4.477 5.276A.87.87 0 003.852 5 .86.86 0 003 5.869c0 .235.087.428.243.599l4.062 4.215c.214.217.434.317.7.317z"></path>
                            </svg>
                        </div>
                        @php
                        if (!function_exists('convertToEmbedURL')) {
                            function convertToEmbedURL($url) {
                                if (!$url) {
                                    return ''; // Jika URL kosong, return string kosong untuk menghindari error
                                }
                        
                                $parsedUrl = parse_url($url);
                                $host = $parsedUrl['host'] ?? '';
                                $query = $parsedUrl['query'] ?? '';
                        
                                // Jika YouTube
                                if (strpos($host, 'youtube.com') !== false || strpos($host, 'youtu.be') !== false) {
                                    parse_str($query, $queryParams);
                                    $videoId = $queryParams['v'] ?? '';
                        
                                    if (strpos($url, 'watch?v=') !== false && $videoId) {
                                        return "https://www.youtube.com/embed/" . $videoId;
                                    }
                        
                                    if (strpos($host, 'youtu.be') !== false) {
                                        $videoId = trim($parsedUrl['path'], '/');
                                        return "https://www.youtube.com/embed/" . $videoId;
                                    }
                                }
                        
                                // Jika Vimeo
                                if (strpos($host, 'vimeo.com') !== false) {
                                    $videoId = trim($parsedUrl['path'], '/');
                                    return "https://player.vimeo.com/video/" . $videoId;
                                }
                        
                                // Jika Dailymotion
                                if (strpos($host, 'dailymotion.com') !== false) {
                                    $videoId = explode("/", $parsedUrl['path'])[2] ?? "";
                                    return "https://www.dailymotion.com/embed/video/" . $videoId;
                                }
                        
                                // Jika Facebook Video
                                if (strpos($host, 'facebook.com') !== false) {
                                    return "https://www.facebook.com/plugins/video.php?href=" . urlencode($url);
                                }
                        
                                // Jika Twitter Video
                                if (strpos($host, 'twitter.com') !== false) {
                                    return "https://twitframe.com/show?url=" . urlencode($url);
                                }
                        
                                // Jika TikTok
                                if (strpos($host, 'tiktok.com') !== false) {
                                    return "https://www.tiktok.com/embed/" . trim($parsedUrl['path'], '/');
                                }
                        
                                // Jika tidak terdeteksi sebagai video, kembalikan URL asli
                                return $url;
                            }
                        }
                        
                        // Konversi URL dengan fungsi
                        $videoUrl = convertToEmbedURL($item['url']);
                        @endphp
                        
                        @if($videoUrl)
                            <div class="show-embed-item w-full" data-height="370" data-type="" style="height: 0px;">
                                <div class="embed-wrap relative">
                                    <div class="embed-wrap-preview">
                                        <iframe style="height: 370px;" class="rounded-md embed-iframe show-embed-item"
                                            src="{{ $videoUrl . '?enablejsapi=1&controls=1&rel=0' }}" 
                                            data-src="{{ $videoUrl }}" 
                                            width="100%" 
                                            title="video" 
                                            allowfullscreen 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                            frameborder="0">
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- <iframe style="height: 370px;" class="rounded-md embed-iframe show-embed-item" src="{{ $item['url'] }}" data-src="{{ $item['url'] }}" width="100%" title="youtube" allowfullscreen="" frameborder="0"></iframe> --}}
                                   
                        </div>
                    </a> 
                @else
                    <a target="_blank" rel="" class="sortable-item hide-item" href="{{ $item['url'] }}" data-type="{{ $item instanceof \App\Models\Header ? 'header' : 'link' }}" data-id="{{ $item['id'] }}">
                        <div class="btnpage flex-center page-item-wrap page-item relative">
                        {{-- <div class="page-item flex-both-center absolute"></div> --}}
                        @if(isset($item['image']) && !empty($item['image']))
                            <img class="link-each-image" src="{{ env('API_URL') .'/storage/img/'. $item['image'] }}" alt="{{ $item['title'] }}">
                            @endif
                            <span class=" item-title text-center page-text-font">{{ $item['title'] }}embed false</span>
                        </div>
                    </a>       
                @endif
        @endif
            {{-- @else
            <a target="_blank" rel="noopener nofollow" class="sortable-item hide-item" href="{{ $item['url'] }}" data-type="{{ $item instanceof \App\Models\Header ? 'header' : 'link' }}" data-id="{{ $item['id'] }}">
                <div class="btnpage flex-center page-item-wrap page-item relative">
                <div class="page-item flex-both-center absolute"></div>
                @if(isset($item['image']) && !empty($item['image']))
                    <img class="link-each-image" src="{{ env('API_URL') .'/storage/img/'. $item['image'] }}" alt="{{ $item['title'] }}">
                    @endif
                    <span class=" item-title-full text-center page-text-font">{{ $item['title'] }}</span>
                </div>
            </a>   
        @endif --}}
    @else
        @if (!isset($item['url']) || empty($item['url']))  
            <div class="itemtitle sortable-item hide-item hidden" data-id="{{ $item['id'] }}" data-type="{{ $item instanceof \App\Models\Header ? 'header' : 'link' }}">
                <span class="page-text-color page-text-font">{{ $item['title'] }}</span> 
            </div>

        @else
                @if ($item['embed']=== false)
                    <a target="_blank" rel="" class="sortable-item hide-item hidden" href="javascript:void(0)" data-type="{{ $item instanceof \App\Models\Header ? 'header' : 'link' }}" data-id="{{ $item['id'] }}">
                        <div class="btnpage flex-center page-item-wrap page-item relative">
                        {{-- <div class="page-item flex-both-center absolute"></div> --}}
                            @if(isset($item['image']) && !empty($item['image']))
                            <img class="link-each-image" src="{{ env('API_URL') .'/storage/img/'. $item['image'] }}" alt="{{ $item['title'] }}">
                            @endif
                            <span class=" item-title-full text-center page-text-font">{{ $item['title'] }}</span>
                        </div>
                    </a> 
                @else
                <a target="_blank" rel="" class="sortable-item hide-item hidden" href="{{ $item['url'] }}" data-type="{{ $item instanceof \App\Models\Header ? 'header' : 'link' }}" data-id="{{ $item['id'] }}">
                    <div class="btnpage flex-center page-item-wrap page-item relative">
          
                        <img class="link-each-image" src="{{ env('API_URL') .'/storage/img/'. $item['image'] }}" alt="{{ $item['title'] }}">
                        <span class=" item-title text-center page-text-font">{{ $item['title'] }}</span>
                    </div>
                </a>   
                @endif
        @endif    
     {{-- @else
        <a target="_blank" rel="noopener nofollow" class="sortable-item hide-item hidden" href="{{ $item['url'] }}" data-type="{{ $item instanceof \App\Models\Header ? 'header' : 'link' }}" data-id="{{ $item['id'] }}">
            <div class="btnpage flex-center page-item-wrap page-item relative">
  
                <img class="link-each-image" src="{{ env('API_URL') .'/storage/img/'. $item['image'] }}" alt="{{ $item['title'] }}">
                <span class=" item-title-full text-center page-text-font">{{ $item['title'] }}</span>
            </div>
        </a>   

    @endif --}}
    @endif
@endforeach      
</div>


<div class="mt-24" id="sortableContainer">
    @foreach ($postblog  as $item)
        {{-- @if ($item['hide']=== true) --}}
        <a target="_blank" rel="" class="sortable-item hide-item " href="{{ env('API_URL') . $username.  '/' . $item['slug'] }}" >
            <div class="btnpage flex-center page-item-wrap page-item relative">
                <img class="link-each-image radius-0" src="{{ env('API_URL') .'/storage/img/myblog.png' }}" alt="{{ $item['title'] }}">
                <span class=" item-title text-center page-text-font">{{ $item['title'] }}</span>
            </div>
        </a> 
        {{-- @endif --}}
    @endforeach
</div>

<div class="mt-24" id="sortableContainer">
    @foreach ($postimage  as $item)
        {{-- @if ($item['hide']=== true) --}}
        <a target="_blank" rel="" class="sortable-item hide-item " href="" >
            <div class="btnpage imagecontainer flex-center page-item-wrap page-item relative">
                <div class="custom-file-upload">
                    @if (isset($item['imageposts']) || !empty($item['imageposts']))  
                        @foreach (array_slice($item->imageposts->toArray(), 0, 4) as $getimage)
                            <img class="img-preview" src="{{ env('API_URL') .'/storage/img/'. $getimage['image'] }}" alt="{{ $getimage['image'] }}" style="max-width: 50px;">
                        @endforeach
                    @endif
                </div>
                <span class=" item-title text-center page-text-font">{{ $item['deskripsi'] }}</span>
            </div>
        </a> 
        {{-- @endif --}}
    @endforeach
</div>
{{-- <a target="_blank" rel="noopener nofollow" class="" href="https://www.instagram.com/acong" data-id="2977328" data-type="page_item">
    <div class="btnpage flex-center page-item-wrap page-item relative">
    <div class="page-item flex-both-center absolute"></div>
        <span class=" item-title-full text-center page-text-font">acong</span>
    </div>
</a> 
<a target="_blank" rel="noopener nofollow" class="" href="https://www.instagram.com/acong" data-id="2977328" data-type="page_item">
    <div class="btnpage flex-center page-item-wrap page-item relative">
    <div class="page-item flex-both-center absolute"></div>
        <span class=" item-title-full text-center page-text-font">acong</span>
    </div>
</a>        --}}
<script>
    const apiUrl = "{{ env('API_URL') }}";      
$(document).ready(function () {
 
 $(document).on('click', '.triggermodal', function () {
     var target = $(this).data('target');
     $('#' + target).css('display', 'flex');
 });

 $(document).on('click', '.closemodal', function () {
     $(this).closest('.sec_modal').css('display', 'none');
 });

 $(document).on('click', function (event) {
     // event.preventDefault();
     var target = $(event.target);
     if (!target.closest('.modalcontainer').length && !target.closest('.triggermodal').length) {
         $('.sec_modal').css('display', 'none');
     }
 });
});

        document.querySelectorAll(".toggle-embed").forEach(button => {
    //   document.querySelectorAll(".show-embed").forEach(button => {
    button.addEventListener("click", function (event) {
        event.preventDefault(); // Mencegah navigasi link
        
        // Cari elemen wrapper yang harus ditambahkan/diubah class-nya
        const wrapper = this.querySelector(".page-item-wrap");
        const embedItem = this.querySelector(".show-embed-item");

        if (wrapper && embedItem) {
            if (wrapper.classList.contains("show-embed")) {
                // Jika sudah memiliki class, hapus class dan atur height ke 0px
                wrapper.classList.remove("show-embed");
                embedItem.style.height = "0px";

                // Hentikan video dengan menghapus src sementara
                const iframe = embedItem.querySelector("iframe");
                if (iframe) {
                    iframe.src = ""; // Hapus src agar video berhenti
                }
            } else {
                // Tambahkan class dan atur height ke 386px
                wrapper.classList.add("show-embed");
                embedItem.style.height = "386px";

                // Kembalikan src agar video bisa dimainkan kembali
                const iframe = embedItem.querySelector("iframe");
                if (iframe) {
                    iframe.src = iframe.getAttribute("data-src"); // Kembalikan src asli
                }
            }
        }
    });
});
  
      window.addEventListener('message', (event) => {

    if (event.data && event.data.type === 'update3-color') {
        document.querySelectorAll('.page-text-color').forEach((element) => {
            element.style.setProperty('--text-color', event.data.x);
        });
        document.querySelectorAll('.btnpage').forEach((element) => {
            element.style.setProperty('--btn-color', event.data.x);
        });

        document.querySelector('.sub-icon').style.setProperty('--btn-color', event.data.x);

    }
//------------------------------------------------ 1,2
if (event.data && event.data.type === 'updateFont') {
        document.querySelectorAll('.page-text-font').forEach((element) => {
            element.style.setProperty('--page-font-family', event.data.font);
        });
    }
//------------------------------------------------ 3
if (event.data && event.data.type === 'update2-color') {
        //document.documentElement.style.setProperty('--page-background', event.data.backgroundpage);
        console.log("Event data yang diterima:", event.data); // Debugging
        document.querySelectorAll('.page-item').forEach((element) => {
            element.style.setProperty('--btn-background', event.data.x);
        });
          document.querySelectorAll('.btnpage').forEach((element) => {
            element.style.setProperty('--btn-color', event.data.y);
        });
        document.querySelector('.sub-icon').style.setProperty('--btn-color', event.data.y);
   
    }
    if (event.data && event.data.type === 'update4-color') {
        //document.documentElement.style.setProperty('--page-background', event.data.backgroundpage);
        console.log("Event data yang diterima:", event.data); // Debugging
        document.querySelectorAll('.page-item').forEach((element) => {
            element.style.setProperty('--btn-background', event.data.y);
            element.style.setProperty('--btn-border', event.data.x);
        });
        document.querySelectorAll('.btnpage').forEach((element) => {
            element.style.setProperty('--btn-color', event.data.z);
        });
        document.querySelector('.sub-icon').style.setProperty('--btn-color', event.data.z);
    }
//------------------------------------------------ 4,5
if (event.data && event.data.type === 'updateButton') {
        console.log("Event data yang diterima:123", event.data); // Debugging
        document.querySelectorAll('.page-item').forEach((element) => {
            element.style.setProperty('--btn-border', event.data.border);
            element.style.setProperty('--btn-background', event.data.background);
            element.style.setProperty('--btn-border-radius', event.data.radius);
        });
        document.querySelectorAll('.btnpage').forEach((element) => {
            element.style.setProperty('--btn-color', event.data.btnpage_color);
        });
        document.querySelector('.sub-icon').style.setProperty('--btn-color', event.data.btnpage_color);
    }
//------------------------------------------------ 6
if (event.data && event.data.type === 'update1-color') {
        document.querySelector('.page-bg').style.setProperty('--page-background', event.data.x);
    }
//------------------------------------------------ 7,8,9
if (event.data && event.data.type === 'update1-image') {
    backgroundValue = window.location.origin + "/storage/backgrounds/" + event.data.x; 
            document.querySelector('.page-bg').style.setProperty('--page-background', `url(${backgroundValue})`);
        }
//------------------------------------------------ 10

if (event.data && event.data.type === 'update-thema') {
        document.querySelectorAll('.page-text-font').forEach((element) => {
            element.style.setProperty('--page-font-family', event.data.x);
        });
        document.querySelectorAll('.page-text-color').forEach((element) => {
            element.style.setProperty('--text-color', event.data.y);
        });
        document.querySelectorAll('.page-item').forEach((element) => {
            element.style.setProperty('--btn-border', event.data.w);
            element.style.setProperty('--btn-background', event.data.z);
            element.style.setProperty('--btn-border-radius', event.data.t);
            element.style.setProperty('--btn-box-shadow', event.data.s);
        });
        document.querySelectorAll('.btnpage').forEach((element) => {
            element.style.setProperty('--btn-color', event.data.u);
        });
        document.querySelectorAll('.sub-icon').forEach((element) => {
            element.style.setProperty('--btn-color', event.data.u);
        });
        document.querySelector('.page-bg').style.setProperty('--page-background', event.data.v);
    }
//------------------------------------------------ 11







    // if (event.data && event.data.type === 'ColorFont') {
    //     document.querySelectorAll('.btnpage').forEach((element) => {
    //         element.style.setProperty('--btn-color', event.data.ColorFont);
    //     });
    // }


   

    




    if (event.data && event.data.type === "updatePosition") {
        console.log("🟢 Data posisi diterima di iframe:", event.data.positions);

        // 🔍 Validasi apakah jumlah data sama
        let receivedPositions = event.data.positions;
        let allItems = document.querySelectorAll(".sortable-item");

        if (receivedPositions.length !== allItems.length) {
            console.error("❌ Data posisi tidak valid: Jumlah item berbeda!", receivedPositions);
            return;
        }

        // 🔍 Validasi apakah posisi sesuai dengan yang dikirim
        let sortedReceived = receivedPositions.map(item => item.position).sort();
        let sortedItems = [...allItems].map(item => parseInt(item.dataset.position)).sort();

        if (JSON.stringify(sortedReceived) !== JSON.stringify(sortedItems)) {
            console.error("❌ Data posisi tidak valid: Urutan tidak sesuai!", receivedPositions);
            return;
        }

        updateItemPositions(receivedPositions);
    }
    


});

// Fungsi untuk memperbarui urutan item secara langsung
// function updateItemPositions(positions) {
//     let container = document.getElementById("sortableContainer");

//     if (!container) {
//         console.error("❌ Error: Element `sortableContainer` tidak ditemukan!");
//         return;
//     }

//     positions.forEach((item) => {
//         let element = document.querySelector(`.sortable-item[data-id='${item.id}']`);
//         if (element) {
//             element.style.order = item.position; // 🔥 Gunakan Flexbox untuk mengubah urutan
//             element.dataset.position = item.position; // Update posisi pada atribut data
//         } else {
//             console.warn(`⚠️ Elemen dengan ID ${item.id} tidak ditemukan di iframe.`);
//         }
//     });

//     console.log("✅ Posisi elemen diperbarui tanpa reload.");
// }



//     if (event.data && event.data.type === 'updateFont123') {
//         document.documentElement.style.setProperty('--btn-color', event.data.background);
        
//         console.log('btn-color dalam btn-color diperbarui ke:', event.data.background);
//     }


//====================================================================================
    document.addEventListener("DOMContentLoaded", function () {
        // Ambil data dari PHP yang sudah di-encode jadi JSON
        const designData = @json($design)[0];
        const designshadow = @json($box_shadow);
        console.log("Data dari server:", designData); // 👉 Lihat data di console
        console.log("Data dari server:", designshadow); 
        // Ubah style berdasarkan data
        if (designData) {
            document.querySelectorAll('.page-text-font').forEach((element) => {
                element.style.setProperty('--page-font-family', designData.font);
            });

            document.querySelectorAll('.page-text-color').forEach((element) => {
                element.style.setProperty('--text-color', designData.font_color);
            });

            document.querySelectorAll('.page-item').forEach((element) => {
                element.style.setProperty('--btn-border', designData.border_button);
                element.style.setProperty('--btn-background', designData.background_button);
                element.style.setProperty('--btn-border-radius', designData.bordir_button);
                element.style.setProperty('--btn-box-shadow', designshadow || '');
            });

            document.querySelectorAll('.btnpage').forEach((element) => {
                element.style.setProperty('--btn-color', designData.color_button);
            });
            document.querySelectorAll('.sub-icon').forEach((element) => {
                element.style.setProperty('--btn-color', designData.color_button);
            });
            
            let backgroundValue = designData.background_page;
            let pageBg = document.querySelector('.page-bg');
            // Cek apakah background adalah warna HEX atau gambar
            if (backgroundValue.startsWith("#") || backgroundValue.startsWith("rgb")) {
                // Jika warna (contoh: #fff4f1 atau rgb(255, 255, 255))
                document.querySelector('.page-bg').style.setProperty('--page-background', backgroundValue);
                if (pageBg.style.getPropertyValue('background-size')) {
                    pageBg.style.removeProperty('background-size', 'cover');
                }
                if (pageBg.style.getPropertyValue('background-position')) {
                    pageBg.style.removeProperty('background-position', 'center');
                }
                if (pageBg.style.getPropertyValue('background-repeat')) {
                    pageBg.style.removeProperty('background-repeat', 'no-repeat');
                }
            } else {
                // Jika path relatif atau URL gambar
                if (!backgroundValue.startsWith("http") && !backgroundValue.startsWith("data:image")) {
                    backgroundValue = window.location.origin + "/storage/backgrounds/" + backgroundValue; // Buat jadi URL lengkap
                    // let backgroundValue123123 = "{{ env('API_URL') .'/storage/backgrounds/' }}" + designData.background_page;
                     // Pastikan ini sudah benar
                    // Ambil URL API dari env
                    document.querySelector('.page-bg').style.setProperty('--page-background', `url(${backgroundValue})`);
                        // let backgroundValue = designData.background_page;
                       // backgroundValue = apiUrl + "/storage/backgrounds/" + backgroundValue;
                    // Debugging URL
                    // console.log("Final Background URL:", backgroundValue123123);
                    // document.querySelector('.page-bg').style.setProperty('--page-background', `${apiUrl}` );



                    if (!pageBg.style.getPropertyValue('background-size')) {
                        pageBg.style.setProperty('background-size', 'cover');
                    }
                    if (!pageBg.style.getPropertyValue('background-position')) {
                        pageBg.style.setProperty('background-position', 'center');
                    }
                    if (!pageBg.style.getPropertyValue('background-repeat')) {
                        pageBg.style.setProperty('background-repeat', 'no-repeat');
                    }
                }
                document.querySelector('.page-bg').style.setProperty('--page-background', `url(${backgroundValue})`);
            }


        } else {
            console.error("Data desain tidak tersedia.");
        }
    });
    
    window.addEventListener("message", (event) => {
    if (event.data && event.data.action === "updatePosition123") {
        console.log("🟢 Data posisi diterima di iframe123123123:", event.data.posisi);

        updateItemPositions(event.data.posisi);
    }

});
window.addEventListener('message', (event) => {
    if (event.data && event.data.action === 'hidestatus') {
        console.log(`🟢 Status toggle diterima di iframe: ID ${event.data.id}, Status: ${event.data.status}, Type: ${event.data.typedata}`);

        // Debug: Cek semua elemen sortable-item yang ada di iframe
        document.querySelectorAll('.hide-item').forEach(el => {
            console.log(`🔎 Elemen ditemukan di iframe: ID ${el.getAttribute("data-id")}, Type: ${el.getAttribute("data-type")}`);
        });

        let element = document.querySelector(`.hide-item[data-id='${event.data.id}'][data-type='${event.data.typedata}']`);
        if (element) {
            element.classList.toggle('hidden', event.data.status === 'off');
            console.log(`✅ Elemen dengan ID ${event.data.id} dan Type ${event.data.typedata} telah diperbarui di iframe.`);
        } else {
            console.warn(`⚠️ Elemen dengan ID ${event.data.id} dan Type ${event.data.typedata} tidak ditemukan di iframe.`);
        }
    }
});
window.addEventListener('message', (event) => {
if (event.data && event.data.action === 'deleteposition') {
        console.log("🗑️ Data posisi untuk dihapus diterima:", event.data);

        document.querySelectorAll('.hide-item').forEach(el => {
            console.log(`🔎 Elemen ditemukan di iframe: ID ${el.getAttribute("data-id")}, Type: ${el.getAttribute("data-type")}`);
        });

   let element = document.querySelector(`.hide-item[data-id='${event.data.id}'][data-type='${event.data.typedata}']`);
        if (element) {
             element.remove();
            console.log(`✅ Elemen dengan ID ${event.data.id} dan Type ${event.data.typedata} telah diperbarui di iframe.`);
        } else {
            console.warn(`⚠️ Elemen dengan ID ${event.data.id} dan Type ${event.data.typedata} tidak ditemukan di iframe.`);
        }

 

        console.log("✅ Semua elemen yang dihapus telah diperbarui di iframe.");
    }
});

// 🔄 Fungsi untuk mengupdate posisi elemen dalam iframe
function updateItemPositions(positions) {
    let container = document.getElementById("sortableContainer");

    if (!container) {
        console.error("❌ Error: Element `sortableContainer` tidak ditemukan!");
        return;
    }

    // 🔄 Buat array untuk menyimpan elemen sesuai urutan position yang benar
    let sortedElements = [];

    // Ambil semua elemen berdasarkan ID dan urutkan sesuai position
    positions.sort((a, b) => a.position - b.position).forEach((item) => {
        let element = document.querySelector(`.sortable-item[data-id='${item.id}'][data-type='${item.type}']`);
        if (element) {
            sortedElements.push(element); // Simpan elemen dalam urutan yang benar
        } else {
            console.warn(`⚠️ Elemen dengan ID ${item.id} tidak ditemukan di iframe.`);
        }
    });

    // 🔥 Kosongkan container dan tambahkan kembali elemen sesuai urutan position
    container.innerHTML = "";
    sortedElements.forEach(element => container.appendChild(element));

    console.log("✅ Posisi elemen di iframe diperbarui sesuai position.");
}

//====================================================================================

// window.addEventListener("message", function(event) {
//     if (event.data && event.data.action === 'updateFont') {
//         document.documentElement.style.setProperty('--page-font-family', event.data.font);
//         document.querySelector('.page-text-font').style.fontFamily = `"${event.data.font}", sans-serif`;
//         console.log('Font dalam iframe diperbarui ke:', event.data.font);
//     }
// });
//----------------------------------------
// window.addEventListener('DOMContentLoaded', function () {
//     let storedFont = localStorage.getItem('selectedFont');
//     if (storedFont) {
//         document.documentElement.style.setProperty('--page-font-family', storedFont);
//         document.querySelector('.page-text-font').style.fontFamily = `"${storedFont}", sans-serif`;
//     }
// });

// window.addEventListener('fontUpdated', function () {
//     let updatedFont = localStorage.getItem('selectedFont');
//     document.documentElement.style.setProperty('--page-font-family', updatedFont);
//     document.querySelector('.page-text-font').style.fontFamily = `"${updatedFont}", sans-serif`;
// });



           // ✅ Fungsi untuk share via WhatsApp
           function shareViaWhatsApp() {
const textToShare = document.getElementById("copyText").innerText; // Ambil teks dari elemen
const userOn = document.querySelector(".user-on").innerText
        // const encodedText = encodeURIComponent(`Halo!!! Silahklan Kunjungi tautan ini: ${textToShare}`);
const message = `Hallo Salam Kenal..!
Perkenalkan nama saya *${userOn}*
Silahkan kunjungi link bio saya di bawah ini:
${textToShare}`;

const encodedText = encodeURIComponent(message);
const whatsappURL = `https://wa.me/?text=${encodedText}`;

        // 🔥 Buka WhatsApp dengan teks yang sudah dienkode
window.open(whatsappURL, '_blank');
}
function shareViaTelegran() {
const textToShare = document.getElementById("copyText").innerText; // Ambil teks dari elemen
const userOn = document.querySelector(".user-on").innerText
        // const encodedText = encodeURIComponent(`Halo!!! Silahklan Kunjungi tautan ini: ${textToShare}`);
const message = `Hallo Salam Kenal..!
Perkenalkan nama saya *${userOn}*
Silahkan kunjungi link bio saya di bawah ini:
${textToShare}`;

const encodedText = encodeURIComponent(message);
// const telegramURL = `https://t.me/share/url?url=${encodeURIComponent(textToShare)}&text=${encodedText}`;
const telegramURL = `https://t.me/share/url?url=${encodedText}`;
        // 🔥 Buka WhatsApp dengan teks yang sudah dienkode
window.open(telegramURL, '_blank');
}

function shareViafacebook() {
const textToShare = document.getElementById("copyText").innerText; // Ambil teks dari elemen
const userOn = document.querySelector(".user-on").innerText

const message = `Hallo Salam Kenal..!
Perkenalkan nama saya *${userOn}*
Silahkan kunjungi link bio saya di bawah ini:
${textToShare}`;

const encodedText = encodeURIComponent(message);
const facebookURL = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(textToShare)}`;


window.open(facebookURL, '_blank');
}
function shareViatwitter() {
const textToShare = document.getElementById("copyText").innerText; // Ambil teks dari elemen
const userOn = document.querySelector(".user-on").innerText

const message = `Hallo Salam Kenal..!
Perkenalkan nama saya *${userOn}*
Silahkan kunjungi link bio saya di bawah ini:
${textToShare}`;

const encodedText = encodeURIComponent(message);
const twitterURL = `https://twitter.com/intent/tweet?text=${encodedText}`;

window.open(twitterURL, '_blank');
}
function shareVialinked() {
const textToShare = document.getElementById("copyText").innerText; // Ambil teks dari elemen
const userOn = document.querySelector(".user-on").innerText

const message = `Hallo Salam Kenal..!
Perkenalkan nama saya *${userOn}*
Silahkan kunjungi link bio saya di bawah ini:
${textToShare}`;

const encodedText = encodeURIComponent(message);
const linkedinURL = `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(textToShare)}&title=${encodeURIComponent(userOn)}`;

window.open(linkedinURL, '_blank');
}
// ✅ Tambahkan event listener ke elemen share-item untuk share ke WhatsApp
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
    </script>
@endsection