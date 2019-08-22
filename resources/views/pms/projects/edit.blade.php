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
                            <li class="breadcrumb-item"><a href="{{url('/pms/projects')}}">Project Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Project</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/pms/projects/update/'.$projectDetails['id'])}}" name="project_update" id="project_update">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">Edit Project</h4>
                            <div class="form-group row">
                                <label for="project_name" class="col-sm-3 text-right control-label col-form-label">Project Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="project_name" id="project_name" value="{{ old('project_name') != '' ? old('project_name') : $projectDetails['project_name']}}" class="form-control" required />
                                    @if ($errors->has('project_name'))
                                        <div class="error">{{ $errors->first('project_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="client_name" class="col-sm-3 text-right control-label col-form-label">Client Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="client_name" id="client_name" value="{{ old('client_name') != '' ? old('client_name') : $projectDetails['client_name']}}" class="form-control" required />
                                    @if ($errors->has('client_name'))
                                        <div class="error">{{ $errors->first('client_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Account Manager</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control custom-select" name="account_manager" id="account_manager" style="width: 100%; height:36px;" required>
                                        <option value="">Select Account Manager</option>
                                        @foreach($accountManagerList as $accountManager)
                                        <option value="{{$accountManager['id']}}" {{ old('account_manager') != '' ? (old('account_manager') == $accountManager['id'] ? 'selected' : '') : ($projectDetails['account_manager'] == $accountManager['id'] ? 'selected' : '')}}>{{$accountManager['first_name'].' '.$accountManager['last_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Project Manager</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control custom-select" name="project_manager" id="project_manager" style="width: 100%; height:36px;" required>
                                        <option value="">Select Project Manager</option>
                                        @foreach($projectManagerList as $projectManager)
                                        <option value="{{$projectManager['id']}}" {{ old('project_manager') != '' ? (old('project_manager') == $projectManager['id'] ? 'selected' : '') : ($projectDetails['project_manager'] == $projectManager['id'] ? 'selected' : '')}}>{{$projectManager['first_name'].' '.$projectManager['last_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="estimated_hours" class="col-sm-3 text-right control-label col-form-label">Project Hours</label>
                                <div class="col-sm-9">
                                    <input type="text" name="estimated_hours" id="estimated_hours" value="{{ old('estimated_hours') != '' ? old('estimated_hours') : $projectDetails['estimated_hours']}}" onkeypress="return isNumberKey(event)" class="form-control" required />
                                    @if ($errors->has('estimated_hours'))
                                        <div class="error">{{ $errors->first('estimated_hours') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Project Type</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control custom-select" name="project_type" id="project_type" style="width: 100%; height:36px;" required>
                                        <option value="">Select Project Type</option>
                                        @foreach($projectTypeData as $type)
                                        <option value="{{$type['id']}}" {{ old('project_type') != '' ? (old('project_type') == $type['id'] ? 'selected' : '') : ($projectDetails['project_type'] == $type['id'] ? 'selected' : '')}}>{{$type['project_type_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label col-form-label">Start Date</label>
                                <div class="col-sm-9">
                                    <input type="text" name="project_start_date" id="project_start_date" value="{{ old('project_start_date') != '' ? old('project_start_date') : $projectDetails['project_start_date']}}" class="form-control" required />
                                    @if ($errors->has('project_start_date'))
                                        <div class="error">{{ $errors->first('project_start_date') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label col-form-label">End Date</label>
                                <div class="col-sm-9">
                                    <input type="text" name="project_end_date" id="project_end_date" value="{{ old('project_end_date') != '' ? old('project_end_date') : $projectDetails['project_end_date']}}" class="form-control" />
                                    @if ($errors->has('project_end_date'))
                                        <div class="error">{{ $errors->first('project_end_date') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Project Status</label>
                                <div class="col-md-9">
                                    <select name="project_status" id="project_status" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                        <option value="">Select Project Status</option>
                                        @foreach(config('constant.project_status') as $key => $value)
                                        <option value="{{$key}}" {{ old('project_status') != '' ? (old('project_status') == $key ? 'selected' : '') : ($projectDetails['project_status'] == $key ? 'selected' : '')}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Project Users</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control custom-select" multiple="" name="project_users[]" id="project_users" style="width: 100%; height:100px;" required>
                                        @foreach($projectUserList as $projectUser)
                                        <option value="{{$projectUser['id']}}" 
                                        {{ old('project_users') != '' ? ((collect(old('project_users'))->contains($projectUser['id'])) ? 'selected':'') : (isset($projectDetails['project_users']) && (collect($projectDetails['project_users'])->contains($projectUser['id']))  ? 'selected' : '')}}>{{$projectUser['first_name'].' '.$projectUser['last_name']}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('project_users'))
                                        <div class="error">{{ $errors->first('project_users') }}</div>
                                    @endif
                                </div>
                            </div>  
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <input type="submit" value="Save" class="btn btn-success">
                                <a href="{{url('/pms/projects')}}"><button type="button" value="Cancel" class="btn btn-secondary">Cancel</button></a>
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
    $('#project_start_date, #project_end_date').datepicker({
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