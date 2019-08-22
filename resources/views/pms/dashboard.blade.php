@extends('layouts.pms_layout.pms_design')
@section('content')
@php
$projectStatusArray = config('constant.project_status');
@endphp
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
                            <li class="breadcrumb-item"><a href="{{url('/pms/dashboard')}}">Home</a></li>
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
        @if(count($projectData) > 0)
        <div class="row">
            <!-- Column -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-0">Open Projects</h5>
                    </div>

                    @if (count($projectData)>0)
                    <table id="project_list" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Project Name</th>
                                <th scope="col">Project Type</th>
                                <th scope="col">Start Date</th>   
                                <th scope="col">End Date</th>   
                                <th scope="col">Estimation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projectData as $projectDatail)
                            <tr>                        
                                <td>
                                    <a href="{{url('/pms/tasks/index/'.$projectDatail['id'])}}" title="" >
                                        {{$projectDatail['project_name']}}
                                    </a>
                                </td>
                                <td>{{$projectDatail['project_type_name']}}</td>
                                <td data-sort="{{ $projectDatail['project_start_date'] }}">{{(new \App\Helpers\CommonHelper)->displayDate($projectDatail['project_start_date'])}}</td>
                                @if ($projectDatail['project_end_date'] == '' || $projectDatail['project_end_date'] == '0000-00-00' || $projectDatail['project_end_date'] == '1970-01-01')
                                <td>    {{ '-' }} </td>
                                @else
                                <td data-sort="{{ $projectDatail['project_end_date'] }}">{{(new \App\Helpers\CommonHelper)->displayDate($projectDatail['project_end_date'])}}</td>
                                @endif
                                <td data-sort="{{ $totalEstimatedHours[$projectDatail['id']] }}">{{(new \App\Helpers\CommonHelper)->displayTaskTime($totalEstimatedHours[$projectDatail['id']])}}</td>         
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                    @else
                    <div class="border-top">
                        <h4 align="center" style="padding : 20px;">No Open Projects Available.</h4>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif 
        <div class="row">
            <!-- Column -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-0">Employee On Leave Today</h5>
                    </div>

                    @if (count($todayLeaveListing)>0)
                    <table id="today_leave_listing" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Days</th>
                                <th scope="col">Leave Starts</th>
                                <th scope="col">Leave Ends</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($todayLeaveListing as $leaveDetail)
                            <tr>
                                <td>{{$leaveDetail['user']['first_name'].' '.$leaveDetail['user']['last_name']}}</td>
                                <td>{{$leaveDetail['leave_days']}}</td>
                                <td data-sort='{{$leaveDetail['leave_start_date']}}'>{{(new \App\Helpers\CommonHelper)->displayDate($leaveDetail['leave_start_date'])}}</td>
                                <td data-sort='{{$leaveDetail['leave_end_date']}}'>{{(new \App\Helpers\CommonHelper)->displayDate($leaveDetail['leave_end_date'])}}</td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                    @else
                    <div class="border-top">
                        <h4 align="center" style="padding : 20px;">No leaves for today.</h4>
                    </div>
                    @endif
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-1">Late days</h5>
                        <ul class="nav nav-tabs">
                            <li class="nav-item active"><a class="nav-link active show" data-toggle="tab" href="#thisMonth">This Month</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#overall">Over All</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="thisMonth">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Total Days</th>
                                            <th scope="col">Late Days</th>
                                            <th scope="col">%</th>          
                                            <th scope="col">Late Days Charges</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$currentMonth['totalDays']}}</td>
                                            <td>{{$currentMonth['lateDays']}}</td>
                                            <td>{{$currentMonth['percent']}}%</td>
                                            <td @if($currentMonth['lateDaysFees'] > 0) class="text-danger" @endif>&#x20b9; {{$currentMonth['lateDaysFees']}}</td>
                                        </tr>
                                    </tbody>
                                </table> 
                            </div>
                            <div class="tab-pane fade" id="overall">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Total Days</th>
                                            <th scope="col">Late Days</th>
                                            <th scope="col">%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$days['totalDays']}}</td>
                                            <td>{{$days['lateDays']}}</td>
                                            <td>{{$days['percent']}}%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!--<div class="card">
                  <div class="card-body">
                      <h5 class="card-title m-b-0">Remaining Leaves</h5>
                  </div>
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">Total Leaves</th>
                              <th scope="col">
                                      Leaves Taken
                              </th>
                              <th scope="col">Leaves Remaining</th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                              <td>{{ $employeeLeaves['totalLeaves'] }}</td>
                              <td><a href="{{url('/pms/leaverequests/1')}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Leaves Taken">{{ $employeeLeaves['takenLeaves'] }} </a></td>
                              <td>{{ $employeeLeaves['remainingLeaves'] }}</td>
                          </tr>
                      </tbody>
                  </table>
              </div>--> 

                @role('hr')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-0">Employees To Be Confirmed Next Month</h5>
                    </div>
                    @if (count($confirmedEmpData)>0)
                    <table id="emp_confirmed" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Joining Date</th>
                                <th scope="col">Confirmation Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($confirmedEmpData as $confirmedEmpDetail)
                            <tr>
                                <td>{{$confirmedEmpDetail['first_name'].' '.$confirmedEmpDetail['last_name']}}</td>
                                <td data-sort='{{$confirmedEmpDetail['joining_date']}}'>{{(new \App\Helpers\CommonHelper)->displayDate($confirmedEmpDetail['joining_date'])}}</td>
                                <td data-sort='{{$confirmedEmpDetail['confirm_date']}}'>{{(new \App\Helpers\CommonHelper)->displayDate($confirmedEmpDetail['confirm_date'])}}</td>
                                <td>
                                    <a class="btn-link" href="{{url('pms/users/edit/'.$confirmedEmpDetail['id'])}}" target="_self">Update</a>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                    @else
                    <div class="border-top">
                        <h4 align="center" style="padding : 20px;">No employees to be confirmed next month.</h4>
                    </div>
                    @endif
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-0">Employees To Be Appraised Next Month</h5>
                    </div>
                    @if (count($appraisedEmpData)>0)
                    <table id="emp_appraised" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Joining Date</th>
                                <th scope="col">Appraisal Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appraisedEmpData as $appraisedEmpDetail)
                            <tr>
                                <td>{{$appraisedEmpDetail['first_name'].' '.$appraisedEmpDetail['last_name']}}</td>
                                <td data-sort='{{$appraisedEmpDetail['joining_date']}}'>{{(new \App\Helpers\CommonHelper)->displayDate($appraisedEmpDetail['joining_date'])}}</td>
                                <td data-sort='{{$appraisedEmpDetail['appraisal_date']}}'>{{(new \App\Helpers\CommonHelper)->displayDate($appraisedEmpDetail['appraisal_date'])}}</td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                    @else
                    <div class="border-top">
                        <h4 align="center" style="padding : 20px;">No employees to be appraised next month.</h4>
                    </div>
                    @endif
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-0">Employees Present On Weekend Days</h5>
                    </div>
                    @if (count($presentOnWeekend)>0)
                    <table id="emp_present_weekend" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Day</th>
                                <th scope="col">Half / Full Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($presentOnWeekend as $presentOnWeekendDetail)
                            <tr>
                                <td>{{$presentOnWeekendDetail['emp_name']}}</td>
                                <td data-sort='{{$presentOnWeekendDetail['pms_date']}}'>{{(new \App\Helpers\CommonHelper)->displayDate($presentOnWeekendDetail['pms_date'])}}</td>
                                <td>{{$presentOnWeekendDetail['pms_day']}}</td>
                                <td>{{$presentOnWeekendDetail['status']}}</td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                    @else
                    <div class="border-top">
                        <h4 align="center" style="padding : 20px;">No employee present on weekend days this month.</h4>
                    </div>
                    @endif
                </div>
                
                @endrole

                @role('pm|tl')
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-0">Pending Leaves</h5>
                    </div>
                    @if (count($pendingLeaveListing)>0)
                    <table id="pending_leave_listing" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Days</th>
                                <th scope="col">Leave Starts</th>
                                <th scope="col">Leave Ends</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingLeaveListing as $leaveDetail)
                            <tr>
                                <td>{{$leaveDetail['user']['first_name'].' '.$leaveDetail['user']['last_name']}}</td>
                                <td>{{$leaveDetail['leave_days']}}</td>
                                <td data-sort='{{$leaveDetail['leave_start_date']}}'>{{(new \App\Helpers\CommonHelper)->displayDate($leaveDetail['leave_start_date'])}}</td>
                                <td data-sort='{{$leaveDetail['leave_end_date']}}'>{{(new \App\Helpers\CommonHelper)->displayDate($leaveDetail['leave_end_date'])}}</td>
                                <td>
                                    <a href="{{url('/pms/leaves/approve/'.$leaveDetail['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Detail">
                                        View
                                    </a>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                    @else
                    <div class="border-top">
                        <h4 align="center" style="padding : 20px;">No pending leaves.</h4>
                    </div>
                    @endif
                </div>
                @endrole
            </div>
            <!-- Column -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-0">Upcoming Employee Leaves</h5>
                    </div>
                    @if (count($upcomingLeaveListing)>0)
                    <table id="upcoming_leave_listing" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Days</th>
                                <th scope="col">Leave Starts</th>
                                <th scope="col">Leave Ends</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($upcomingLeaveListing as $leaveDetail)
                            <tr>
                                <td>{{$leaveDetail['user']['first_name'].' '.$leaveDetail['user']['last_name']}}</td>
                                <td>{{$leaveDetail['leave_days']}}</td>
                                <td data-sort='{{$leaveDetail['leave_start_date']}}'>{{(new \App\Helpers\CommonHelper)->displayDate($leaveDetail['leave_start_date'])}}</td>
                                <td data-sort='{{$leaveDetail['leave_end_date']}}'>{{(new \App\Helpers\CommonHelper)->displayDate($leaveDetail['leave_end_date'])}}</td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                    @else
                    <div class="border-top">
                        <h4 align="center" style="padding : 20px;">No upcoming leaves.</h4>
                    </div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-0">Holidays for the Year – {{ date('Y') }}</h5>
                    </div>
                    @if (count($holidaysData)>0)
                    <table id="holidays" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Holiday</th>
                                <th scope="col">Date</th>
                                <th scope="col">Day</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($holidaysData as $holidaysDetail)
                            <tr>
                                <td>{{ $holidaysDetail['holiday_name'] }}</td>
                                <td data-sort="{{ $holidaysDetail['holiday_date'] }}">{{ (new \App\Helpers\CommonHelper)->displayDate($holidaysDetail['holiday_date']) }}</td>
                                <td>{{ (new \App\Helpers\CommonHelper)->displayDay($holidaysDetail['holiday_date']) }}</td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                    @else
                    <div class="border-top">
                        <h4 align="center" style="padding : 20px;">No holidays available.</h4>
                    </div>
                    @endif
                </div>
            </div>
        </div>  

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    @if($userData['birthday_msg'] != ''){
    <div class="modal fade none-border" id="birthdayCard">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i style="color:blue;">{{ $userData['birthday_msg'] }} {{ $userData['first_name'] }} !!</i></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <img src="{{asset('images/birthday/'.$userData['img_name'])}}" width="470" height="300" alt="Birtday Card" />
                </div>
            </div>
        </div>
    </div>
    @endif  
</div>

<!-- this page js -->
<script src="{{asset('js/pms_js/jquery.min.js')}}"></script>  
<script src="{{asset('js/pms_js/DataTables/datatables.min.js')}}"></script>
<script>
$('#today_leave_listing').DataTable({searching: false, paging: true, info: true, lengthChange: false, pageLength: 5, order: [[2, "asc"]]});
$('#upcoming_leave_listing').DataTable({searching: false, paging: true, info: true, lengthChange: false, pageLength: 5, order: [[2, "asc"]]});
$('#holidays').DataTable({searching: false, paging: true, info: true, lengthChange: false, pageLength: 5, order: [[1, "asc"]]});
$('#pending_leave_listing').DataTable({searching: false, paging: true, info: true, lengthChange: false, pageLength: 5, order: [[2, "asc"]]});
$('#project_list').DataTable({searching: false, paging: true, info: true, lengthChange: false, pageLength: 5, order: [[2, "asc"]]});
$('#emp_confirmed').DataTable({searching: false, paging: true, info: true, lengthChange: false, pageLength: 5, order: [[1, "asc"]]});
$('#emp_appraised').DataTable({searching: false, paging: true, info: true, lengthChange: false, pageLength: 5, order: [[1, "asc"]]});
$('#emp_present_weekend').DataTable({searching: false, paging: true, info: true, lengthChange: false, pageLength: 5, order: [[1, "asc"]]});
$.noConflict();
</script>
@if($userData['birthday_msg'] != ''){
<script>
    $(document).ready(function () {
        $('#birthdayCard').modal('show');
    });
</script>
}
@endif
@endsection