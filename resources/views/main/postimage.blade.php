@extends('main.main')
@section('main-content')
@include('modals.modal-addpostimage')
@include('modals.modal-addpostblog')
@include('modals.modal-showimage')


<div class="flexcenter mb-32">
    <button class="triggermodal addlink addpostimage cursor-pointer text-white radius-4 flexcenter " data-target="showaddpostimage">
        <span>+ Add Post Image</span>
    </button>
</div>

<div  id="sortableList"  class="  group-header sortable-list ">
    @if ($postimage->isEmpty())
        <div class="group-header sortable-list flexcenter">
            <span>No Post Image</span>
        </div>

    @else
         
    @foreach ($postimage as $item)
        <div  class="mb-16 data-item ">
            <div class=" sortable-item  bg-white shadow-sm   rounded-sm xs:rounded-md xs:shadow-xs xs:p-16 xs:pr-72"  data-id="{{ $item['id']}}">
            <div class="w-full mb-5" >
                <div class="img_form overflow-scroll">
                    
                    <div class="custom-file-upload">
                        @if (isset($item['imageposts']) || !empty($item['imageposts']))  
                        @php
                        $dataimg = [];
                        @endphp
                            @foreach ($item->imageposts as $getimage)
                                <a href="#" class="triggermodal trigger-galery-modal" data-target="showImg" data-index="{{ $loop->index }}">
                                    <img class="img-preview" src="{{ env('API_URL') .'/storage/img/'. $getimage['image'] }}" alt="{{ $getimage['image'] }}" style="max-width: 150px;margin: 5px;">
                                </a>
                                <input type="hidden" name="existing_images[]" value="{{ $getimage->image }}">
                        @php
                        $dataimg[] = env('API_URL') .'/storage/img/'. $getimage['image'];
                        @endphp         
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="child-posimage relative">
                <div class="profildeskripsi break-all  data-posimage"  data-images='@json($item->imageposts->pluck("image"))'>
                    <span >Deskripsi :</span>
                    <span class="adddeskripsi">{{ $item['deskripsi'] }}</span>
                    <input type="hidden" class="postimageid" value="{{ $item['id'] }}">

                    <div class="position-subposimage flexend absolute">
                        <button class=" triggermodal " data-target="showaddpostimage"> 
                            <span class="sec_label btn-user">Edit</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
</div>


<div class="socials-header">
    <h2>My Blog</h2>
</div>
<div  id="sortableList" class="group-socials sortable-list">
    @foreach ($postblog as $item)
        <div  class="mb-16 ">
            <div class="  child-socials  bg-white radius-4">
                <div class="sub-child-socials relative flex">
                    <div class="flex items-center px-16 addlogo data-blog " style="gap: 20px;"  data-id="{{ $item['id']}}"  data-deskripsi="{{ $item['deskripsi'] }}">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 13a1 1 0 1 0 0 2a1 1 0 0 0 0-2m0-9a1 1 0 0 0-.993.883L11 7v6a1 1 0 0 0 1.993.117L13 13V7a1 1 0 0 0-1-1"/></g></svg> --}}
                        <span >Title :</span>
                        <span class="blogtitle text-blBlue">{{ $item['title'] }} </span>
                        <div class=" position-subchild flexend absolute ">
                            <button class="triggermodal " data-target="showaddpostblog"> 
                                <span class="sec_label btn-user">Edit</span>
                            </button>
                        </div>
                    </div>  
                </div>    

                <div class=" font-inter mt-3 text-16 pl-16 pr-116 font-normal relative" >
                    <div  class=" addurl  data-social text-blTxtGrey limit-one-line break-all  " >
                        <span id="copyTextblog">{{ config('app.APP_URL') .  '/' . Auth::user()->username .  '/' . $item['slug'] }}</span>
                    </div>
                    
                    <div class="flex items-center cursor-pointer absolute position-subcopy">
                        <div>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.6667 3H5.66667C4.75 3 4 3.75 4 4.66667V16.3333H5.66667V4.66667H15.6667V3ZM18.1667 6.33333H9C8.08333 6.33333 7.33333 7.08333 7.33333 8V19.6667C7.33333 20.5833 8.08333 21.3333 9 21.3333H18.1667C19.0833 21.3333 19.8333 20.5833 19.8333 19.6667V8C19.8333 7.08333 19.0833 6.33333 18.1667 6.33333ZM18.1667 19.6667H9V8H18.1667V19.6667Z" fill="#0D0C22"></path>
                            </svg>
                        </div> 
                        <div id="copybloglink" class="ml-2" >Copy link</div>
                    </div> 

                </div>
                <input type="hidden" class="blogid" value="{{ $item['id'] }}">
            </div>
        </div>
    @endforeach

  
    <a href="#" class="triggermodal addposblog" data-target="showaddpostblog">
        <div class=" addsocials align-center bg-white radius-4 cursor-pointer">
        <span>+ Add Post Blog</span>
        </div>
    </a>
</div>

<script>

let allSelectedFiles = [];
let existingImages = [];

document.querySelectorAll(".data-posimage").forEach(button => {
    button.addEventListener("click", function (event) {
        event.preventDefault();
        const headerContainer = this.closest(".data-posimage");

        if (headerContainer) {
            const postimageName = headerContainer.querySelector(".adddeskripsi").textContent.trim();
            const postimagerId = headerContainer.querySelector(".postimageid").value.trim();
            const imagesData = JSON.parse(this.getAttribute('data-images'));

            existingImages = imagesData;
            allSelectedFiles = [];

            document.querySelector("#showaddpostimage h1").textContent = "Update Header";
            document.querySelector("#showaddpostimage #deskripsipostimage").value = postimagerId;
            document.querySelector("#showaddpostimage #deskripsi").value = postimageName;
            document.querySelector("#showaddpostimage #submitFormPostimage span").textContent = "Update";
            
            // document.querySelector("#showaddpostimage #datapostimage").value = JSON.stringify(existingImages);
            renderPreview();
            updateFileNames();
        }
    });
});


document.getElementById('images').addEventListener('change', function () {
    const newFiles = Array.from(this.files).filter(file => file.type.startsWith('image/'));
    newFiles.forEach(file => {
        const exists = allSelectedFiles.some(f => f.name === file.name && f.lastModified === file.lastModified);
        if (!exists) allSelectedFiles.push(file);
    });

    renderPreview();
    updateFileNames();
    updateFormFiles();
});


function renderPreview() {
    const previewContainer = document.getElementById('image-preview-container');
    previewContainer.innerHTML = '';

    existingImages.forEach(imageName => {
        const container = document.createElement('div');
        container.classList.add('image-preview');

        const imgElement = document.createElement('img');
        imgElement.src = `${window.location.origin}/storage/img/${imageName}`;
        imgElement.classList.add('img-preview');
        imgElement.style.maxWidth = '150px';
        imgElement.style.margin = '5px';

        const datapostimage = document.createElement('input'); 
        datapostimage.type = 'hidden'; 
        datapostimage.name = 'datapostimage[]';
        datapostimage.value = imageName;

        const deleteLabel = document.createElement('label');
        deleteLabel.classList.add('delete-label');
        deleteLabel.textContent = 'Delete';

        deleteLabel.addEventListener('click', (event) => {
            event.preventDefault();
            event.stopPropagation();
            existingImages = existingImages.filter(img => img !== imageName);
            renderPreview();
            updateFileNames();
        });

        container.appendChild(imgElement);
        container.appendChild(deleteLabel);
        container.appendChild(datapostimage);
        previewContainer.appendChild(container);
    });

    allSelectedFiles.forEach((file) => {
        const oFReader = new FileReader();

        const container = document.createElement('div');
        container.classList.add('image-preview');

        const imgElement = document.createElement('img');
        imgElement.classList.add('img-preview');
        imgElement.style.maxWidth = '150px';
        imgElement.style.margin = '5px';

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
    const fileNameContainer = document.getElementById('file-names');
    const allNames = existingImages.concat(allSelectedFiles.map(f => f.name));
    fileNameContainer.textContent = allNames.length
        ? allNames.join('\n')
        : 'No files chosen';
}

function updateFormFiles() {
    const dataTransfer = new DataTransfer();
    allSelectedFiles.forEach(file => dataTransfer.items.add(file));
    document.getElementById('images').files = dataTransfer.files;
}

document.querySelectorAll(".data-blog").forEach(button => {
    button.addEventListener("click", function (event) {
        event.preventDefault();
        const headerContainer = this.closest(".data-blog");

        if (headerContainer) {
            const blogId = this.getAttribute('data-id');
            const blogtitle = headerContainer.querySelector(".blogtitle").textContent.trim();
            const blogdeskripsi = this.getAttribute('data-deskripsi');

            document.querySelector("#showaddpostblog h1").textContent = "Update Blog";
            document.querySelector("#showaddpostblog #title").value = blogtitle;
            document.querySelector("#showaddpostblog #idpostblog").value = blogId;
            document.querySelector("#showaddpostblog #submitFormblog span").textContent = "Update";

            quill.root.innerHTML = blogdeskripsi;
            document.querySelector("#content").value = blogdeskripsi;
        }
    });
});

  


document.querySelector(".addpostimage").addEventListener("click", function (event) {
    event.preventDefault();

    document.querySelector("#showaddpostimage h1").textContent = "Post Image";
    document.querySelector("#showaddpostimage #deskripsipostimage").value = "";
    document.querySelector("#showaddpostimage #deskripsi").value = "";
    document.querySelector("#showaddpostimage #submitFormPostimage span").textContent = "Save";
    document.getElementById("image-preview-container").innerHTML = "";

    const inputFile = document.getElementById("images");
    inputFile.value = "";

    allSelectedFiles = [];

    const fileNameContainer = document.getElementById("file-names");
    if (fileNameContainer) {
        fileNameContainer.textContent = "No files chosen";
    }
});

document.querySelector(".addposblog").addEventListener("click", function (event) {
    event.preventDefault();

    document.querySelector("#showaddpostblog h1").textContent = "Post Blog";
    document.querySelector("#showaddpostblog #title").value = "";
    document.querySelector("#showaddpostblog #submitFormblog span").textContent = "Save";

    quill.root.innerHTML = "";
    document.querySelector("#content").value = "";
    // document.getElementById("image-preview-container").innerHTML = "";
});


document.addEventListener('DOMContentLoaded', function () {

const modal = document.getElementById('showImg'); 
const imgElement = modal.querySelector('img[name="img"]');
let currentIndex = 0;
let images = [];

document.querySelectorAll('.sortable-item').forEach(parentElement => {
    parentElement.querySelectorAll('.triggermodal').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                images = Array.from(parentElement.querySelectorAll('.triggermodal img'))
                            .map(img => img.src);

                currentIndex = parseInt(button.getAttribute('data-index'), 10);

                if (images.length > 0 && images[currentIndex]) {
                    imgElement.src = images[currentIndex];
                    modal.style.display = 'block';
                } else {
                    console.error('Index tidak valid atau gambar tidak ditemukan.');
                }
            });
        });
    });


    document.getElementById('nextImg').addEventListener('click', function (event) {
        event.preventDefault();
        if (images.length > 0) {
            currentIndex = (currentIndex + 1) % images.length;
            imgElement.src = images[currentIndex];
        }
    });


    document.getElementById('prevImg').addEventListener('click', function (event) {
        event.preventDefault();
        if (images.length > 0) {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            imgElement.src = images[currentIndex];
        }
    });

});

function copyToClipboard(event) {
    event.preventDefault();

    const parentElement = event.currentTarget.closest('.child-socials');
    const textElement = parentElement.querySelector('#copyTextblog');
    const textToCopy = textElement ? textElement.innerText : '';

    if (!textToCopy) {
        console.error('Teks tidak ditemukan.');
        return;
    }

    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(textToCopy).then(() => {
            showSuccessMessage(parentElement);
        }).catch(err => {
            console.error('Gagal menyalin teks: ', err);
        });
    } else {
        const tempInput = document.createElement('input');
        tempInput.value = textToCopy;
        document.body.appendChild(tempInput);
        tempInput.select();
        try {
            document.execCommand('copy');
            showSuccessMessage(parentElement);
        } catch (err) {
            console.error('Fallback: Gagal menyalin teks', err);
        }
        document.body.removeChild(tempInput);
    }
}

function showSuccessMessage(parentElement) {
    const successcopylink = parentElement.querySelector('#copybloglink');

    if (successcopylink) {
        successcopylink.innerText = 'Copied';
        setTimeout(() => {
            successcopylink.innerText = 'Copy link';
        }, 2000);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.child-socials').forEach(item => {
        const copyLinkBtn = item.querySelector('#copybloglink');
        if(copyLinkBtn){
            copyLinkBtn.addEventListener('click', copyToClipboard);
        }
    });
});

</script>

@endsection