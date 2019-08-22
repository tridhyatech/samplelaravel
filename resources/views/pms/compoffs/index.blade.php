@extends('layouts.pms_layout.pms_design')
@section('content')
@php
$compOffStatusArray = config('constant.compoff_status');
$compoffMarkedAsArray = config('constant.compoff_marked_as');
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
                            <li class="breadcrumb-item active" aria-current="page">Comp-off Requests</li>
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
                    <div class="card-body text-right">
                        <a href="{{url('/pms/compoffs/add')}}" title="Add Comp-off Request">
                            <button type="button" class="btn btn-cyan btn-sm">Add Comp-off Request</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Comp-off Requests</h4>
                        <div class="table-responsive">
                            <table id="compoff_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Employee</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Comp-off Days</th>
                                        <th>Comp-off Description</th>
                                        <th>Approver</th>
                                        <th>Comp-off Status</th>
                                        <th>Encashed / Leave Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($compOffData)>0)  
                                    @php
                                    $i = 1;
                                    @endphp 
                                    @foreach($compOffData as $compoff)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$compoff['user']['first_name'].' '.$compoff['user']['last_name']}}</td>
                                        <td data-sort='{{ $compoff['compoff_start_date'] }}'>{{(new \App\Helpers\CommonHelper)->displayDate($compoff['compoff_start_date'])}}</td>
                                        <td data-sort='{{ $compoff['compoff_end_date'] }}'>{{(new \App\Helpers\CommonHelper)->displayDate($compoff['compoff_end_date'])}}</td>

                                        <td>{{$compoff['compoff_days']}}</td>
                                        <td>{{$compoff['compoff_description']}}</td>
                                        <td>{{$compoff['approver']['first_name'].' '.$compoff['approver']['last_name']}}</td>
                                        <td>
                                            {{$compOffStatusArray[$compoff['compoff_status']]}}
                                        </td>
                                        <td>
                                            @if($compoff['compoff_marked_as'] != '')  
                                            {{$compoffMarkedAsArray[$compoff['compoff_marked_as']]}}
                                            @if($compoff['compoff_marked_as'] == 1)
                                            ({{ $compoff['compoff_encash_month_year'] }})
                                            @endif    
                                            @else
                                            -
                                            @endif
                                        </td>

                                        <td align="center">
                                            <a href="{{url('/pms/compoffs/destroy/'.$compoff['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @php
                                    $i++
                                    @endphp 
                                    @endforeach 
                                    @else
                                    <tr>
                                        <td colspan='10'>You have not added any comp-off requests yet.</td>
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
<script type="text/javascript">
$('#compoff_listing').DataTable();
</script>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection