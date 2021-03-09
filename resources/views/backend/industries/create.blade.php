@extends ('backend.layouts.app')

@section ('title', 'Industries Management' . ' | ' . 'Create Industries')

@section('page-header')
    <h1>
       Industries Management
        <small>Create Industries</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.industries.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-Industries']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Create Industries</h3>

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
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div>
        </div><!--box-->
    </div>
    {{ Form::close() }}
@endsection