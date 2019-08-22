@extends('layouts.pms_layout.pms_design')
@section('content')
@php
$crStatusArray = config('constant.cr_status');
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
                            <li class="breadcrumb-item active" aria-current="page">All Change Requests</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/pms/cr/all_cr')}}" name="search_cr" id="search_cr">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">Change Requests</h4>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Select Project</label>
                                <div class="col-md-9">
                                  <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="project_id" id="project_id">
                                    <option value="">All</option>
                                    @foreach($projectsData as $project)
                                    <option value="{{$project['id']}}" {{ (isset($searchFilter['project_id']) && $searchFilter['project_id'] == $project['id']) ? 'selected' : '' }}>{{$project['project_name']}}</option>
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
                    <!-- <div class="card-body text-right">
                        <a href="{{url('/pms/projects/create')}}" title="Create Project">
                          <button type="button" class="btn btn-cyan btn-sm">Create Project</button>
                        </a>
                    </div> -->
                    <div class="card-body">
                        <h4 class="card-title">Change Requests List</h4>
                        <div class="table-responsive">
                            <table id="cr_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                  										<th>No</th>
                                      <th>Project Name</th>
                                      <th>Title</th>
                  										<th>Estimated Hours</th>
                                      <th>Status</th>
                  										<th>Added By</th>
                                      @permission('cr.edit|cr.delete')
                                      <th>Action</th>
                                      @endpermission
                                    </tr>
                                </thead>
                                <tbody>
                                  @if (count($crData)>0)  
                                    @php
                                    $i = 1
                                    @endphp 
                                    @foreach($crData as $cr)
                                      @if ($cr['project_id'] != 40 || $cr['added_by'] == $loggedInUserID)
                                        <tr>
                                          <td>{{$i}}</td>
                                          <td>
                                            <a href="{{url('/pms/tasks/index/'.$cr['project_id'])}}" title="" >
                                              {{$cr['project_name']}}
                                            </a>
                                          </td>
                                          <td>{{ $cr['title'] }}</td>
                                          <td>{{ $cr['estimated_hours'] }}</td>
                                          <td>{{$crStatusArray[$cr['status']]}}</td>
                                          <td>{{ $cr['added_by_name'] }}</td>
                                          @permission('cr.edit|cr.delete')
                                          <td align="center">
                                            @permission('cr.edit')
                                            <a href="{{url('/pms/cr/edit/'.$cr['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update">
                                                <i class="mdi mdi-pencil"></i>
                                            </a>
                                            @endpermission
                                            @permission('cr.delete')
                                            <a href="{{url('/pms/cr/destroy/'.$cr['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                            @endpermission
                                          </td>
                                          @endpermission
                                        </tr>
                                      @php
                                      $i++
                                      @endphp 
                                      @endif
                                    @endforeach
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
    $('#cr_listing').DataTable();
</script>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection