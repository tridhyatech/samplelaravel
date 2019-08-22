@extends('layouts.pms_layout.pms_design')
@section('content')
@php
$taskStatusArray = config('constant.task_status');
$totalLoggedHours = 0;
$totalEstimationHours = 0;
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
                            <li class="breadcrumb-item active" aria-current="page">My Tasks</li>
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
                <div class="card">
                    <form class="form-horizontal" method="post" action="{{url('pms/tasks/mytasks')}}" name="teamTask" id="teamTask">
                        @csrf
                        <input type="hidden" name="reqType" id="reqType" value="myTask"/>
                        <div class="card-body">
                            <h4 class="card-title">Filter My Task</h4>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Project Name</label>
                                <div class="col-md-9">
                                    <select name="ddlProject" id="ddlProject" class="form-control custom-select">
                                        <option value="">-- select project --</option>
                                        @foreach($assignedProject as $ap)
                                        <option value="{{$ap['id']}}" {{ request()->input('ddlProject',old('ddlProject')) == $ap['id'] ? 'selected' : ''}}>{{$ap['project_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Start Date</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="taskStartDate" id="taskStartDate" value="{{request()->input('taskStartDate',old('taskStartDate'))}}"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Status</label>
                                <div class="col-md-9">
                                    <select name="ddlTaskStatus" id="ddlTaskStatus" class="form-control custom-select">
                                        <option value="">-- select status --</option>
                                         @foreach($projectStatus as $ps)
                                         <option value="{{$ps['id']}}" {{request()->input('ddlTaskStatus',old('ddlTaskStatus')) == $ps['id'] ? 'selected' : ''}}>{{$ps['statusName']}}</option>
                                         @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" name="submit" id="submit" class="btn btn-success">Search</button>
                                <a role="button" href="{{url('pms/tasks/mytasks')}}" name="reset" id="reset" class="btn btn-warning">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                    <div class="card-body">
                        <div style="float:left"><h4 class="card-title">Task Management</h4></div>
                        <div style="float:right;margin-bottom:10px;"><a href="{{url('/pms/tasks/uploadtasktimeentries')}}" title="Upload Task Time Sheet">
                          <button type="button" class="btn btn-cyan">Upload Task Time Sheet</button>
                        </a></div>
                        <div class="table-responsive">
                            <table id="task_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Task Id</th>
                                        <th>Task Name</th>
                                        <th>Project</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Estimation</th>
                                        <th>Logged Hours</th>
                                        <!--<th>Assigned To</th>-->
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($tasksData)>0)  
                                    @php
                                    $i = 1
                                    @endphp 
                                    @foreach($tasksData as $task)
                                    @php
                                    $totalLoggedHours = $totalLoggedHours + $task['total_logged_hours'];
                                    $totalEstimationHours = $totalEstimationHours + $task['task_hours'];
                                    @endphp
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$task['id']}}</td>
                                        <td>{{$task['task_name']}}</td>
                                        <td>
                                            @if(isset($task['project_name']))
                                            {{$task['project_name']}}
                                            @endif
                                        </td>
                                        <td>{{(new \App\Helpers\CommonHelper)->displayDate($task['task_start_date'])}}</td>
                                        <td>{{(new \App\Helpers\CommonHelper)->displayDate($task['task_end_date'])}}</td>
                                        <td>{{(new \App\Helpers\CommonHelper)->displayTaskTime($task['task_hours'])}}</td>
                                        <td>{{(new \App\Helpers\CommonHelper)->displayTaskTime($task['total_logged_hours'])}}</td>
<!--                                        <td>
                                            @if(isset($task['assigned_to']))
                                            {{$task['assigned_to']}}
                                            @endif
                                        </td>-->
                                        <td>
                                            {{$taskStatusArray[$task['task_status']]}}
                                        </td>
                                        <td align="center">
                                            <a href="javascript:void(0)" onclick="addTaskEntryPopup({{$task['id']}})" data-toggle="tooltip" data-placement="top" title="" data-original-title="Task Entry">
                                                <i class="mdi mdi-alarm"></i>
                                            </a>
                                            <a href="{{url('/pms/tasks/edit/'.$task['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="{{url('/pms/tasks/destroy/'.$task['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');">
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
                                        <td colspan='10'>No Tasks Found.</td>
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
    <!-- ============================================================== --><!-- Modal Update Time Entry -->
    <div class="modal fade none-border" id="add-task-entry">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong id="time_entry_title">Add</strong> task entry</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form method="post" action="{{url('/pms/savetaskentry')}}" name="save_taskentry" id="save_taskentry">
                    <div class="modal-body">
                        <div class="alert alert-success alert-block" id="time_success_msg" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>Task entry has been submitted successfully!!</strong>
                        </div>
                        <div class="alert alert-danger alert-block" id="time_error_msg" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>Error while submitting task entry!!</strong>
                        </div> 
                        <div class="alert alert-success alert-block" id="time_delete_success_msg" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>Task entry has been deleted successfully!!</strong>
                        </div>
                        <div class="alert alert-danger alert-block" id="time_delete_error_msg" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>Error while deleting task entry!!</strong>
                        </div> 
                        <div id="task-entry-content"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL -->
</div>

<!-- this page js -->
<script type="text/javascript">
    $(function(){
    $('#taskStartDate').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        //daysOfWeekDisabled: [0,7],
        orientation: "bottom auto"
    });
  });
</script>
<script src="{{asset('js/admin_js/DataTables/datatables.min.js')}}"></script>
<script>
                                          $('#task_listing').DataTable();
                                          $("#save_taskentry").submit(function(event){
                                          // cancels the form submission
                                          event.preventDefault();
                                          saveTaskEntry();
                                          });
                                          function addTaskEntryPopup(taskID){
                                          console.log('taskID : ' + taskID);
                                          $.ajax({
                                          type: "POST",
                                                  url: getsiteurl() + '/pms/gettaskentrylisting',
                                                  data: {"_token": "{{ csrf_token() }}", "id": taskID},
                                                  success: function(response) {
                                                  $('#task-entry-content').html(response);
                                                  $('#add-task-entry').modal('show');
                                                  return false;
                                                  }
                                          });
                                          }
</script>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection