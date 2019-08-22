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
                            <li class="breadcrumb-item active" aria-current="page">User Management</li>
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
                        <a href="{{url('/pms/users/create')}}" title="Create User">
                            <button type="button" class="btn btn-cyan btn-sm">Create User</button>
                        </a>
                    </div>
                    @endpermission
                    <div class="card-body">
                        <h4 class="card-title">User Management</h4>
                        <div class="table-responsive">
                            <table id="user_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Employee Code</th>
                                        <th>Email</th>
                                        <th>Designation</th>
                                        <th>Reporting To</th>
                                        <th>Status</th>
                                        @permission('users.edit|users.delete')
                                        <th>Action</th>
                                        @endpermission
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($usersData)>0)  
                                    @php
                                    $i = 1
                                    @endphp 
                                    @foreach($usersData as $user)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->last_name}}</td>
                                        <td>{{$user->employee_id}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>@isset ($user->designation->designation_name){{$user->designation->designation_name}}@endisset</td>
                                        <td nowrap="nowrap" class="reporting_to" id="reporting_to_{{$user->id}}">   
                                            <label class="reporting_edit" id="{{$user->id}}" data-reportingid="{{ (isset($user->reportingto) && !empty($user->reportingto)) ? $user->reportingto->id : ''}}">
                                                @if(isset($user->reportingto->first_name) && isset($user->reportingto->last_name))
                                                {{$user->reportingto->first_name.' '.$user->reportingto->last_name}}
                                                @endif
                                            </label>
                                        </td>
                                        <td>{{$statusArray[$user->status]}}</td>
                                        @permission('users.edit|users.delete')
                                        <td align="center">
                                            @permission('users.edit')
                                            <a href="{{url('/pms/users/edit/'.$user->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            @endpermission
                                            @permission('users.delete')
                                            <a href="{{url('/pms/users/destroy/'.$user->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');">
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
                                        <td colspan='7'>No Users Found.</td>
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
                                                $('#user_listing').DataTable();
</script>
<script src="{{asset('js/pms_js/reporting.js')}}"></script>

<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection