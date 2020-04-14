@extends('layouts.master')
@section('title', 'Editing '.$academic->firstname.' '.$academic->lastname.' Profile')
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
            <h5>Edit Academic Staff</h5>
            <h6 class="sub-heading">Editng Academic Staff Profile</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('academics.create') }}" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="left" title="Add Academic Staff">
                <i class="icon-user-plus"></i>
              </a>
              <a href="{{ route('academics.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Academic Staff list">
                <i class="icon-users"></i>
              </a>
            </div>
          </div>
      </div>
    </div>
  </header>

  <div class="main-content">

    <!-- Row start -->
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">Edit {{ $academic->firstname.' '.$academic->lastname }}'s Profile</div>
            <div class="card-body">
                <form method="POST" action="{{ route('academics.update', $academic->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname" class="col-form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" placeholder="First Name" class="form-control" name="firstname" value="{{ old('firstname') ?? $academic->firstname }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Last Name" class="form-control" name="lastname" value="{{ old('firstname') ?? $academic->lastname }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="phone_no" class="col-form-label">Phone Number</label>
                        <input id="phone_no" maxlength="11" type="tel" class="form-control" name="phone_no" placeholder="Phone Number" value="{{ old('phone_no') ?? $academic->phone_no }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email" class="col-form-label">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') ?? $academic->email }}" placeholder="Email">
                    </div>
                    <div class="form-group col-md-4">                  
                        <label for="DOB" class="col-form-label">Date of Birth</label>
                        <input id="date" type="date" name="date" value="{{ old('date') }}" required autocomplete="date" placeholder="Date of Birth">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">                        
                        <label for="college_id" class="col-form-label">College</label>
                        <select id="college_id" name="college_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($colleges as $college)
                                <option value="{{ $college->id }}" @if($college->id == $academic->college_id) selected @endif title="{{ $college->college_description }}">{{ $college->college_name }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">                        
                        <label for="department_id" class="col-form-label">Department</label>
                        <select id="department_id" name="department_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" @if($department->id == $academic->department_id) selected @endif title="{{ $department->department_description }}">{{ $department->department_name }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">         
                        <label for="course_id" class="col-form-label">Course</label>
                        <select id="course_id" name="course_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" @if($course->id == $academic->course_id) selected @endif title="{{ $course->course_description }}">{{ $course->course_name }}</option>                                
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="employee_no" class="col-form-label">Employee Number</label>
                        <input id="employee_no" maxlength="11" type="tel" class="form-control" name="employee_no" placeholder="Employee Number" value="{{ old('employee_no') ?? $academic->employee_no }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gender" class="col-form-label">Gender</label>
                        <select id="gender" name="gender" class="form-control" required>
                            <option>Choose</option>
                            <option value="Female" @if($academic->gender == 'Female') selected @endif>Female</option>
                            <option value="Male" @if($academic->gender == 'Male') selected @endif>Male</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">                  
                        <label for="marital_status" class="col-form-label">Marital Status</label>
                        <select id="marital_status" name="marital_status" class="form-control" required>
                            <option>Choose</option>
                            <option value="single" @if($academic->marital_status == 'Single') selected @endif>Single</option>
                            <option value="married" @if($academic->marital_status == 'Married') selected @endif>Married</option>
                            <option value="divorced" @if($academic->marital_status == 'Divorced') selected @endif>Divorced</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">                        
                        <label for="country_id" class="col-form-label">Country</label>
                        <select id="country_id" name="country_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->CountryID }}" @if($country->CountryID == $academic->country_id) selected @endif>{{ $country->CountryName }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">                        
                        <label for="state_id" class="col-form-label">State</label>
                        <select id="state_id" name="state_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->StateID }}" @if($state->StateID == $academic->state_id) selected @endif>{{ $state->StateName }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">         
                        <label for="date_joined" class="col-form-label">Date Joined</label>
                        <input id="date" type="date" name="date" value="{{ old('date') }}" required autocomplete="date" placeholder="Date Joined">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="address" class="col-form-label">Address</label>
                    <textarea id="address" rows="3" class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address') ?? $academic->address}}</textarea>
                </div>
                <a href="{{ route('academics.index') }}" class="btn btn-danger">Back</a>
                <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
      </div>
    <!-- Row end -->
    </div>


@endsection
