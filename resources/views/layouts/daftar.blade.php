@extends('index')
@section('content')

<div class="logincontainer">
    <div class="formlogin bg-white ">
        <div class="judul_login">
            <h1>Create your account</h1>
        </div>
        <form action="{{ route('createdaftar') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="list_input">
                <input class="bl-input" type="text" name="email" id="userlogin" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="list_input relative">
                <span id="fixed-url" class="spanlink">
                    http://192.168.3.113:4126/
                </span>
                <input class="bl-input" type="text" name="username" id="username-input" placeholder="Username" value="{{ old('username') }}">
            </div>
            <input type="hidden" id="full-user" name="full-user">

            <div class="list_input password-container">
                <input class="bl-input"  type="password" name="password" id="password" placeholder="Password" value="">
                    {{-- <i class="toggle-password" data-toggle-id="password" onclick="togglePassword(event, 'password')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                            <path fill="currentColor" d="M9.5 7A8.5 8.5 0 0 0 1 15.5v7a8.5 8.5 0 0 0 15 5.477A8.5 8.5 0 0 0 31 22.5v-7a8.5 8.5 0 0 0-15-5.477A8.48 8.48 0 0 0 9.5 7m5.345 4.8A8.5 8.5 0 0 0 14 15.5v7c0 1.326.304 2.581.845 3.7A6.5 6.5 0 0 1 3 22.5v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0v-1a6.5 6.5 0 0 1 11.845-3.7M16 15.5a6.5 6.5 0 1 1 13 0v7a6.5 6.5 0 1 1-13 0v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0zm-7.324 1.361c-.371.31-.99.177-1.383-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294s.41 1.105.038 1.414m13.02-1.414c.393.472.41 1.105.04 1.414c-.372.31-.992.177-1.384-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294"/>
                        </svg>
                    </i> --}}
            </div>
            <ul id="password-rules" style="font-size: 14px; margin-top: 5px;">
                <li id="length-rule" style="display: none;">🔴 Minimal 8 karakter</li>
                <li id="number-rule" style="display: none;">🔴 Mengandung angka</li>
                <li id="lowercase-rule" style="display: none;">🔴 Mengandung huruf kecil</li>
                <li id="uppercase-rule" style="display: none;">🔴 Mengandung huruf besar</li>
            </ul>

            <div class="list_input password-container konfirmasi-password" style="display: none;" >
                <input class="bl-input"  type="password" name="konfirmasipassword" id="konfirmasipassword" placeholder="Konfirmasi Password" value="">
                    <i class="toggle-password" data-toggle-id="konfirmasipassword" onclick="togglePassword(event, 'konfirmasipassword')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                            <path fill="currentColor" d="M9.5 7A8.5 8.5 0 0 0 1 15.5v7a8.5 8.5 0 0 0 15 5.477A8.5 8.5 0 0 0 31 22.5v-7a8.5 8.5 0 0 0-15-5.477A8.48 8.48 0 0 0 9.5 7m5.345 4.8A8.5 8.5 0 0 0 14 15.5v7c0 1.326.304 2.581.845 3.7A6.5 6.5 0 0 1 3 22.5v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0v-1a6.5 6.5 0 0 1 11.845-3.7M16 15.5a6.5 6.5 0 1 1 13 0v7a6.5 6.5 0 1 1-13 0v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0zm-7.324 1.361c-.371.31-.99.177-1.383-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294s.41 1.105.038 1.414m13.02-1.414c.393.472.41 1.105.04 1.414c-.372.31-.992.177-1.384-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294"/>
                        </svg>
                    </i>
            </div>
        
            <button class="bl-btn bl-btn-md btn_submit text-white" type="submit" >
                <span>Daftar</span>
            </button>
            
        </form>
    </div>
</div>
<script>



const fixedUrl = "http://192.168.3.113:4126/";
const usernameInput = document.getElementById('username-input');
const fullUrlInput = document.getElementById('full-user');
usernameInput.addEventListener('input', function() {
    const fullUrl = fixedUrl + this.value;
    fullUrlInput.value = fullUrl;
});
</script>
@endsection