@extends('layouts.master')
@section('title', 'Showing '.$nonAcademicStaff->firstname.' '.$nonAcademicStaff->lastname.' Profile')
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
            <h5>Non-Academic Staff Profile</h5>
            <h6 class="sub-heading">Displaying Non-Academic Staff Profile</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('nonacademics.create') }}" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="left" title="Add Non-Academic Staff">
                <i class="icon-user-plus"></i>
              </a>
              <a href="{{ route('nonacademics.edit', ['admins' => $nonAcademicStaff->id]) }}" class="btn btn-danger float-right" data-toggle="tooltip" data-placement="left" title="Edit {{ $nonAcademicStaff->firstname.' '.$nonAcademicStaff->lastname }}">
                <i class="icon-edit"></i>
              </a>

              <a href="{{ route('nonacademics.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Non-Academic Staff list">
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
          <div class="box card-inverse bg-img" style="background-image: url({{ asset('assets/img/unify-sunny.jpg') }}); padding-top: 200px">
                  <div class="flexbox align-items-center px-20" data-overlay="4">
                    <div class="flexbox align-items-center mr-auto">
                      <div class="pl-10 d-none d-md-block">
                      <h5 class="mb-0"><a class="hover-primary text-white" href="#">{{ $nonAcademicStaff->firstname.' '.$nonAcademicStaff->lastname }}</a></h5>
                        <span>Non-Academic Staff</span>
                      </div>
                    </div>
    
                    <ul class="flexbox flex-justified text-center py-20">
                      <li class="px-10">
                        <span class="opacity-60">ID Number</span><br>
                        <span class="font-size-20">{{ $nonAcademicStaff->employee_number }}</span>
                      </li>
                      <li class="px-10">
                        <span class="opacity-60">Category</span><br>
                        <span class="font-size-20">{{ $nonAcademicStaff->categories->category_name }}</span>
                      </li>
                      <li class="pl-10">
                        <span class="opacity-60">Date Joined</span><br>
                        <span class="font-size-20"><?php $date = \Carbon\Carbon::parse($nonAcademicStaff->date_joined , 'UTC'); echo $date->isoFormat('MMMM Do YYYY'); ?></span>
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
                        <p>Email :<span class="text-gray pl-10">{{ $nonAcademicStaff->email }}</span> </p>
                        <p>Phone :<span class="text-gray pl-10">{{ $nonAcademicStaff->phone_no }}</span></p>
                        <p>Gender :<span class="text-gray pl-10">{{ $nonAcademicStaff->gender }}</span></p>
                      </div>
                   </div>

                   <div class="col-md-6 col-6">
                        <div class="profile-user-info">
                          <p>Marital Status :<span class="text-gray pl-10">{{ $nonAcademicStaff->marital_status }}</span></p>
                          <p>Date of Birth :<span class="text-gray pl-10"><?php $date = \Carbon\Carbon::parse($nonAcademicStaff->dob , 'UTC'); echo $date->isoFormat('MMMM Do YYYY'); ?></span></p>
                          <p>Address :<span class="text-gray pl-10">{{ $nonAcademicStaff->address }}</span></p>
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
            <div class="card-header">{{ $nonAcademicStaff->firstname.' '.$nonAcademicStaff->lastname }}'s Payments History</div>
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
                  @foreach($paymentLists as $paymentList)
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
                            <a class="dropdown-item" href="{{ route('payments.non_academic_show', ['payments.non_academic_show' => $paymentList->id]) }}" title="More details on {{ $paymentList->firstname.' '.$paymentList->lastname }}">
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