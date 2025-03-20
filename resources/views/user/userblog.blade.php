@extends('user.index')
@section('content')

 
    @if (!empty($profil['image']))
    
            <img id="displayImage" class="display-image m-auto" src="{{ env('API_URL') .'/storage/img/'. $profil['image'] }}" alt="" role="presentation">
        
        @else

            <img id="displayImage" class="display-image m-auto" src="{{ env('API_URL') .'/storage/img/mylink.png' }}" alt="" role="presentation">
    @endif

    <div class="title">
        <h1 class="user-on page-text-color page-text-font">{{ $profil['nama'] }}</h1>
    </div>

    <div class="titlebio">
        <h2 class="page-text-color page-text-font text-center">{{ $profil['bio'] }}</h2>
    </div>

    <div class="mt-16 flex-center" >

        @foreach ($social as $getitem)

            @if ($getitem['hide'] === true)
                <div class="margin-12 hide-item" data-id="{{ trim($getitem['id']) }}" data-type="social">
                    <a class="social-icon-anchor" aria-label="social-icon" rel="" href="{{ $getitem['url'] }}">
                    <span>{!! $getitem['svg'] !!}</span>
                    </a>
                </div>
            @else
                <div class="margin-12 hide-item hidden" data-id="{{ trim($getitem['id']) }}" data-type="social">
                    <a class="social-icon-anchor" aria-label="social-icon" rel="" href="{{ $getitem['url'] }}">
                    <span>{!! $getitem['svg'] !!}</span>
                    </a>
                </div>
            @endif
            
        @endforeach

    </div>




       
            <div class="itemjudul">
                <span class="page-text-color page-text-font">{{ $slug['title'] }}</span> 
            </div>
            <div class="blog-container">
                <div class="blog-content">
                    {!! $slug['deskripsi'] !!}
                </div>
                
            </div>

            
<script>
document.addEventListener("DOMContentLoaded", function () {
    const background_div = document.getElementById("background_div"); 
    const blog = document.querySelector(".blog-container"); 
 // Menjadikan div berada di tengah halaman
    // blog.style.padding = "20px";  // Memberikan jarak nyaman
    background_div.style.boxSizing = "border-box"; // Mengatur padding tidak melebihi maxWidth

    blog.style.width = "100%";
    blog.style.maxWidth = "800px";
    blog.style.margin = "0 auto";
});


</script> 

@endsection