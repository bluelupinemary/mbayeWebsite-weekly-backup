@extends('backend.layouts.app')

@section('page-header')
    <h1>
        {{ app_name() }}
        <small>{{ trans('strings.backend.dashboard.title') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Reports</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #17a2b8;">
                    <div class="inner">
                      <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                      <p>Add Users</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #28a745;">
                    <div class="inner">
                      <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                      <p>Add Users</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #ffc107;">
                    <div class="inner">
                      <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                      <p>Add Users</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #dc3545;">
                    <div class="inner">
                      <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                      <p>Add Users</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
          </div>
        </div><!-- /.box-body -->
    </div><!--box box-info-->

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">User Actions</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #28a745;">
                    <div class="inner">
                      <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                      <p>Add Users</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <a href="{{ route('admin.access.user.create') }}" class="small-box-footer">Click Here <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>

              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #17a2b8;">
                    <div class="inner">
                      <h3><i class="fa fa-list" aria-hidden="true"></i></h3>
                      <p>List Users</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <a href="{{ route('admin.access.user.index') }}" class="small-box-footer">Click Here <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>

              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #ffc107;">
                    <div class="inner">
                      <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                      <p>Add Users</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="small-box-footer">Click Here <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>

              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #dc3545;">
                    <div class="inner">
                      <h3><i class="fa fa-ban" aria-hidden="true"></i></h3>
                      <p>Delete Users</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="small-box-footer">Click Here <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
          </div>
        </div><!-- /.box-body -->
    </div><!--box box-info-->

    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Role Actions</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #17a2b8;">
                    <div class="inner">
                      <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                      <p>Add Users</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #28a745;">
                    <div class="inner">
                      <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                      <p>Add Users</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #ffc107;">
                    <div class="inner">
                      <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                      <p>Add Users</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #dc3545;">
                    <div class="inner">
                      <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                      <p>Add Users</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
          </div>
        </div><!-- /.box-body -->
    </div><!--box box-info-->

    <div class="box box-secondary">
        <div class="box-header with-border">
            <h3 class="box-title">Permission Actions</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #17a2b8;">
                    <div class="inner">
                      <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                      <p>Add Users</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #28a745;">
                    <div class="inner">
                      <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                      <p>Add Users</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #ffc107;">
                    <div class="inner">
                      <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                      <p>Add Users</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <div class="col-lg-3 col-6">
                  <!-- small box -->
                  <div class="small-box" style="background-color: #dc3545;">
                    <div class="inner">
                      <h3><i class="fa fa-plus" aria-hidden="true"></i></h3>
                      <p>Add Users</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
              </div>
          </div>
        </div><!-- /.box-body -->
    </div><!--box box-info-->

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! history()->render() !!}
        </div><!-- /.box-body -->
    </div><!--box box-info-->
@endsection