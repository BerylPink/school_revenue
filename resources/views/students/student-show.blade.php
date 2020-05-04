@extends('layouts.master')
@section('title', 'Showing '.$student->firstname.' '.$student->lastname.' Profile')
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
            <h5>Student Profile</h5>
            <h6 class="sub-heading">Displaying Student Profile</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('students.create') }}" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="left" title="Add Student">
                <i class="icon-user-plus"></i>
              </a>
              <a href="{{ route('students.edit', ['students' => $student->id]) }}" class="btn btn-danger float-right" data-toggle="tooltip" data-placement="left" title="Edit {{ $student->firstname.' '.$student->lastname }}">
                <i class="icon-edit"></i>
              </a>

              <a href="{{ route('students.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Students list">
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
                      @if($student->profile_avatar != 'default_avatar.png')
                          <a href="{{ asset('uploads/'.$student->profile_avatar) }}" class="effects">
                        @else
                          <a href="{{ asset('assets/img/default_avatar.png') }}" class="effects">
                        @endif
                        @if($student->profile_avatar != 'default_avatar.png')
                            <img class="avatar avatar-xl avatar-bordered img-responsive" src="{{ asset('uploads/'.$student->profile_avatar) }}" alt="User Thumb" style="width: 80px; height: 74px;"/>
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
                      <h5 class="mb-0"><a class="hover-primary text-white" href="#">{{ $student->firstname.' '.$student->lastname }}</a></h5>
                        <span>{{ $student->registration_number }}</span>
                      </div>
                    </div>
    
                    <ul class="flexbox flex-justified text-center py-20">
                      <li class="px-10">
                        <span class="opacity-60">Country</span><br>
                        <span class="font-size-20">{{ $student->CountryName }}</span>
                      </li>

                      <li class="px-10">
                        <span class="opacity-60">State</span><br>
                        <span class="font-size-20">{{ $student->StateName }}</span>
                      </li>
                      
                      <li class="pl-10">
                        <span class="opacity-60">Reg. Date</span><br>
                        <span class="font-size-20"><?php $date = \Carbon\Carbon::parse($student->created_at , 'UTC'); echo $date->isoFormat('MMMM Do YYYY'); ?></span>
                      </li>
                    </ul>
                  </div>
                </div>	
          
    
              <!-- Profile Image -->
              <div class="box">
                <div class="box-body box-profile">            
                  <div class="row gutters">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 row">
                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <div class="profile-user-info">
                          <p>Email :<span class="text-gray pl-10">{{ $student->email }}</span> </p>
                          <p>Phone :<span class="text-gray pl-10">{{ $student->phone_no }}</span></p>
                          <p>Gender :<span class="text-gray pl-10">{{ $student->gender }}</span></p>
                          <p>Address :<span class="text-gray pl-10">{{ $student->address }}</span></p>
                        </div>
                    </div>

                      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                          <div class="profile-user-info">
                            <p>Age :<span class="text-gray pl-10">{{ \Carbon\Carbon::parse($student->dob)->age}}</span> </p>
                            <p>College :<span class="text-gray pl-10">{{ $student->college_name }}</span></p>
                            <p>Department :<span class="text-gray pl-10">{{ $student->department_name }}</span></p>
                          </div>
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
            <div class="card-header">Payments History</div>
            <div class="card-body">
              <table id="basicExample" class="table table-bordered table-responsive">
                <thead class="thead-inverse">
                  <tr>
                    <th>S/N</th>
                    <th>Fee Type</th>
                    <th>Fee Category</th>
                    <th>Payment Gateway</th>
                    <th>Amount (₦)</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($paymentHistories as $paymentHistory)
                  <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $paymentHistory->fee_type_name }}</td>
                    <td>{{ $paymentHistory->fee_name }}</td>
                    <td>{{ $paymentHistory->payment_gateway_name }}</td>
                    <td>{{ number_format($paymentHistory->amount_paid )}}</td>
                    <td><?php $date = \Carbon\Carbon::parse($paymentHistory->created_at , 'UTC'); echo $date->isoFormat('MMMM Do YYYY h:mm:ssa'); ?></td>
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