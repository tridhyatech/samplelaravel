@extends('layouts.pms_layout.pms_design')
@section('content')
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
                            <li class="breadcrumb-item"><a href="{{url('/pms/teamleaves')}}">Team Leave Requests</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Approve Leave Request</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/pms/leaves/update/'.$leaveDetails['id'])}}" name="leave_update" id="leave_update">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">Approve Leave Request</h4>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 text-right control-label col-form-label">Name</label>
                                <div class="col-sm-9">
                                    {{$leaveDetails['user']['first_name'].' '.$leaveDetails['user']['last_name']}}
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Approver</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control custom-select" name="approver_id" id="approver_id" style="width: 100%; height:36px;" disabled="" >
                                        <option value="">Select Approver</option>
                                        @foreach($reportingToList as $reportingTo)
                                        <option value="{{$reportingTo['id']}}" {{ $leaveDetails['approver_id'] == 
                                        $reportingTo['id'] ? 'selected' : ''}}>{{$reportingTo['first_name'].' '.$reportingTo['last_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label col-form-label">Leave Start Date</label>
                                <div class="col-sm-4">
                                    <input type="text" name="leave_start_date" id="leave_start_date" value="{{ old('leave_start_date') != '' ? old('leave_start_date') : $leaveDetails['leave_start_date']}}" class="form-control" readonly="" />
                                    @if ($errors->has('leave_start_date'))
                                        <div class="error">{{ $errors->first('leave_start_date') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    <select name="leave_start_type" id="leave_start_type" class="select2 form-control custom-select" style="width: 100%; height:36px;" disabled="" >
                                        <option value="0" {{ old('leave_start_type') != '' ? (old('leave_start_type') == 0 ? 'selected' : '') : ($leaveDetails['leave_start_type'] == 0 ? 'selected' : '')}}>Full Day</option>
                                        <option value="1" {{ old('leave_start_type') != '' ? (old('leave_start_type') == 1 ? 'selected' : '') : ($leaveDetails['leave_start_type'] == 1 ? 'selected' : '')}}>First Half</option>
                                        <option value="2" {{ old('leave_start_type') != '' ? (old('leave_start_type') == 2 ? 'selected' : '') : ($leaveDetails['leave_start_type'] == 2 ? 'selected' : '')}}>Second Half</option>
                                    </select>
                                    @if ($errors->has('leave_start_type'))
                                        <div class="error">{{ $errors->first('leave_start_type') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label col-form-label">Leave End Date</label>
                                <div class="col-sm-4">
                                    <input type="text" name="leave_end_date" id="leave_end_date" value="{{ old('leave_end_date') != '' ? old('leave_end_date') : $leaveDetails['leave_end_date']}}" class="form-control" readonly="" />
                                    @if ($errors->has('leave_end_date'))
                                        <div class="error">{{ $errors->first('leave_end_date') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    <select name="leave_end_type" id="leave_end_type" class="select2 form-control custom-select" style="width: 100%; height:36px;" disabled="" >
                                        <option value="0" {{ old('leave_end_type') != '' ? (old('leave_end_type') == 0 ? 'selected' : '') : ($leaveDetails['leave_end_type'] == 0 ? 'selected' : '')}}>Full Day</option>
                                        <option value="1" {{ old('leave_end_type') != '' ? (old('leave_end_type') == 1 ? 'selected' : '') : ($leaveDetails['leave_end_type'] == 1 ? 'selected' : '')}}>First Half</option>
                                        <option value="2" {{ old('leave_end_type') != '' ? (old('leave_end_type') == 2 ? 'selected' : '') : ($leaveDetails['leave_end_type'] == 2 ? 'selected' : '')}}>Second Half</option>
                                    </select>
                                    @if ($errors->has('leave_end_type'))
                                        <div class="error">{{ $errors->first('leave_end_type') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="reason" class="col-sm-3 text-right control-label col-form-label">Leave Reason</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="reason" id="reason" readonly="">{{ old('reason') != '' ? old('reason') : $leaveDetails['reason']}}</textarea>
                                    @if ($errors->has('reason'))
                                        <div class="error">{{ $errors->first('reason') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="approver_comment" class="col-sm-3 text-right control-label col-form-label">Approver Comment</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="approver_comment" id="approver_comment" required="" >{{ old('approver_comment') != '' ? old('approver_comment') : $leaveDetails['approver_comment']}}</textarea>
                                    @if ($errors->has('approver_comment'))
                                        <div class="error">{{ $errors->first('approver_comment') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Leave Status</label>
                                <div class="col-md-9">
                                    <select name="leave_status" id="leave_status" class="select2 form-control custom-select" style="width: 100%; height:36px;" required="">
                                        <option value="">Select Leave Status</option>
                                        @foreach(config('constant.leave_status') as $key => $value)
                                        <option value="{{$key}}" {{ old('leave_status') != '' ? (old('leave_status') == $key ? 'selected' : '') : ($leaveDetails['leave_status'] == $key ? 'selected' : '')}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <input type="submit" value="Save" class="btn btn-success">
                                <a href="{{url('/pms/teamleaves')}}"><button type="button" value="Cancel" class="btn btn-secondary">Cancel</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<script type="text/javascript">
  $(function(){
    $('#task_start_date, #task_end_date').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd'
    });
  });
</script>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection