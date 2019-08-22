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
                            <li class="breadcrumb-item"><a href="{{url('/pms/projects/myprojects')}}">{{ $projectName }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Change Request</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/pms/cr/store/'.$projectId)}}" name="cr_create" id="cr_create">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">Add Change Request</h4>
                            <div class="form-group row">
                                <label for="title" class="col-sm-3 text-right control-label col-form-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control" required />
                                    @if ($errors->has('title'))
                                        <div class="error">{{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="estimated_hours" class="col-sm-3 text-right control-label col-form-label">Estimated Hours</label>
                                <div class="col-sm-9">
                                    <input type="text" name="estimated_hours" id="estimated_hours" value="{{ old('estimated_hours') }}" class="form-control" onkeypress="return isNumberKey(event)" required />
                                    @if ($errors->has('estimated_hours'))
                                        <div class="error">{{ $errors->first('estimated_hours') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Status</label>
                                <div class="col-md-9">
                                    <select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                        <option value="">Select Status</option>
                                        @foreach(config('constant.cr_status') as $key => $value)
                                        <option value="{{$key}}" {{ old('status') != '' ? (old('status') == $key ? 'selected' : '') : ''}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error">{{ $errors->first('status') }}</div>
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
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection