@extends('layouts.master')
@section('title', $student->firstname.' '.$student->lastname)
@section('content')
@include('partials._messages')
<!-- Styles -->
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
<header class="main-heading">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
          <div class="page-icon">
            <i class="icon-library"></i>
          </div>
          <div class="page-title">
            <h5>Dahboard</h5>
            <h6 class="sub-heading">{{ $student->firstname.' '.$student->lastname }} Dashboard</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
        {{-- <div class="right-actions">
            <a href="{{ route('students.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Students list">
            <i class="icon-users"></i>
            </a>

        </div> --}}
        </div>
      </div>
    </div>
  </header>

  <div class="main-content">
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                <i>Coming soon...</i>
            </div>

        </div>
    </div>
  </div>


@endsection