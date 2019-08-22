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
                            <li class="breadcrumb-item active" aria-current="page">Task Management</li>
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
                        <a href="{{url('/admin/tasks/create/'.$projectID)}}" title="Create Task">
                          <button type="button" class="btn btn-cyan btn-sm">Create Task</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Task Management</h4>
                        <div class="table-responsive">
                            <table id="task_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                  										<th>No</th>
                  										<th>Task Name</th>
                  										<th>Project</th>
                                      <th>Start Date</th>
                  										<th>End Date</th>
                  										<th>Estimation</th>
                  										<th>Assigned To</th>
                  										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if (count($tasksData)>0)  
                								@php
                								$i = 1
                								@endphp 
                								@foreach($tasksData as $task)
                                  <tr>
                                    <td>{{$i}}</td>
                  									<td>{{$task->task_name}}</td>
                  									<td>
                                      @if(isset($task->project->project_name))
                                        {{$task->project->project_name}}
                                      @endif
                                    </td>
                                    <td>{{$task->task_start_date}}</td>
                  									<td>{{$task->task_end_date}}</td>
                  									<td>{{$task->task_hours}}</td>
                  									<td>
                                      @if(isset($task->user->first_name) && isset($task->user->last_name))
                                        {{$task->user->first_name.' '.$task->user->last_name}}
                                      @endif
                                    </td>
                                    <td align="center">
                                      <a href="{{url('/admin/tasks/edit/'.$task->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update">
                                          <i class="mdi mdi-check"></i>
                                      </a>
                                      <a href="{{url('/admin/tasks/destroy/'.$task->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');">
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
                                    <td colspan='8'>No Records Found.</td>
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
    $('#task_listing').DataTable();
</script>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection