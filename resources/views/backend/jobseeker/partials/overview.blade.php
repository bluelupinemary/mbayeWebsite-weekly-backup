<table class="table table-striped table-hover table-overview">
    <tr>
        <th>Name</th>
        <td>{{ $jobseeker->user->first_name .' '. $jobseeker->user->last_name }}</td>
    </tr>

    <tr>
        <th>Email</th>
        <td>{{ $jobseeker->user->email }}</td>
    </tr>

    <tr>
        <th>Secondary Email</th>
        <td>{{ $jobseeker->secondary_email }}</td>
    </tr>

    <tr>
        <th>Secondary Mobile Number</th>
        <td>{{ $jobseeker->secondary_mobile_number }}</td>
    </tr>

    <tr>
        <th>Objective</th>
        <td>{{ $jobseeker->objective }}</td>
    </tr>

    <tr>
        <th>Present Address</th>
        <td>{{ $jobseeker->present_address }}</td>
    </tr>

    <tr>
        <th>Present City</th>
        <td>{{ $jobseeker->present_city }}</td>
    </tr>

    <tr>
        <th>State</th>
        <td>{{ $jobseeker->state }}</td>
    </tr>

    <tr>
        <th>Present Country</th>
        <td>{{ $jobseeker->present_country }}</td>
    </tr>

    <tr>
        <th>Profession</th>
        <td>{{ $jobseeker->profession->profession_name }}</td>
    </tr>
    
</table>