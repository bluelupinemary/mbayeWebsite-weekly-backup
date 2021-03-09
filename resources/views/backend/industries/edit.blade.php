@extends ('backend.layouts.app')

@section ('title', 'Industries Management' . ' | ' . 'Edit Industries')

@section('page-header')
    <h1>
        Industries Management
        <small>Edit Industries</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($industry, ['route' => ['admin.industries.update', $industry], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-industries']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Industries</h3>

                <div class="box-tools pull-right">
                    @include('backend.industries.partials.industries-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            {{-- Including Form blade file --}}
            <div class="box-body">
                <div class="form-group">
                    @include("backend.industries.form")
                    <div class="edit-form-btn">
                    {{ link_to_route('admin.industries.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div>
        </div><!--box-->
    </div>
    {{ Form::close() }}
@endsection