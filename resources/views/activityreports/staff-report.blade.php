@extends('layouts.master')
@section('title', 'Staff Report')
@section('content')
@include('partials._messages')

<style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px 15px;
  text-align: left;    
}
td:empty {
  visibility:hidden;
}
td:blank {
  visibility:hidden;
}
</style>
<header class="main-heading">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
          <div class="page-icon">
            <i class="icon-library"></i>
          </div>
          <div class="page-title">
            <h5>Staff Report</h5>
            <h6 class="sub-heading">All Staff report <strong><?php echo date('M, d Y'); ?></h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
           
          </div>
      </div>
    </div>
  </header>
  <!-- END: .main-heading -->
<div class="main-content">
  <!-- Row start -->
    <div class="row gutters"> 
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="form-row">
                <div class="form-group col-md-4">                        
                    <label for="academic_session" class="col-form-label">Staff Category</label>
                    <select id="academic_session" name="academic_session" class="form-control">
                      <option>Staff Category</option>
                      <option>Academic Staff</option>
                      <option>Non-Academic Staff</option>
                    </select>
                </div>
                <div class="form-group col-md-4">                        
                    <label for="semester" class="col-form-label">Category</label>
                    <select id="semester" name="semester" class="form-control" required>
                      <option>Category</option>  
                      <option>Cleaner</option>
                      <option>Exam Invigilator</option>
                      <option>Potters</option>
                    </select>
                </div> 
                <div class="form-group col-md-4">                        
                    <label for="semester" class="col-form-label">College</label>
                    <select id="semester" name="semester" class="form-control" required>
                      <option>College</option> 
                      <option>Engineering</option>
                      <option>Law</option>
                      <option>Medcine</option>
                      <option>Science</option>
                    </select>
                </div>  
            </div>
            <div class="card">
                <div class="card-body">
                    <table id="basicExample" class="table table-bordered table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>College</th>
                            <th>Department</th>
                            <th>Date created</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>
</div>

@endsection