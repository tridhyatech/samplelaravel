<div class="col-md-12">
  <div class="card">
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-4 text-right control-label col-form-label">Task Date</label>
            <div class="col-sm-8">
                <input type="text" name="log_date" id="log_date" autocomplete="off" value="{{ old('log_date') }}" class="form-control" required />
                @if ($errors->has('log_date'))
                    <div class="error">{{ $errors->first('log_date') }}</div>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-right control-label col-form-label">Work Time</label>
            <div class="col-md-4">
              <select class="select2 form-control" style="width: 100%; height:36px;" name="task_hours" id="task_hours" required>
                <option value="">Hours</option>  
                @for ($i = 0; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ old('task_hours') == 
                $i ? 'selected' : ''}}>{{ $i }}</option>
                @endfor  
              </select>
            </div>
            <div class="col-md-4">
              <select class="select2 form-control" style="width: 100%; height:36px;" name="task_minutes" id="task_minutes" required>
                <option value="">Minutes</option>  
                <option value="0" selected>0</option>
                <option value="15" {{ old('task_minutes') == 
            "15" ? 'selected' : ''}}>15</option>
                <option value="30" {{ old('task_minutes') == 
            "30" ? 'selected' : ''}}>30</option>
                <option value="45" {{ old('task_minutes') == 
            "45" ? 'selected' : ''}}>45</option>
              </select>
            </div>
        </div> 
        <div class="form-group row">
            <label for="log_description" class="col-sm-4 text-right control-label col-form-label">Task Description</label>
            <div class="col-sm-8">
                <textarea rows="3" class="form-control" name="log_description" id="log_description" required>{{ old('log_description') }}</textarea>
            </div>
        </div>
    </div>
    <div class="border-bottom">
        <div class="card-body">
            <button type="submit" class="btn btn-danger waves-effect waves-light save-category">Save</button>
            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
<div class="col-md-12">
  <div class="card">
    <div class="card-body">
        <h4 class="card-title">Task Entries</h4>
        <div class="table-responsive">
            <table id="task_listing" class="table table-striped table-bordered">
                <thead>
                    <tr>
                      <th>No</th>
                      <th>Date</th>
                      <th>Hours</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @if (count($taskEntryListing)>0)  
                @php
                $i = 1
                @endphp 
                @foreach($taskEntryListing as $taskEntry)
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{(new \App\Helpers\CommonHelper)->displayDate($taskEntry['log_date'])}}</td>
                    <td>{{(new \App\Helpers\CommonHelper)->displayTaskTime($taskEntry['log_hours'])}}</td>
                    <td>{{$taskEntry['log_description']}}</td>
                    <td align="center">
                      <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update" onclick="editTaskEntry({{$taskEntry['id']}});">
                          <i class="mdi mdi-pencil"></i>
                      </a>
                      <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="deleteTaskEntry({{$taskEntry['id']}});">
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
                    <td colspan='5'>No Records Found.</td>
                  </tr>
                 @endif
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
<input type="hidden" name="task_id" id="task_id" value="{{$taskID}}">
<input type="hidden" name="id" id="id" value="0">
<input type="hidden" name="task_start_date" id="task_start_date" value="{{$taskDetail['task_start_date']}}">
<input type="hidden" name="task_end_date" id="task_end_date" value="{{$taskDetail['task_end_date']}}">
<script type="text/javascript">
    $(function(){
      $('#log_date').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        startDate: $('#task_start_date').val(),
        endDate: $('#task_end_date').val(),
      });
    });

    function saveTaskEntry(){
        var data = $("#save_taskentry").serialize();
        var taskID = $('#task_id').val();

        $.ajax({
            type: "POST",
            url: getsiteurl()+'/pms/savetaskentry',
            data: data,
            success: function(response) {
                $('#time_success_msg').hide();
                $('#time_error_msg').hide();
                $('#time_delete_success_msg').hide();
                $('#time_delete_error_msg').hide();
                if(response == 'success'){
                    $('#time_success_msg').show();
                    
                    setTimeout(function(){
                        $('#time_success_msg').hide();
                        $('#time_error_msg').hide();
                        $('#time_delete_success_msg').hide();
                        $('#time_delete_error_msg').hide();
                        $('#task-entry-content').html('');
                        addTaskEntryPopup(taskID);
                        // location.reload();
                    }, 1000);
                }else{
                    $('#time_error_msg').show();
                }
                return false;
            }
        });
        return false;
    }

    function deleteTaskEntry(taskTimeID){
        var taskID = $('#task_id').val();

        var r = confirm("Are you sure you want to delete?");
        if (r == true) {

            $.ajax({
                type: "POST",
                url: getsiteurl()+'/pms/deletetaskentry',
                data: {"_token": "{{ csrf_token() }}","id": taskTimeID},
                success: function(response) {
                    $('#time_success_msg').hide();
                    $('#time_error_msg').hide();
                    $('#time_delete_success_msg').hide();
                    $('#time_delete_error_msg').hide();
                    if(response == 'success'){
                        $('#time_delete_success_msg').show();
                        setTimeout(function(){
                            $('#time_success_msg').hide();
                            $('#time_error_msg').hide();
                            $('#time_delete_success_msg').hide();
                            $('#time_delete_error_msg').hide();
                            $('#task-entry-content').html('');
                            addTaskEntryPopup(taskID);
                            // location.reload();
                        }, 1000);
                    }else{
                        $('#time_delete_error_msg').show();
                    }
                    return false;
                }
            });
        } 
        return false;
    }

    function editTaskEntry(taskTimeID){
        var taskID = $('#task_id').val();

        $.ajax({
            type: "POST",
            url: getsiteurl()+'/pms/gettaskentrydetail',
            data: {"_token": "{{ csrf_token() }}","id": taskTimeID},
            success: function(response) {
                $('#time_entry_title').html('Update');
                var data = $.parseJSON(response);
                $('#log_date').val(data.log_date);
                $('#log_description').val(data.log_description);
                $('#task_hours').val(data.task_hours);
                $('#task_minutes').val(data.task_minutes);
                $('#id').val(data.id);
                return false;
            }
        });
        return false;
    }
</script>