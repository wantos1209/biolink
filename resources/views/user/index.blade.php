<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Poppins&family=EB+Garamond&family=Teko&family=Balsamiq+Sans&family=Kite+One&family=PT+Sans&family=Quicksand&family=DM+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto&display=swap">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <title>Document</title>

      @livewireStyles
      <style>
  
        @font-face {
            font-family: myFont1;
            src: url(/font/Lato-Regular.ttf);
        }
        *, ::after, ::before {
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }
            body {
            /* height: 100%; */
            /* background: #171717; */
            margin: 0;
            font-family: myFont1; 
        }
      div {
            display: block;
            unicode-bidi: isolate;
        }
        a {
    color: inherit;
    text-decoration: inherit
}
        h1,h2,h3,h4,h5,h6 {
    font-size: inherit;
    font-weight: inherit
}

audio,canvas,embed,iframe,img,object,svg,video {
    display: block;
    vertical-align: middle
}
img {
    border-style: solid
}

img,video {
    max-width: 100%;
    height: auto
}
h1 {
    display: block;
    font-size: 2em;
    margin-block-start: 0.67em;
    margin-block-end: 0.67em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
    unicode-bidi: isolate;
}
h2 {
    display: block;
    font-size: 1.5em;
    margin-block-start: 0.83em;
    margin-block-end: 0.83em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
    unicode-bidi: isolate;

}
button, select {
    text-transform: none;
}
button {
    background-color: transparent;
    color: inherit;
    border-width: 0;
    padding: 0;
    cursor: pointer;
}
button, input, optgroup, select, textarea {
    font-family: myFont1;
    font-size: 100%;
    line-height: 1.15;
    margin: 0;
}
button, input, optgroup, select, textarea {
    padding: 0;
    line-height: inherit;
    color: inherit;
    border: transparent;
}
.hidden {
    display: none
}
#sortableContainer {
    display: flex;
    flex-direction: column;
}
            .page-text-font {
            font-family: var(--page-font-family), sans-serif;
            text-transform: none;
            }
   
            .page-bg {
                
                /* background:  #df2626; */
                background: var(--page-background);
            }
            .page-text-color {
                color: var(--text-color);
            }
            .page-item-wrap:last-child {
                margin-bottom: 0;
            }
            .link-each-image, .page-item-wrap {
                border-radius: 30px;
            }
        
            .page-item-wrap {
                margin: 16px 0;
            }
            .page-item-wrap {
                    transition: transform .15s cubic-bezier(.17,.67,.29,2.71) 0s;
                }
         
            .page-item {
            border:  var(--btn-border);
            background:  var(--btn-background);
            border-radius:  var(--btn-border-radius);
            box-shadow: var(--btn-box-shadow);
            }
            /* .page-bg {
                height: 100vh;
                inset: 0;
                position: fixed;
                width: 100vw;
                z-index: -1;
            } */
                /* .page-item {
            border: 2px solid #970a4e;
            background: transparent;
            border-radius: 30px;
            } */
            .w-full {
                                width: 100%
                            }
            .share-btn, .share-btn-transparent {
                align-items: center;
                cursor: pointer;
                display: flex;
                height: 40px;
                justify-content: center;
                width: 40px;
            }
            .min-h-full {
                min-height: 100vh;
            }
            .flex-h-center {
                display: flex;
                justify-content: center;
            }
            .share-btn {
                border:  var(--btn-border);
                background: var(--btn-background);
                border-radius: 50%;
            }

            .relative {
                position: relative;
            }
            .display-image {
    border-radius: 50%;
    display: block;
    height: 96px;
    width: 96px;
}
.m-auto {
    margin: auto;
}
            .page-full-wrap {
                margin-top: 24px;
                padding-bottom: 100px;
                width: 680px;
                z-index: 10;
            }
            .flex {
            display: flex;
            }
         
          .title {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 0;
            text-align: center;
            margin-top: 16px;
          }
          .itemtitle {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 16px;
            text-align: center;
            margin-top: 32px;
          }
          .itemjudul {
            font-size: 20px;
            font-weight: 700;
            text-align: center;
            margin-top: 10px;
          }
          .blog-content {
            width: 100%;
            /* max-width: 750px; */
            margin: 0 auto; 
            padding: 20px; 
            margin-bottom: 16px;
            margin-top: 32px;
          }
          /* .blog-container {
            display: flex;
            justify-content: center;
            padding: 20px;
        } */

/* .blog-content {
    max-width: 750px;
    width: 100%;
    line-height: 1.6;
    font-size: 16px; 
    color: #333;    
} */

@media (max-width: 768px) {
    .blog-content {
        padding: 15px;
        font-size: 15px;
    }
}

@media (max-width: 576px) {
    .blog-content {
        padding: 10px;
        font-size: 14px;
    }
}
@media (max-width: 325px) {
    .blog-content {
        padding: 0px;
        font-size: 12px;
    }
}
          .btnpage {
            color: var(--btn-color);
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 400;
            text-transform: none;
            min-height: 60px;
            padding: 10px;
            /* height: 100%;
            width: 100%; */
            /* align-items: center;
            display: flex;
            justify-content: center; */
          }
   
          /* 
        .page-item {
            box-sizing: border-box;
            height: 100%;
            left: 0;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: -1;
        }
        .absolute {
            position: absolute;
        } */
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .margin-12{
            margin: 0 12px 12px;
        }
        .mt-48 {
            margin-top: 48px;
        }
        .mt-16 {
            margin-top: 16px;
        }
        /* Default Quill Fonts */
.ql-font-serif {
    font-family: Georgia, Times New Roman, serif;
}

.ql-font-monospace {
    font-family: Monaco, Consolas, monospace;
}

/* Custom Font: Tambahan font baru */
.ql-font-roboto {
    font-family: 'Roboto', sans-serif;
}

.ql-font-poppins {
    font-family: 'Poppins', sans-serif;
}

        .page-logo {
    bottom: 32px;
    left: calc(50% - 25px);
    position: absolute;
    height: 48px;
    width: 48px;
}
.page-logo:hover svg .bl-logo-br {
                opacity: 1
            }
            .object-contain {
    -o-object-fit: contain;
    object-fit: contain
}
.titlebio {
    font-size: 16px;
    font-weight: 400;
    line-height: 22px;
    margin-top: 12px;
}
.text-center {
    text-align: center;
}
/* .link-each-image, .page-item-wrap {
    border-radius: 30px;
} */

.link-each-image {
    height: 43px;
    left: 9px;
    -o-object-fit: cover;
    object-fit: cover;
    position: absolute;
    width: 43px;
}

.sub-icon path {
    stroke: var(--btn-color);
}
.formprofil {
    padding: 32px;
    border-radius: 8px;
    width: 480px;
    /* margin-top: 64px; */
}
.bg-white {
    --tw-bg-opacity: 1;
    background-color: rgba(255, 255, 255, var(--tw-bg-opacity));
    background-color: wheat;
}
.sec_modal {
    /* background: rgba(var(--rgba-black), 0.8); */
    /* margin: auto; */
    top: 0;
    left: 0;
    display: none;
    align-items: center;
    justify-content: center;
    position: fixed;
    width: 100%;
    height: 100%;
    margin-left: var(--sidebar-width);
    z-index: 999;
}
.modalcontainer {
    border-radius: 8px;
}

.flex-h-between {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.judul_modal {
    color: var(--dark-color);
    font-weight: 700;
    font-size: 20px;
    font-family: myfont1;
    margin-right: -12px;
    /* padding-left: 32px; */
    padding-bottom: 10px;
    /* border-bottom-width: 1px; */
}
.closemodal {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    opacity: 0px;
    background: #E4C59E;
    cursor: pointer;
    font-size: 20px;
    font-weight: 400;
    text-align: center;
    align-content: center;
}
.garis {
    margin-left: -32px;
    margin-right: -32px;
    border-color: var(--grey-color);
}

hr {
    border-top-width: 1px;
}
hr {
    height: 0;
    color: inherit;
}
.mt-26 {
    margin-top: 26px;
}
.list_input {
    border-radius: 4px;
    border: 1px solid transparent;
}
.align-center {
    text-align: center;
    align-content: center;
}
.px-24 {
    padding-left: 24px;
    padding-right: 24px;
}
.cursor-pointer {
    cursor: pointer;
}
.h-48 {
    height: 48px;
}
.relative {
    position: relative;
}
.flexbetween {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.items-center {
    align-items: center;
}
.flex {
    display: flex;
}
.right-16 {
    right: 16px;
}
.font-inter {
    font-family: Inter, sans-serif;
}
.text-left {
    text-align: left;
}
.ml-16 {
    margin-left: 16px;
}
.text-gradient, .text-gradient-v1 {
    background-color: #ff5858;
    background-size: 100%;
    background-repeat: repeat;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    -moz-background-clip: text;
    -moz-text-fill-color: transparent;
}
.text-gradient {
    background-image: linear-gradient(112.44deg, #ff5858 2.09%, #c058ff 75.22%);
}
.text-20 {
    font-size: 20px;
}
.mt-26 {
    margin-top: 26px;
}

.align-center {
    text-align: center;
    align-content: center;
}
.h-60 {
    height: 60px;
}
.btn_submit {
    letter-spacing: 2px;
    line-height: 17px;
    text-transform: uppercase;
    border-radius: 4px;
    width: 100%;
    margin-top: 24px;
}

.bl-btn-md {
    min-width: 96px;
    height: 40px;
}
.text-white {
    --tw-text-opacity: 1;
    color: rgba(255, 255, 255, var(--tw-text-opacity));
}
.bl-btn {
    font-family: Inter, sans-serif;
    font-size: 14px;
    font-weight: 600;
    background: linear-gradient(112.44deg, #ff5858 2.09%, #c058ff 75.22%);
    background-size: 165%;
}
.text-white {
    --tw-text-opacity: 1;
    color: rgba(255, 255, 255, var(--tw-text-opacity));
}
.h-60 {
    height: 60px;
}
.flexcenter {
    display: flex;
    justify-content: center;
    align-items: center;
}
.inline {
    display: inline;
}

.mr-8 {
    margin-right: 8px;
}
audio, canvas, embed, iframe, img, object, svg, video {
    display: block;
    vertical-align: middle;
}
.btn_submit {
    letter-spacing: 2px;
    line-height: 17px;
    text-transform: uppercase;
    border-radius: 4px;
    width: 100%;
    margin-top: 24px;
}
/* -------------------------------------------------------- */

.page-item-wrap.expanded-form:hover, .page-item-wrap.show-embed:hover {
    transform: unset;
}

.flex-col {
    flex-direction: column
}
.item-title-full {
    width: 55%;
    word-break: break-word;
}
.item-title {
    width: 55%;
    word-break: break-word;
}
.page-item-wrap.show-embed {
    border-radius: 30px;
    box-shadow: none;
    transform: unset;
    transition: unset;
}
.page-item-wrap:hover {
    transform: translate3d(0px, 0px, 0px) scale(1.015);
}
/* ----------------------------------------------------------- */
.page-item-wrap.show-embed .show-embed-item {
    overflow: visible;
}
.show-embed-item {
    /* max-height: 217px; */
}
.show-embed-item {
    overflow: hidden;
    transition: all .3s ease-in-out;
}

.show-embed-item iframe, .embed-wrap {
    height: 100% !important;
}
.embed-wrap {
    box-sizing: border-box;
    height: 100%;
    padding: 8px;
    width: 100%;
}
.embed-wrap-preview {
    height: 100%;
}
.page-item-wrap.show-embed .show-embed-item {
    overflow: visible;
}
.embed-wrap iframe, .embed-wrap-inside {
    border-radius: 52px;
   
}
.radius-0 {
    border-radius: 0px;
}

/* -------------------------------------------------------- */
.imagecontainer {
    min-height : 120px
 }
.embed-ind-arrow {
    height: 14px;
    margin-bottom: 16px;
    position: absolute;
    right: 24px;
    top: calc(50% - 7px);
}
.embed-ind-arrow-icon path {
    stroke: var(--btn-color);
}

.embed-ind-arrow-icon {
    transform: rotate(-90deg);
}
.contact_form.contact-expand .embed-ind-arrow-icon, .page-item-wrap.show-embed .embed-ind-arrow-icon, .show-article-embed.article-expand .embed-ind-arrow-icon {
    transform: rotate(0deg);
}
.embed-ind-arrow-icon {
    transition: all .4s ease-in-out;
}
.ql-align-right {
    text-align: right;
}

.ql-align-center {
    text-align: center;
}

.ql-align-justify {
    text-align: justify;
}

.ql-align-left {
    text-align: left;
}

/* --------------------------------------------------------------- */
        @media (max-width: 768px) {
                .page-full-wrap {
                    margin-top: 24px;
                    width: 90%;
                }
            }

@media only screen and (max-width: 600px) {
    #background_div {
        align-items: center;
        flex-direction: column;
        height: 100vh;
        height: 100svh;
        justify-content: space-between;
        overflow-y: auto;
    }
}
@media (max-width: 768px) {
    .page-full-wrap {
        margin-top: 24px;
        width: 90%;
    }
}
@media (max-width: 700px) {
    .formprofil {
        padding-top: 16px;
        width: 100%;
        height: 100vh;
    }
    .modalcontainer{
        width: 100%;
    }
    .full-modal{
        padding-left: 0; 
        padding-right: 0;
        height: 60px;
    }
}
      </style>
</head>
<body>


    <div class="flex-h-center min-h-full page-bg " id="background_div">

        <div class="relative page-full-wrap blog-container">

            
        @yield('content')
            
  

                <div class="page-logo text-center">
                    <a target="_blank" aria-label="Biolink" rel="" href="http://192.168.3.113:4126/login">
                        <img src="{{ env('API_URL') .'/storage/img/mylink.png' }}" alt="">
                        {{-- <svg class="sub-icon" fill="none" height="32" viewBox="0 0 32 32" width="32" xmlns="http://www.w3.org/2000/svg"><path class="bl-logo-br" opacity="0.5" clip-rule="evenodd" d="m1 1v30h30v-30zm-.333333-1c-.36819 0-.666667.298476-.666667.666666v30.666634c0 .3682.298476.6667.666666.6667h30.666634c.3682 0 .6667-.2985.6667-.6667v-30.666633c0-.36819-.2985-.666667-.6667-.666667zm8.047693 7.60626v1.71086c0 .23961-.1294.35942-.38818.35942h-1.17891v-2.42971h1.17891c.25878 0 .38818.11981.38818.35943zm0 3.82424v1.7828c0 .2396-.1294.3594-.38818.3594h-1.17891v-2.4872h1.17891c.14377 0 .24441.0287.30192.0862.0575.048.08626.1342.08626.2588zm.20128-5.59261h-3.79552v9.14371h3.79552c1.21726 0 1.82586-.5319 1.82586-1.5958v-1.7827c0-.6614-.2156-1.0735-.647-1.2365.4314-.1821.647-.62776.647-1.33702v-1.61022c0-1.05431-.6086-1.58147-1.82586-1.58147zm5.12666 0h-2.0416v9.14371h2.0416zm3.1094 0h1.9265c1.2077 0 1.8115.52716 1.8115 1.58147v5.96644c0 1.0639-.6038 1.5958-1.8115 1.5958h-1.9265c-1.2172 0-1.8258-.5319-1.8258-1.5958v-5.96644c0-1.05431.6086-1.58147 1.8258-1.58147zm1.6821 7.27471v-5.4057c0-.23962-.1246-.35943-.3738-.35943h-.6901c-.2588 0-.3881.11981-.3881.35943v5.4057c0 .2396.1293.3595.3881.3595h.6901c.2492 0 .3738-.1199.3738-.3595zm-9.03336 11.5684h-2.63098v-7.6341h-2.04153v9.1437h4.67251zm2.74736-7.6341h-2.0415v9.1437h2.0415zm5.1654 0h1.8833v9.1437h-1.8402l-1.9984-5.4776v5.4776h-1.869v-9.1437h1.8546l1.9697 5.4632zm7.3944 4.5143 1.8403-4.5143h-2.2141l-1.7683 4.5143 1.7683 4.6294h2.2141zm-4.2268-4.5143v9.1437h2.0415v-9.1437z" fill="#000000" fill-rule="evenodd"></path></svg>                    </a> --}}
                </div>
        </div>
    </div>
    
    @livewireScripts
 
  
</body>
</html>