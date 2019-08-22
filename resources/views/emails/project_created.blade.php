<div>
    <p>Hello Sagar Shah,</p>

    <p>Please find recently created project details as mentioned below.</p>

    <table border="1" cellpadding="3" cellspacing="3" style="border-collapse:collapse;">
        <tbody>
            <tr>
                <td>Project Name</td>
                <td>{{$project_name}}</td>
            </tr>
            <tr>
                <td>Client Name</td>
                <td>{{$client_name}}</td>
            </tr>
            <tr>
                <td>Project Type</td>
                <td>{{$project_type}}</td>
            </tr>
            <tr>
                <td>Project Start Date</td>
                <td>{{$project_start_date}}</td>
            </tr>
            <tr>
                <td>Project End Date</td>
                <td>{{$project_end_date}}</td>
            </tr>
            <tr>
                <td>Estimated Hours</td>
                <td>{{$estimated_hours}}</td>
            </tr>
            <tr>
                <td>Account Manager</td>
                <td>{{$account_manager}}</td>
            </tr>
            <tr>
                <td>Project Manager</td>
                <td>{{$project_manager}}</td>
            </tr>
            <tr>
                <td>Project Status</td>
                <td>{{$project_status}}</td>
            </tr>
            @foreach ($assigned_user as $value)
                <tr>
                    <td>Assigned To</td>
                    <td>{{$value}}</td>
                </tr>
            @endforeach
            <tr>
                <td>Created By</td>
                <td>{{$loggedInUserName}}</td>
            </tr>
        </tbody>
    </table>

    <p>Kindly <a href="{{url('/pms/projects/edit/'.$id)}}">click here</a> to edit this project</p>

    <p>
    Regards,<br>
    Tridhya Tech
    </p>
</div>
