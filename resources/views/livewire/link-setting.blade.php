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

<div  id="sortableList"  class="group-header sortable-list ">
    {{-- <div class="child-header bg-white radius-4 cursor-pointer">
        <label for="header">Header</label>
        <input type="text" name="header" readonly>
    </div> --}}
@foreach ($sortedItems as $item)
    <div  class="mb-16 data-item">
        {{-- <div class=" sortable-item child-header bg-white shadow-sm relative  rounded-sm xs:rounded-md xs:shadow-xs xs:p-16 xs:pr-72"  data-id="{{ $item['id']}}" data-type="{{ $item instanceof \App\Models\Header ? 'header' : 'link' }}"> --}}
        {{-- <a href="{{ route('profil') }}" class=""> </a> --}}

        <div class="sortable-item child-header bg-white shadow-sm relative rounded-sm xs:rounded-md xs:shadow-xs xs:p-16 xs:pr-72"
    data-id="{{ $item['id'] }}" 
    data-type="{{ $item['type'] }}">

        {{-- <div class="sortable-item child-header bg-white shadow-sm relative rounded-sm xs:rounded-md xs:shadow-xs xs:p-16 xs:pr-72" --}}
        {{-- data-id="{{ $item['id'] }}" data-type="{{ isset($item['url']) ? 'link' : 'header' }}"> --}}
        @if (!isset($item['url']) || empty($item['url']))  
        
        {{-- Jika tidak ada URL, berarti ini adalah HEADER --}}
        <div class="w-full px-24 text-center text-blDark font-inter font-bold text-16">
            <span>{{ $item['title'] }}</span>
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
            <div class="flexbetween" >
                <div class="flex">
                    @if (!empty($item['image']))
                    <div class="w-h-52 flex-shrink">
                        <div class="foto-url w-h-52" style="">
                            {{-- <span  mode="in-out" style="height: 100%; width: 100%; position: absolute; inset: 0px;">
                                <canvas  width="128" height="128" style="height: 100%; width: 100%; position: absolute; inset: 0px; display: none;"></canvas> --}}
                                <img  src="{{ env('API_URL') .'/storage/img/'. $item['image'] }}" alt="{{ $item['title'] }}" style="height: 100%; width: 100%; position: absolute; inset: 0px;">
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

{{-- <div class="container">
    <h3>Links</h3>
    <div id="linksList" class="sortable-list">
        @foreach ($user['profil'][0]['header'] as $getlink)
            <div class="sortable-item" data-id="{{ $getlink->id }}" data-type="link">
                {{ $getlink->position }}
            </div>
        @endforeach
    </div>

    <h3>Headers</h3>
    <div id="headersList" class="sortable-list">
        @foreach ($user['profil'][0]['link'] as $getlink)
            <div class="sortable-item" data-id="{{ $getlink->id }}" data-type="header">
                {{ $getlink->position }}
            </div>
        @endforeach
    </div>
</div> --}}

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
            console.log("🟢 Item dipindahkan:");
            console.log("Dari index:", evt.oldIndex, "Ke index:", evt.newIndex);

            let allItems = document.querySelectorAll(".sortable-item");
            let positions = [];

            allItems.forEach((item, index) => {
                positions.push({
                    id: item.dataset.id,
                    type: item.dataset.type,
                    position: index + 1
                });
            });
            console.log("🔄 Mengirim data posisi ke Livewire:", positions);

            // ✅ PASTIKAN LIVEWIRE TERSEDIA SEBELUM EMIT
            function ensureLivewireLoaded(callback) {
                if (typeof Livewire !== "undefined" && typeof Livewire.dispatch === "function") {
                    console.log("🟢 Livewire siap, mengirim event...");
                    callback();
                } else {
                    console.warn("⏳ Livewire belum ter-load, mencoba lagi...");
                    setTimeout(() => ensureLivewireLoaded(callback), 500);
                }
            }

            ensureLivewireLoaded(() => {
                console.log("🟢 Livewire siap, mengirim event...");
               Livewire.dispatch('updateOrder', { positions });
            });
        }
    });
});


</script>
