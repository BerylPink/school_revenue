@extends('layouts.master')
@section('title', 'Editing '.$student->firstname.' '.$student->lastname.' Profile')
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
            <h5>Student Profile</h5>
            <h6 class="sub-heading">Edit my Profile</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
        <div class="right-actions">
            {{-- <a href="{{ route('students.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Students list">
            <i class="icon-users"></i>
            </a> --}}

        </div>
        </div>
      </div>
    </div>
  </header>

  <div class="main-content">

    <!-- Row start -->
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header">Edit My Profile</div>
            <div class="card-body">
                <form method="POST" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname" class="col-form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" placeholder="First Name" class="form-control" name="firstname" value="{{ old('firstname') ?? $student->firstname }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Last Name" class="form-control" name="lastname" value="{{ old('lastname') ?? $student->lastname }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="phone_no" class="col-form-label">Phone Number</label>
                        <input id="phone_no" maxlength="11" type="tel" class="form-control" name="phone_no" value="{{ old('phone_no') ?? $student->phone_no }}" placeholder="Phone Number">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email" class="col-form-label">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') ?? $student->email }}" placeholder="Email">
                    </div>
                    <div class="form-group col-md-4">                        
                        <label for="dob" class="col-form-label">Date of Birth</label>
                        <input id="dob" type="dob" class="form-control" name="dob" value="{{ old('dob') ?? $student->dob }}"  placeholder="Date of Birth">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">                        
                        <label for="countries_id" class="col-form-label">Country</label>
                        <select id="countries_id" name="countries_id" class="form-control">
                            <option>Choose</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->CountryID }}" @if($country->CountryID == $student->countries_id ) selected @endif>{{ $country->CountryName }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">                        
                        <label for="states_id" class="col-form-label">State</label>
                        <select id="states_id" name="states_id" class="form-control">
                            <option>Choose</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->StateID }}" @if($state->StateID == $student->states_id ) selected @endif>{{ $state->StateName }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">         
                        <label for="gender" class="col-form-label">Gender</label>
                        <select id="gender" name="gender" class="form-control">
                            <option>Choose</option>
                            <option value="Female" @if($student->gender == 'Female') selected @endif>Female</option>
                            <option value="Male" @if($student->gender == 'Male') selected @endif>Male</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">         
                        <label for="profile_avatar" class="col-form-label">Registration Number</label>
                        <input type="text" class="form-control" id="registration_number" placeholder="Registration Number" class="form-control" name="registration_number" value="{{ old('registration_number') ?? $student->registration_number }}" readonly maxlength="11">
                    </div>

                    <div class="form-group col-md-6" style="margin-top: 2.23rem!important;">
                        {{-- <label for="profile_avatar" class="col-form-label">Profile Avatar</label> --}}
                        {{-- <label class="custom-file"> --}}
                            <input type="file" id="profile_avatar" name="profile_avatar" class="custom-file-input">
                            <span class="custom-file-control"></span>
                            <input type="hidden" id="old_profile_avatar" name="old_profile_avatar" class="custom-file-input" value="{{ $student->profile_avatar }}">
                        {{-- </label> --}}
                    </div>
                </div>

                <input type="hidden"  name="colleges_id" value="{{ $student->colleges_id }}">

                <input type="hidden"  name="departments_id" value="{{ $student->departments_id }}">
              
                <div class="form-group">
                    <label for="address" class="col-form-label">Address</label>
                    <textarea id="address" rows="3" class="form-control" name="address">{{ old('address') ?? $student->address }}</textarea>
                </div>

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
