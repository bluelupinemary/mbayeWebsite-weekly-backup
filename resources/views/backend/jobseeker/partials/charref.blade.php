@foreach($charref as $charref)
    <table class="table table-striped table-hover table-charref">
        
        <tr>
            <th>Name</th>
            <td>{{ $charref->name }}</td>
        </tr>

        <tr>
            <th>Email</th>
            <td>{{ $charref->email }}</td>
        </tr>

        <tr>
            <th>Company Name</th>
            <td>{{ $charref->company_name }}</td>
        </tr>

        <tr>
            <th>Designation</th>
            <td>{{ $charref->designation }}</td>
        </tr>
    
    </table>
@endforeach