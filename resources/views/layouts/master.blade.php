<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Common CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/icomoon.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs4.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bs4-custom.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/gallery/gallery.css') }}" />
  {{-- <link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}"> --}}
  
  {{-- <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}" sizes="32x32"> --}}
  
  <title>@yield('title') - School Revenue</title>
</head>

<body>

  {{-- <body oncontextmenu="return false;"> --}}
  <!-- Loading starts -->
  {{-- <div id="loading-wrapper">
    <div id="loader">
      <div class="line1"></div>
      <div class="line2"></div>
      <div class="line3"></div>
      <div class="line4"></div>
      <div class="line5"></div>
      <div class="line6"></div>
    </div>
  </div> --}}
  <!-- Loading ends -->
      @include('partials._navbar')
      @include('partials._footer')

  </body>
</html>