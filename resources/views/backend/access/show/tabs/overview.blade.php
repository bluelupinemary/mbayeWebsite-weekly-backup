<table class="table table-striped table-hover">
    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.name') }}</th>
        <td>{{ $user->first_name .' '. $user->last_name }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.email') }}</th>
        <td>{{ $user->email }}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.username') }}</th>
        <td>{{ $user->username }}</td>
    </tr>
    @if($user->dob != '')
    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.dob') }}</th>
        <td>{{ $user->dob }}</td>
    </tr>
    @endif

    @if($user->age != '')
    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.dob') }}</th>
        <td>{{ $user->age }}</td>
    </tr>
    @endif

    @if($user->address != '')
    <tr>
        <th>Address</th>
        <td>{{ $user->address }}</td>
    </tr>
    @endif

    @if($user->country != '')
    <tr>
        <th>Country</th>
        <td>{{ $user->country }}</td>
    </tr>
    @endif

    @if($user->id_number != '')
    <tr>
        <th>ID:</th>
        <td>{{ $user->id_number }}</td>
    </tr>
    @endif

    @if($user->sponser_id != '')
    <tr>
        <th>Sponser ID</th>
        <td>{{ $user->sponser_id }}</td>
    </tr>
    @endif

    @if($user->sponser_name != '')
    <tr>
        <th>Sponser Name</th>
        <td>{{ $user->sponser_name }}</td>
    </tr>
    @endif

    @if($user->mobile_number != '')
    <tr>
        <th>Mobile Number</th>
        <td>{{ $user->mobile_number }}</td>
    </tr>
    @endif

    @if($user->org_type != '')
    <tr>
        <th>Organization Type</th>
        <td>{{ $user->org_type }}</td>
    </tr>
    @endif

    @if($user->org_name != '')
    <tr>
        <th>Organization Nmae</th>
        <td>{{ $user->org_name }}</td>
    </tr>
    @endif

    @if($user->occupation != '')
    <tr>
        <th>Occupation</th>
        <td>{{ $user->occupation }}</td>
    </tr>
    @endif

    @if($user->member_type != '')
    <tr>
        <th>Member Type</th>
        <td>{{ $user->member_type }}</td>
    </tr>
    @endif

    @if($user->gender != '')
    <tr>
        <th>Gender</th>
        <td>{{ $user->gender }}</td>
    </tr>
    @endif

    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.status') }}</th>
        <td>{!! $user->status_label !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.confirmed') }}</th>
        <td>{!! $user->confirmed_label !!}</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.created_at') }}</th>
        <td>{{ $user->created_at }} ({{ $user->created_at->diffForHumans() }})</td>
    </tr>

    <tr>
        <th>{{ trans('labels.backend.access.users.tabs.content.overview.last_updated') }}</th>
        <td>{{ $user->updated_at }} ({{ $user->updated_at->diffForHumans() }})</td>
    </tr>

    @if ($user->trashed())
        <tr>
            <th>{{ trans('labels.backend.access.users.tabs.content.overview.deleted_at') }}</th>
            <td>{{ $user->deleted_at }} ({{ $user->deleted_at->diffForHumans() }})</td>
        </tr>
    @endif
</table>