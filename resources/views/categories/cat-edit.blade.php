@extends('layouts.master')
@section('title', 'Editing '.$category->category_name)
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
            <h5>Edit Non-Academic Staff Category</h5>
          <h6 class="sub-heading">Editing {{ $category->category_name }}</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('categories.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Non-Academic Staff Category list">
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
      <div class="card-header">Edit Non-Academic Staff Category</div>
      <div class="card-body">
        <form method="POST" action="{{ route('categories.update', $category->id) }}">
          @csrf @method('PUT')
        <div class="form-group row gutters">
          <label for="category_name" class="col-sm-3 col-form-label">Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="category_name" placeholder="Name" class="form-control" name="category_name" value="{{ old('category_name') ?? $category->category_name }}">
          </div>
        </div>
        
        <div class="form-group row gutters">
          <label for="category_description" class="col-sm-3 col-form-label">Description</label>
          <div class="col-sm-9">
            <textarea id="category_description" rows="3" class="form-control @error('category_description') is-invalid @enderror" name="category_description" required autocomplete="category_description" autofocus>{{ old('category_description') ?? $category->category_description }}</textarea>
            @error('category_description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>

        <div class="form-group row gutters">
          <div class="col-sm-10">
            <a href="{{ route('categories.index') }}" class="btn btn-danger">Back</a>
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
