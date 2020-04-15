@extends('layouts.master')
@section('title', 'Add Fee Category')
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
            <h5>Add Fee Category</h5>
            <h6 class="sub-heading">Create a new Fee Category</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('fee-categories.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Fee Category list">
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
      <div class="card-header">Create Department</div>
      <div class="card-body">
        <form method="POST" action="{{ route('fee-categories.store') }}">
          @csrf
        <div class="form-group row gutters">
          <label for="fee_name" class="col-sm-3 col-form-label">Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="fee_name" placeholder="" class="form-control @error('fee_name') is-invalid @enderror" name="fee_name" value="{{ old('fee_name') }}" required autocomplete="fee_name" autofocus>
            @error('fee_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>

        <div class="form-group row gutters">                        
          <label for="fee_type" class="col-sm-3 col-form-label">Fee Type</label>
          <div class="col-sm-9">
          <select id="fee_type" name="fee_type" class="form-control @error('fee_type') is-invalid @enderror" required>
              <option>Choose</option>
              @foreach ($feeTypes as $feeType)
                  <option value="{{ $feeType->id }}">{{ $feeType->fee_type_name }}</option>                                
              @endforeach
          </select>
          @error('fee_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
      </div>

      <div class="form-group row gutters">
        <label for="amount" class="col-sm-3 col-form-label">Amount</label>
        <div class="col-sm-9">
          <input type="tel" maxlength="11" class="form-control" id="amount" placeholder="" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount" autofocus>
          @error('amount')
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
