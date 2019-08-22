@extends('layouts.admin_layout.admin_design')
@section('content')

<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
   <div class="page-breadcrumb">
      <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title">Dashboard</h4>
              <div class="ml-auto text-right">
                  <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                      </ol>
                  </nav>
              </div>
          </div>
      </div>
  </div>
  <!-- ============================================================== -->
  <!-- End Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <!-- ============================================================== -->
  <!-- Container fluid  -->
  <!-- ============================================================== -->
  <div class="container-fluid">
      @if (Session::has('success'))
      <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{!!session('success')!!}</strong>
      </div>
      @endif    
      @if (Session::has('error'))
      <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{!!session('error')!!}</strong>
      </div>
      @endif 
      <!-- ============================================================== -->
      <!-- Sales Cards  -->
      <!-- ============================================================== -->
      <div class="row">
          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                  <div class="box bg-cyan text-center">
                      <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                      <h6 class="text-white">Dashboard</h6>
                  </div>
              </div>
          </div>
          <!-- Column -->
          <div class="col-md-6 col-lg-4 col-xlg-3">
              <div class="card card-hover">
                  <div class="box bg-success text-center">
                      <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                      <h6 class="text-white">Charts</h6>
                  </div>
              </div>
          </div>
           <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                  <div class="box bg-warning text-center">
                      <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                      <h6 class="text-white">Widgets</h6>
                  </div>
              </div>
          </div>
          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                  <div class="box bg-danger text-center">
                      <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                      <h6 class="text-white">Tables</h6>
                  </div>
              </div>
          </div>
          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                  <div class="box bg-info text-center">
                      <h1 class="font-light text-white"><i class="mdi mdi-arrow-all"></i></h1>
                      <h6 class="text-white">Full Width</h6>
                  </div>
              </div>
          </div>
          <!-- Column -->
          <!-- Column -->
          <div class="col-md-6 col-lg-4 col-xlg-3">
              <div class="card card-hover">
                  <div class="box bg-danger text-center">
                      <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                      <h6 class="text-white">Forms</h6>
                  </div>
              </div>
          </div>
          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                  <div class="box bg-info text-center">
                      <h1 class="font-light text-white"><i class="mdi mdi-relative-scale"></i></h1>
                      <h6 class="text-white">Buttons</h6>
                  </div>
              </div>
          </div>
           <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                  <div class="box bg-cyan text-center">
                      <h1 class="font-light text-white"><i class="mdi mdi-pencil"></i></h1>
                      <h6 class="text-white">Elements</h6>
                  </div>
              </div>
          </div>
          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                  <div class="box bg-success text-center">
                      <h1 class="font-light text-white"><i class="mdi mdi-calendar-check"></i></h1>
                      <h6 class="text-white">Calnedar</h6>
                  </div>
              </div>
          </div>
          <!-- Column -->
          <div class="col-md-6 col-lg-2 col-xlg-3">
              <div class="card card-hover">
                  <div class="box bg-warning text-center">
                      <h1 class="font-light text-white"><i class="mdi mdi-alert"></i></h1>
                      <h6 class="text-white">Errors</h6>
                  </div>
              </div>
          </div>
          <!-- Column -->
      </div>
  </div>
  <!-- ============================================================== -->
  <!-- End Container fluid  -->
  <!-- ============================================================== -->
</div>

<!--This page JavaScript -->
<!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
<!-- Charts js Files -->
<script src="{{asset('js/admin_js/flot/excanvas.js')}}"></script>
<script src="{{asset('js/admin_js/flot/jquery.flot.js')}}"></script>
<script src="{{asset('js/admin_js/flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('js/admin_js/flot/jquery.flot.time.js')}}"></script>
<script src="{{asset('js/admin_js/flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('js/admin_js/flot/jquery.flot.crosshair.js')}}"></script>
<script src="{{asset('js/admin_js/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
<script src="{{asset('js/admin_js/chart/chart-page-init.js')}}"></script>
<?php
/*
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Chart-box-->    
    <div class="row-fluid">
      <div class="widget-box">
        <div class="widget-title bg_lg">
          <h5>Welcome</h5>
        </div>
        <div class="widget-content" >
          <div class="row-fluid">
            <div class="span9">
              Welcome to the Salary Slip Management System
            </div>
            
          </div>
        </div>
      </div>
    </div>
<!--End-Chart-box--> 
    
</div>

<!--end-main-container-part-->
*/
?>
@endsection