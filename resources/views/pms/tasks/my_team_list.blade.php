@extends('layouts.pms_layout.pms_design')
@section('content')
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
                            <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Team List</li>
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
                    <div class="card-body">
                        <h4 class="card-title">Team List</h4>
                        <div class="table-responsive">
                          <table id="team_listing" class="table table-striped table-bordered">
                            <thead>
                              <tr>
            					<th>No</th>
                                <th>Name</th>
                                <th>Employee Code</th>
                                <th>Email</th>
                                <th>Phone</th>
            					<th>Designation</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (isset($myTeamList) && count($myTeamList)>0)  
								@php
								$i = 1
								@endphp 
								@foreach($myTeamList as $team)
                                  <tr>
                                    <td>{{$i}}</td>
                                    <td>{{ $team['first_name'].' '.$team['last_name'] }}</td>
                                    <td>{{ $team['employee_id'] }}</td>
                                    <td>{{ $team['email'] }}</td>
                                    <td>{{ $team['phone'] }}</td>
                  					<td>{{ $team['designation_name'] }}</td>
                                  </tr>
                                @php
                                $i++
                                @endphp
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
    $('#team_listing').DataTable();
</script>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection