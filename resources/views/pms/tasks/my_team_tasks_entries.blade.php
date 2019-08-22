@extends('layouts.pms_layout.pms_design')
@section('content')
@php
$monthNameArray = config('constant.months');
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
                            <li class="breadcrumb-item active" aria-current="page">Team Task Entries</li>
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
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal" method="post" action="{{url('/pms/teamtasksentries')}}" name="team_task_entries" id="team_task_entries">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">Team Task Entries</h4>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Employee</label>
                                <div class="col-md-9">
                                  <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="employee" id="employee" required>
                                    <option value="">Select Employee</option>
                                    <option value="{{$loggedInUserID}}" {{ (isset($request->employee) && $request->employee == $loggedInUserID) ? 'selected' : '' }}>{{$loggedInUserName}}</option>
                                    @foreach($myTeamList as $key => $value)
                                    <option value="{{$value['id']}}" {{ (isset($request->employee) && $request->employee == $value['id']) ? 'selected' : '' }}>{{$value['first_name'].' '.$value['last_name']}}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Month</label>
                                <div class="col-md-9">
                                  <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="month" id="month" required>
                                    <option value="">Select Month</option>    
                                    @foreach($monthNameArray as $key => $value)
                                    <option value="{{$key}}" {{ (isset($request->month) && $request->month == $key) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Year</label>
                                <div class="col-md-9">
                                  <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="year" id="year" required>
                                    <option value="">Select Year</option>    
                                    @foreach($years as $key => $value)
                                    <option value="{{$key}}" {{ (isset($request->year) && $request->year == $key) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button name="submit" type="submit" class="btn btn-success">
                                    Search
                                </button>
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
                @if (isset($request->employee) && isset($request->year) && isset($request->month))
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Task Entries of <b>{{ $empName }}, {{$monthNameArray[$request->month]}} {{ $request->year }}</b></h4>
                        @if (count($taskEntries)>0)
                        <div class="table-responsive panel-body">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                  <tr>
                                    <th><b>Projects/Dates</b></th>
                                    @foreach($daysList as $days)
                                      <td><b>{{$days}}</b></td>
                                    @endforeach
                                      <td><b>Σ</b></td>
                                  </tr>
                                  @foreach($allProjects as $projectName)
                                    <tr>
                                      <td><b>{{$projectName}}</b></td>
                                      @foreach($allDaysList as $allDays)
                                        @if (isset($allHours[$allDays.' '.$projectName]))
                                          <td style="color:#28b779"><b>{{$allHours[$allDays.' '.$projectName]}}</b></td>
                                        @else
                                          <td>0</td>
                                        @endif
                                      @endforeach
                                        <td style="color:#28b779"><b>{{$totalHorArr[$projectName]}}</b></td>
                                    </tr>
                                    @if(!empty($allProjecttasks[$projectName]))
                                    @foreach($allProjecttasks[$projectName] as $task_id => $task_name)
                                    <tr>
                                      <td style="color:#27a9e3"><b rel="tooltip" title="{{$task_name}}">{{strlen($task_name)<=20?$task_name:substr($task_name,0,20).'...'}}</b></td>
                                      @foreach($allDaysList as $allDays)
                                        @if (isset($alltaskHours[$projectName][$allDays.' '.$task_id]))
                                          <td style="color:#27a9e3"><b>{{$alltaskHours[$projectName][$allDays.' '.$task_id]}}</b></td>
                                        @else
                                          <td>0</td>
                                        @endif
                                      @endforeach
                                        <td style="color:#27a9e3"><b>{{$totalTaskHourArr[$projectName][$task_id]}}</b></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                  
                                  @endforeach
                                  <tr>
                                    <td><b>Σ</b></td>
                                    @foreach($totalVerArr as $totalVer)
                                        @if ($totalVer > 0)
                                            <td style="color:#28b779"><b>{{ $totalVer }}</b></td>
                                        @else
                                            <td>{{ $totalVer }}</td>
                                        @endif
                                    @endforeach
                                    <td style="color:#28b779"><b>{{ $allTotalHours }}</b></td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="border-top">
                          <h4 align="center" style="padding : 20px;">No Task Entries for {{ $empName }}.</h4>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>

<!-- this page js -->
<script src="{{asset('js/admin_js/DataTables/datatables.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
	    $("[rel=tooltip]").tooltip({ placement: 'top',tooltipClass: 'tasktooltip'});
	});
</script>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection