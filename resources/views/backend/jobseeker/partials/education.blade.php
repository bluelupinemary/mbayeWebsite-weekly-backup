@foreach($education as $education)
    <table class="table table-striped table-hover table-education">
        
        <tr>
            <th>School Name</th>
            <td>{{ $education->school_name }}</td>
        </tr>

        <tr>
            <th>Field of Study</th>
            <td>{{ $education->field_of_study }}</td>
        </tr>

        <tr>
            <th>Start Date</th>
            <td>{{ $education->start_date }}</td>
        </tr>

        <tr>
            <th>End Date</th>
            <td>{{ $education->end_date }}</td>
        </tr>

        <tr>
            <th>Degree Level</th>
            <td>{{ $education->education_level }}</td>
        </tr>

        <tr>
            <th>Description</th>
            <td>{{ $education->description }}</td>
        </tr>

    
    </table>
@endforeach