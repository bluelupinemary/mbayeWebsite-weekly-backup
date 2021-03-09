@foreach($workexp as $workexp)
    <table class="table table-striped table-hover table-workexp">
        
        <tr>
            <th>Designation</th>
            <td>{{ $workexp->designation }}</td>
        </tr>

        <tr>
            <th>Company Name</th>
            <td>{{ $workexp->company_name }}</td>
        </tr>

        <tr>
            <th>Address</th>
            <td>{{ $workexp->address }}</td>
        </tr>

        <tr>
            <th>Role</th>
            <td>{{ $workexp->role }}</td>
        </tr>

        <tr>
            <th>Contact No</th>
            <td>{{ $workexp->contact_no }}</td>
        </tr>

        <tr>
            <th>Start Date</th>
            <td>{{ $workexp->start_date }}</td>
        </tr>

        <tr>
            <th>End Date</th>
            <td>{{ $workexp->end_date }}</td>
        </tr>
    
    </table>
@endforeach