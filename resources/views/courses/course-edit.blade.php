@extends('layouts.master')
@section('title', 'Editing '.$course->course_name)
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
            <h5>Edit Course</h5>
          <h6 class="sub-heading">Editing {{ $course->course_name }}</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('courses.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Course list">
                <i class="icon-office"></i>
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
      <div class="card-header">Edit Course</div>
      <div class="card-body">
        <form method="POST" action="{{ route('courses.update', $course->id) }}">
          @csrf @method('PUT')
        <div class="form-group row gutters">
          <label for="course_name" class="col-sm-3 col-form-label">Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="course_name" placeholder="Name" class="form-control @error('course_name') is-invalid @enderror" name="course_name" value="{{ old('course_name') ?? $course->course_name }}" required autocomplete="course_name" autofocus>
            @error('course_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>
        <div class="form-group row gutters">
          <label for="course_description" class="col-sm-3 col-form-label">Description</label>
          <div class="col-sm-9">
            <textarea id="course_description" rows="3" class="form-control @error('course_description') is-invalid @enderror" name="course_description" required autocomplete="course_description" autofocus>{{ old('course_description') ?? $course->course_description }}</textarea>
            @error('course_description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>
        <div class="form-group row gutters">
          <div class="col-sm-10">
            <a href="{{ route('courses.index') }}" class="btn btn-danger">Back</a>
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
