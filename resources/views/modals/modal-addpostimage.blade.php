
<div id="showaddpostimage" class="sec_modal" >
    <div class="modalcontainer ">
        {{-- <form id="postImageForm" action={{ route('createpostimage') }} enctype="multipart/form-data" method="post"> --}}
            <form id="postImageForm"
                enctype="multipart/form-data"
                method="POST"
                data-create="{{ route('createpostimage') }}"
                data-update="{{ route('updatepostimage') }}">
                @csrf

            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
            {{-- <div class="group-post p-32 rounded-sm mt-32 bg-white "> --}}
            <div class="formaddpostimage pb-80 bg-white ">
                <div class="judul_modal flex-h-between">
                    
                    <h1>Post Image</h1>
                    <span class="closemodal" onclick="closeModal()">X</span>
                    {{-- <button class="lihat closemodal" onclick="closeModal()">X</button> --}}
                </div>
                <hr class="garis">
                <div class="img_form overflow-scroll mt-32">
                    <div class="custom-file-upload">
                        <label for="images" class="custom-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M18 15v3h-3v2h3v3h2v-3h3v-2h-3v-3zm-4.7 6H5c-1.1 0-2-.9-2-2V5c0-1.1.9-2 2-2h14c1.1 0 2 .9 2 2v8.3c-.6-.2-1.3-.3-2-.3c-1.1 0-2.2.3-3.1.9L14.5 12L11 16.5l-2.5-3L5 18h8.1c-.1.3-.1.7-.1 1c0 .7.1 1.4.3 2"/>
                            </svg>
                            <span>Upload Images</span>
                        </label>
                        <div id="image-preview-container"></div>
                        <input type="file" id="images" name="images[]" multiple onchange="previewImages(); updateFileNames();">
                    </div>
                    
                </div>
                <pre  id="file-names" class="mt-12 px-6 ">No files chosen</pre>
               
                <div class="profiltext ">
                    <input type="hidden" id="deskripsipostimage" name="idpostimage">
                    <textarea id="deskripsi"  name="deskripsi" cols="30" rows="1" placeholder="Tulis Keterangan" maxlength="150" required></textarea>
                </div>
                <button id="submitFormPostimage" class="btnsave saveadd bl-btn text-white absolute flexcenter" type="submit">
                    <span>Save</span> <span class="bl-circle-loader absolute hidden"></span>
                </button>
                {{-- <button class="btnsave bl-btn text-white relative flexcenter" type="submit">
                    <span>Save</span> <span class="bl-circle-loader absolute hidden"></span>
                    </button> --}}
                <div class="error-message" style="display: none; color: red;"></div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById("submitFormPostimage").addEventListener("click", function (event) {
        const form = document.getElementById("postImageForm");
        const deskripsi = document.getElementById("deskripsi").value.trim();
        const idpostimage = document.getElementById("deskripsipostimage").value.trim();
        const errorElement = form.querySelector(".error-message");
    
        errorElement.style.display = "none";
    
        if (!deskripsi || deskripsi.length < 1) {
            event.preventDefault();
            return showErrorMessage("Deskripsi wajib diisi.", errorElement);
        }
    
        const routeCreate = form.getAttribute("data-create");
        const routeUpdate = form.getAttribute("data-update");
    
        form.action = idpostimage ? routeUpdate : routeCreate;
    
    });
    
</script>
