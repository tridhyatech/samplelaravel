@extends('layouts.pms_layout.pms_design')
@section('content')
@php
$encashed = 0;
if(null !==  Session::get('data')){
    $encashed = Session::get('data');
}
if($compoffDetails['compoff_marked_as'] != 1){
    $monthDivStyle='style=display:none';
}else{
    $monthDivStyle='';
}
@endphp
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
                            <li class="breadcrumb-item"><a href="{{url('/pms/teamcompoffs')}}">Employee Comp-off Requests</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Marked As Comp-off Request</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/pms/compoffs/updateMarkedAs/'.$compoffDetails['id'])}}" name="compoff_update" id="compoff_update">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">Marked As Comp-off Request</h4>    
                             <div class="form-group row">
                                <label for="name" class="col-sm-3 text-right control-label col-form-label">Name</label>
                                <div class="col-sm-9">
                                    {{$compoffDetails['user']['first_name'].' '.$compoffDetails['user']['last_name']}}
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
                                <label class="col-md-3 text-right control-label col-form-label">Comp-off Marked As</label>
                                <div class="col-md-4">
                                    <select name="compoff_marked_as" id="compoff_marked_as" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                        <option value="">Select Compoff Marked As</option>
                                        @foreach(config('constant.compoff_marked_as') as $key => $value)
                                        <option value="{{$key}}" {{ old('compoff_marked_as') != '' ? (old('compoff_marked_as') == $key ? 'selected' : '') : ($compoffDetails['compoff_marked_as'] == $key ? 'selected' : '')}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div id='monthDiv' class="form-group row" {{ $monthDivStyle }}>
                                <label class="col-md-3 text-right control-label col-form-label">Encash Month</label>
                                <div class="col-md-4">
                                        <input type="text" name="compoff_encash_month_year" id="compoff_encash_month_year" value="{{ old('compoff_encash_month_year') != '' ? old('compoff_encash_month_year') : $compoffDetails['compoff_encash_month_year'] }}" class="form-control" />
                                        @if ($errors->has('compoff_encash_month_year'))
                                            <div class="error">{{ $errors->first('compoff_encash_month_year') }}</div>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <input type="submit" value="Save" class="btn btn-success">
                                <a href="{{url('/pms/teamcompoffs')}}"><button type="button" value="Cancel" class="btn btn-secondary">Cancel</button></a>
                            </div>
                        </div>
                        <input type="hidden" id="old_marked_as" name="old_marked_as" value="{{$compoffDetails['compoff_marked_as']}}">
                        <input type="hidden" id="user_id" name="user_id" value="{{$compoffDetails['user_id']}}">
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
<script type="text/javascript">
    $( document ).ready(function() {

        if({{ $encashed }} == 1 || ({{ $compoffDetails['compoff_marked_as']}} !== null && {{ $compoffDetails['compoff_marked_as'] }} == 1)){
            $('#monthDiv').show();
        }else{
            $('#monthDiv').hide();
        }
        $('#compoff_encash_month_year').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'mm-yyyy'
        });
        $("#compoff_marked_as").change(function(){
            if($(this).val() == '1'){
                $('#monthDiv').show();
            }else{
                $('#monthDiv').hide();
            }
        });
    });    
    
    
    
</script>
@endsection