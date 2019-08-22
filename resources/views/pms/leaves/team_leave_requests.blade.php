@extends('layouts.pms_layout.pms_design')
@section('content')
@php
$leaveStatusArray = config('constant.leave_status');
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
                            <li class="breadcrumb-item active" aria-current="page">Team Leave Requests</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/pms/teamleaves')}}" name="team_leave_status" id="team_leave_status">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">View Team Leave Requests</h4>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Leave Status</label>
                                <div class="col-md-9">
                                  <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="leave_status" id="leave_status">
                                    <option value="0">All</option>
                                    @foreach(config('constant.leave_status') as $key => $value)
                                    <option value="{{$key}}" {{ (isset($leaveStatusSelected) && $leaveStatusSelected == $key) ? 'selected' : ''}}>{{$value}}</option>
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Team Leave Requests</h4>
                        @if (count($leavesData)>0)  
                        <div class="table-responsive">
                            <table id="leave_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Employee</th>
                                      <th>Start Date</th>
                                      <th>End Date</th>
                                      <th>Return Date</th>
                                      <th>Leave Days</th>
                                      <th>Reason</th>
                                      <th>Approver</th>
                                      <th>Leave Status</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                								@php
                								$i = 1;
                								@endphp 
                								@foreach($leavesData as $leave)
                                  <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$leave['user']['first_name'].' '.$leave['user']['last_name']}}</td>
                                    <td>{{(new \App\Helpers\CommonHelper)->displayDate($leave['leave_start_date'])}}</td>
                                    <td>{{(new \App\Helpers\CommonHelper)->displayDate($leave['leave_end_date'])}}</td>
                                    <td>{{(new \App\Helpers\CommonHelper)->displayDate($leave['return_date'])}}</td>
                                    <td>{{$leave['leave_days']}}</td>
                                    <td>{{$leave['reason']}}</td>
                  									<td>{{$leave['approver']['first_name'].' '.$leave['approver']['last_name']}}</td>
                                    <td>
                                      {{$leaveStatusArray[$leave['leave_status']]}}
                                    </td>
                                    <td align="center">
                                      @if ($loggedInUserID == $leave['approver_id'] || Auth::user()->hasRole('pm'))
                                        <a href="{{url('/pms/leaves/approve/'.$leave['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                      @endif
                                      <a href="{{url('/pms/leaves/destroy/'.$leave['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');">
                                          <i class="mdi mdi-close"></i>
                                      </a>
                                    </td>
                                  </tr>
                                  @php
                                  $i++
                                  @endphp 
                                 @endforeach 
                                </tbody>
                            </table>
                        </div>
                        @else
                          <div class="border-top">
                            <h4 align="center" style="padding : 20px;">No leaves from your team.</h4>
                          </div>
                        @endif
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
<script type="text/javascript">
    $('#leave_listing').DataTable();
</script>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection