@extends('layouts.master')
@section('title', 'Student Registration')
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
            <h5>Student Registration</h5>
            <h6 class="sub-heading">Create a new Student Profile</h6>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="main-content">

    <!-- Row start -->
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">Create Profile</div>
            <div class="card-body">
                <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                    @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname" class="col-form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" placeholder="First Name" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                        @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Last Name" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="phone_no" class="col-form-label">Phone Number</label>
                        <input id="phone_no" maxlength="11" type="tel" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ old('phone_no') }}" required autocomplete="phone_no" autofocus placeholder="Phone Number">

                        @error('phone_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email" class="col-form-label">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-group col-md-4">                        
                        <label for="DOB" class="col-form-label">Date of Birth</label>
                        <input id="date" type="date" name="date" value="{{ old('date') }}" required autocomplete="date" placeholder="Date of Birth">
                        <!-- @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror -->
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">                        
                        <label for="college_id" class="col-form-label">College</label>
                        <select id="college_id" name="college_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($colleges as $college)
                                <option value="{{ $college->id }}" title="{{ $college->college_description }}">{{ $college->college_name }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="department_id" class="col-form-label">Department</label>
                        <select id="department_id" name="department_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($departmentss as $department)
                                <option value="{{ $department->id }}" title="{{ $department->department_description }}">{{ $department->department_name }}</option>                                
                            @endforeach
                        </select>                        
                        
                    </div>
                    <div class="form-group col-md-4">         
                        <label for="profile_avatar" class="col-form-label">Admission Number</label>
                        <input type="text" class="form-control" id="admission_no" placeholder="Admission Number" class="form-control @error('admission_no') is-invalid @enderror" name="admission_no" value="{{ old('admission_no') }}" required autocomplete="admission_no" autofocus>
                        @error('admission_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">                        
                        <label for="country_id" class="col-form-label">Country</label>
                        <select id="country_id" name="country_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->CountryID }}">{{ $country->CountryName }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">                        
                        <label for="state_id" class="col-form-label">State</label>
                        <select id="state_id" name="state_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->StateID }}">{{ $state->StateName }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">         
                        <label for="gender" class="col-form-label">Gender</label>
                        <select id="gender" name="gender" class="form-control" required>
                            <option>Choose</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="admission_date" class="col-form-label">Admission Date</label>
                        <input id="admission_date" type="admission_date" name="admission_date" value="{{ old('admission_date') }}" required autocomplete="admission_date" placeholder="Admission Date">
                        <!-- @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror -->
                    </div>
                    <div class="form-group col-md-6">
                        <label for="profile_avatar" class="col-form-label">Profile Avatar</label>
                        <label class="custom-file">
                            <input type="file" id="profile_avatar" name="profile_avatar" class="custom-file-input">
                            <span class="custom-file-control"></span>
                        </label>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname" class="col-form-label">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirm_password" class="col-form-label">Confirm Password</label>
                        <input id="confirm_assword" type="password" class="form-control" name="confirm_password" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-form-label">Address</label>
                    <textarea id="address" rows="3" class="form-control @error('address') is-invalid @enderror" name="address"  required autocomplete="address" autofocus>{{ old('address') }}</textarea>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
      </div>
    <!-- Row end -->
    </div>


@endsection
