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
                            <li class="breadcrumb-item active" aria-current="page">Assign Users</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/pms/projects/updateusers/'.$projectDetails['id'])}}" name="project_update" id="project_update">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">Assign Users</h4>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Project Name</label>
                                <label class="col-md-9 text-left control-label col-form-label">{{$projectDetails['project_name']}}</label>
                                
                          <div class="error">{{ $errors->first('project_users') }}</div>
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
                                <a href="{{url('/pms/projects/myprojects')}}"><button type="button" value="Cancel" class="btn btn-secondary">Cancel</button></a>
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