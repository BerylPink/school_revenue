@extends('layouts.master')
@section('title', 'Editing '.$bank->account_name)
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
            <h5>Edit Bank Details</h5>
          <h6 class="sub-heading">Editing {{ $bank->account_name }}</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('banks.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Bank details list">
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
      <div class="card-header">Edit Bank Details</div>
      <div class="card-body">
        <form method="POST" action="{{ route('banks.update', $bank->id) }}">
          @csrf @method('PUT')
        <div class="form-group row gutters">
          <label for="bank_name" class="col-sm-3 col-form-label">Bank Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="bank_name" placeholder="Bank Name" class="form-control" name="bank_name" value="{{ old('bank_name') ?? $bank->bank_name }}">
          </div>
        </div>
        
        <div class="form-group row gutters">
          <label for="account_name" class="col-sm-3 col-form-label">Account Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="account_name" placeholder="Account Name" class="form-control" name="account_name" value="{{ old('account_name') ?? $bank->account_name }}">
          </div>
        </div>

      <div class="form-group row gutters">
        <label for="account_number" class="col-sm-3 col-form-label">Account Number</label>
        <div class="col-sm-9">
          <input type="tel" axlength="10" class="form-control" id="account_number" placeholder="Account Number" class="form-control" name="account_number" value="{{ old('account_number') ?? $bank->account_number }}">
        </div>
      </div>

        <div class="form-group row gutters">
          <div class="col-sm-10">
            <a href="{{ route('banks.index') }}" class="btn btn-danger">Back</a>
            <button type="submit" class="btn btn-primary">Update</button>
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
