<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <!--Standard stuff -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Jquery and UI-->
    <script src="{{asset('jquery-ui/external/jquery/jquery.js')}}"></script>
    <link rel="stylesheet" href="{{asset('jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('jquery-ui/jquery-ui.structure.min.css')}}">
    <link rel="stylesheet" href="{{asset('jquery-ui/jquery-ui.theme.min.css')}}">
    <script src="{{asset('jquery-ui/jquery-ui.min.js')}}"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Tab title -->
    <title>{{ config('app.name', 'Colorlab booking') }}</title>


    
    
    
    <!-- Styles -->
    <link href="{{ asset('css/normalize.css') }}?<?php echo time();?>" rel="stylesheet">

    <!--Bootstrap (not in use) -->
    <!--<link href="{{ asset('css/app.css') }}?<?php echo time();?>" rel="stylesheet">
    <script src="{{ URL::asset('js/app.js') }}"></script>-->
    
    
    <!-- GETMDL.IO-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-orange.min.css" />
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">

    <!--Font awesome -->
    <!--<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>-->

    <!-- Our css -->
    <link href="{{ url('/') }}/css/style.css?<?php echo time();?>" rel="stylesheet">
</head>
<body>
    <div id="app">
    
        <!-- Display for the notification flash send to the user -->
        @include('partials.notifyFlash')

         <!-- Navbar -->
        @include('partials.nav')

            <div class="page-content"><!-- Your content goes here -->  
                @yield('content')<!-- Content for each page -->
            </div>
          </main>
        </div>
        
    </div>

    <!-- Footer -->
    @include('partials.footer')
    <!-- Scripts -->
    <script src="{{ URL::asset('js/freebies.js') }}"></script>
    <script src="{{ URL::asset('js/ajax.js') }}"></script>
    <script src="{{ URL::asset('js/deleteAlert.js') }}"></script>
</body>
</html>
