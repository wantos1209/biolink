<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('index.name', 'Laravel') }}</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Poppins&family=EB+Garamond&family=Teko&family=Balsamiq+Sans&family=Kite+One&family=PT+Sans&family=Quicksand&family=DM+Sans&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto&display=swap">


    <!-- Styles -->
    <style>
        :root {
        --primary-color: #0095f6;
        --secondary-color: #e0c088;
        --text-color: #ffffff;
        --sidebar-width: 35%;
        }
        .sortable-list {
        list-style: none;
        padding: 10px;
        background: #f7f7f7;
        min-height: 50px;
        border: 1px solid #ddd;
    }
    .sortable-item {
        background: white;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        
        /* cursor: grab; */
    }
    .sortable-item {
    /* cursor: grab !important; */
    }
    /* #linksList {
    display: block !important;
    position: relative !important;
} */

    </style>
    <link rel="stylesheet" href="css/style.css">

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body class="bg-gray-100">
    {{-- <div class="container mx-auto px-4"> --}}
        <!-- Navbar -->
        <nav class="">
           @include('layouts.header')
        </nav>
    
    
        
        <!-- Main Content -->
        <main class="main-content bg-black">
            @yield('content')
            
        </main>

        <footer>
            @include('layouts.footer')
        </footer>

    {{-- </div> --}}
    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    {{-- <script src="{{ asset('/js/script.js') }}"></script> --}}
    <script src="/js/script.js"></script>

</body>

</html>
