@extends('layouts.master')
@section('title', 'Editing '.$academicStaff->firstname.' '.$academicStaff->lastname.' Profile')
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
            <div class="card-header">Edit {{ $academicStaff->firstname.' '.$academicStaff->lastname }}'s Profile</div>
            <div class="card-body">
                <form method="POST" action="{{ route('academics.update', $academicStaff->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname" class="col-form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" placeholder="First Name" class="form-control" name="firstname" value="{{ old('firstname') ?? $academicStaff->firstname }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Last Name" class="form-control" name="lastname" value="{{ old('firstname') ?? $academicStaff->lastname }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="phone_no" class="col-form-label">Phone Number</label>
                        <input id="phone_no" maxlength="11" type="tel" class="form-control" name="phone_no" placeholder="Phone Number" value="{{ old('phone_no') ?? $academicStaff->phone_no }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email" class="col-form-label">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') ?? $academicStaff->email }}" placeholder="Email">
                    </div>
                    <div class="form-group col-md-4">                  
                        <label for="dob" class="col-form-label">Date of Birth</label>
                        <input id="dob" class="form-control" name="dob" value="{{ old('dob') ?? $academicStaff->dob }}" required readonly autocomplete="dob" placeholder="Date of Birth">
                    </div>
                </div>

                <div class="form-row">
                    {{-- <div class="form-group col-md-4">                        
                        <label for="college_id" class="col-form-label">College</label>
                        <select id="college_id" name="college_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($colleges as $college)
                                <option value="{{ $college->id }}" @if($college->id == $academicStaff->college_id) selected @endif title="{{ $college->college_description }}">{{ $college->college_name }}</option>                                
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
                    </div> --}}
                    <div class="form-group col-md-12">         
                        <label for="courses_id" class="col-form-label">Course</label>
                        <select id="courses_id" name="courses_id[]" class="form-control" multiple required>
                            <option>Choose</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" @foreach($coursesArray as $courseArray) @if($course->id == $courseArray) selected @endif @endforeach title="{{ $course->course_description }}">{{ $course->course_name }}</option>                                
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="employee_number" class="col-form-label">Employee Number</label>
                        <input id="employee_number" maxlength="11" type="tel" class="form-control" name="employee_number" placeholder="Employee Number" value="{{ old('employee_number') ?? $academicStaff->employee_number }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gender" class="col-form-label">Gender</label>
                        <select id="gender" name="gender" class="form-control" required>
                            <option>Choose</option>
                            <option value="Female" @if($academicStaff->gender == 'Female') selected @endif>Female</option>
                            <option value="Male" @if($academicStaff->gender == 'Male') selected @endif>Male</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">                  
                        <label for="marital_status" class="col-form-label">Marital Status</label>
                        <select id="marital_status" name="marital_status" class="form-control" required>
                            <option>Choose</option>
                            <option value="single" @if($academicStaff->marital_status == 'Single') selected @endif>Single</option>
                            <option value="married" @if($academicStaff->marital_status == 'Married') selected @endif>Married</option>
                            <option value="divorced" @if($academicStaff->marital_status == 'Divorced') selected @endif>Divorced</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">                        
                        <label for="country_id" class="col-form-label">Country</label>
                        <select id="country_id" name="country_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->CountryID }}" @if($country->CountryID == $academicStaff->country_id) selected @endif>{{ $country->CountryName }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">                        
                        <label for="states_id" class="col-form-label">State</label>
                        <select id="states_id" name="states_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->StateID }}" @if($state->StateID == $academicStaff->states_id) selected @endif>{{ $state->StateName }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">         
                        <label for="date_joined" class="col-form-label">Date Joined</label>
                        <input id="date_joined" class="form-control" name="date_joined" value="{{ old('date_joined') ?? $academicStaff->date_joined }}" required readonly autocomplete="date_joined" placeholder="Date Joined">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="address" class="col-form-label">Address</label>
                    <textarea id="address" rows="3" class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address') ?? $academicStaff->address}}</textarea>
                </div>
                <a href="{{ route('academics.index') }}" class="btn btn-danger">Back</a>
                <button type="submit" class="btn btn-primary">Update</button>
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
