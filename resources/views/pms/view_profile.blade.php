@extends('layouts.pms_layout.pms_design')
@section('content')
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
                            <li class="breadcrumb-item active" aria-current="page">Profile Details</li>
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
                        <h4 class="card-title">Profile Details</h4>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                          <tr>
                                            <th>Name</th>
                                            <td>{{ $user->first_name.' '.$user->last_name }}</td>
                                          </tr>
                                          <tr>
                                            <th>Designation</th>
                                            <td>{{ $designation_name }}</td>
                                          </tr>
                                          <tr>
                                            <th>Employee Code</th>
                                            <td>{{ $user->employee_id }}</td>
                                          </tr>
                                          <tr>
                                            <th>Company Email</th>
                                            <td>{{ $user->email }}</td>
                                          </tr>
                                          <tr>
                                            <th>Personal Email</th>
                                            <td>{{ $user->personal_email }}
                                                @if($user->personal_email != '')
                                                <a href="#gotoEdit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                @endif
                                            </td>
                                          </tr>
                                          <tr>
                                            <th>Phone Number</th>
                                            <td>{{ $user->phone }}
                                                @if($user->phone != '')
                                                <a href="#gotoEdit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                @endif
                                            </td>
                                          </tr>
                                          <tr>
                                            <th>Date Of Birth</th>
                                            <td>
                                                @if ($user->birthdate == '' || $user->birthdate == '0000-00-00' || $user->birthdate == '1970-01-01')
                                                    {{ '-' }}
                                                @else
                                                    {{ (new \App\Helpers\CommonHelper)->displayDate($user->birthdate) }}  
                                                    <a href="#gotoEdit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                @endif
                                            </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                          <tr>
                                            <th>Department</th>
                                            @foreach(config('constant.department') as $key => $value)
                                                @if ($key == $user->department)
                                                    <td>{{ $value }}</td>
                                                @endif
                                            @endforeach
                                          </tr>
                                          <tr>
                                            <th>Bank Name</th>
                                            <td>{{ $user->bank_name }}</td>
                                          </tr>
                                          <tr>
                                            <th>Bank Account No</th>
                                            <td>{{ $user->bank_account_no }}</td>
                                          </tr>
                                          <tr>
                                            <th>PAN No</th>
                                            <td>{{ $user->pan_no }}</td>
                                          </tr>
                                          <tr>
                                            <th>Employee Status</th>
                                            @foreach(config('constant.employee_status') as $key => $value)
                                                @if ($key == $user->employee_status)
                                                    <td>{{ $value }}</td>
                                                @endif
                                            @endforeach
                                          </tr>
                                          <tr>
                                            <th>Reporting Person</th>
                                            <td>{{ $reportingPerson }}</td>
                                          </tr>
                                          
                                          <tr>
                                            <th>Joining Date</th>
                                            <td>
                                                @if ($user->joining_date == '' || $user->joining_date == '0000-00-00 00:00:00' || $user->joining_date == '1970-01-01 00:00:00')
                                                    {{ '-' }}
                                                @else
                                                    {{ (new \App\Helpers\CommonHelper)->displayDate($user->joining_date) }}  
                                                @endif
                                            </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal" method="post" action="{{url('/pms/viewprofile')}}" name="edit_personal_details" id="edit_personal_details">
                    @csrf
                        <div id="gotoEdit" class="card-body">
                            <h4 class="card-title">Edit Personal Details</h4>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Personal Email</label>
                                <div class="col-md-6">
                                    <input type="text" name="personal_email" id="personal_email" value="{{ $user->personal_email }}" class="form-control" />
                                    @if ($errors->has('personal_email'))
                                        <div class="error">{{ $errors->first('personal_email') }}</div>
                                    @endif
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Phone Number</label>
                                <div class="col-md-6">
                                    <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="form-control" required />
                                    @if ($errors->has('phone'))
                                        <div class="error">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Date Of Birth</label>
                                <div class="col-md-6">
                                    <input type="text" name="dob" id="dob" value="{{ $user->birthdate }}" class="form-control" />
                                    @if ($errors->has('dob'))
                                        <div class="error">{{ $errors->first('dob') }}</div>
                                    @endif
                                </div>
                            </div> 
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button name="submit" type="submit" class="btn btn-success">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
<script type="text/javascript">
    $(function(){
        $('#dob').datepicker({
            endDate: "today",
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    });
</script>
@endsection