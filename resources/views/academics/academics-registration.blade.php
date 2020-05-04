@extends('layouts.master')
@section('title', 'Academic Staff Registration')
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
            <h5>Academic Staff Registration</h5>
            <h6 class="sub-heading">Create a new Academic Staff Profile</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
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
            <div class="card-header">Create Profile</div>
            <div class="card-body">
                <form method="POST" action="{{ route('academics.store') }}" enctype="multipart/form-data">
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
                        <input id="dob" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required readonly placeholder="Date of Birth">
                        @error('dob')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
                    </div>
                </div>

                <div class="form-row">
                    {{-- <div class="form-group col-md-4">                        
                        <label for="college_id" class="col-form-label">College</label>
                        <select id="college_id" name="college_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($colleges as $college)
                                <option value="{{ $college->id }}" title="{{ $college->college_description }}">{{ $college->college_name }}</option>                                
                            @endforeach
                        </select>
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
                    </div> --}}
                    <div class="form-group col-md-12">        
                         
                        <label for="courses_id" class="col-form-label">Course</label>
                        <select id="courses_id" name="courses_id[]" class="form-control" multiple required>
                            <option>Choose</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" title="{{ $course->course_description }}">{{ $course->course_name }}</option>                                
                            @endforeach
                        </select>   
                        <small class="text-danger">*Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.</small> 
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="employee_number" class="col-form-label">Employee Number</label>
                        <input id="employee_number" maxlength="11" type="tel" class="form-control @error('employee_number') is-invalid @enderror" name="employee_number" value="{{ old('employee_number') }}" required autocomplete="employee_number" autofocus placeholder="Employee Number">

                        @error('employee_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-4">         
                        <label for="gender" class="col-form-label">Gender</label>
                        <select id="gender" name="gender" class="form-control @error('gender') is-invalid @enderror" required>
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
                    
                    <div class="form-group col-md-4">         
                        <label for="marital_status" class="col-form-label">Marital Status</label>
                        <select id="marital_status" name="marital_status" class="form-control" required>
                            <option>Choose</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                        </select>
                        @error('marital_status')
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
                        <label for="states_id" class="col-form-label">State</label>
                        <select id="states_id" name="states_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->StateID }}">{{ $state->StateName }}</option>                                
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">                        
                        <label for="date_joined" class="col-form-label">Date Joined</label>
                        <input id="date_joined" class="form-control @error('date_joined') is-invalid @enderror" name="date_joined" value="{{ old('date_joined') }}" required readonly placeholder="Date Joined">
                        @error('date_joined')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror 
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
     
         $('#country_id').on('change',function () {
             let country_id = $('#country_id').find('option:selected').val();
             if(country_id != 156){
                 $('#states_id').prop('selectedIndex', 1).val();
             }else{
                 $('#states_id').prop('selectedIndex', 0).val();
             }
         })
     
     </script>

@endsection
