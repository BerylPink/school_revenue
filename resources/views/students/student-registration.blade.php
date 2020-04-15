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
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
        <div class="right-actions">
            <a href="{{ route('students.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Students list">
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
                        <label for="dob" class="col-form-label">Date of Birth</label>
                        <input id="dob" type="dob" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required readonly placeholder="Date of Birth">
                        @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">                        
                        <label for="colleges_id" class="col-form-label">College</label>
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
                    <div class="form-group col-md-4">
                        <label for="departments_id" class="col-form-label">Department</label>
                        <select id="departments_id" name="departments_id" class="form-control @error('departments_id') is-invalid @enderror" required>
                            <option value="">Choose</option>                                
                        </select>                        
                        @error('departments_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">         
                        <label for="profile_avatar" class="col-form-label">Registration Number</label>
                        <input type="text" class="form-control" id="registration_number" placeholder="Registration Number" class="form-control @error('registration_number') is-invalid @enderror" name="registration_number" value="{{ old('registration_number') }}" required autocomplete="registration_number" maxlength="11" autofocus>
                        @error('registration_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">                        
                        <label for="countries_id" class="col-form-label">Country</label>
                        <select id="countries_id" name="countries_id" class="form-control @error('countries_id') is-invalid @enderror" required>
                            <option>Choose</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->CountryID }}">{{ $country->CountryName }}</option>                                
                            @endforeach
                        </select>
                        @error('countries_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">                        
                        <label for="states_id" class="col-form-label">State</label>
                        <select id="states_id" name="states_id" class="form-control @error('states_id') is-invalid @enderror" required>
                            <option>Choose</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->StateID }}">{{ $state->StateName }}</option>                                
                            @endforeach
                        </select>
                        @error('states_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">         
                        <label for="gender" class="col-form-label">Gender</label>
                        <select id="gender" name="gender" class="form-control @error('states_id') is-invalid @enderror" required>
                            <option>Choose</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="profile_avatar" class="col-form-label">Profile Avatar</label>
                        {{-- <label class="custom-file"> --}}
                            <input type="file" accept="image/x-png,image/gif,image/jpeg" id="profile_avatar" name="profile_avatar" class="custom-file-input">
                            <span class="custom-file-control"></span>
                        {{-- </label> --}}
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password" class="col-form-label">Password</label>
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

    $('#countries_id').on('change',function () {
        let country_id = $('#countries_id').find('option:selected').val();
        if(country_id != 156){
            $('#states_id').prop('selectedIndex', 1).val();
        }else{
            $('#states_id').prop('selectedIndex', 0).val();
        }
    })

</script>
@endsection
