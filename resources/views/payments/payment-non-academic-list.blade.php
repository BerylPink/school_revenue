@extends('layouts.master')
@section('title', 'Non-Academic Staff Payment List')
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
            <h5>Non-Academic Staff Payment List</h5>
            <h6 class="sub-heading">All Non-Academic Staff payments made as of <strong><?php echo date('M, d Y'); ?></h6>
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
                <th>Name</th>
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
                <td>{{ $paymentList->firstname.' '.$paymentList->lastname }}</td>
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
<!-- Row end -->
  </div>

@endsection