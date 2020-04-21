@extends('layouts.master')
@section('title', 'Change Password')
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
            <h5>Update Password</h5>
            <h6 class="sub-heading">Change your current password</h6>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            </div>
            </div>
        </div>
    </div>
</header>

<div class="main-content">

    <div class="row gutters">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
        <div class="card">
            <div class="card-header">Update Password Form</div>
            <div class="card-body">
            <form method="POST" action="{{ route('settings.update_password') }}">
                @csrf @method('PUT')
                <div class="form-group row gutters">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row gutters">
                    <label for="confirm_password" class="col-sm-3 col-form-label">Confirm Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                    </div>
                </div>
                <div class="form-group row gutters">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    </div>
</div>


@endsection