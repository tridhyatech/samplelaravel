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
                            <li class="breadcrumb-item active" aria-current="page">Team Comp-off Requests</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/pms/teamcompoffs')}}" name="team_compoff_status" id="team_compoff_status">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">View 
                                @role('pm|tl') Team @endrole 
                                @role('hr|admin') Employee @endrole 
                                Comp-off Requests</h4>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">@role('pm|tl') Comp-off Status @endrole @role('hr|admin') Employee @endrole </label>
                                <div class="col-md-9">
                                    @role('pm|tl')   
                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="compoff_status" id="compoff_status">
                                        <option value="0">All</option>
                                        @foreach(config('constant.compoff_status') as $key => $value)
                                        <option value="{{$key}}" {{ (isset($compoffStatusSelected) && $compoffStatusSelected == $key) ? 'selected' : ''}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                    @endrole
                                    @role('hr|admin')
                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="user" id="user">
                                        <option value="0">All</option>
                                        @foreach($userNameArray as $key => $value)
                                        <option value="{{$key}}" {{ (isset($userSelected) && $userSelected == $key) ? 'selected' : ''}}>{{$value}}</option>
                                        @endforeach
                                    </select>  
                                    @endrole
                                </div>

                            </div>
                            @role('admin')
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Compoff Status</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control custom-select" name="ddlCompOffStatus" id="ddlCompOffStatus">
                                        <option value="">-- select status --</option>
                                        @foreach($compoffStatus as $cs)
                                        <option value="{{$cs['id']}}" {{ ($cs['id'] == request()->input('ddlCompOffStatus',old('ddlCompOffStatus'))) ? 'selected' : ''  }}>{{$cs['statusName']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endrole
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button name="submit" type="submit" class="btn btn-success">
                                    Search
                                </button>
                                <a href="{{url('/pms/teamcompoffs')}}" role="button" name="reset" class="btn btn-warning">
                                    Reset
                                </a>
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
                    <div class="card-body">
                        <h4 class="card-title">Team Comp-off Requests</h4>
                        @if (count($compoffData)>0)  
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
                                    @php
                                    $i = 1;
                                    @endphp 
                                    @foreach($compoffData as $compoff)
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
                                            @if (Auth::user()->hasRole('hr') || Auth::user()->hasRole('admin')) 
                                            <a href="{{url('/pms/compoffs/markedas/'.$compoff['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            <a href="{{url('/pms/compoffs/destroy/'.$compoff['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                            @endif 
                                            @if (($loggedInUserID == $compoff['approver_id'] || Auth::user()->hasRole('pm')) && $compoff['compoff_marked_as'] == '')
                                            <a href="{{url('/pms/compoffs/approve/'.$compoff['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            @endif
                                            @if (($loggedInUserID == $compoff['approver_id'] || Auth::user()->hasRole('pm')))
                                            <a href="{{url('/pms/compoffs/destroy/'.$compoff['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                    $i++
                                    @endphp 
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="border-top">
                            <h4 align="center" style="padding : 20px;">No comp-off from your team.</h4>
                        </div>
                        @endif
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