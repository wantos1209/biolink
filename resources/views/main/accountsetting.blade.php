@extends('layouts.main')
@section('content')
@include('modals.modal-changepassword')

<div class="account-setting">

    <form action="{{ route('updateprofil') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="group-design bg-white">
            <div class="child-profil  radius-4">
                <span>Profile</span>
            </div>
            <div class="child-profiltext radius-4">
                <div class="profiltext">
                    <input class="mt-5"type="text" name="nama" value="{{ $user['profil'][0]['nama'] }}">
                    <input class="mt-24" type="text" name="bio" value="{{ $user['profil'][0]['bio'] }}">
                </div>
                <div class="profilimg ml-32">
                    <div class="profil-canvas">
                    @if (is_null($user['profil'][0]['image']))
                        <input type="file" id="profile-img-upload" accept="image/*" class="p-b-wrap absolute opacity-0 cursor-pointer" name="images"  onchange="previewImages();">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.0245 6.06756V6.06756C18.5729 6.06756 18.1637 5.80726 17.9712 5.40047C17.6237 4.66439 17.1818 3.72369 16.9203 3.21158C16.5341 2.45007 15.9082 2.00696 15.0414 2.00091C15.0268 1.9997 9.37059 1.9997 9.35606 2.00091C8.48922 2.00696 7.86451 2.45007 7.4771 3.21158C7.2168 3.72369 6.77491 4.66439 6.42744 5.40047C6.23495 5.80726 5.82453 6.06756 5.37416 6.06756V6.06756C2.95766 6.06756 1 8.02521 1 10.4405V17.6271C1 20.0411 2.95766 22 5.37416 22H19.0245C21.4398 22 23.3974 20.0411 23.3974 17.6271V10.4405C23.3974 8.02521 21.4398 6.06756 19.0245 6.06756Z" stroke="url(#paint0_linear_331_550)" stroke-linecap="round" stroke-linejoin="round"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M8.34778 13.6033C8.34657 15.7256 10.079 17.4617 12.1977 17.4605C14.3128 17.4581 16.0404 15.7293 16.044 13.6118C16.0477 11.4859 14.3212 9.7534 12.2001 9.75098C10.0669 9.74856 8.33083 11.5101 8.34778 13.6033Z" stroke="url(#paint1_linear_331_550)" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M18.1356 10.7718C18.0186 10.7598 17.9031 10.7293 17.7737 10.6772C17.6298 10.6133 17.5052 10.532 17.3847 10.4096C17.1683 10.1794 17.043 9.87829 17.043 9.56771C17.043 9.40273 17.0767 9.23922 17.1426 9.09109C17.2086 8.94102 17.2868 8.81443 17.4282 8.67673C17.5357 8.58307 17.6459 8.5077 17.7965 8.44135C18.2431 8.26438 18.7744 8.37012 19.1064 8.70199C19.2059 8.80002 19.2897 8.91833 19.3362 9.01809L19.3637 9.08883C19.4306 9.23922 19.4643 9.40273 19.4643 9.56771C19.4643 9.88458 19.3406 10.1776 19.111 10.4216C18.9125 10.6214 18.6518 10.7443 18.3737 10.7718L18.2536 10.7778L18.1356 10.7718Z" fill="url(#paint2_linear_331_550)"></path> <defs><linearGradient id="paint0_linear_331_550" x1="1.9738" y1="12" x2="14.7268" y2="22.5155" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5858"></stop> <stop offset="1" stop-color="#C058FF"></stop></linearGradient> <linearGradient id="paint1_linear_331_550" x1="8.68228" y1="13.6058" x2="13.4618" y2="17.1188" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5858"></stop> <stop offset="1" stop-color="#C058FF"></stop></linearGradient> <linearGradient id="paint2_linear_331_550" x1="17.1482" y1="9.56712" x2="18.6501" y2="10.6729" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5858"></stop> <stop offset="1" stop-color="#C058FF"></stop></linearGradient></defs></svg>
                    @else
                        <div class="profil-img">
                            <div>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer delete-icon">
                                    <circle cx="12" cy="12" r="11" fill="#0D0C22" stroke="white" stroke-width="2"></circle> 
                                    <g clip-path="url(#clip0)">
                                        <path d="M15.7766 8.21582L8.86487 15.1275" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M15.7823 15.1347L8.86487 8.21582" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g> 
                                    <defs><clipPath id="clip0"><rect width="10.3784" height="10.3784" fill="white" transform="translate(7.13513 6.48633)"></rect></clipPath></defs>
                                </svg>
                            </div>
                            <img src="{{ env('API_URL') .'/storage/img/'. $user['profil'][0]['image'] }}" alt="Preview" name="img">
                            <input type="hidden" name="old_image" value="{{ $user['profil'][0]['image'] }}">
                        </div>
                    @endif
                    </div> 
                </div>
            </div>
                <button class="btnsave bl-btn text-white relative flexcenter" type="submit">
            <span>Save Profile</span></span> <span class="bl-circle-loader absolute hidden"></span>
            </button>
        </div>
    </form>

    <form action="{{ route('updateacount') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="group-settings p-32 rounded-sm mt-32 bg-white">
            <div class="child-profil radius-4 pb-24">
                <span>Account</span>
            </div>
            <div class="profiltext">
                <input class="mt-5" type="email" name="email" placeholder="Email@domain.com" value="{{ $user['email'] }}">
            </div>
            <button class="btnpasword relative flexcenter cursor-pointer px-32 py-8 triggermodal" data-target="showchangepass"  data-index="index1" type="button">
                <span class="flex items-center leading-17">Set Password</span>
            </button>

            <button class="btnsave bl-btn text-white relative flexcenter" type="submit">
                <span>Save changes</span>
            </button>
        </div>
    </form>

</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById('profile-img-upload');
    const container = document.querySelector('.profil-canvas');
    const deleteIcon = document.querySelector('.delete-icon');

    // Jika tombol hapus (SVG) ada, tambahkan event listener
    if (deleteIcon) {
        deleteIcon.addEventListener('click', function () {
            const profilImgDiv = document.querySelector('.profil-img');

            if (profilImgDiv) {
                profilImgDiv.remove(); // Hapus elemen gambar
            }

            // Tampilkan kembali input file
            const newFileInput = document.createElement('input');
            newFileInput.type = "file";
            newFileInput.id = "profile-img-upload";
            newFileInput.accept = "image/*";
            newFileInput.classList.add("p-b-wrap", "absolute", "opacity-0", "cursor-pointer");
            newFileInput.name = "images";
            newFileInput.onchange = previewImages;
            const svgIcon = document.createElement('div');
            svgIcon.innerHTML = `
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.0245 6.06756V6.06756C18.5729 6.06756 18.1637 5.80726 17.9712 5.40047C17.6237 4.66439 17.1818 3.72369 16.9203 3.21158C16.5341 2.45007 15.9082 2.00696 15.0414 2.00091C15.0268 1.9997 9.37059 1.9997 9.35606 2.00091C8.48922 2.00696 7.86451 2.45007 7.4771 3.21158C7.2168 3.72369 6.77491 4.66439 6.42744 5.40047C6.23495 5.80726 5.82453 6.06756 5.37416 6.06756V6.06756C2.95766 6.06756 1 8.02521 1 10.4405V17.6271C1 20.0411 2.95766 22 5.37416 22H19.0245C21.4398 22 23.3974 20.0411 23.3974 17.6271V10.4405C23.3974 8.02521 21.4398 6.06756 19.0245 6.06756Z" stroke="url(#paint0_linear_331_550)" stroke-linecap="round" stroke-linejoin="round"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M8.34778 13.6033C8.34657 15.7256 10.079 17.4617 12.1977 17.4605C14.3128 17.4581 16.0404 15.7293 16.044 13.6118C16.0477 11.4859 14.3212 9.7534 12.2001 9.75098C10.0669 9.74856 8.33083 11.5101 8.34778 13.6033Z" stroke="url(#paint1_linear_331_550)" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M18.1356 10.7718C18.0186 10.7598 17.9031 10.7293 17.7737 10.6772C17.6298 10.6133 17.5052 10.532 17.3847 10.4096C17.1683 10.1794 17.043 9.87829 17.043 9.56771C17.043 9.40273 17.0767 9.23922 17.1426 9.09109C17.2086 8.94102 17.2868 8.81443 17.4282 8.67673C17.5357 8.58307 17.6459 8.5077 17.7965 8.44135C18.2431 8.26438 18.7744 8.37012 19.1064 8.70199C19.2059 8.80002 19.2897 8.91833 19.3362 9.01809L19.3637 9.08883C19.4306 9.23922 19.4643 9.40273 19.4643 9.56771C19.4643 9.88458 19.3406 10.1776 19.111 10.4216C18.9125 10.6214 18.6518 10.7443 18.3737 10.7718L18.2536 10.7778L18.1356 10.7718Z" fill="url(#paint2_linear_331_550)"></path> <defs><linearGradient id="paint0_linear_331_550" x1="1.9738" y1="12" x2="14.7268" y2="22.5155" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5858"></stop> <stop offset="1" stop-color="#C058FF"></stop></linearGradient> <linearGradient id="paint1_linear_331_550" x1="8.68228" y1="13.6058" x2="13.4618" y2="17.1188" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5858"></stop> <stop offset="1" stop-color="#C058FF"></stop></linearGradient> <linearGradient id="paint2_linear_331_550" x1="17.1482" y1="9.56712" x2="18.6501" y2="10.6729" gradientUnits="userSpaceOnUse"><stop stop-color="#FF5858"></stop> <stop offset="1" stop-color="#C058FF"></stop></linearGradient></defs></svg>
            `;

            container.appendChild(newFileInput);
            container.appendChild(svgIcon);
        });
    }
});
function previewImages() {
    const fileInput = document.getElementById('profile-img-upload');
    const container = document.querySelector('.profil-canvas'); // Tempat menampilkan gambar

    // Hapus preview gambar sebelumnya (jika ada)
    const existingPreview = container.querySelector('.profil-img');
    if (existingPreview) {
        existingPreview.remove();
    }

    const file = fileInput.files[0]; // Ambil file pertama

    if (file) {
        // Validasi apakah file adalah gambar
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];
        if (!validImageTypes.includes(file.type)) {
            alert('Hanya file gambar yang diperbolehkan (JPEG, PNG, GIF, WEBP, SVG)');
            fileInput.value = ""; // Reset input file
            return; // Hentikan fungsi jika file bukan gambar
        }

        const reader = new FileReader();
        // Saat file berhasil dibaca
        reader.onload = function(e) {
            // Buat elemen div untuk profil-img
            const profilImgDiv = document.createElement('div');
            profilImgDiv.classList.add('profil-img');

            // Buat ikon SVG (ikon hapus atau edit)
            // const svgIcon = `
            //const svgWrapper = document.createElement('div');
            //svgWrapper.innerHTML = `
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

            // Ambil elemen SVG dari wrapper untuk menambahkan event listener
            // const svgIcon = svgWrapper.firstElementChild;

            svgIcon.addEventListener('click', function () {
                profilImgDiv.remove(); // Hapus gambar
                fileInput.value = "";  // Reset input file
            });
       
            // Buat elemen gambar dan set source-nya
            const imgElement = document.createElement('img');
            imgElement.src = e.target.result; // Set source dari file reader
            imgElement.alt = "Preview";
            imgElement.name = "img";
            //imgElement.style.maxWidth = "100px"; // Atur ukuran gambar
     
            // Tambahkan ikon dan gambar ke dalam profil-img div
            profilImgDiv.appendChild(svgIcon);
            // profilImgDiv.innerHTML = svgIcon;
            profilImgDiv.appendChild(imgElement);
          
            // Tambahkan div ke container
            container.appendChild(profilImgDiv);

        };

        reader.readAsDataURL(file); // Baca file sebagai Data URL
    }
}

</script>
@endsection
