<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
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

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-orange.min.css" />
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

    <link href="{{ asset('css/app.css') }}?<?php echo time();?>" rel="stylesheet">
    <link href="{{ url('/') }}/css/main.css?<?php echo time();?>" rel="stylesheet">
    <script src="{{ URL::asset('js/app.js') }}"></script>
</head>
<body>
    <div id="app">

       

        <!-- Display for the notification flash send to the user -->
        @include('partials.notifyFlash')

         <!-- Navbar -->
        @include('partials.nav')

            <div class="page-content"><!-- Your content goes here -->  @yield('content')</div>
          </main>
        </div>
        <!-- Content spesifikt til hver underside -->
        <!--<div class="container">
            <div class="row">
                <div class="panel panel-default">
                   
                </div>
            </div>
        </div>-->
    </div>

    <!-- Footer -->
    @include('partials.footer')
    <!-- Scripts -->
    <script src="{{ URL::asset('js/freebies.js') }}"></script>
    <script src="{{ URL::asset('js/ajax.js') }}"></script>
    <script src="{{ URL::asset('js/deleteAlert.js') }}"></script>
</body>
</html>
