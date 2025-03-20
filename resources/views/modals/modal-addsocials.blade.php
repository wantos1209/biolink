{{-- @extends('layouts.main')
@section('content') --}}

<div id="showaddsocials" class="sec_modal" >
    <div class="modalcontainer">
        <form id="socialsForm">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="formaddlink pb-80 bg-white ">
                <div class="judul_modal flex-h-between">
                    <div class="back">
                    <svg data-v-4dc33573="" width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer bg-gray-100 hover:bg-gray-200 duration-200 ease-out rounded-full" 
                        style="margin-top: -2px;">
                        <circle cx="12" cy="12" r="12"></circle> 
                        <path d="M8.00012 11.748L16.1721 11.748" stroke="#200E32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> 
                        <path d="M11.7639 15.496L7.99992 11.748L11.7639 8" stroke="#200E32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    </div>
                    <div class="flexcenter gap-12">
                    <div class="align-center icon-svg"></div>
                    <div class="font-inter span-name-atas font-semibold text-blDark text-16 modal-title-center justify-center flex">
                        <span></span>
                    </div>
                </div>
                    <span class="closemodal" onclick="closeModal()">X</span>
                    
                </div>
                <hr class="garis">

                <div class="child-profiltext radius-4">
                    <div class="socialstext ">
                        <div class="px-12 pt-12 bg-white span-name-bawah">
                            <span></span>
                            <input type="hidden" id="idInput" name="idsocial">
                            <input type="hidden" id="TitleInput" name="title">
                            <input class="mt-5 mb-5" id="Urlnput" type="text" name="url" placeholder="URL (https://domain/youraccount)">
                            <input type="hidden" id="svgInput" name="svg">
                        </div>
                    </div>
                </div>

                <button id="submitFormsocials" class="btnsave saveadd bl-btn text-white absolute flexcenter" type="submit">
                    <span>Save</span></span> <span class="bl-circle-loader absolute hidden"></span>
                </button>
                {{-- <p class="error-message text-red-500 hidden"></p> --}}
                <div class="error-message" style="display: none; color: red;"></div>
            </div>
        </form>
    </div>
</div>
<script>

//     document.getElementById("submitFormsocials").addEventListener("click", function (event) {
//         event.preventDefault(); // Mencegah reload halaman

//         const form = document.getElementById("socialsForm");
//         const formData = new FormData(form);
//         const errorMessage = document.getElementById("Error");

//         const url = formData.get("url").trim();
//         if (url.length < 1) {
//             showErrorMessage("Nama link wajib diisi.");
//             return;
//         }
//         if (!isValidUrl(url)) {
//             showErrorMessage("Format URL tidak valid.");
//             return;
//         }
//         form.submit();
//     });
// });  


// function copyToClipboard() {
//     const textToCopy = document.getElementById('copyText').innerText;

//     // Cek apakah navigator.clipboard didukung
//     if (navigator.clipboard && navigator.clipboard.writeText) {
//         navigator.clipboard.writeText(textToCopy).then(() => {
//             showSuccessMessage();
//         }).catch(err => {
//             console.error('Gagal menyalin teks: ', err);
//         });
//     } else {
//         // Fallback untuk browser lama
//         const tempInput = document.createElement('input');
//         tempInput.value = textToCopy;
//         document.body.appendChild(tempInput);
//         tempInput.select();
//         try {
//             document.execCommand('copy');
//             showSuccessMessage();
//         } catch (err) {
//             console.error('Fallback: Gagal menyalin teks', err);
//         }
//         document.body.removeChild(tempInput);
//     }
// }

// // Fungsi untuk menampilkan notifikasi sukses
// function showSuccessMessage() {
//     const successMessage = document.getElementById('copySuccess');
//     successMessage.style.display = 'block';
//     setTimeout(() => {
//         successMessage.style.display = 'none';
//     }, 2000);
// }
</script>
{{-- @endsection --}}