
<div id="showaddpostblog" class="sec_modal" >
    <div class="modalcontainer  modalimage">

        <form action={{ route('createblog') }} id="postForm" enctype="multipart/form-data" method="post">
            {{-- <form id="postImageForm"
            enctype="multipart/form-data"
            method="POST"
            data-create="{{ route('createblog') }}"
            data-update="{{ route('updateblog') }}"> --}}
            @csrf
            {{-- <div class="group-post p-32 rounded-sm mt-32 bg-white"> --}}
            <div class="formaddpostimage blogcustom  pb-80 bg-white ">
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
            <input type="hidden" name="idpostblog" id="idpostblog">
            <!-- Upload Gambar -->
            {{-- <input type="file" id="imageUpload" name="image" accept="image/*"> --}}
            {{-- <img id="preview" src="" style="display:none; width: 100px;"> --}}
    
            {{-- <button class="btnsave bl-btn text-white relative flexcenter" type="submit">
                <span>Save</span> <span class="bl-circle-loader absolute hidden"></span>
                </button> --}}
                <button id="submitFormblog" class="btnsave saveadd bl-btn text-white absolute flexcenter" type="submit">
                    <span>Save</span> <span class="bl-circle-loader absolute hidden"></span>
                </button>
            <div class="error-message" style="display: none; color: red;"></div>
            </div>
        </form>
    </div>
</div>

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


const ImageResize = Quill.import('modules/imageResize');
let Font = Quill.import('formats/font');
Quill.register(Font, true);

    const quill = new Quill('#editor', {
    theme: 'snow',
    placeholder: 'Tulis sesuatu...',

        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'], 
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': [] }], 
                [{ 'header': 1 }, { 'header': 2 }], 
                [{ 'color': [] }, { 'background': [] }], 
                ['blockquote', 'code-block'], 
                [{ 'font': [] }],
                ['link','image','video','clean'],

            ],
            imageResize: {
            displaySize: true,
            modules: ['Resize', 'DisplaySize', 'Toolbar'],
            }
        }
    });


document.getElementById("submitFormblog").addEventListener("click", function (event) {
    event.preventDefault(); 

    const form = document.getElementById("postForm");
    // const idpostblog = document.getElementById("idpostblog").value.trim();
    const errorElement = form.querySelector(".error-message");
    errorElement.style.display = "none";

    document.getElementById('content').value = quill.root.innerHTML;

    const formData = new FormData(form);
    const title = formData.get("title")?.trim();
    const content = formData.get("content")?.trim();

    if (!title) {
        return showErrorMessage("Nama title wajib diisi.", errorElement);
    }

    if (!content || content === "<p><br></p>") {
        return showErrorMessage("Konten tidak boleh kosong.", errorElement);
    }
    form.submit();
});

function showErrorMessage(message, container) {
    container.textContent = message;
    container.style.display = "block";
}

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

                if (!response.ok) {
                    const errorData = await response.json();
                    
                    if (response.status === 422 && errorData.errors) {
                        const messages = Object.values(errorData.errors).flat().join('\n');
                        alert("Gagal upload:\n" + messages);
                    } else if (errorData.error) {
                        alert("Error: " + errorData.error);
                    } else {
                        alert("Terjadi kesalahan saat upload gambar.");
                    }

                    return;
                }

                const data = await response.json();
                if (data.url) {
                    const range = quill.getSelection();
                    quill.insertEmbed(range.index, "image", data.url);
                }

            } catch (error) {
                console.error("Gagal mengunggah gambar:", error);
                alert("Terjadi kesalahan saat upload.");
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

                event.target.remove();
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
