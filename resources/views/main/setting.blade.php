@extends('index')
@section('main-content')

<div class="group-settings p-32 rounded-sm mt-32 bg-white">
    <div class="child-profil radius-4 pb-24">
        <span>My pages</span>
    </div>
    @foreach ($user['profil'] as $getlink)
  
    <div class="border border-solid border-blGreyV1 p-12 grid grid-cols-3">
        <div class="col-span-2 flex">
            <div alt="" class="bl-user-pic object-cover w-45 h-45 image-loader-wrap rounded-full transform cursor-pointer flex-shrink-0" style="position: relative; padding-bottom: 0px; --transition-duration: 0.5s;">
                <span mode="in-out" style="height: 100%; width: 100%; position: absolute; inset: 0px;">
                    {{-- <canvas  width="128" height="128" style="height: 100%; width: 100%; position: absolute; inset: 0px; display: none;"></canvas> --}}
                    @if(isset($getlink['image']) && !empty($getlink['image']))
                        <img src="{{ env('API_URL') .'/storage/img/'. $getlink['image'] }}" alt="{{ $getlink['nama'] }}" style="height: 100%; width: 100%; position: absolute; inset: 0px;"> 
                    @else
                        <img src="{{ env('API_URL') .'/storage/img/mylink.png' }}" alt="{{ $getlink['nama'] }}" style="height: 100%; width: 100%; position: absolute; inset: 0px;">
                    @endif
                </span>
            </div>
     
            <div class="ml-12 text-14 font-inter font-/normal flex items-center flex-wrap">
                <div class="text-blDark w-full">{{ $getlink['nama'] }}</div> 
                <div class="text-blGrey">{{ env('API_URL') . $user['username'] }}</div>
            </div>
        </div>
      
        @if ($getlink['status']=== "off")
        <div class="flexend">
            <form action="{{ route('deleteprofil', ['id' => $getlink['id']]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btnedit text-sm">
                    <span>Delete</span>
                </button>
            </form>
        </div>
        @endif
    </div>
    @endforeach

    <div>
        <a href="{{ route('profil') }}" class="">
        <div class="btnaddnew text-sm  hover:underline">
            <span>+ Add a new page </span>
        </div>
        </a>
    </div>
</div>

    <form action="{{ route('updateusername') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="group-settings p-32 rounded-sm mt-32 bg-white">
            <div class="child-profil radius-4 pb-24">
                <span>My username</span>
            </div>

            <div class="list_input relative">
                <span id="fixed-url" class="spanlink">
                    http://192.168.3.113:4126/
                </span>
                <input class="bl-input" type="text" name="username" id="username-input" value="{{ $user['username'] }}">
            </div>

            <input type="hidden" id="full-user" name="full-user">

            {{-- <div class="profiltext">
                <input class="mt-5"type="text" name="header" value="asdasd" >
            </div> --}}

            <button class="btnsave bl-btn text-white relative flexcenter" type="submit">
            <span>Save</span></span> <span class="bl-circle-loader absolute hidden"></span>
            </button>
        </div> 
    </form>

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
