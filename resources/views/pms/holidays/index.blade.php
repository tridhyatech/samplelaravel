@extends('layouts.pms_layout.pms_design')
@section('content')
@php
$statusArray = config('constant.status');
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
                            <li class="breadcrumb-item active" aria-current="page">Holidays Management</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/pms/holidays')}}" name="search_project" id="search_project">
                    @csrf
                        <div class="card-body">
                          <h4 class="card-title">Holidays Management</h4>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Holiday Year</label>
                                <div class="col-md-9">
                                  <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="request_year" id="request_year" >
                                    <option value="">Select Year</option>  
                                    @for ($year = date('Y'); $year <= 2030; $year++)
                                        <option value="{{ $year }}" {{ (isset($searchFilter['request_year']) && $searchFilter['request_year'] == $year) ? 'selected' : '' }}>{{ $year }}</option>
                                    @endfor   
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
                    @permission('users.create')
                    <div class="card-body text-right">
                        <a href="{{url('/pms/holidays/create')}}" title="Create Holiday">
                          <button type="button" class="btn btn-cyan btn-sm">Create Holiday</button>
                        </a>
                    </div>
                    @endpermission
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="holiday_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Name</th>
                                      <th>Date</th>
                                      <th>Year</th>
                                      @permission('users.edit|users.delete')
                                      <th>Action</th>
                                      @endpermission
                                    </tr>
                                </thead>
                                <tbody>
                                @if (count($holidaysData)>0)  
                                @php
                                $i = 1
                                @endphp 
                                @foreach($holidaysData as $holidayDetail)
                                  <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$holidayDetail['holiday_name']}}</td>
                                    <td>{{(new \App\Helpers\CommonHelper)->displayDate($holidayDetail['holiday_date'])}}</td>
                                    <td>{{$holidayDetail['holiday_year']}}</td>
                                    @permission('users.edit|users.delete')
                                    <td align="center">
                                      @permission('users.edit')
                                      <a href="{{url('/pms/holidays/edit/'.$holidayDetail['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update">
                                          <i class="mdi mdi-pencil"></i>
                                      </a>
                                      @endpermission
                                      @permission('users.delete')
                                      <a href="{{url('/pms/holidays/destroy/'.$holidayDetail['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');">
                                          <i class="mdi mdi-close"></i>
                                      </a>
                                      @endpermission
                                    </td>
                                    @endpermission
                                  </tr>
                                  @php
                                  $i++
                                  @endphp 
                                 @endforeach 
                                 @else
                                 <tr>
                                    <td colspan='5'>No Holidays Found.</td>
                                  </tr>
                                 @endif
                                </tbody>
                            </table>
                        </div>
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
<script>
    $('#holiday_listing').DataTable();
</script>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection