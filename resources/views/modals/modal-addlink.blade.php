
<div id="showaddlink" class="sec_modal" >
    <div class="modalcontainer">
        {{-- <div class="profilcontainer"> --}}
            {{-- <form action="{{ route('createlink') }}" id="linkForm" method="post" enctype="multipart/form-data"> --}}
            <form id="linkForm"> 
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="formaddlink pb-80 bg-white ">
                <div class="judul_modal flex-h-between">
                    
                    <h1>Add Link</h1>
                    <span class="closemodal" onclick="closeModal()">X</span>
                    
                </div>
                <hr class="garis">
    
                <div class="child-addlink radius-4">
                    
                    <div class="profiltext ">
                        <input id="title" class="mt-5"type="text" name="title" placeholder="Title">
                        <input  id="url" class="mt-12" type="url" name="url" placeholder="URL">
                        <input type="hidden" id="idInput" name="idlink">
                    </div>
                    <div class="addlinkimg align-center ml-24">
                        <div class="profil-addlink  relative">
                            <div class="custom-img-addlink flexcenter cursor-pointer">
                            <input type="file" id="profile-img-upload" accept="image/*" class="p-b-wrap absolute opacity-0 cursor-pointer" name="images"  onchange="previewImages();">
                            <div>
                                <svg width="40" height="37" viewBox="0 0 40 37" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto"><rect width="32" height="32" rx="4" fill="#B6B6BC"></rect> <path d="M6 23.5777L8.2935 21.1582C9.12 20.2852 10.5075 20.2807 11.3415 21.1462L12.669 22.5007C13.5645 23.4142 15.054 23.3482 15.8655 22.3597L19.209 18.2932C20.169 17.1247 21.93 17.0527 22.9815 18.1372L26.0955 21.3502" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <rect x="21.5" y="24.5" width="18" height="12" rx="1.5" fill="white" stroke="white"></rect> <rect x="22.5" y="25.5" width="16" height="10" rx="1.5" fill="white" stroke="#B6B6BC"></rect> <path d="M28.5467 29.546H29.6661C29.5237 28.6386 28.6154 28 27.4374 28C26.0609 28 25 28.8738 25 30.3616C25 31.8136 25.9923 32.7143 27.4603 32.7143C28.7756 32.7143 29.7145 31.9816 29.7145 30.7739V30.1958H27.5341V30.9263H28.6535C28.6383 31.4954 28.1981 31.8561 27.4654 31.8561C26.6385 31.8561 26.1169 31.3117 26.1169 30.3527C26.1169 29.3982 26.6588 28.8582 27.4552 28.8582C28.0226 28.8582 28.4067 29.1158 28.5467 29.546Z" fill="#B6B6BC"></path> <path d="M31.6436 28.0627H30.542V32.6515H31.6436V28.0627Z" fill="#B6B6BC"></path> <path d="M32.55 32.6515H33.6517V30.756H35.771V29.9561H33.6517V28.8626H36V28.0627H32.55V32.6515Z" fill="#B6B6BC"></path> <circle cx="11" cy="12" r="3" stroke="white" stroke-width="1.5"></circle></svg> 
                                <div class="text-blLGrey font-inter text-10 text-center mt-8">Picture</div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="flexbetween mt-32">
                    <div class="text-16 font-inter font-normal">
                        <Span>Make this a embed link</Span>
                    </div> 
    
                <div class="flex">
                    {{-- <label class="bl-toggle-btn relative inline-block ring-opacity-0">
                        <input id="highlight" type="checkbox" class="bl-toggle-input"> 
                        <span class="bl-toggle-slider absolute cursor-pointer rounded-52"></span> <!---->
                    </label> --}}
                   
                        <span class="sec_label">Embed is</span>
                        <div class="sec_togle">
                            <input type="checkbox" id="switch-embed" 
                                    class="switch-embed" 
                                    data-id="">
                            <label for="switch-embed" class="sec_switch"></label>
                            <input type="hidden" name="hidesocials" id="hiddenStatus" value="off">
                        </div>
                </div>
            </div>
    
            <button id="submitFormlink" class="btnsave saveadd bl-btn text-white absolute flexcenter" type="submit" >
                    <span>Save</span></span> <span class="bl-circle-loader absolute hidden"></span>
                </button>
                <div class="error-message" style="display: none; color: red;"></div>
            </div>
            
        </form>
        </div>
</div>
<script>

document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById('profile-img-upload');
    const container = document.querySelector('.profil-addlink');
    const deleteIcon = document.querySelector('.delete-icon');

    if (deleteIcon) {
        deleteIcon.addEventListener('click', function () {
            const profilImgDiv = document.querySelector('.img-addlink');
            event.stopPropagation();
            if (profilImgDiv) {
                profilImgDiv.remove();
            }

            const customImgDiv = document.createElement('div');
            customImgDiv.classList.add('custom-img-addlink','flexcenter','cursor-pointer');

            const newFileInput = document.createElement('input');
            newFileInput.type = "file";
            newFileInput.id = "profile-img-upload";
            newFileInput.accept = "image/*";
            newFileInput.classList.add("p-b-wrap", "absolute", "opacity-0", "cursor-pointer");
            newFileInput.name = "images";
            newFileInput.onchange = previewImages;
            const svgIcon = document.createElement('div');
            svgIcon.innerHTML = `
                <svg width="40" height="37" viewBox="0 0 40 37" fill="none" xmlns="http://www.w3.org/2000/svg" class="mx-auto"><rect width="32" height="32" rx="4" fill="#B6B6BC"></rect> <path d="M6 23.5777L8.2935 21.1582C9.12 20.2852 10.5075 20.2807 11.3415 21.1462L12.669 22.5007C13.5645 23.4142 15.054 23.3482 15.8655 22.3597L19.209 18.2932C20.169 17.1247 21.93 17.0527 22.9815 18.1372L26.0955 21.3502" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <rect x="21.5" y="24.5" width="18" height="12" rx="1.5" fill="white" stroke="white"></rect> <rect x="22.5" y="25.5" width="16" height="10" rx="1.5" fill="white" stroke="#B6B6BC"></rect> <path d="M28.5467 29.546H29.6661C29.5237 28.6386 28.6154 28 27.4374 28C26.0609 28 25 28.8738 25 30.3616C25 31.8136 25.9923 32.7143 27.4603 32.7143C28.7756 32.7143 29.7145 31.9816 29.7145 30.7739V30.1958H27.5341V30.9263H28.6535C28.6383 31.4954 28.1981 31.8561 27.4654 31.8561C26.6385 31.8561 26.1169 31.3117 26.1169 30.3527C26.1169 29.3982 26.6588 28.8582 27.4552 28.8582C28.0226 28.8582 28.4067 29.1158 28.5467 29.546Z" fill="#B6B6BC"></path> <path d="M31.6436 28.0627H30.542V32.6515H31.6436V28.0627Z" fill="#B6B6BC"></path> <path d="M32.55 32.6515H33.6517V30.756H35.771V29.9561H33.6517V28.8626H36V28.0627H32.55V32.6515Z" fill="#B6B6BC"></path> <circle cx="11" cy="12" r="3" stroke="white" stroke-width="1.5"></circle></svg> 
                <div class="text-blLGrey font-inter text-10 text-center mt-8">Picture</div>
            `;
            container.appendChild(customImgDiv);
            customImgDiv.appendChild(newFileInput);
            customImgDiv.appendChild(svgIcon);
        });
    }
});
function previewImages() {
    const fileInput = document.getElementById('profile-img-upload');
    const container = document.querySelector('.profil-addlink');
    const existingPreview = container.querySelector('.img-addlink');
    if (existingPreview) {
        existingPreview.remove();
    }

    const file = fileInput.files[0];

    if (file) {
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
        if (!validImageTypes.includes(file.type)) {
            alert('Hanya file gambar yang diperbolehkan (JPEG, PNG, GIF, WEBP, SVG)');
            fileInput.value = ""; 
            return; 
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const profilImgDiv = document.createElement('div');
            profilImgDiv.classList.add('img-addlink');

            const svgIcon = document.createElement('div');
            svgIcon.innerHTML = `
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer">
                    <circle cx="12" cy="12" r="11" fill="#0D0C22" stroke="white" stroke-width="2"></circle> 
                    <g clip-path="url(#clip0)">
                        <path d="M15.7766 8.21582L8.86487 15.1275" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M15.7823 15.1347L8.86487 8.21582" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g> 
                    <defs><clipPath id="clip0"><rect width="10.3784" height="10.3784" fill="white" transform="translate(7.13513 6.48633)"></rect></clipPath></defs>
                </svg>
            `;


            svgIcon.addEventListener('click', function () {
                event.stopPropagation();
                profilImgDiv.remove();
                fileInput.value = ""; 
            });
            event.stopPropagation();
            const imgElement = document.createElement('img');
            imgElement.src = e.target.result;
            imgElement.alt = "Preview";
            imgElement.name = "img";

            profilImgDiv.appendChild(svgIcon);
            // profilImgDiv.innerHTML = svgIcon;
            profilImgDiv.appendChild(imgElement);
            
            container.appendChild(profilImgDiv);

        };

        reader.readAsDataURL(file); 
    }
}

</script>
