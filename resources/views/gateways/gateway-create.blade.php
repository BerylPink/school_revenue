@extends('layouts.master')
@section('title', 'Add Payment Gateway')
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
            <h5>Add Payment Gateway</h5>
            <h6 class="sub-heading">Create a new Payment Gateway</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('gateways.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Gateway list">
                <i class="icon-tree"></i>
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
      <div class="card-header">Create Payment Gateway</div>
      <div class="card-body">
        <form method="POST" action="{{ route('gateways.store') }}">
          @csrf
        <div class="form-group row gutters">
          <label for="gateway_name" class="col-sm-3 col-form-label">Gateway Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="gateway_name" placeholder="" class="form-control @error('gateway_name') is-invalid @enderror" name="gateway_name" value="{{ old('gateway_name') }}" required autocomplete="gateway_name" autofocus>
            @error('gateway_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>

        
        <div class="form-group row gutters">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Row end -->
  </div>
@endsection
