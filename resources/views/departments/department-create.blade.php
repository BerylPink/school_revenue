@extends('layouts.master')
@section('title', 'Add Department')
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
            <h5>Add Department</h5>
            <h6 class="sub-heading">Create a new Department</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('departments.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Department list">
                <i class="icon-books"></i>
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
        <form method="POST" action="{{ route('colleges.store') }}">
          @csrf
        <div class="form-group row gutters">
          <label for="college_name" class="col-sm-3 col-form-label">Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="college_name" placeholder="" class="form-control @error('college_name') is-invalid @enderror" name="college_name" value="{{ old('college_name') }}" required autocomplete="college_name" autofocus>
            @error('college_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>

        <div class="form-group row gutters">                        
          <label for="colleges_id" class="col-sm-3 col-form-label">College</label>
          <div class="col-sm-9">
          <select id="colleges_id" name="colleges_id" class="form-control" required>
              <option>Choose</option>
              @foreach ($colleges as $college)
                  <option value="{{ $college->id }}" title="{{ $college->college_description }}">{{ $college->college_name }}</option>                                
              @endforeach
          </select>
          </div>
      </div>

        <div class="form-group row gutters">
          <label for="college_description" class="col-sm-3 col-form-label">Description</label>
          <div class="col-sm-9">
            <textarea id="college_description" rows="3" class="form-control @error('college_description') is-invalid @enderror" name="college_description" required autocomplete="college_description" autofocus>{{ old('college_description') }}</textarea>
            @error('college_description')
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
