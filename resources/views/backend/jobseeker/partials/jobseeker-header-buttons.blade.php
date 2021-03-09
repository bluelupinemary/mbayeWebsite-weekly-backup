<!--Action Button-->
    @if(Active::checkUriPattern('admin/jobseekers'))
        <export-component></export-component>
    @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Action
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="{{route('admin.jobseekers.index')}}"><i class="fa fa-list-ul"></i>{{trans('menus.backend.jobseekerprofiles.all')}}</a></li>
    {{-- @permission('view-frontend')
    <li><a href="{{route('admin.jobseekers.create')}}"><i class="fa fa-plus"></i>{{trans('menus.backend.jobseekerprofiles.create')}}</a></li>
    @endauth --}}
    @permission('view-frontend')
    {{-- <li><a href="{{route('admin.jobseekers.deleted')}}"><i class="fa fa-plus"></i> deleted JobSeeker Profile</a></li> --}}
    @endauth
  </ul>
</div>
<div class="clearfix"></div>