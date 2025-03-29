@extends('index')
@section('content')

<div class="profilcontainer">
    <div class="mb-24 text-center">
        <div class="font-inter font-bold text-blDark text-24 leading-7">Setup your page</div> 
        <div class="mt-8 font-inter font-normal text-blDark text-14 leading-4">Let’s setup {{ config('app.APP_URL') .  '/' . Auth::user()->username }} 🎉</div>
    </div>
    <div class="formprofil bg-white ">
        <div class="judul_login">
            <h1>Create your profil</h1>
        </div>
        <form id="createprofilForm" action="{{ route('createprofil') }}" method="post" enctype="multipart/form-data">
            {{-- <form id="createprofilForm"> --}}
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="child-profiltext radius-4">    
            <div class="profilimg mr-32">
                <div class="profil-canvas-create flexcenter">
                    <input type="file" id="profile-img-upload" accept="image/*" class="p-b-wrap absolute opacity-0 cursor-pointer" name="images"  onchange="previewImages();" value="{{ old('images') }}">
                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.0245 5.06756V5.06756C18.5729 5.06756 18.1637 4.80726 17.9712 4.40047C17.6237 3.66439 17.1818 2.72369 16.9203 2.21158C16.5341 1.45007 15.9082 1.00696 15.0414 1.00091C15.0268 0.999697 9.37059 0.999697 9.35606 1.00091C8.48922 1.00696 7.86451 1.45007 7.4771 2.21158C7.2168 2.72369 6.77491 3.66439 6.42744 4.40047C6.23495 4.80726 5.82453 5.06756 5.37416 5.06756V5.06756C2.95766 5.06756 1 7.02521 1 9.4405V16.6271C1 19.0411 2.95766 21 5.37416 21H19.0245C21.4398 21 23.3974 19.0411 23.3974 16.6271V9.4405C23.3974 7.02521 21.4398 5.06756 19.0245 5.06756Z" stroke="#6E6D7A" stroke-linecap="round" stroke-linejoin="round"></path> 
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.34778 12.6033C8.34657 14.7256 10.079 16.4617 12.1977 16.4605C14.3128 16.4581 16.0404 14.7293 16.044 12.6118C16.0477 10.4859 14.3212 8.7534 12.2001 8.75098C10.0669 8.74856 8.33083 10.5101 8.34778 12.6033Z" stroke="#6E6D7A" stroke-linecap="round" stroke-linejoin="round"></path> 
                        <path d="M18.1356 9.77184C18.0186 9.75984 17.9031 9.72932 17.7737 9.67724C17.6298 9.6133 17.5052 9.53196 17.3847 9.40957C17.1683 9.17935 17.043 8.87829 17.043 8.56771C17.043 8.40273 17.0767 8.23922 17.1426 8.09109C17.2086 7.94102 17.2868 7.81443 17.4282 7.67673C17.5357 7.58307 17.6459 7.5077 17.7965 7.44135C18.2431 7.26438 18.7744 7.37012 19.1064 7.70199C19.2059 7.80002 19.2897 7.91833 19.3362 8.01809L19.3637 8.08883C19.4306 8.23922 19.4643 8.40273 19.4643 8.56771C19.4643 8.88458 19.3406 9.17763 19.111 9.42157C18.9125 9.62138 18.6518 9.74425 18.3737 9.77185L18.2536 9.77779L18.1356 9.77184Z" fill="#6E6D7A"></path>
                    </svg>
                </div>  

                @php $imagePath = session('old_image'); @endphp
                @if($imagePath)
                <div class="profil-img" id="preview-from-session">
                    <div onclick="removeSessionImage()" class="cursor-pointer">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer">
                        <circle cx="12" cy="12" r="11" fill="#0D0C22" stroke="white" stroke-width="2"></circle> 
                        <g clip-path="url(#clip0)"><path d="M15.7766 8.21582L8.86487 15.1275" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M15.7823 15.1347L8.86487 8.21582" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g> 
                        <defs><clipPath id="clip0"><rect width="10.3784" height="10.3784" fill="white" transform="translate(7.13513 6.48633)"></rect></clipPath></defs></svg>
                    </div>
                    <img src="{{ asset('storage/' . $imagePath) }}" alt="Preview" name="img">
                </div>
                @endif
                {{-- <input type="file" id="images" name="images[]" multiple onchange="previewImages(); updateFileNames();"> --}}
            </div>
            
            <div class="profiltext">
                <div class="list_input">
                    <input class="bl-input" type="text" name="nama" id="nama" placeholder="Nama Profil" value="{{ old('nama') }}">
                </div>

                <div class="list_input mt-16">
                    <input class="bl-input" type="text" name="bio" id="bio" placeholder="Bio" value="{{ old('bio') }}">
                </div>
            </div>
           
        </div>

            <div class="mt-32 mb-8 font-inter font-semibold">Add your first link</div>
            {{-- @foreach(old('namalink', ['']) as $i => $link)
            <div id="input-container">
                <div class="profil-text-input">
                    
                    <div class="list_input">
                        <input class="bl-input" type="text" name="namalink[0]" id="namalink-0" placeholder="Nama Link" value="{{ old("namalink.$i") }}">
                    </div>
                   
                    <div class="list_input">
                        <input class="bl-input" type="text" name="url[0]" id="url-0" placeholder="URL (https://domain/youraccount)" value="{{ old("url.$i") }}">
                    </div>
                </div>
            </div>
            @endforeach --}}
            @php
            $oldNamaLinks = old('namalink', []);
            $oldUrls = old('url', []);
            @endphp

            <div id="input-container">
                @forelse($oldNamaLinks as $i => $nama)
                    <div class="profil-text-input">
                        <div class="list_input">
                            <input class="bl-input namalink" type="text" name="namalink[{{ $i }}]" id="namalink-{{ $i }}" placeholder="Nama Link" value="{{ $nama }}">
                        </div>
                        <div class="list_input">
                            <input class="bl-input namaurl" type="text" name="url[{{ $i }}]" id="url-{{ $i }}" placeholder="URL (https://domain/youraccount)" value="{{ $oldUrls[$i] ?? '' }}">
                        </div>
                    </div>
                @empty
             
                    <div class="profil-text-input">
                        <div class="list_input">
                            <input class="bl-input namalink" type="text" name="namalink[0]" id="namalink-0" placeholder="Nama Link" value="">
                        </div>
                        <div class="list_input">
                            <input class="bl-input namaurl" type="text" name="url[0]" id="url-0" placeholder="URL (https://domain/youraccount)" value="">
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="mt-16 cursor-pointer text-14 font-inter text-blPrimary" id="add-link-btn">
                <span class="hover:underline">+ Add another link</span>
            </div>

            <button  id="submitFormcreateprofil" class="bl-btn bl-btn-md btn_submit text-white" type="submit">
                <span>Create Profil</span>
            </button>
            <div class="error-message" style="display: none; color: red;"></div>
        </form>
    </div>
</div>
<script>

let linkCounter = 1;

linkCounter = document.querySelectorAll('#input-container .profil-text-input').length;

    document.getElementById('add-link-btn').addEventListener('click', function () {
        const inputContainer = document.getElementById('input-container');
        const newInputGroup = document.createElement('div');
        newInputGroup.classList.add('profil-text-input', 'mt-4');

        newInputGroup.innerHTML = `
            <div class="list_input">
            
                <input class="bl-input namalink" type="text" name="namalink[${linkCounter}]" id="namalink-0" placeholder="Nama Link" value="">
            </div>
            <div class="list_input">
                <input class="bl-input namaurl" type="text" name="url[${linkCounter}]" id="url-0" placeholder="URL (https://domain/youraccount)" value="">
            </div>
        `;

        inputContainer.appendChild(newInputGroup);
        linkCounter++;
    });

    function removeSessionImage() {
        const previewDiv = document.getElementById('preview-from-session');
        const fileInput = document.getElementById('profile-img-upload');

        if (previewDiv) previewDiv.remove();
        if (fileInput) fileInput.value = ""; 

        fetch('/remove-temp-image', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            }
        });
    }

function previewImages() {
    const fileInput = document.getElementById('profile-img-upload');
    const container = document.querySelector('.profil-canvas-create'); 
    const existingPreview = container.querySelector('.profil-img');
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
            profilImgDiv.classList.add('profil-img');

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
                profilImgDiv.remove();
                fileInput.value = ""; 
            });
       
            const imgElement = document.createElement('img');
            imgElement.src = e.target.result;
            imgElement.alt = "Preview";
            imgElement.name = "img";
            //imgElement.style.maxWidth = "100px";
     
            profilImgDiv.appendChild(svgIcon);
            // profilImgDiv.innerHTML = svgIcon;
            profilImgDiv.appendChild(imgElement);
          
            container.appendChild(profilImgDiv);

        };

        reader.readAsDataURL(file);
    }
}

document.getElementById("submitFormcreateprofil").addEventListener("click", function (event) {
    event.preventDefault(); 

    const form = document.getElementById("createprofilForm");
    const formData = new FormData(form);
    const errorElement = form.querySelector(".error-message");
    errorElement.style.display = "none";

    const nama = formData.get("nama")?.trim();
    const namalinks = formData.getAll("namalink[0]");
    const urls = formData.getAll("url[0]");

        if (!nama || nama.length < 3) {
            return showErrorMessage("Nama Profil minimal 3 karakter.", errorElement);
        }

        if (!namalinks.length || namalinks.some(n => !n.trim())) {
            return showErrorMessage("Nama link wajib diisi.", errorElement);
        }

        if (namalinks.some(n => n.trim().length > 20)) {
            return showErrorMessage("Nama link maksimal 20 karakter.", errorElement);
        }

        const urlRegex = /^(https?:\/\/)?[\w\-]+(\.[\w\-]+)+[/#?]?.*$/;

        if (!urls.length || urls.some(u => !u.trim())) {
            return showErrorMessage("URL wajib diisi.", errorElement);
        }

        if (urls.some(u => u.trim().length > 255)) {
            return showErrorMessage("URL maksimal 255 karakter.", errorElement);
        }

        if (urls.some(u => !urlRegex.test(u.trim()))) {
            return showErrorMessage("Format URL tidak valid.", errorElement);
        }

        form.submit();
    });

    function showErrorMessage(message, container) {
    container.textContent = message;
    container.style.display = "block";
}

</script>
@endsection