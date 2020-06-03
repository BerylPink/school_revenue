@extends('layouts.master')
@section('title', $academicPayment->firstname.' '.$academicPayment->lastname.' Details')
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
            <h5>Non-Academic Payment Details</h5>
            <h6 class="sub-heading"> Payment made to {{ $academicPayment->firstname.' '.$academicPayment->lastname }} on <?php $date = \Carbon\Carbon::parse($academicPayment->created_at , 'UTC'); echo $date->isoFormat('MMMM Do YYYY h:mm:ssa'); ?></h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('payments.non_academic_list') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Non-Academic Payments List">
                <i class="icon-credit-card"></i>
              </a>
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
              <th>Payment Category</th>
              <th>Amount (₦)</th>
              <th>Paid By</th>
            </tr>
          </thead>
          <tbody>
            @foreach($paymentDetails as $paymentDetail)
            <tr>
              <td>{{ ++$i }}</td>
              <td>{{ $paymentDetail->payment_category_name }}</td>
              <td>{{ number_format($paymentDetail->amount) }}</td>
              <td>{{ $createdBy }}</td>
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
