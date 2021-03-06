@extends ('backend.layouts.app')

@section ('title', 'CareStory Management')

@section('page-header')
    <h1>CareStory Management</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">CareStory Management</h3>

            <div class="box-tools pull-right">
                @include('backend.carestory.partials.carestory-header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="carestory-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.blogs.table.title') }}</th>
                            <th>{{ trans('labels.backend.blogs.table.publish') }}</th>
                            <th>{{ trans('labels.backend.blogs.table.status') }}</th>
                            <th>{{ trans('labels.backend.blogs.table.createdby') }}</th>
                            {{-- <th>Tags</th> --}}
                            <th>Email</th>
                            {{-- <th>{{ trans('labels.backend.blogs.table.shares') }}</th> --}}
                            <th>{{ trans('labels.backend.blogs.table.createdat') }}</th>
                            {{-- <th>{{ trans('labels.backend.blogs.table.privacy') }}</th> --}}
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    <thead class="transparent-bg">
                        <tr>
                            <th>
                                {!! Form::text('first_name', null, ["class" => "search-input-text form-control", "data-column" => 0, "placeholder" => trans('labels.backend.blogs.table.title')]) !!}
                                <a class="reset-data" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                            </th>
                            <th></th>
                            <th>
                                {!! Form::select('status', $status, null, ["class" => "search-input-select form-control", "data-column" => 2, "placeholder" => trans('labels.backend.blogs.table.all')]) !!}
                            </th>
                            <th></th>
                            <th>
                                {{-- {!! Form::select('tags', $tags, null, ["class" => "search-input-select form-control", "data-column" => 4, "placeholder" => trans('labels.backend.blogs.table.all')]) !!} --}}
                            </th>
                            <th></th>
                            <th></th>
       
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->

    <!--<div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {{-- {!! history()->renderType('Blog') !!} --}}
        </div><!-- /.box-body -->
    </div><!--box box-info-->
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var dataTable = $('#carestory-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.carestory.get") }}',
                    type: 'post',
                    data: {trashed: false},
                },
                columns: [
                    {data: 'name', name: '{{config('module.carestory.table')}}.name'},
                    {data: 'publish_datetime', name: '{{config('module.carestory.table')}}.publish_datetime'},
                    {data: 'status', name: '{{config('module.carestory.table')}}.status'},
                    {data: 'created_by', name: '{{config('module.carestory.table')}}.created_by'},
                    // {data: 'tag_name', name: '{{config('module.blog_tags.table')}}.name'},
                    {data: 'email', name: 'email'},
                    // {data: 'shares', name: 'shares'},
                    {data: 'created_at', name: '{{config('module.carestory.table')}}.created_at'},
                    // {data: 'privacy', name: 'privacy'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[1, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4,5,6,7 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4,5,6,7 ]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [0, 1, 2, 3, 4,5,6,7 ]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4,5,6,7 ]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4,5,6,7 ]  }}
                    ]
                },
                language: {
                    @lang('datatable.strings')
                }
            });

            Backend.DataTableSearch.init(dataTable);
        });
    </script>
@endsection