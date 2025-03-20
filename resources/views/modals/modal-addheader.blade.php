
<div id="showaddheader" class="sec_modal" >
    <div class="modalcontainer">
        <form id="headerForm">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="formaddlink pb-80 bg-white ">
                <div class="judul_modal flex-h-between">
                    
                    <h1>Add Header</h1>
                    <span class="closemodal" onclick="closeModal()">X</span>
                    {{-- <button class="lihat closemodal" onclick="closeModal()">X</button> --}}
                </div>
                <hr class="garis">

                <div class="child-profiltext radius-4">
                    <input type="hidden" id="idInput" name="idheader">
                    <div class="profiltext ">
                        <input class="mt-5"type="text" id="TitleInput" name="title" placeholder="title">
                    </div>
            
                </div>

                <button id="submitFormheader"  class="btnsave saveadd bl-btn text-white absolute flexcenter" type="submit">
                    <span>Save</span></span> <span class="bl-circle-loader absolute hidden"></span>
                </button>
                {{-- <p class="error-message text-red-500 hidden"></p> --}}
                <div class="error-message" style="display: none; color: red;"></div>
            </div>
        </form>
    </div>
</div>

<script>


  




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
