<div>
    <p>Hello Sagar Shah,</p>

    <p>Please find change request details as mentioned below.</p>

    <table border="1" cellpadding="3" cellspacing="3" style="border-collapse:collapse;">
        <tbody>
            <tr>
                <td>Project Name</td>
                <td>{{$project_name}}</td>
            </tr>
            <tr>
                <td>Title</td>
                <td>{{$title}}</td>
            </tr>
            <tr>
                <td>Estimated Hours</td>
                <td>{{$estimated_hours}}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>{{$status}}</td>
            </tr>
            <tr>
                <td>Added By</td>
                <td>{{$added_by_name}}</td>
            </tr>
        </tbody>
    </table>

    <p>Kindly <a href="{{url('/pms/cr/edit/'.$id)}}">click here</a> to edit this change request</p>

    <p>
    Regards,<br>
    Tridhya Tech
    </p>
</div>
