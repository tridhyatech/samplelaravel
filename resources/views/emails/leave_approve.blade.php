<div>
    <p>Hello {{$employee_name}},</p>

    <p>Your leave application from {{$leave_start_date}} to {{$leave_end_date}} has been {{$leave_status}}.</p>
    <p>Kindly <a href="{{url('/pms/leaverequests')}}">click here</a> to see leave request</p>

    <p>
    Regards,<br>
    Tridhya Tech
    </p>
</div>
