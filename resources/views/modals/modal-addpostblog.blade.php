
<div id="showaddpostblog" class="sec_modal" >
    <div class="modalcontainer blogcustom">

        <form action={{ route('createblog') }} id="postForm" enctype="multipart/form-data" method="post">
            @csrf
            {{-- <div class="group-post p-32 rounded-sm mt-32 bg-white"> --}}
            <div class="formaddpostimage blogcustom pb-80 bg-white ">
                <div class="judul_modal flex-h-between">
                    
                    <h1>Post Blog</h1>
                    <span class="closemodal" onclick="closeModal()">X</span>
                    {{-- <button class="lihat closemodal" onclick="closeModal()">X</button> --}}
                </div>
                <hr class="garis">
            <!-- Input Editor (Quill.js) -->
            <div class="profiltext mt-32">
                <input id="title" class="mb-12" type="text" name="title" placeholder="Title">
            </div>
            <div id="editor"></div>
            <input type="hidden" name="content" id="content">
    
            <!-- Upload Gambar -->
            {{-- <input type="file" id="imageUpload" name="image" accept="image/*"> --}}
            {{-- <img id="preview" src="" style="display:none; width: 100px;"> --}}
    
            {{-- <button class="btnsave bl-btn text-white relative flexcenter" type="submit">
                <span>Save</span> <span class="bl-circle-loader absolute hidden"></span>
                </button> --}}
                <button id="submitFormheader" class="btnsave saveadd bl-btn text-white absolute flexcenter" type="submit">
                    <span>Save</span> <span class="bl-circle-loader absolute hidden"></span>
                </button>
            <div class="error-message" style="display: none; color: red;"></div>
            </div>
        </form>
    </div>
</div>
<!-- Quill.js -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
<script>
        let isButtonActive = true; 

if (sessionStorage.getItem("isButtonActive") === "false") {
    isButtonActive = false;
}

function handleClick(event, element) {
    if (!isButtonActive) {
        event.preventDefault();
        return;
    }

    isButtonActive = false; 
    sessionStorage.setItem("isButtonActive", "false");
    window.location.href = element.href;

    setTimeout(() => {
        isButtonActive = true;
        sessionStorage.setItem("isButtonActive", "true"); 
    }, 5000);
}

window.addEventListener("load", () => {
    isButtonActive = true; 
    sessionStorage.setItem("isButtonActive", "true");
});

// Import module ImageResize (pastikan plugin sudah di-load)
const ImageResize = Quill.import('modules/imageResize');

// Font whitelist (gunakan ini agar pilihan font tampil jelas)
let Font = Quill.import('formats/font');
// Font.whitelist = ['serif', 'monospace', 'roboto', 'poppins']; 
Quill.register(Font, true);

const quill = new Quill('#editor', {
theme: 'snow',
placeholder: 'Tulis sesuatu...',
// height: 1000,
modules: {
    toolbar: [
        ['bold', 'italic', 'underline', 'strike'], // Format dasar
        [{ 'list': 'ordered'}, { 'list': 'bullet' }], // List
        [{ 'align': [] }], // List
        [{ 'header': 1 }, { 'header': 2 }], // Judul
        [{ 'color': [] }, { 'background': [] }], // Warna teks
        ['blockquote', 'code-block'], // Gaya penulisan
        [{ 'font': [] }],
        
        // [{ 'font': Font.whitelist }], // disarankan pakai whitelist
        ['link','image','video','clean'], // Bisa menyisipkan tautan
        // ['image'], // Bisa menyisipkan gambar
        // ['video'], // Bisa menyisipkan video
        // ['clean'], // Hapus format
        // imageResize: {} // Tambahkan modul imageResize
    ],
    // imageResize: {} // Tambahkan modul imageResize
    imageResize: {
    displaySize: true, // Menampilkan ukuran saat resize
    modules: ['Resize', 'DisplaySize', 'Toolbar'], // Modul yang diaktifkan
    }
}
});

//     modules: {
//     imageResize: {
//         displaySize: true, // Menampilkan ukuran saat resize
//         modules: ['Resize', 'DisplaySize', 'Toolbar'], // Modul yang diaktifkan
//     }
// }

// Menampilkan preview gambar sebelum upload

// document.getElementById('imageUpload').addEventListener('change', function(event) {
// const reader = new FileReader();
// reader.onload = function(){
//     document.getElementById('preview').src = reader.result;
//     document.getElementById('preview').style.display = 'block';
// };

// reader.readAsDataURL(event.target.files[0]);
// });

// Kirim Form dengan Fetch API
document.getElementById('postForm').addEventListener('submit', function(event) {
// event.preventDefault();
document.getElementById('content').value = quill.root.innerHTML; // 🔥 Simpan teks berformat

// const formData = new FormData(this);
// fetch('/create-post', {
//     method: 'POST',
//     body: formData,
//     headers: {
//         "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
//     },
// }).then(response => response.json())
// .then(data => {
//     if (data.success) {
//         alert("Post berhasil dibuat!");
//         window.location.reload();
//     } else {
//         alert("Terjadi kesalahan: " + data.message);
//     }
// }).catch(error => console.error("Error:", error));
});
quill.getModule('toolbar').addHandler('image', () => {
const input = document.createElement('input');
input.setAttribute('type', 'file');
input.setAttribute('accept', 'image/*');
input.click();

input.onchange = async () => {
const file = input.files[0];
if (file) {
    const formData = new FormData();
    formData.append("image", file);

    try {
        const response = await fetch("/upload-image", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
        });

        const data = await response.json();
        if (data.url) {
            const range = quill.getSelection();
            quill.insertEmbed(range.index, "image", data.url);
        }
    } catch (error) {
        console.error("Gagal mengunggah gambar:", error);
    }
}
};
});
quill.root.addEventListener('click', function (event) {
    event.preventDefault(); 
    event.stopPropagation(); 
if (event.target.tagName === 'IMG') {
if (confirm('hapus gambar ini?')) {
    let imageUrl = event.target.getAttribute('src');

    // Hapus elemen dari editor
    event.target.remove();

    // Kirim request ke server untuk menghapus gambar dari storage
    fetch('/delete-image', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ image: imageUrl })
    }).then(response => response.json())
      .then(data => console.log(data));
}
}
});

</script>
