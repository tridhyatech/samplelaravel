@extends('layouts.pms_layout.pms_design')
@section('content')
@php
$statusArray = config('constant.status');
@endphp
<link href="{{asset('css/admin_css/dataTables.bootstrap4.css')}}" rel="stylesheet">
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
                            <li class="breadcrumb-item active" aria-current="page">My Team</li>
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My Team</h4>
                        <div class="table-responsive">
                            <table id="project_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="12">Team</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($myTeamList)>0)  
                                    @php
                                    $i = 1
                                    @endphp 
                                    @foreach($myTeamList as $myTeamDetail)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>
                                            <a href="{{url('/pms/tasks/index/'.$project['id'])}}" title="" >
                                                {{$project['project_name']}}
                                            </a>
                                        </td>
                                        <td>{{$project['project_type_name']}}</td>
                                        <td>{{$project['project_start_date']}}</td>
                                        <td>{{$project['estimated_hours']}}</td>
                                        <td>{{$project['client_name']}}</td>
                                        <td>{{$project['account_manager_name']}}</td>
                                        <td>{{$project['project_manager_name']}}</td>
                                        <td align="center">
                                            <!-- <a href="{{url('/pms/projects/edit/'.$project['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update">
                                                <i class="mdi mdi-check"></i>
                                            </a>
                                            <a href="{{url('/pms/projects/destroy/'.$project['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');">
                                                <i class="mdi mdi-close"></i>
                                            </a> -->
                                        </td>
                                    </tr>
                                    @php
                                    $i++
                                    @endphp 
                                    @endforeach 
                                    @else
                                    <tr>
                                        <td colspan='9'>No Projects Found.</td>
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
<script src="{{asset('js/admin_js/DataTables/datatables.min.js')}}"></script>
<script>
$('#project_listing').DataTable();
</script>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection