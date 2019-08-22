<div>
    <p>Hello {{$reporting_name}},</p>

    <p>We have received a leave request. Please find details as mentioned below.</p>

    <table border="1" cellpadding="3" cellspacing="3" style="border-collapse:collapse;">
        <tbody>
            <tr>
                <td>Name</td>
                <td>{{$employee_name}}</td>
            </tr>
            <tr>
                <td>Start Date</td>
                <td>{{$leave_start_date}}</td>
            </tr>
            <tr>
                <td>End Date</td>
                <td>{{$leave_end_date}}</td>
            </tr>
            <tr>
                <td>Return Date</td>
                <td>{{$return_date}}</td>
            </tr>
            <tr>
                <td>Leave Days</td>
                <td>{{$leave_days}}</td>
            </tr>
            <tr>
                <td>Reason</td>
                <td>{{$reason}}</td>
            </tr>
        </tbody>
    </table>

    <p>Kindly <a href="{{url('/pms/leaves/approve/'.$id)}}">click here</a> to see leave request</p>

    <p>
    Regards,<br>
    Tridhya Tech
    </p>
</div>
