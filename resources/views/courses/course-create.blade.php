@extends('layouts.master')
@section('title', 'Add Course')
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
            <h5>Add Course</h5>
            <h6 class="sub-heading">Create new Course</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('courses.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Course list">
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
      <div class="card-header">Create Course</div>
      <div class="card-body">
        <form method="POST" action="{{ route('courses.store') }}">
          @csrf
        <div class="form-group row gutters">
          <label for="course_name" class="col-sm-3 col-form-label">Course Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="course_name" placeholder="" class="form-control @error('course_name') is-invalid @enderror" name="course_name" value="{{ old('course_name') }}" required autocomplete="course_name" autofocus>
            @error('course_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>

        <div class="form-group row gutters">                        
          <label for="colleges_id" class="col-sm-3 col-form-label">College</label>
          <div class="col-sm-9">
          <select id="colleges_id" name="colleges_id" class="form-control @error('colleges_id') is-invalid @enderror" required>
              <option>Choose</option>
              @foreach ($colleges as $college)
                  <option value="{{ $college->id }}" title="{{ $college->college_description }}">{{ $college->college_name }}</option>                                
              @endforeach
          </select>
          @error('colleges_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
      </div>

      <div class="form-group row gutters">                        
          <label for="departments_id" class="col-sm-3 col-form-label">Department</label>
          <div class="col-sm-9">
          <select id="departments_id" name="departments_id" class="form-control @error('departments_id') is-invalid @enderror" required>
              <option>Choose</option>
          </select>
          @error('departments_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
      </div>

        <div class="form-group row gutters">
          <label for="course_description" class="col-sm-3 col-form-label">Course Description</label>
          <div class="col-sm-9">
            <textarea id="course_description" rows="3" class="form-control @error('course_description') is-invalid @enderror" name="course_description" required autocomplete="course_description" autofocus>{{ old('course_description') }}</textarea>
            @error('course_description')
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

  <script>
    $('#colleges_id').on('change',function () {
        let college_id = $('#colleges_id').find('option:selected').val();
        // console.log(state);
        $.ajaxSetup({
            headers: {
                'X-CSRF_TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ route('colleges.departments') }}",
            method: "GET",
            dataType: "JSON",
            data: {college_id:college_id},
            success: function(data){
                if(data){
                    $('#departments_id').html(data.collegeDepartment);
                }
            },
        })
    })
  </script>
@endsection
