<!--Action Button-->
  @if(Active::checkUriPattern('admin/industries'))
      <export-component></export-component>
  @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Action
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="{{route('admin.industries.index')}}"><i class="fa fa-list-ul"></i>ALL Industries</a></li>
    @permission('create-profession')
    <li><a href="{{route('admin.industries.create')}}"><i class="fa fa-plus"></i>Create Industries</a></li>
    @endauth
  </ul>
</div>

<div class="clearfix"></div>