@extends('layouts.pms_layout.pms_design')
@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Late Users</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/pms/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Late Users</li>
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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal" method="post" action="{{url('/late-users-data')}}" name="late_users_form" id="late_users_form">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">Late Users</h4>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Month</label>
                                <div class="col-md-9">
                                  <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="month" id="month" required>
                                    <option value="">Select Month</option>    
                                    @foreach(config('constant.months') as $key => $value)
                                    <option value="{{$key}}" {{ (isset($data['request_month']) && $data['request_month'] == $key) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Year</label>
                                <div class="col-md-9">
                                  <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="year" id="year" required>
                                    <option value="">Select Year</option>    
                                    @foreach($years as $key => $value)
                                    <option value="{{$key}}" {{ (isset($data['request_year']) && $data['request_year'] == $key) ? 'selected' : '' }}>{{$value}}</option>
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
            <!-- Column -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title m-b-0">Late users</h5>
                    </div>
                    <table id="late_users" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Employee Code</th>
                                <th scope="col">Name</th>
                                <th scope="col">Late Days</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lateUsers as $lateUsersDetail)
                                @if($lateUsersDetail['lateCount'] > 3)
                                    <tr>
                                        <td>{{ $lateUsersDetail['emp_code'] }}</td>
                                        <td>{{ $lateUsersDetail['emp_name'] }}</td>
                                        <td>{{ $lateUsersDetail['lateCount'] }}</td>
                                    </tr>
                                @endif
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>

<!-- this page js -->
<script src="{{asset('js/pms_js/jquery.min.js')}}"></script>  
<script src="{{asset('js/pms_js/DataTables/datatables.min.js')}}"></script>
<script>
    $('#late_users').DataTable({searching: true, paging: true, info: true, lengthChange: false, pageLength: 10, order: [[0, "asc"]]});
    $.noConflict();
</script>

@endsection