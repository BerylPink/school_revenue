@extends('layouts.master')

@section('title')
    Dashboard | Admin
@endsection

@section('content')
@include('partials._messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div> 
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection