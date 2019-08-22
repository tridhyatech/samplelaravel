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
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/pms/changepassword')}}" name="user_create" id="user_create">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">Change Password</h4>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 text-right control-label col-form-label">Current Password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password" id="password" value="" autocomplete="new-password" class="form-control" required />
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="new_password" class="col-sm-3 text-right control-label col-form-label">New Password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="new_password" id="new_password" class="form-control" required />
                                    @if ($errors->has('new_password'))
                                        <div class="error">{{ $errors->first('new_password') }}</div>
                                    @endif
                                </div>
                                <div class="col-sm-2">
                                    <input id="generatePswdButton" type="button" value="Generate Password" class="btn btn-info">
                                </div>  
                                <div class="col-sm-1">
                                    <a id="showPswd" href="JavaScript:void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show/Hide Password">
                                    <i class="mdi mdi-eye" style="font-size: 18px; margin-left: -25px;"></i></a>
                                </div>   
                            </div>
                            <div class="form-group row">
                                <label for="confirm_password" class="col-sm-3 text-right control-label col-form-label">Confirm password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required />
                                    @if ($errors->has('confirm_password'))
                                        <div class="error">{{ $errors->first('confirm_password') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <input id="submitBtn" type="submit" value="Change" class="btn btn-success">
                                <a href="{{url('/pms/dashboard')}}"><button type="button" value="Cancel" class="btn btn-secondary">Cancel</button></a>
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
@endsection

<script src="{{asset('js/pms_js/jquery.min.js')}}"></script>  
<script type="text/javascript">
    $( document ).ready(function() {
        $('#showPswd').click(function(){
            var x = document.getElementById("new_password");
            var y = document.getElementById("confirm_password");
            if (x.type === "password") {
              x.type = "text";
              y.type = "text";
            } else {
              x.type = "password";
              y.type = "password";
            } 
        });
        $('#generatePswdButton').click(function(){
              var hash = randomPassword(8);   
//            $("#new_password").prop('type', 'text');
//            $("#confirm_password").prop('type', 'text');
            $('#new_password').val(hash);
            $('#confirm_password').val(hash);
        });
//        $('#submitBtn').click(function(){
//            $("#new_password").prop('type', 'password');
//            $("#confirm_password").prop('type', 'password');
//        });
    });
    function randomPassword(length) {
        var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
        var pass = "";
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * chars.length);
            pass += chars.charAt(i);
        }
        return pass;
    }
</script>