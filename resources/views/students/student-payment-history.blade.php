@extends('layouts.master')
@section('title', 'My Payment History')
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
            <h5>Payment History </h5>
            <h6 class="sub-heading">Payment History as of <strong><?php echo date('M, d Y'); ?></h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            
            </div>
          </div>
      </div>
    </div>
  </header>
  <!-- END: .main-heading -->

  <div class="main-content">
    <!-- Row start -->
    <div class="row gutters">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
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
                  <td>{{ $paymentHistory->amount_paid }}</td>
                  <td><?php $date = \Carbon\Carbon::parse($paymentHistory->created_at , 'UTC'); echo $date->isoFormat('MMMM Do YYYY h:mm:ssa'); ?></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Row end -->
 </div>

@endsection