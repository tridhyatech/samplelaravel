<div class="row" id="time_entry_row">
@if (count($punchArray)>0)    
    @php
    $i = 1;
    @endphp
    @foreach($punchArray as $punchDetail)
        <div class="col-md-6 row-block" id="row{{$i}}">
            <label class="control-label"></label>
            @if($i % 2 == 1)
                <input class="form-control form-white" placeholder="In entry" type="text" name="entry{{$i}}" id="entry{{$i}}" value="{!! str_replace('(in)', '', $punchDetail) !!}" required />
            @else 
                <div class="input-group">
                    <input class="form-control form-white" placeholder="Out entry" type="text" name="entry{{$i}}" id="entry{{$i}}" value="{!! str_replace('(out)', '', $punchDetail) !!}" required />
                    <div class="input-group-addon">
                        <a href="javascript:void(0)" class="delete-button" id="delete_row_{{$i}}" onclick="deleteRow({{$i}})"><i class="mdi mdi-close"></i></a>
                    </div>
                </div>
            @endif
        </div>
    @php
    $i++;
    @endphp
    @endforeach
    @if(count($punchArray) % 2 == 1)
        <div class="col-md-6">
            <label class="control-label"></label>
            <div class="input-group">
                <input class="form-control form-white" placeholder="Out entry" type="text" name="entry{{count($punchArray)+1}}" id="entry{{count($punchArray)+1}}" value="" required />
                <div class="input-group-addon">
                    <a href="javascript:void(0)" class="delete-button" id="delete_row_{{count($punchArray)+1}}" onclick="deleteRow({{count($punchArray)+1}})"><i class="mdi mdi-close"></i></a>
                </div>
            </div>
        </div>
    @endif
@endif
    <div id="last_element_ref"></div>
</div> 
<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
<input type="hidden" name="time_entry_id" id="time_entry_id" value="{{$timeEntryID}}">
<input type="hidden" name="time_entry_count" id="time_entry_count" value="{{count($punchArray)}}">