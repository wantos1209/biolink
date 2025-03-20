
<div id="showaddpostimage" class="sec_modal" >
    <div class="modalcontainer ">
        <form action={{ route('createpostimage') }} enctype="multipart/form-data" method="post">
            @csrf
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
                <div id="file-names" class="mt-12 px-6 ">No files chosen</div>

                <div class="profiltext ">
                    <textarea id="deskripsi"  name="deskripsi" cols="30" rows="1" placeholder="Tulis Keterangan" maxlength="150" required></textarea>
                </div>
                <button id="submitFormheader" class="btnsave saveadd bl-btn text-white absolute flexcenter" type="submit">
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

document.addEventListener('DOMContentLoaded', function () {
            const images = document.querySelector('#images');
            const previewContainer = document.querySelector('#image-preview-container'); 
            const fileNameContainer = document.querySelector('#file-names'); 
            const uploadForm = document.querySelector('#uploadForm');
           
            let allSelectedFiles = []; 
        
            images.addEventListener('change', function () {
               
                previewImages();
            });
        
            function previewImages() {
                let invalidFiles = 0;
                const newFiles = Array.from(images.files);
        
                newFiles.forEach((file) => {
                    if (!file.type.startsWith('image/')) {
                        invalidFiles++;
                        return;
                    }
        
                    const fileExists = allSelectedFiles.some(
                        existingFile => existingFile.name === file.name && existingFile.lastModified === file.lastModified
                    );
        
                    if (!fileExists) {
                        allSelectedFiles.push(file);
                    }
                });
        
                if (invalidFiles > 0) {
                    alert(`${invalidFiles} file bukan gambar dan tidak ditambahkan.`);
                }
        
                renderPreview();
                updateFileNames();
            }
        
            function renderPreview() {
                
                previewContainer.innerHTML = ''; 
        
                allSelectedFiles.forEach((file, index) => {
                    const oFReader = new FileReader();

                    const container = document.createElement('div');
                    container.classList.add('image-preview');


                    const imgElement = document.createElement('img');
                    imgElement.classList.add('img-preview');
                    imgElement.style.maxWidth = '150px';
                    imgElement.style.margin = '5px';

                    // Elemen label Delete (tanpa fungsi terlebih dahulu)
                    const deleteLabel = document.createElement('label');
                    deleteLabel.classList.add('delete-label');
                    deleteLabel.textContent = 'Delete'; 
                    
                    oFReader.onload = function (oFREvent) {
                        imgElement.src = oFREvent.target.result;
                    };
        
                    deleteLabel.addEventListener('click', (event) => {
                        event.preventDefault(); 
                        event.stopPropagation();  
                        allSelectedFiles = allSelectedFiles.filter(
                            f => f.name !== file.name || f.lastModified !== file.lastModified
                        );
        
                        renderPreview();
                        updateFileNames();
                        updateFormFiles();
                    });
                  
                    oFReader.readAsDataURL(file);

                    container.appendChild(imgElement);
                    container.appendChild(deleteLabel);
                    previewContainer.appendChild(container);

                });
            }
 
            function updateFileNames() {
                fileNameContainer.innerHTML = ''; 
        
                allSelectedFiles.forEach((file) => {
                    const fileNameElement = document.createElement('div');
                    fileNameElement.textContent = file.name;
                    fileNameContainer.appendChild(fileNameElement);
                });
            }
        
            function updateFormFiles() {
                const dataTransfer = new DataTransfer();
        
                allSelectedFiles.forEach((file) => {
                    dataTransfer.items.add(file);
                });
        
                images.files = dataTransfer.files; 
            }
        
            uploadForm.addEventListener('submit', function () {
                updateFormFiles(); 
            });
        });
  




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
