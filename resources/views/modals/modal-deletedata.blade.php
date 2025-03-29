
<div id="showdeletedata" class="sec_modal" >
    <div class="modalcontainer">
        <form id="deleteform" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="formaddlink pb-80 bg-white ">
                <div class="judul_modal flex-h-between">
                    
                    <h1>Hapus</h1>
                    <span class="closemodal" onclick="closeModal()">X</span>
                    {{-- <button class="lihat closemodal" onclick="closeModal()">X</button> --}}
                </div>
                <hr class="garis">

                <div class="child-profiltext radius-4">
                    <input type="hidden" id="idInput" name="idheader">
                    <input type="hidden" id="deleteType" name="deleteType">
                    <div class="profiltext ">
                       <label id="getName"></label>
                    </div>
                   
                </div>
                {{-- <span id="countdown" style="position:fixed; top:10px; right:10px; background:#000; color:#fff; padding:5px 10px; display:none;"></span> --}}
                <button id="customContextMenu" class="btnsave saveadd bl-btn text-white absolute flexcenter" type="submit">
                    <span>Delete</span></span> <span class="bl-circle-loader  hidden"></span>
                </button>
                {{-- <p class="error-message text-red-500 hidden"></p> --}}
            </div>
        </form>
    </div>
</div>
