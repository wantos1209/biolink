@extends('index')
@section('main-content')
@include('modals.modal-addpostimage')
@include('modals.modal-addpostblog')

<div class="flexcenter mb-32">
    <button class="triggermodal addlink cursor-pointer text-white radius-4 flexcenter " data-target="showaddpostimage" data-index="index4">

        <span>+ Add Post Image</span>
   
    </button>


</div>




<div  id="sortableList"  class="group-header sortable-list ">
    @foreach ($postimage as $item)
        <div  class="mb-16 data-item">
            <div class=" sortable-item  bg-white shadow-sm   rounded-sm xs:rounded-md xs:shadow-xs xs:p-16 xs:pr-72"  data-id="{{ $item['id']}}">
            <div class="w-full mb-5 triggermodal"  data-target="showaddpostimage">
                <div class="img_form overflow-scroll">
                    <div class="custom-file-upload">
                        @if (isset($item['imageposts']) || !empty($item['imageposts']))  
                            @foreach ($item->imageposts as $getimage)
                                <img class="img-preview" src="{{ env('API_URL') .'/storage/img/'. $getimage['image'] }}" alt="{{ $getimage['image'] }}" style="max-width: 150px;margin: 5px;">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="profildeskripsi break-all">
                <span  class="adddeskripsi">Keterangan :</span>
                {{ $item['deskripsi'] }}
                {{-- <input type="hidden" class="addid" value="{{ $item['id'] }}"> --}}
            </div>

            {{-- <div class=" position-subchild flexcenter absolute ">
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
                    
                                 <input type="checkbox" id="switch-header{{ $item['id'] }}" 
                                        class="switch-header" 
                                        value="on" 
                                        data-id="{{ $item['id'] }}" 
                                        {{ $item['hide'] == 'on' ? 'checked' : '' }}>
                                 <label for="switch-header{{ $item['id'] }}" class="sec_switch"></label>
                     
                               
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
            </div> --}}
            {{-- @endif --}}
        </div>
    </div>
    @endforeach
</div>

<div class="socials-header">
    <h2>My Blog</h2>
</div>
<div class="group-socials">
    @foreach ($postblog as $item)
        <div  class="mb-16 data-item">
            <div class="  child-socials  bg-white radius-4 cursor-pointer data-item "  data-id="{{ $item['id']}}">
         
                <div class="flex items-center px-16 addlogo" style="gap: 20px;">
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 13a1 1 0 1 0 0 2a1 1 0 0 0 0-2m0-9a1 1 0 0 0-.993.883L11 7v6a1 1 0 0 0 1.993.117L13 13V7a1 1 0 0 0-1-1"/></g></svg> --}}
                    <span class="addname">Title :</span>
                    {{ $item['title'] }}
                    
                </div>  

            
            <div class=" font-inter mt-3 text-16 pl-16 pr-116 font-normal relative" data-target="showaddsocials">
                <div class=" addurl  data-social text-blTxtGrey limit-one-line break-all  triggermodal">
                {{ config('app.APP_URL') .  '/' . Auth::user()->username .  '/' . $item['slug'] }}
                </div>

                <div class="flex items-center cursor-pointer absolute position-subcopy">
                    <div>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.6667 3H5.66667C4.75 3 4 3.75 4 4.66667V16.3333H5.66667V4.66667H15.6667V3ZM18.1667 6.33333H9C8.08333 6.33333 7.33333 7.08333 7.33333 8V19.6667C7.33333 20.5833 8.08333 21.3333 9 21.3333H18.1667C19.0833 21.3333 19.8333 20.5833 19.8333 19.6667V8C19.8333 7.08333 19.0833 6.33333 18.1667 6.33333ZM18.1667 19.6667H9V8H18.1667V19.6667Z" fill="#0D0C22"></path>
                        </svg>
                    </div> 
                    <div id="copylink" class="ml-2" onclick="copyToClipboard()">Copy link</div>
                </div> 
            </div>

         

                <input type="hidden" class="addid" value="{{ $item['id'] }}">
                {{-- <div class="flexbetween triggermodal data-link" data-target="showaddlink">
                    <div class="flex">
                                            <div class="py-6 flex justify-between flex-col ml-16">
                                <div class="judul-link">
                                    <span>nama link</span>
                                </div> 
                            <div class="nama-url limit-one-line cursor-pointer">
                                http://192.168.3.113:4126/profilpage
                            </div>
                         
                            <input type="hidden" class="addid" value="2">
                            <input type="hidden" class="addembed" value="off">
    
                        </div>
                    </div>
                </div> --}}

                
            {{-- <div class=" position-subchild flexcenter absolute ">
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
    
                                 <input type="checkbox" id="switch-header{{ $item['id'] }}" 
                                        class="switch-header" 
                                        value="on" 
                                        data-id="{{ $item['id'] }}" 
                                        {{ $item['hide'] == 'on' ? 'checked' : '' }}>
                                 <label for="switch-header{{ $item['id'] }}" class="sec_switch"></label>

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
            </div> --}}
            {{-- @endif --}}
        </div>
    </div>
    @endforeach

    <a href="#" class="triggermodal" data-target="showaddpostblog" data-index="index5">
        <div class=" addsocials align-center bg-white radius-4 cursor-pointer">
        <span>+ Add Post Blog</span>
        </div>
    </a>
</div>

{{-- @foreach ($profil as $item)

@php
    $content = str_replace('/storage', env('APP_URL') . '/storage', $item->deskripsi);
@endphp
        <div>
            {!! $content !!}
        </div>
@endforeach --}}



<script>

        
        


</script>



@endsection