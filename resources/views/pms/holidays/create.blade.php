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
                            <li class="breadcrumb-item"><a href="{{url('/pms/holidays')}}">Holidays Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Holiday</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/pms/holidays/store')}}" name="holiday_create" id="holiday_create">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">Create Holiday</h4>
                            <div class="form-group row">
                                <label for="holiday_name" class="col-sm-3 text-right control-label col-form-label">Holiday Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="holiday_name" id="holiday_name" value="{{ old('holiday_name') }}" class="form-control" required />
                                    @if ($errors->has('holiday_name'))
                                        <div class="error">{{ $errors->first('holiday_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="holiday_date" class="col-sm-3 text-right control-label col-form-label">Holiday Date</label>
                                <div class="col-sm-9">
                                    <input type="text" name="holiday_date" id="holiday_date" value="{{ old('holiday_date') }}" class="form-control" required />
                                    @if ($errors->has('holiday_date'))
                                        <div class="error">{{ $errors->first('holiday_date') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Holiday Year</label>
                                <div class="col-md-9">
                                    <select name="holiday_year" id="holiday_year" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                        <option value="">Select Year</option>
                                        @for ($year = date('Y'); $year <= 2030; $year++)
                                            <option value="{{ $year }}" {{ old('holiday_year') == 
                                        $year ? 'selected' : ''}}>{{ $year }}</option>
                                        @endfor  
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <input type="submit" value="Save" class="btn btn-success">
                                <a href="{{url('/pms/holidays')}}"><button type="button" value="Cancel" class="btn btn-secondary">Cancel</button></a>
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
    $('#holiday_date').datepicker({
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