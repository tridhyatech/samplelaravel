@extends('layouts.admin_layout.admin_design')
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
                            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('/admin/tasks/index/'.$projectID)}}">Task Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Task</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/admin/tasks/update/'.$taskDetails['id'])}}" name="project_update" id="project_update">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">Edit Task</h4>
                            <div class="form-group row">
                                <label for="task_name" class="col-sm-3 text-right control-label col-form-label">Task Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="task_name" id="task_name" value="{{ old('task_name') != '' ? old('task_name') : $taskDetails['task_name']}}" class="form-control" required />
                                    @if ($errors->has('task_name'))
                                        <div class="error">{{ $errors->first('task_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="task_hours" class="col-sm-3 text-right control-label col-form-label">Estimated Hours</label>
                                <div class="col-sm-9">
                                    <input type="text" name="task_hours" id="task_hours" value="{{ old('task_hours') != '' ? old('task_hours') : $taskDetails['task_hours']}}" class="form-control" required />
                                    @if ($errors->has('task_hours'))
                                        <div class="error">{{ $errors->first('task_hours') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="task_start_date" class="col-sm-3 text-right control-label col-form-label">Start Date</label>
                                <div class="col-sm-9">
                                    <input type="text" name="task_start_date" id="task_start_date" value="{{ old('task_start_date') != '' ? old('task_start_date') : $taskDetails['task_start_date']}}" class="form-control" required />
                                    @if ($errors->has('task_start_date'))
                                        <div class="error">{{ $errors->first('task_start_date') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="task_end_date" class="col-sm-3 text-right control-label col-form-label">End Date</label>
                                <div class="col-sm-9">
                                    <input type="text" name="task_end_date" id="task_end_date" value="{{ old('task_end_date') != '' ? old('task_end_date') : $taskDetails['task_end_date']}}" class="form-control" required />
                                    @if ($errors->has('task_end_date'))
                                        <div class="error">{{ $errors->first('task_end_date') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Assign To</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control custom-select" name="user_id" id="user_id" style="width: 100%; height:36px;" required>
                                        <option value="">Select User</option>
                                        @foreach($projectUser as $projectUserDetail)
                                        <option value="{{$projectUserDetail['id']}}" {{ old('user_id') != '' ? (old('user_id') == $projectUserDetail['id'] ? 'selected' : '') : ($taskDetails['user_id'] == $projectUserDetail['id'] ? 'selected' : '')}}>{{$projectUserDetail['first_name'].' '.$projectUserDetail['last_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Task Status</label>
                                <div class="col-md-9">
                                    <select name="task_status" id="task_status" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                        <option value="">Select Task Status</option>
                                        @foreach(config('constant.task_status') as $key => $value)
                                        <option value="{{$key}}" {{ old('task_status') != '' ? (old('task_status') == $key ? 'selected' : '') : ($taskDetails['task_status'] == $key ? 'selected' : '')}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <input type="hidden" name="project_id" id="project_id" value="{{$projectID}}">
                                <input type="submit" value="Save" class="btn btn-success">
                                <a href="{{url('/admin/tasks/index/'.$projectID)}}"><button type="button" value="Cancel" class="btn btn-secondary">Cancel</button></a>
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