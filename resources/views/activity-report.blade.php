@extends('layouts.master')
@section('title', 'Activtiy Report')
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
            <h5>Activity Report</h5>
            <h6 class="sub-heading">Reports <strong><?php echo date('M, d Y'); ?></h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <!-- <div class="right-actions">
            <a href="{{ route('banks.create') }}" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="left" title="Add Bank Details">
                <i class="icon-plus"></i>
              </a>
            </div> -->
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
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            </tr>
                        </thead>
                    </table>
                </div> 
            </div>
        </div>
    </div>
</div>


@endsection