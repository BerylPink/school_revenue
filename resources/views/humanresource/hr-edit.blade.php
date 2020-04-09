@extends('layouts.master')
@section('title', 'Editing '.$hr->firstname.' '.$hr->lastname.' Profile')
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
            <h5>Edit Human Resources</h5>
            <h6 class="sub-heading">Editng Human Resources Profile</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('human-resource.create') }}" class="btn btn-primary float-right" data-toggle="tooltip" data-placement="left" title="Add Human Resources">
                <i class="icon-user-plus"></i>
              </a>
              <a href="{{ route('human-resource.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Human resources list">
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
            <div class="card-header">Edit {{ $hr->firstname.' '.$hr->lastname }}'s Profile</div>
            <div class="card-body">
                <form method="POST" action="{{ route('human-resource.update', $hr->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname" class="col-form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" placeholder="First Name" class="form-control" name="firstname" value="{{ old('firstname') ?? $hr->firstname }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname" class="col-form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Last Name" class="form-control" name="lastname" value="{{ old('firstname') ?? $hr->lastname }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="phone_no" class="col-form-label">Phone Number</label>
                        <input id="phone_no" maxlength="11" type="tel" class="form-control" name="phone_no" placeholder="Phone Number" value="{{ old('phone_no') ?? $hr->phone_no }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email" class="col-form-label">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') ?? $hr->email }}" placeholder="Email">
                    </div>
                    <div class="form-group col-md-4">                        
                        <label for="gender" class="col-form-label">Gender</label>
                        <select id="gender" name="gender" class="form-control" required>
                            <option>Choose</option>
                            <option value="Female" @if($hr->gender == 'Female') selected @endif>Female</option>
                            <option value="Male" @if($hr->gender == 'Male') selected @endif>Male</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">                        
                        <label for="state_id" class="col-form-label">State</label>
                        <select id="state_id" name="state_id" class="form-control" required>
                            <option>Choose</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->StateID }}" @if($state->StateID == $hr->states_id) selected @endif>{{ $state->StateName }}</option>                                
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6" style="margin-top: 2.24rem!important;">         
                        {{-- <label for="profile_avatar" class="col-form-label">Profile Avatar</label> --}}
                        {{-- <label class="custom-file"> --}}
                            <input type="file" id="profile_avatar" name="profile_avatar" class="custom-file-input">
                        <input type="hidden" id="old_profile_avatar" name="old_profile_avatar" class="custom-file-input" value="{{ $hr->profile_avatar }}">
                            <span class="custom-file-control"></span>
                        {{-- </label> --}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-form-label">Address</label>
                    <textarea id="address" rows="3" class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address') ?? $hr->address}}</textarea>
                </div>
                <a href="{{ route('human-resource.index') }}" class="btn btn-danger">Back</a>
                <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
      </div>
    <!-- Row end -->
    </div>


@endsection
