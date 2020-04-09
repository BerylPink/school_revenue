@extends('layouts.master')
@section('title', 'Showing '.$hr->firstname.' '.$hr->lastname.' Profile')
@section('content')
@include('partials._messages')

<header class="main-heading">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
          <div class="page-icon">
            <i class="icon-library"></i>
          </div>
          <div class="page-title">
            <h5>Human Resources Profile</h5>
            <h6 class="sub-heading">Displaying Human Resources Profile</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('human-resource.create') }}" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="left" title="Add Human Resource">
                <i class="icon-user-plus"></i>
              </a>
              <a href="{{ route('human-resource.edit', ['human-resource' => $hr->id]) }}" class="btn btn-danger float-right" data-toggle="tooltip" data-placement="left" title="Edit {{ $hr->firstname.' '.$hr->lastname }}">
                <i class="icon-edit"></i>
              </a>

              <a href="{{ route('human-resource.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Human resources list">
                <i class="icon-users"></i>
              </a>

            </div>
          </div>
        </div>
    </div>
  </header>

  <div class="main-content">
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <div class="box card-inverse bg-img" style="background-image: url({{ asset('assets/img/unify-rainy.jpg') }}); padding-top: 200px">
                  <div class="flexbox align-items-center px-20" data-overlay="4">
                    <div class="flexbox align-items-center mr-auto">
                      @if($hr->profile_avatar != 'default_avatar.png')
                          <a href="{{ asset('uploads/'.$hr->profile_avatar) }}" class="effects">
                        @else
                          <a href="{{ asset('assets/img/default_avatar.png') }}" class="effects">
                        @endif
                        @if($hr->profile_avatar != 'default_avatar.png')
                            <img class="avatar avatar-xl avatar-bordered img-responsive" src="{{ asset('uploads/'.$hr->profile_avatar) }}" alt="User Thumb" style="width: 80px; height: 74px;"/>
                            <div class="overlay">
                              <span class="expand">+</span>
                            </div>
                        @else
                            <img class="avatar avatar-xl avatar-bordered img-responsive" src="{{ asset('assets/img/default_avatar.png') }}" alt="User Thumb" style="width: 80px; height: 74px;"/>
                            <div class="overlay">
                              <span class="expand">+</span>
                            </div>
                        @endif
                      </a>
                      <div class="pl-10 d-none d-md-block">
                      <h5 class="mb-0"><a class="hover-primary text-white" href="#">{{ $hr->firstname.' '.$hr->lastname }}</a></h5>
                        <span>Human Resources</span>
                      </div>
                    </div>
    
                    <ul class="flexbox flex-justified text-center py-20">
                      <li class="px-10">
                        <span class="opacity-60">State</span><br>
                        <span class="font-size-20">{{ $hr->StateName }}</span>
                      </li>
                      <li class="pl-10">
                        <span class="opacity-60">Date Joined</span><br>
                        <span class="font-size-20"><?php $date = \Carbon\Carbon::parse($hr->created_at , 'UTC'); echo $date->isoFormat('MMMM Do YYYY'); ?></span>
                      </li>
                    </ul>
                  </div>
                </div>	
          
    
              <!-- Profile Image -->
              <div class="box">
                <div class="box-body box-profile">            
                  <div class="row gutters">
                    <div class="col-md-8 col-12">
                      <div class="profile-user-info">
                        <p>Email :<span class="text-gray pl-10">{{ $hr->email }}</span> </p>
                        <p>Phone :<span class="text-gray pl-10">{{ $hr->phone_no }}</span></p>
                        <p>Gender :<span class="text-gray pl-10">{{ $hr->gender }}</span></p>
                        <p>Address :<span class="text-gray pl-10">{{ $hr->address }}</span></p>
                      </div>
                   </div>
                    </div>
                   </div>
                  </div>
                
            </div>
      </div>
  </div>
@endsection