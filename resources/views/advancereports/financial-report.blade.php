@extends('layouts.master')
@section('title', 'Financial Report')
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
            <h5>Financial Report</h5>
            <h6 class="sub-heading">All Financial report <strong><?php echo date('M, d Y'); ?></h6>
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
                    <label for="academic_session" class="col-form-label">Academic Session</label>
                    <select id="academic_session" name="academic_session" class="form-control">
                      <option>Session</option>
                      <option>2018/2019</option>
                      <option>2019/2020</option>
                    </select>
                </div>
                <div class="form-group col-md-6">                        
                    <label for="semester" class="col-form-label">Semester</label>
                    <select id="semester" name="semester" class="form-control" required>
                      <option>Semester</option>  
                      <option>First Semester</option>
                      <option>Second Semester</option>
                    </select>
                </div>  
            </div>

            <div class="card">
                <div class="card-header">Area Spline Graph</div>
                <div class="card-body">
                    <div id="areaSplineGraph" class="chart-height"></div>
                </div>
            </div>

            <div class="row gutters">
                <div class="col-xl-6 col-lg-6 col-md-4 col-sm-6">
                    <div class="card">
                        <div class="card-header">Pie Chart</div>
                        <div class="card-body">
                            <div id="pieChart" class="chart-height"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="card-header">Bar Graph</div>
                        <div class="card-body">
                            <div id="barGraph" class="chart-height"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
