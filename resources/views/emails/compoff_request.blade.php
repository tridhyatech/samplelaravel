<div>
    <p>Hello {{$reporting_name}},</p>

    <p>We have received a comp-off request. Please find details as mentioned below.</p>

    <table border="1" cellpadding="3" cellspacing="3" style="border-collapse:collapse;">
        <tbody>
            <tr>
                <td>Name</td>
                <td>{{$employee_name}}</td>
            </tr>
            <tr>
                <td>Start Date</td>
                <td>{{$compoff_start_date}}</td>
            </tr>
            <tr>
                <td>End Date</td>
                <td>{{$compoff_end_date}}</td>
            </tr>
            <tr>
                <td>Comp-off Days</td>
                <td>{{$compoff_days}}</td>
            </tr>
            <tr>
                <td>Comp-off Description</td>
                <td>{{$compoff_description}}</td>
            </tr>
        </tbody>
    </table>

    <p>Kindly <a href="{{url('/pms/compoffs/approve/'.$id)}}">click here</a> to see comp-off request</p>

    <p>
    Regards,<br>
    Tridhya Tech
    </p>
</div>
