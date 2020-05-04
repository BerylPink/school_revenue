@extends('layouts.master')
@section('title', 'Editing '.$nonacademic->firstname.' '.$nonacademic->lastname.' Profile')
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
            <h5>Edit Non-Academic Staff</h5>
            <h6 class="sub-heading">Editng Non-Academic Staff Profile</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('nonacademics.create') }}" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="left" title="Add Non-Academic Staff">
                <i class="icon-user-plus"></i>
              </a>
              <a href="{{ route('nonacademics.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Non-Academic Staff list">
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
            <div class="card-header">Edit {{ $nonacademic->firstname.' '.$nonacademic->lastname }}'s Profile</div>
            <div class="card-body">
                <form method="POST" action="{{ route('nonacademics.update', $nonacademic->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname" class="col-form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" placeholder="First Name" class="form-control" name="firstname" value="{{ old('firstname') ?? $nonacademic->firstname }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Last Name" class="form-control" name="lastname" value="{{ old('firstname') ?? $nonacademic->lastname }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="phone_no" class="col-form-label">Phone Number</label>
                        <input id="phone_no" maxlength="11" type="tel" class="form-control" name="phone_no" placeholder="Phone Number" value="{{ old('phone_no') ?? $nonacademic->phone_no }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email" class="col-form-label">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') ?? $nonacademic->email }}" placeholder="Email">
                    </div>
                    <div class="form-group col-md-4">                  
                        <label for="dob" class="col-form-label">Date of Birth</label>
                        <input id="dob" class="form-control" name="dob" value="{{ old('dob') ?? $nonacademic->dob }}" required readonly autocomplete="dob" placeholder="Date of Birth">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="employee_number" class="col-form-label">Employee Number</label>
                        <input id="employee_number" maxlength="11" type="tel" class="form-control" name="employee_number" placeholder="Employee Number" value="{{ old('employee_number') ?? $nonacademic->employee_number }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gender" class="col-form-label">Gender</label>
                        <select id="gender" name="gender" class="form-control" required>
                            <option>Choose</option>
                            <option value="Female" @if($nonacademic->gender == 'Female') selected @endif>Female</option>
                            <option value="Male" @if($nonacademic->gender == 'Male') selected @endif>Male</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">                  
                        <label for="marital_status" class="col-form-label">Marital Status</label>
                        <select id="marital_status" name="marital_status" class="form-control" required>
                            <option>Choose</option>
                            <option value="single" @if($nonacademic->marital_status == 'Single') selected @endif>Single</option>
                            <option value="married" @if($nonacademic->marital_status == 'Married') selected @endif>Married</option>
                            <option value="divorced" @if($nonacademic->marital_status == 'Divorced') selected @endif>Divorced</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">                        
                        <label for="category_id" class="col-form-label">Category</label>
                        <select id="category_id" name="category_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if($category->id == $nonacademic->category_id) selected @endif>{{ $category->category_name }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">         
                        <label for="date_joined" class="col-form-label">Date Joined</label>
                        <input id="date_joined" class="form-control" name="date_joined" value="{{ old('date_joined') ?? $nonacademic->date_joined }}" required readonly autocomplete="date_joined" placeholder="Date Joined">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">                        
                        <label for="country_id" class="col-form-label">Country</label>
                        <select id="country_id" name="country_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->CountryID }}" @if($country->CountryID == $nonacademic->country_id) selected @endif>{{ $country->CountryName }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">                        
                        <label for="states_id" class="col-form-label">State</label>
                        <select id="states_id" name="states_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->StateID }}" @if($state->StateID == $nonacademic->states_id) selected @endif>{{ $state->StateName }}</option>                                
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="address" class="col-form-label">Address</label>
                    <textarea id="address" rows="3" class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address') ?? $nonacademic->address}}</textarea>
                </div>
                <a href="{{ route('admins.index') }}" class="btn btn-danger">Back</a>
                <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
      </div>
    <!-- Row end -->
    </div>

    <script>
     
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
