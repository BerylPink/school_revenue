@extends('layouts.master')
@section('title', 'Payment Gateway List')
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
            <h5>Payment Gateway List</h5>
            <h6 class="sub-heading">All Payment Gateways as of <strong><?php echo date('M, d Y'); ?></h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('gateways.create') }}" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="left" title="Add Payment Gateway">
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
              <th>Gateway Name</th>
              <th>Date Created</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($gateways as $gateway)
            <tr>
              <td>{{ ++$i }}</td>
              <td>{{ $gateway->gateway_name }}</td>
              <td><?php $date = \Carbon\Carbon::parse($gateway->created_at , 'UTC'); echo $date->isoFormat('MMMM Do YYYY h:mm:ssa'); ?></td>
              <td>
                <div class="dropdown text-center">
                  <a class="btn btn-primary dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select Action
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                      <a class="dropdown-item" href="{{ route('gateways.edit', ['gateways' => $gateway->id]) }}" title="Edit {{ $gateway->gateway_name }}">
                        <span class="icon-edit text-warning"></span> 
                        Edit
                      </a>
                      <form method="POST" action="{{ route('gateways.destroy', ['gateways' => $gateway->id]) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="dropdown-item" href=""   title="Delete {{ $gateway->gateway_name }}">
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
