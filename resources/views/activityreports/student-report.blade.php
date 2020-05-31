@extends('layouts.master')
@section('title', 'Student Report')
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
            <h5>Student Report</h5>
            <h6 class="sub-heading">All Student report <strong><?php echo date('M, d Y'); ?></h6>
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
                <div class="form-group col-md-6">                        
                    <label for="academic_session" class="col-form-label">College</label>
                    <select id="academic_session" name="academic_session" class="form-control">
                      <option>College</option>
                      <option>Engineering</option>
                      <option>Law</option>
                      <option>Medcine</option>
                      <option>sciences</option>
                    </select>
                </div>
                <div class="form-group col-md-6">                        
                    <label for="semester" class="col-form-label">Department</label>
                    <select id="semester" name="semester" class="form-control" required>
                      <option>Department</option>
                      <option>1</option>
                      <option>2</option>
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