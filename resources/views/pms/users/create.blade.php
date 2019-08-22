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
                            <li class="breadcrumb-item"><a href="{{url('/pms/users')}}">User Management</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create User</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/pms/users/store')}}" name="user_create" id="user_create">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">Create User</h4>
                            <div class="form-group row">
                                <label for="first_name" class="col-sm-3 text-right control-label col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control" required />
                                    @if ($errors->has('first_name'))
                                        <div class="error">{{ $errors->first('first_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="last_name" class="col-sm-3 text-right control-label col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control" required />
                                    @if ($errors->has('last_name'))
                                        <div class="error">{{ $errors->first('last_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 text-right control-label col-form-label">Company Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required />
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="personal_email" class="col-sm-3 text-right control-label col-form-label">Personal Email</label>
                                <div class="col-sm-9">
                                    <input type="personal_email" name="personal_email" id="personal_email" value="{{ old('personal_email') }}" class="form-control" />
                                    @if ($errors->has('personal_email'))
                                        <div class="error">{{ $errors->first('personal_email') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 text-right control-label col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" id="password" value="{{ old('password') }}" class="form-control" required />
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="confirm_password" class="col-sm-3 text-right control-label col-form-label">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="confirm_password" id="confirm_password" value="{{ old('confirm_password') }}" class="form-control" required />
                                    @if ($errors->has('confirm_password'))
                                        <div class="error">{{ $errors->first('confirm_password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-sm-3 text-right control-label col-form-label">Contact Number</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control" required />
                                    @if ($errors->has('phone'))
                                        <div class="error">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label col-form-label">Date Of Birth</label>
                                <div class="col-sm-9">
                                    <input type="text" name="dob" id="dob" value="{{ old('dob') }}" class="form-control"/>
                                    @if ($errors->has('dob'))
                                        <div class="error">{{ $errors->first('dob') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="employee_id" class="col-sm-3 text-right control-label col-form-label">Employee ID</label>
                                <div class="col-sm-9">
                                    <input type="text" name="employee_id" id="employee_id" value="{{ old('employee_id') }}" class="form-control" required />
                                    @if ($errors->has('employee_id'))
                                        <div class="error">{{ $errors->first('employee_id') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Designation</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control custom-select" name="designation_id" id="designation_id" style="width: 100%; height:36px;" required>
                                        <option value="">Select Designation</option>
                                        @foreach($designationData as $designation)
                                        <option value="{{$designation['id']}}" {{ old('designation_id') == $designation['id'] ? 'selected' : ''}}>{{$designation['designation_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Department</label>
                                <div class="col-md-9">
                                    <select name="department" id="department" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                        <option value="">Select Department</option>
                                        @foreach(config('constant.department') as $key => $value)
                                        <option value="{{$key}}" {{ old('department') == $key ? 'selected' : ''}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Reporting To</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control custom-select" name="reporting_to" id="reporting_to" style="width: 100%; height:36px;" required>
                                        <option value="">Select</option>
                                        @foreach($reportingToList as $reportingTo)
                                        <option value="{{$reportingTo['id']}}" {{ old('reporting_to') == $reportingTo['id'] ? 'selected' : ''}}>{{$reportingTo['first_name'].' '.$reportingTo['last_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="bank_name" class="col-sm-3 text-right control-label col-form-label">Bank Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="bank_name" id="bank_name" value="{{ old('bank_name') }}" class="form-control" />
                                    @if ($errors->has('bank_name'))
                                        <div class="error">{{ $errors->first('bank_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bank_account_no" class="col-sm-3 text-right control-label col-form-label">Bank Account Number</label>
                                <div class="col-sm-9">
                                    <input type="text" name="bank_account_no" id="bank_account_no" value="{{ old('bank_account_no') }}" class="form-control" />
                                    @if ($errors->has('bank_account_no'))
                                        <div class="error">{{ $errors->first('bank_account_no') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pan_no" class="col-sm-3 text-right control-label col-form-label">PAN Number</label>
                                <div class="col-sm-9">
                                    <input type="text" name="pan_no" id="pan_no" value="{{ old('pan_no') }}" class="form-control" />
                                    @if ($errors->has('pan_no'))
                                        <div class="error">{{ $errors->first('pan_no') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 text-right control-label col-form-label">Joining Date</label>
                                <div class="col-sm-9">
                                    <input type="text" name="joining_date" id="joining_date" value="{{ old('joining_date') }}" class="form-control" />
                                    @if ($errors->has('joining_date'))
                                        <div class="error">{{ $errors->first('joining_date') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Role</label>
                                <div class="col-md-9">
                                    <select class="select2 form-control custom-select" name="role_id" id="role_id" style="width: 100%; height:36px;" required>
                                        <option value="">Select Role</option>
                                        @foreach($roleList as $role)
                                        <option value="{{$role['id']}}" {{ old('role_id') == $role['id'] ? 'selected' : ''}}>{{$role['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Employee Status</label>
                                <div class="col-md-9">
                                    <select name="employee_status" id="employee_status" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                        <option value="">Select Status</option>
                                        @foreach(config('constant.employee_status') as $key => $value)
                                        <option value="{{$key}}" {{ old('employee_status') == $key ? 'selected' : ''}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <?php
                            /*
                            <div class="form-group row">
                                <label for="available_leaves" class="col-sm-3 text-right control-label col-form-label">Leave Opening Bal</label>
                                <div class="col-sm-9">
                                    <input type="text" name="available_leaves" id="available_leaves" value="{{ old('available_leaves') }}" class="form-control" />
                                    @if ($errors->has('available_leaves'))
                                        <div class="error">{{ $errors->first('available_leaves') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="used_leaves" class="col-sm-3 text-right control-label col-form-label">Leave Balance C/F</label>
                                <div class="col-sm-9">
                                    <input type="text" name="used_leaves" id="used_leaves" value="{{ old('used_leaves') }}" class="form-control" />
                                    @if ($errors->has('used_leaves'))
                                        <div class="error">{{ $errors->first('used_leaves') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Status</label>
                                <div class="col-md-9">
                                    <select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                        <option value="">Select Status</option>
                                        @foreach(config('constant.status') as $key => $value)
                                        <option value="{{$key}}" {{ old('status') == $key ? 'selected' : ''}}>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            */
                            ?>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <input type="submit" value="Save" class="btn btn-success">
                                <a href="{{url('/pms/users')}}"><button type="button" value="Cancel" class="btn btn-secondary">Cancel</button></a>
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
<script type="text/javascript">
    $(function(){
        $('#joining_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
        $('#dob').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd'
        });
    });
</script>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
@endsection