@extends('layouts.master')
@section('title', 'Showing '.$academicStaff->firstname.' '.$academicStaff->lastname.' Profile')
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
            <h5>Academic Staff Profile</h5>
            <h6 class="sub-heading">Displaying Academic Staff Profile</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('academics.create') }}" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="left" title="Add Admin">
                <i class="icon-user-plus"></i>
              </a>
              <a href="{{ route('academics.edit', ['admins' => $academicStaff->id]) }}" class="btn btn-danger float-right" data-toggle="tooltip" data-placement="left" title="Edit {{ $academicStaff->firstname.' '.$academicStaff->lastname }}">
                <i class="icon-edit"></i>
              </a>

              <a href="{{ route('academics.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Academic Staff list">
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
          <div class="box card-inverse bg-img" style="background-image: url({{ asset('assets/img/unify-cloudy.jpg') }}); padding-top: 200px">
                  <div class="flexbox align-items-center px-20" data-overlay="4">
                    <div class="flexbox align-items-center mr-auto">
                      {{-- @if($academicStaff->profile_avatar != 'default_avatar.png')
                          <a href="{{ asset('uploads/'.$academicStaff->profile_avatar) }}" class="effects">
                        @else
                          <a href="{{ asset('assets/img/default_avatar.png') }}" class="effects">
                        @endif
                        @if($academicStaff->profile_avatar != 'default_avatar.png')
                            <img class="avatar avatar-xl avatar-bordered img-responsive" src="{{ asset('uploads/'.$academicStaff->profile_avatar) }}" alt="User Thumb" style="width: 80px; height: 74px;"/>
                            <div class="overlay">
                              <span class="expand">+</span>
                            </div>
                        @else
                            <img class="avatar avatar-xl avatar-bordered img-responsive" src="{{ asset('assets/img/default_avatar.png') }}" alt="User Thumb" style="width: 80px; height: 74px;"/>
                            <div class="overlay">
                              <span class="expand">+</span>
                            </div>
                        @endif
                      </a> --}}
                      <div class="pl-10 d-none d-md-block">
                      <h5 class="mb-0"><a class="hover-primary text-white" href="#">{{ $academicStaff->firstname.' '.$academicStaff->lastname }}</a></h5>
                        <span>Academic Staff</span>
                      </div>
                    </div>
    
                    <ul class="flexbox flex-justified text-center py-20">
                      <li class="px-10">
                        <span class="opacity-60">ID Number</span><br>
                        <span class="font-size-20">{{ $academicStaff->employee_number }}</span>
                      </li>
                      <li class="px-10">
                        <span class="opacity-60">State</span><br>
                        <span class="font-size-20">{{ $academicStaff->state->StateName }}</span>
                      </li>
                      <li class="pl-10">
                        <span class="opacity-60">Date Joined</span><br>
                        <span class="font-size-20"><?php $date = \Carbon\Carbon::parse($academicStaff->date_joined , 'UTC'); echo $date->isoFormat('MMMM Do YYYY'); ?></span>
                      </li>
                    </ul>
                  </div>
                </div>	
          
    
              <!-- Profile Image -->
              <div class="box">
                <div class="box-body box-profile">            
                  <div class="row gutters">
                    <div class="col-md-6 col-6">
                      <div class="profile-user-info">
                        <p>Email :<span class="text-gray pl-10">{{ $academicStaff->email }}</span> </p>
                        <p>Phone :<span class="text-gray pl-10">{{ $academicStaff->phone_no }}</span></p>
                        <p>Gender :<span class="text-gray pl-10">{{ $academicStaff->gender }}</span></p>
                        <p>Address :<span class="text-gray pl-10">{{ $academicStaff->address }}</span></p>
                      </div>
                   </div>

                   <div class="col-md-6 col-6">
                        <div class="profile-user-info">
                          <p>Courses Handled:<span class="text-gray pl-10">
                            <ul>
                            @foreach($courses as $course)
                              <li class="text-gray">{{ $course->course_name }}({{ $course->course_code }})</li>
                            @endforeach
                            </ul>
                          </span> </p>
                          <p>Marital Status :<span class="text-gray pl-10">{{ $academicStaff->marital_status }}</span></p>
                          <p>Date of Birth :<span class="text-gray pl-10"><?php $date = \Carbon\Carbon::parse($academicStaff->dob , 'UTC'); echo $date->isoFormat('MMMM Do YYYY'); ?></span></p>
                          {{-- <p>Address :<span class="text-gray pl-10">{{ $academicStaff->address }}</span></p> --}}
                        </div>
                    </div>
                    </div>
                   </div>
                  </div>
                
            </div>
      </div>

      <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header">{{ $academicStaff->firstname.' '.$academicStaff->lastname }}'s Payments History</div>
            <div class="card-body">
              <table id="basicExample" class="table table-bordered table-responsive">
                <thead class="thead-inverse">
                  <tr>
                    <th>S/N</th>
                    <th>Payment Category</th>
                    <th>Amount (₦)</th>
                    <th>Date Created</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($academicPaymentLists as $paymentList)
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $paymentList->payment_category_name }}</td>
                    <td>{{ number_format($paymentList->amount) }}</td>
                    <td><?php $date = \Carbon\Carbon::parse($paymentList->created_at , 'UTC'); echo $date->isoFormat('MMMM Do YYYY h:mm:ssa'); ?></td>
                    <td>
                      <div class="dropdown text-center">
                        <a class="btn btn-primary dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Select Action
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="{{ route('payments.academic_show', ['payments.academic_list' => $paymentList->id]) }}" title="More details on {{ $paymentList->firstname.' '.$paymentList->lastname }}">
                                <span class="icon-profile text-primary"></span> 
                                Details
                              </a>
                            </form>
    
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection