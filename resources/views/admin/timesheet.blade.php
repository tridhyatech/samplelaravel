@extends('layouts.admin_layout.admin_design')
@section('content')
<!--main-container-part-->
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
                            <li class="breadcrumb-item active" aria-current="page">View Time Sheet</li>
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
                    <form class="form-horizontal" method="post" action="{{url('/admin/viewtimesheet')}}" name="user_create" id="user_create">
                    @csrf
                        <div class="card-body">
                            <h4 class="card-title">View Time Sheet</h4>
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Employee</label>
                                <div class="col-md-9">
                                  <select class="select2 form-control" style="width: 100%; height:36px;" name="employee" id="employee" required>
                                    <option value="">Select Employee</option>    
                                    @foreach(config('constant.employees') as $key => $value)
                                    <option value="{{$key}}" {{ (isset($request->employee) && $request->employee == $key) ? 'selected' : '' }}>{{ucfirst($value)}}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Month</label>
                                <div class="col-md-9">
                                  <select class="select2 form-control" style="width: 100%; height:36px;" name="month" id="month" required>
                                    <option value="">Select Month</option>    
                                    @foreach(config('constant.months') as $key => $value)
                                    <option value="{{$key}}" {{ (isset($data['request_month']) && $data['request_month'] == $key) ? 'selected' : '' }}>{{$value}}</option>
                                    @endforeach
                                  </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3 text-right control-label col-form-label">Year</label>
                                <div class="col-md-9">
                                  <select class="select2 form-control" style="width: 100%; height:36px;" name="year" id="year" required>
                                    <option value="">Select Year</option>    
                                    @foreach($years as $key => $value)
                                    <option value="{{$key}}" {{ (isset($data['request_year']) && $data['request_year'] == $key) ? 'selected' : '' }}>{{$value}}</option>
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
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="user_listing" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                      <th>Employee</th>
                                      <th>Employee Code</th>
                                      <th>Total Days</th>
                                      <th>Working Days</th>
                                      <th>Absent Days</th>
                                      <th>Late Days</th>
                                      <th>Early Going Days</th>
                                      <th>Average</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if (count($pms_records)>0)
                                  <tr>
                                    <td>{{$summary['emp_name']}}</td>
                                    <td>{{$summary['emp_code']}}</td>
                                    <td>{{$summary['total_days']}}</td>
                                    <td>{{$summary['working_days']}}</td>
                                    <td>{{$summary['absent_days']}}</td>
                                    <td>{{$summary['late_days']}}</td>
                                    <td>{{$summary['early_going_days']}}</td>
                                    <td>{{$summary['average']}}</td>
                                  </tr>
                                  @else
                                  <tr>
                                    <td colspan='9'>No records found for {{$data['month_name']}} month.</td>
                                  </tr>
                                  @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Summary</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>Date</th>
                                    <th>First IN</th>
                                    <th>Last Out</th>
                                    <th>Working Hours</th>
                                    <th>Break Hours</th>
                                    <th>Total Hours</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @if (count($pms_records)>0)    
                                @foreach($pms_records as $pms)
                                  <tr>
                                    <td>{{$pms->date}}-{{$pms->month}}-{{$pms->year}}</td>
                                    <td>{{$pms->first_in}}</td>
                                    <td>{{$pms->last_out}}</td>
                                    <td>{{$pms->working_hours}}</td>
                                    <td>{{$pms->break_hours}}</td>
                                    <td>{{$pms->total_hours}}</td>
                                    <td><div><strong><a href="#" rel="tooltip" 
     data-toggle="tooltip" 
     data-html="true" 
     data-title="{{$pms->punch_table}}">{{$pms->status}}</a>
                      </strong></div></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="displayTimeEntryPopup({{$pms->id}})" class="btn btn-cyan btn-sm">
                                            <i class="ti-pencil"></i> Update Entry
                                        </a>
                                    </td>
                                  </tr>
                                 @endforeach 
                                 @else
                                  <tr>
                                    <td colspan='8'>No Records Found.</td>
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
    <!-- Modal Update Time Entry -->
    <div class="modal fade none-border" id="update-time-entry">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><strong>Update</strong> time entry</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form method="post" action="{{url('/admin/updatetimeentry')}}" name="update_timeentry" id="update_timeentry">
                    <div class="modal-body">
                        <div class="alert alert-success alert-block" id="time_success_msg" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>Time entry has been updated successfully!!</strong>
                        </div>
                        <div class="alert alert-danger alert-block" id="time_error_msg" style="display: none;">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>Error while updating time entry!!</strong>
                        </div>
                        <div id="time-entry-content"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect waves-light save-category" onclick="addRow()">Add Row</button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light save-category">Save</button>
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END MODAL -->
</div>
<script type="text/javascript">
    function addRow(){
        $('#last_element_ref').before('<div class="col-md-6 row-block" id="rowx"><label class="control-label"></label><input class="form-control form-white" placeholder="In entry" type="text" name="entry_in" id="entry_in" value="" required /></div><div class="col-md-6 row-block" id="rowy"><label class="control-label"></label><div class="input-group"><input class="form-control form-white" placeholder="Out entry" type="text" name="entry_out" id="entry_out" value="" required /><div class="input-group-addon"><a href="javascript:void(0)" class="delete-button" id="delete_row_x" onclick="deleteRow()"><i class="mdi mdi-close"></i></a></div></div></div>');

        reassignInputID();
        reassignAnchorID();
        return false;
    }

    function deleteRow(elementID){
        $('#row'+elementID).remove();
        $('#row'+(elementID-1)).remove();

        reassignInputID();
        reassignAnchorID();
        return false;
    }

    function reassignInputID(){
        var newID = '';
        $("#time_entry_row :input").each(function(index,value){
            var elementID = $(this).attr('id');
            newID = 'entry'+(index+1);

            $('#'+elementID).attr('name', newID);
            $('#'+elementID).attr('id', newID);
            $(this).closest('.row-block').attr('id', 'row'+(index+1));
        });
        
        return true;
    }

    function reassignAnchorID(){
        var newID = '';
        var i = 2;
        $(".delete-button").each(function(index,value){
            var elementID = $(this).attr('id');
            newID = 'delete_row_'+(i);
            
            $('#'+elementID).attr('id', newID);
            $('#'+newID).attr("onclick","deleteRow("+i+")");

            i = (i+2);
        });
        return true;
    }

    function displayTimeEntryPopup(timeEntryID){
        $.ajax({
            type: "POST",
            url: '/admin/gettimeentry',
            data: {"_token": "{{ csrf_token() }}","id": timeEntryID},
            success: function(response) {
                $('#time-entry-content').html(response);
                $('#update-time-entry').modal('show');
                return false;
            }
        });
    }

    $("#update_timeentry").submit(function(event){
        // cancels the form submission
        event.preventDefault();
        updateTimeEntry();
    });

    function updateTimeEntry(){
        var count = $('#time_entry_count').val();
        var data = $("#update_timeentry").serialize();

        $.ajax({
            type: "POST",
            url: '/admin/updatetimeentry',
            data: data,
            success: function(response) {
                $('#time_success_msg').hide();
                $('#time_error_msg').hide();
                if(response == 'success'){
                    $('#time_success_msg').show();

                    setTimeout(function(){
                        $('#update-time-entry').modal('hide');
                        location.reload();
                    }, 2000);
                }else{
                    $('#time_error_msg').show();
                }
                return false;
            }
        });
        return false;
    }
</script>
@endsection