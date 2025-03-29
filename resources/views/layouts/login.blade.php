@extends('index')
@section('content')

<div class="logincontainer">
    <div class="formlogin bg-white ">
        <div class="judul_login">
            <h1>Login MyLinkL21</h1>
        </div>
        <form action="{{ route('login') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="list_input">
                <input class="bl-input" type="text" name="username" id="userlogin" placeholder="Username" value="{{ old('name') }}">
            </div>
            <div class="list_input password-container">
                <input class="bl-input"  type="password" name="password" id="password" placeholder="Password" value="">
                    <i class="toggle-password" data-toggle-id="password" onclick="togglePassword(event, 'password')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
                            <path fill="currentColor" d="M9.5 7A8.5 8.5 0 0 0 1 15.5v7a8.5 8.5 0 0 0 15 5.477A8.5 8.5 0 0 0 31 22.5v-7a8.5 8.5 0 0 0-15-5.477A8.48 8.48 0 0 0 9.5 7m5.345 4.8A8.5 8.5 0 0 0 14 15.5v7c0 1.326.304 2.581.845 3.7A6.5 6.5 0 0 1 3 22.5v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0v-1a6.5 6.5 0 0 1 11.845-3.7M16 15.5a6.5 6.5 0 1 1 13 0v7a6.5 6.5 0 1 1-13 0v-1a3.5 3.5 0 1 0 7 0v-5a3.5 3.5 0 1 0-7 0zm-7.324 1.361c-.371.31-.99.177-1.383-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294s.41 1.105.038 1.414m13.02-1.414c.393.472.41 1.105.04 1.414c-.372.31-.992.177-1.384-.294c-.393-.472-.41-1.105-.039-1.414c.372-.31.991-.178 1.384.294"/>
                        </svg>
                    </i>
            </div>
            <div class="list_forgot">
                <a href="#" class="triggermodal" data-target="shownotif" data-index="index3" onclick="closeModal()">Lupa Password ?</a>
            </div>
            <button class="bl-btn bl-btn-md btn_submit text-white" type="submit" >
                <span>Masuk</span>
            </button>
            
        </form>
    </div>
</div>

@endsection