@extends('layouts.master')

@section('title', 'Dashboard')
@section('content')
@include('partials._messages')
<!-- BEGIN .main-heading -->
<header class="main-heading">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
          <div class="page-icon">
            <i class="icon-library"></i>
          </div>
          <div class="page-title">
            <h5>Dashboard</h5>
            <h6 class="sub-heading">An overview of all features</h6>
          </div>
        </div>
        {{-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
          <div class="right-actions">
            <a href="#" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="left" title="Download Reports">
              <i class="icon-download4"></i>
            </a>
          </div>
        </div> --}}
      </div>
    </div>
  </header>
  <!-- END: .main-heading -->

  <div class="main-content">
    <div class="row gutters">
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="stats-widget">
              <div class="stats-widget-header">
                <i class="icon-users"></i>
              </div>
              <div class="stats-widget-body">
                <!-- Row start -->
                <ul class="row no-gutters">
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h6 class="title">Students</h6>
                  </li>
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                  <h4 class="total">{{ $totalStudents }}</h4>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="stats-widget">
              <div class="stats-widget-header">
                <i class="icon-clipboard"></i>
              </div>
              <div class="stats-widget-body">
                <!-- Row start -->
                <ul class="row no-gutters">
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h6 class="title">Academic Staffs</h6>
                  </li>
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h4 class="total">{{ $totalAcademicStaffs }}</h4>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="stats-widget">
              
              <div class="stats-widget-header">
                <i class="icon-newspaper"></i>
              </div>
              <div class="stats-widget-body">
                <!-- Row start -->
                <ul class="row no-gutters">
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h6 class="title">Non-Academic Staffs</h6>
                  </li>
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h4 class="total">{{ $totalNonAcademicStaffs }}</h4>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>

    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="stats-widget">
              <div class="stats-widget-header">
                <i class="icon-note_add"></i>
              </div>
              <div class="stats-widget-body">
                <!-- Row start -->
                <ul class="row no-gutters">
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h6 class="title">Current Expenses</h6>
                  </li>
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                  <h4 class="total">&#8358;{{ number_format($expenses) }}</h4>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="stats-widget">
              <div class="stats-widget-header">
                <i class="icon-note_add"></i>
              </div>
              <div class="stats-widget-body">
                <!-- Row start -->
                <ul class="row no-gutters">
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h6 class="title">Expenses Balance</h6>
                  </li>
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                  <h4 class="total">&#8358;{{ number_format($balance) }}</h4>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="stats-widget">
              <div class="stats-widget-header">
                <i class="icon-clipboard"></i>
              </div>
              <div class="stats-widget-body">
                <!-- Row start -->
                <ul class="row no-gutters">
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h6 class="title">Expenses Budget</h6>
                  </li>
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h4 class="total">&#8358;{{ number_format($finances->expenses_budget) }}</h4>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="stats-widget">
              <div class="stats-widget-header">
                <i class="icon-calculator"></i>
              </div>
              <div class="stats-widget-body">
                <!-- Row start -->
                <ul class="row no-gutters">
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h6 class="title">School Fund</h6>
                  </li>
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h4 class="total">&#8358;{{ number_format($finances->school_fund) }}</h4>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>

    <div class="row gutters">
      <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col">
        <a href="{{ route('payments.academic_list') }}" class="block-140">
          <div class="icon violet">
            <i class="icon-credit-card"></i>
          </div>
        <h5>{{ $totalAcademicStaffPayment }}</h5>
          <p>Academic Staffs Payments</p>
        </a>
      </div>
      <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col">
        <a href="{{ route('payments.non_academic_list') }}" class="block-140">
          <div class="icon pink">
            <i class="icon-credit-card3"></i>
          </div>
          <h5>{{ $totalNonAcademicStaffPayment }}</h5>
          <p>Non-Academic Staffs Payments</p>
        </a>
      </div>
      <div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col">
        <a href="{{ route('payments.student_list') }}" class="block-140">
          <div class="icon success">
            <i class="icon-briefcase"></i>
          </div>
          <h5>{{ $totalStudentPayment }}</h5>
          <p>Students Payments</p>
        </a>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="stats-widget">
              <div class="stats-widget-header">
                <i class="icon-layers3"></i>
              </div>
              <div class="stats-widget-body">
                <!-- Row start -->
                <ul class="row no-gutters">
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h6 class="title">Student Payments</h6>
                  </li>
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h4 class="total">&#8358;{{ number_format($studentPayments) }}</h4>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection

@section('scripts')

@endsection