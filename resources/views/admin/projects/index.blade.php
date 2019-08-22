@extends('layouts.admin_layout.admin_design')
@section('content')
@php
$statusArray = config('constant.status');
@endphp
<link href="{{asset('css/admin_css/dataTables.bootstrap4.css')}}" rel="stylesheet">
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="text-left">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Project Management</li>
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
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
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
                <div class="card">
                    <div class="card-body text-right">
                        <a href="{{url('/admin/projects/create')}}" title="Create Project">
                          <button type="button" class="btn btn-cyan btn-sm">Create Project</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Project Management</h4>
                        <div class="table-responsive">
                            <table id="project_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                  										<th>No</th>
                  										<th>Project Name</th>
                  										<th>Project Type</th>
                  										<th>Start Date</th>
                  										<th>Estimation</th>
                  										<th>Client Name</th>
                  										<th>Account Manager</th>
                  										<th>Project Manager</th>
                  										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if (count($projectsData)>0)  
                								@php
                								$i = 1
                								@endphp 
                								@foreach($projectsData as $project)
                                  <tr>
                                    <td>{{$i}}</td>
                  									<td>
                                      <a href="{{url('/admin/tasks/index/'.$project->id)}}" title="" >
                                        {{$project->project_name}}
                                      </a>
                                    </td>
                  									<td>{{$project->projecttype->project_type_name}}</td>
                  									<td>{{$project->project_start_date}}</td>
                  									<td>{{$project->estimated_hours}}</td>
                  									<td>{{$project->client_name}}</td>
                  									<td>{{$project->accountmanager->first_name.' '.$project->accountmanager->last_name}}</td>
                  									<td>{{$project->projectmanager->first_name.' '.$project->projectmanager->last_name}}</td>
                                    <td align="center">
                                      <a href="{{url('/admin/projects/edit/'.$project->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update">
                                          <i class="mdi mdi-check"></i>
                                      </a>
                                      <a href="{{url('/admin/projects/destroy/'.$project->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');">
                                          <i class="mdi mdi-close"></i>
                                      </a>
                                    </td>
                                  </tr>
                                  @php
                                  $i++
                                  @endphp 
                                 @endforeach 
                                 @else
                                 <tr>
                                    <td colspan='9'>No Projects Found.</td>
                                  </tr>
                                 @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>

<!-- this page js -->
<script src="{{asset('js/admin_js/DataTables/datatables.min.js')}}"></script>
<script>
    $('#project_listing').DataTable();
</script>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection