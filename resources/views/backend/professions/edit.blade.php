@extends ('backend.layouts.app')

@section ('title', 'Professions Management' . ' | ' . 'Edit Profession')

@section('page-header')
    <h1>
        Professions Management
        <small>Edit Professions</small>
    </h1>
@endsection

@section('content')
    {{ Form::model($profession, ['route' => ['admin.professions.update', $profession], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-professions']) }}

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Professions</h3>

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
                    {{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
                    <div class="clearfix"></div>
                </div>
            </div>
        </div><!--box-->
    </div>
    {{ Form::close() }}
@endsection