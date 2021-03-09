@extends ('backend.layouts.app')

@section ('title', 'Professions Management' . ' | ' . 'Create Professions')

@section('page-header')
    <h1>
       Profession Management
        <small>Create Professions</small>
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'admin.professions.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-professions']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Create Professions</h3>

                <div class="box-tools pull-right">
                    @include('backend.professions.partials.professions-header-buttons')
                </div><!--box-tools pull-right-->
            </div><!-- /.box-header -->

            {{-- Including Form blade file --}}
            <div class="box-body">
                <div class="form-group">
                    @include("backend.professions.form")
                    <div class="edit-form-btn">
                    {{ link_to_route('admin.professions.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-md']) }}
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div>
        </div><!--box-->
    </div>
    {{ Form::close() }}
@endsection