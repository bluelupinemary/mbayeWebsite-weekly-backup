@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . 'Assign Number')

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>Assign Number</small>
    </h1>
@endsection

@section('content')
{{ Form::open(['route' => 'admin.access.assignnumber.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-permission', 'files' => true]) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Assign Number</h3>

                <div class="box-tools pull-right">
                    @include('backend.access.includes.partials.user-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            <div class="box-body">
                {{ Form::hidden('id', $user->id) }}
                <div class="form-group">
                    {{ Form::label('country', 'Country', ['class' => 'col-lg-2 control-label']) }}
            
                    <div class="col-lg-10">
                        {{ Form::text('country', $user->country, ['class' => 'form-control box-size ']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="form-group">
                    {{ Form::label('special_number', 'Number', ['class' => 'col-lg-2 control-label']) }}
            
                    <div class="col-lg-10">
                        {{ Form::text('special_number', null, ['class' => 'form-control box-size ', 'placeholder' => 'Enter Number']) }}
                    </div><!--col-lg-10-->
                </div><!--form control-->

                <div class="edit-form-btn">
                    {{ link_to_route('admin.access.user.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div><!-- /.box-body -->
        </div><!--box-->

    {{ Form::close() }}
@endsection

@section('after-scripts')
    <script type="text/javascript">
        Backend.Utils.documentReady(function(){
            csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            Backend.Users.selectors.getPremissionURL = "{{ route('admin.get.permission') }}";
            Backend.Users.init("create");
        });
        window.onload = function () {
            Backend.Users.windowloadhandler();
        };

    </script>
@endsection
