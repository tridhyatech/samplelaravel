@extends('layouts.pms_layout.pms_design')
@section('content')
@php
$projectStatusArray = config('constant.project_status');
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
                            <li class="breadcrumb-item active" aria-current="page">My Projects</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/pms/projects/myprojects')}}" name="search_project" id="search_project">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">My Projects</h4>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Project Type</label>
                                <div class="col-md-9">
                                  <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="project_type" id="project_type" >
                                    <option value="">Select Project Type</option>   
                                    @foreach($projectTypeData as $projectType)
                                    <option value="{{$projectType['id']}}" {{ (isset($searchFilter['project_type']) && $searchFilter['project_type'] == $projectType['id']) ? 'selected' : '' }}>{{$projectType['project_type_name']}}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Project Status</label>
                                <div class="col-md-9">
                                  <select class="select2 form-control custom-select" style="width: 100%; height:36px;" name="project_status" id="project_status">
                                    <option value="">All</option>    
                                    @foreach(config('constant.project_status') as $key => $value)
                                    <option value="{{$key}}" {{ (isset($searchFilter['project_status']) && $searchFilter['project_status'] == $key) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div> 
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button name="submit" type="submit" class="btn btn-success">Search</button>
                                <a role="button" href="{{url('pms/projects/myprojects')}}" name="reset" id="reset" class="btn btn-warning">Reset</a>
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
                    @permission('projects.create')
                    <div class="card-body text-right">
                        <a href="{{url('/pms/projects/create')}}" title="Create Project">
                          <button type="button" class="btn btn-cyan btn-sm">Create Project</button>
                        </a>
                    </div>
                    @endpermission
                    <div class="card-body">
                        <h4 class="card-title">My Projects</h4>
                        <div class="table-responsive">
                            <table id="project_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                  										<th>No</th>
                  										<th>Project Name</th>
                  										<th>Project Type</th>
                  										<th>Start Date</th>
                                      <th>Client Name</th>
                                      <th>Account Manager</th>
                                      <th>Project Manager</th>
                                      <th>Status</th>
                                      <th>Estimation</th>
                                      <th>Logged Hours</th>
                                      <th>%</th>
                  										@permission('projects.edit|projects.delete|projects.assign')
                                      <th>Action</th>
                                      @endpermission
                                    </tr>
                                </thead>
                                <tbody>
                                @if (count($projectsData)>0)  
                								@php
                								$i = 1
                								@endphp 
                								@foreach($projectsData as $project)
                                  <tr>
                                    <td>{{$i}}</td>
                  									<td>
                                      <a href="{{url('/pms/tasks/index/'.$project['id'])}}" title="" >
                                        {{$project['project_name']}}
                                      </a>
                                    </td>
                  									<td>{{$project['project_type_name']}}</td>
                  									<td>{{(new \App\Helpers\CommonHelper)->displayDate($project['project_start_date'])}}</td>
                                    <td>{{$project['client_name']}}</td>
                                    <td>{{$project['account_manager_name']}}</td>
                                    <td>{{$project['project_manager_name']}}</td>
                                    <td>
                                      {{$projectStatusArray[$project['project_status']]}}
                                    </td>
                                    <td>{{(new \App\Helpers\CommonHelper)->displayTaskTime($totalEstimatedHours[$project['id']])}}</td>
                                    <td>{{(new \App\Helpers\CommonHelper)->displayTaskTime($project['total_logged_hours'])}}</td>
                                    @if ($percentage[$project['id']] > 100)
                                        <td data-sort="{{$percentage[$project['id']]}}" style="color:#FF0000;">{{$percentage[$project['id']]}}%</td>
                                    @elseif ($percentage[$project['id']] === 'NA')
                                        <td data-sort="{{$percentage[$project['id']]}}">{{$percentage[$project['id']]}}</td>
                                    @else
                                        <td data-sort="{{$percentage[$project['id']]}}">{{$percentage[$project['id']]}}%</td>
                                    @endif
                                    @permission('projects.edit|projects.delete|projects.assign')
                                    <td align="center">
                                      @permission('cr.add')
                                      <a href="{{url('/pms/cr/create/'.$project['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add CR">
                                          <i class="fa fa-plus"></i>
                                      </a>
                                      @endpermission
                                      @permission('projects.edit')
                                      <a href="{{url('/pms/projects/edit/'.$project['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update">
                                          <i class="mdi mdi-pencil"></i>
                                      </a>
                                      @endpermission
                                      @permission('projects.delete')
                                      <a href="{{url('/pms/projects/destroy/'.$project['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');">
                                          <i class="mdi mdi-close"></i>
                                      </a>
                                      @endpermission
                                      @permission('projects.assign')
                                      <a href="{{url('/pms/projects/assignusers/'.$project['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Assign Users">
                                          <i class="mdi mdi-account-plus"></i>
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
                                    <td colspan='12'>No Projects Found.</td>
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