$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
$("#user_listing").on("click", ".reporting_edit", function(){
    var userId = $(this).attr('id');
    var currentReporting = $('#reporting_to_'+userId).text();
    var reportingID = $(this).attr('data-reportingid');
    if(userId) {
                $.ajax({
                    url: 'reporting/ajax/'+userId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#reporting_to_'+userId).empty();
                        $('#reporting_to_'+userId).append('<select name="report_to" class="report_to" id="report_to_'+userId+'">');
                        $.each(data, function(key, value) {
                            var selected = value.id==reportingID?'selected':'';
                            $('select[id="report_to_'+userId+'"]').append('<option '+selected+' value="'+ value.id +'">'+ value.first_name +' '+ value.last_name+'</option>');
                        });
                        $('#reporting_to_'+userId).append('</select>');
                        $('#reporting_to_'+userId).append('<i data-toggle="tooltip" title="Confirm" class="mdi mdi-check" id="confirm_'+userId+'"></i>');
                        $('#reporting_to_'+userId).append('<i data-toggle="tooltip" title="Cancle" class="mdi mdi-close" id="closert_'+userId+'" data-canclereportid="'+reportingID+'" data-currentreport="'+currentReporting+'"></i>');
                        
                    }
                });
            }
});
$("#user_listing").on("click", ".mdi-check", function(){
    var user_id = $(this).attr('id').substring(8); 
    var report_id = $('#report_to_'+user_id+' option:selected').val();
    if(user_id && report_id) {
                $.ajax({
                    url: 'reporting/update/'+user_id+'/'+report_id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#reporting_to_'+user_id).empty();
                        $('#reporting_to_'+user_id).append('<label class="reporting_edit" id="'+user_id+'" data-reportingid="'+report_id+'">');
                        $('#'+user_id).text(data[0].first_name+' '+data[0].last_name);
                        $('#reporting_to_'+user_id).append('</label>');
                        
                    }
                });
            }
});    
$("#user_listing").on("click", ".mdi-close", function(){
    var user_id = $(this).attr('id').substring(8); 
    var reportingID = $(this).attr('data-canclereportid');
    var currentReporting = $(this).attr('data-currentreport');
                        $('#reporting_to_'+user_id).empty();
                        $('#reporting_to_'+user_id).append('<label class="reporting_edit" id="'+user_id+'" data-reportingid="'+reportingID+'">');
                        $('#'+user_id).text(currentReporting);
                        $('#reporting_to_'+user_id).append('</label>');
});
