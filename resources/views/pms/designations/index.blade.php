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
                            <li class="breadcrumb-item active" aria-current="page">Designation Management</li>
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
                    @permission('designation.create')              
                    <div class="card-body text-right">
                        <a href="{{url('/pms/designation/create')}}" title="Create Designation">
                          <button type="button" class="btn btn-cyan btn-sm">Create Designation</button>
                        </a>
                    </div>
                    @endpermission
                    <div class="card-body">
                        <h4 class="card-title">Designation Management</h4>
                        <div class="table-responsive">
                            <table id="designation_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Designation Name</th>
                                      @permission('designation.edit|designation.delete')
                                      <th>Action</th>
                                      @endpermission
                                    </tr>
                                </thead>
                                <tbody>
                                @if (count($designationData)>0)  
                                @php
                                $i = 1
                                @endphp 
                                @foreach($designationData as $designation)
                                  <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$designation['designation_name']}}</td>
                                    @permission('designation.edit|designation.delete')
                                    <td align="center">
                                      @permission('designation.edit')
                                      <a href="{{url('/pms/designation/edit/'.$designation['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update">
                                          <i class="mdi mdi-pencil"></i>
                                      </a>
                                      @endpermission
                                      @permission('designation.delete')
                                      <a href="{{url('/pms/designation/destroy/'.$designation['id'])}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="return confirm('Are you sure you want to delete?');">
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
                                    <td colspan='7'>No Records Found.</td>
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
    $('#designation_listing').DataTable();
</script>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection