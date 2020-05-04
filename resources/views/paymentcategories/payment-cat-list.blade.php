@extends('layouts.master')
@section('title', 'Payment Category List')
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
            <h5>Payment Category List</h5>
            <h6 class="sub-heading">All Payment Categories as of <strong><?php echo date('M, d Y'); ?></h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('payment-categories.create') }}" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="left" title="Add Payment Category">
                <i class="icon-plus"></i>
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
                <th>Name</th>
                <th>Description</th>
                <th>Date Created</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($paymentCategories as $paymentCategory)
              <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $paymentCategory->payment_category_name }}</td>
                <td>{{ $paymentCategory->payment_category_description }}</td>
                <td><?php $date = \Carbon\Carbon::parse($paymentCategory->created_at , 'UTC'); echo $date->isoFormat('MMMM Do YYYY h:mm:ssa'); ?></td>
                <td>
                  <div class="dropdown text-center">
                    <a class="btn btn-primary dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Select Action
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="{{ route('payment-categories.edit', ['payment-categories' => $paymentCategory->id]) }}" title="Edit {{ $paymentCategory->payment_category_name }}">
                          <span class="icon-edit text-warning"></span> 
                          Edit
                        </a>
                        <form method="POST" action="{{ route('payment-categories.destroy', ['payment-categories' => $paymentCategory->id]) }}">
                          @csrf @method('DELETE')
                          <button type="submit" class="dropdown-item" href=""   title="Delete {{ $paymentCategory->payment_category_name }}">
                          <span class="icon-bin text-danger"></span> 
                          Delete
                          </button>
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
