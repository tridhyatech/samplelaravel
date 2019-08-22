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
                            <li class="breadcrumb-item"><a href="{{url('/pms/teamcompoffs')}}">Team Comp-off Requests</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Approve Comp-off Request</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/pms/compoffs/update/'.$compoffDetails['id'])}}" name="compoff_update" id="compoff_update">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">Approve Comp-off Request</h4>
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 text-right control-label col-form-label">Name</label>
                                <div class="col-sm-9">
                                    {{$compoffDetails['user']['first_name'].' '.$compoffDetails['user']['last_name']}}
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Approver</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control custom-select" name="approver_id" id="approver_id" style="width: 100%; height:36px;" disabled="" >
                                        <option value="">Select Approver</option>
                                        @foreach($reportingToList as $reportingTo)
                                        <option value="{{$reportingTo['id']}}" {{$compoffDetails['approver_id'] == 
                                        $reportingTo['id'] ? 'selected' : ''}}>{{$reportingTo['first_name'].' '.$reportingTo['last_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label col-form-label">Comp-off Start Date</label>
                                <div class="col-sm-4">
                                    <input type="text" name="compoff_start_date" id="compoff_start_date" value="{{ old('compoff_start_date') != '' ? old('compoff_start_date') : $compoffDetails['compoff_start_date']}}" class="form-control" readonly="" />
                                    @if ($errors->has('compoff_start_date'))
                                        <div class="error">{{ $errors->first('compoff_start_date') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    <select name="compoff_start_type" id="compoff_start_type" class="select2 form-control custom-select" style="width: 100%; height:36px;" disabled="" >
                                        <option value="0" {{ old('compoff_start_type') != '' ? (old('compoff_start_type') == 0 ? 'selected' : '') : ($compoffDetails['compoff_start_type'] == 0 ? 'selected' : '')}}>Full Day</option>
                                        <option value="1" {{ old('compoff_start_type') != '' ? (old('compoff_start_type') == 1 ? 'selected' : '') : ($compoffDetails['compoff_start_type'] == 1 ? 'selected' : '')}}>First Half</option>
                                        <option value="2" {{ old('compoff_start_type') != '' ? (old('compoff_start_type') == 2 ? 'selected' : '') : ($compoffDetails['compoff_start_type'] == 2 ? 'selected' : '')}}>Second Half</option>
                                    </select>
                                    @if ($errors->has('compoff_start_type'))
                                        <div class="error">{{ $errors->first('compoff_start_type') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label col-form-label">Comp-off End Date</label>
                                <div class="col-sm-4">
                                    <input type="text" name="compoff_end_date" id="compoff_end_date" value="{{ old('compoff_end_date') != '' ? old('compoff_end_date') : $compoffDetails['compoff_end_date']}}" class="form-control" readonly="" />
                                    @if ($errors->has('compoff_end_date'))
                                        <div class="error">{{ $errors->first('compoff_end_date') }}</div>
                                    @endif
                                </div>
                                <div class="col-md-5">
                                    <select name="compoff_end_type" id="compoff_end_type" class="select2 form-control custom-select" style="width: 100%; height:36px;" disabled="" >
                                        <option value="0" {{ old('compoff_end_type') != '' ? (old('compoff_end_type') == 0 ? 'selected' : '') : ($compoffDetails['compoff_end_type'] == 0 ? 'selected' : '')}}>Full Day</option>
                                        <option value="1" {{ old('compoff_end_type') != '' ? (old('compoff_end_type') == 1 ? 'selected' : '') : ($compoffDetails['compoff_end_type'] == 1 ? 'selected' : '')}}>First Half</option>
                                        <option value="2" {{ old('compoff_end_type') != '' ? (old('compoff_end_type') == 2 ? 'selected' : '') : ($compoffDetails['compoff_end_type'] == 2 ? 'selected' : '')}}>Second Half</option>
                                    </select>
                                    @if ($errors->has('compoff_end_type'))
                                        <div class="error">{{ $errors->first('compoff_end_type') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="compoff_description" class="col-sm-3 text-right control-label col-form-label">Compoff Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="compoff_description" id="reason" readonly="">{{ old('compoff_description') != '' ? old('compoff_description') : $compoffDetails['compoff_description']}}</textarea>
                                    @if ($errors->has('reason'))
                                        <div class="error">{{ $errors->first('compoff_description') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="approver_comment" class="col-sm-3 text-right control-label col-form-label">Approver Comment</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="approver_comment" id="approver_comment" required="" >{{ old('approver_comment') != '' ? old('approver_comment') : $compoffDetails['approver_comment']}}</textarea>
                                    @if ($errors->has('approver_comment'))
                                        <div class="error">{{ $errors->first('approver_comment') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Compoff Status</label>
                                <div class="col-md-9">
                                    <select name="compoff_status" id="compoff_status" class="select2 form-control custom-select" style="width: 100%; height:36px;" required="">
                                        <option value="">Select Compoff Status</option>
                                        @foreach(config('constant.compoff_status') as $key => $value)
                                        <option value="{{$key}}" {{ old('compoff_status') != '' ? (old('compoff_status') == $key ? 'selected' : '') : ($compoffDetails['compoff_status'] == $key ? 'selected' : '')}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <input type="submit" value="Save" class="btn btn-success">
                                <a href="{{url('/pms/compoffs')}}"><button type="button" value="Cancel" class="btn btn-secondary">Cancel</button></a>
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