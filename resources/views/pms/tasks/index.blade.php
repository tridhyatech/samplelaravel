@extends('layouts.pms_layout.pms_design')
@section('content')
@php
$taskStatusArray = config('constant.task_status');
$totalLoggedHours = 0;
$totalEstimationHours = 0;
@endphp
<link href="{{asset('css/pms_css/dataTables.bootstrap4.css')}}" rel="stylesheet">
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
                            <li class="breadcrumb-item"><a href="{{url('/pms/dashboard')}}">Home</a></li>
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
                    @permission('tasks.create')
                    <div class="card-body text-right">
                        <a href="{{url('/pms/tasks/create/'.$projectID)}}" title="Create Task">
                          <button type="button" class="btn btn-cyan btn-sm">Create Task</button>
                        </a>
                    </div>
                    @endpermission
                    <div class="card-body">
                        <h4 class="card-title">Task Management @if(isset($tasksData[0]['project_name'])) ({{$tasksData[0]['project_name']}})@endif
                        </h4>
                        <div class="table-responsive">
                            <table id="task_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                  										<th>No</th>
                  										<th>Task Name</th>
                                      <th>Start Date</th>
                  										<th>End Date</th>
                                      <th>Assigned To</th>
                                      <th>Status</th>
                                      <th>Estimation</th>
                  										<th>Logged Hours</th>
                  										@permission('tasks.edit|tasks.delete')
                                      <th>Action</th>
                                      @endpermission
                                    </tr>
                                </thead>
                                <tbody>
                                @if (count($tasksData)>0)  
                								@php
                								$i = 1;
                								@endphp 
                								@foreach($tasksData as $task)
                                  @php
                                  $totalLoggedHours = $totalLoggedHours + $task['total_logged_hours'];
                                  $totalEstimationHours = $totalEstimationHours + $task['task_hours'];
                                  @endphp
                                  <tr>
                                    <td>{{$i}}</td>
                  									<td>{{$task['task_name']}}</td>
                                    <td>{{(new \App\Helpers\CommonHelper)->displayDate($task['task_start_date'])}}</td>
                  									<td>{{(new \App\Helpers\CommonHelper)->displayDate($task['task_end_date'])}}</td>
                                    <td>
                                      @if(isset($task['assigned_to']))
                                        {{$task['assigned_to']}}
                                      @endif
                                    </td>
                                    <td>
                                      {{$taskStatusArray[$task['task_status']]}}
                                    </td>
                                    <td>{{(new \App\Helpers\CommonHelper)->displayTaskTime($task['task_hours'])}}</td>
                                    <td>{{(new \App\Helpers\CommonHelper)->displayTaskTime($task['total_logged_hours'])}}</td>
                                    @permission('tasks.edit|tasks.delete')
                                    <td align="center">
                                      @permission('tasks.edit')
                                      <a href="{{url('/pms/tasks/edit/'.$task['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update">
                                          <i class="mdi mdi-pencil"></i>
                                      </a>
                                      @endpermission
                                      @permission('tasks.delete')
                                      <a href="{{url('/pms/tasks/destroy/'.$task['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');">
                                          <i class="mdi mdi-close"></i>
                                      </a>
                                      @endpermission
                                    </td>
                                    @endpermission
                                  </tr>
                                  @php
                                  $i++
                                  @endphp 
                                 @endforeach 
                                 @else
                                 <tr>
                                    <td colspan='9'>No Tasks Found.</td>
                                  </tr>
                                 @endif
                                </tbody>
                                @if (count($tasksData)>0) 
                                <tfoot>
                                    <tr>
                                        <th colspan="6" style="text-align:right">Total Estimated Hours:</th>
                                        <th>{{(new \App\Helpers\CommonHelper)->displayTaskTime($totalEstimationHours)}}</th>
                                        <th>{{(new \App\Helpers\CommonHelper)->displayTaskTime($totalLoggedHours)}}</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                @endif
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
<script src="{{asset('js/pms_js/DataTables/datatables.min.js')}}"></script>
<script>
    $('#task_listing').DataTable();
</script>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection