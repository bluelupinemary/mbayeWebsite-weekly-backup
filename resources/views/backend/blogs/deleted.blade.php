@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.deleted'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.management') }}
        <small>{{ trans('labels.backend.access.users.deleted') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.users.deleted') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.blogs.partials.blogs-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="blogs-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.blogs.table.title') }}</th>
                            <th>{{ trans('labels.backend.blogs.table.publish') }}</th>
                            <th>{{ trans('labels.backend.blogs.table.status') }}</th>
                            <th>{{ trans('labels.backend.blogs.table.createdby') }}</th>
                            <th>{{ trans('labels.backend.blogs.table.email') }}</th>
                            <th>{{ trans('labels.backend.blogs.table.shares') }}</th>
                            <th>{{ trans('labels.backend.blogs.table.createdat') }}</th>
                            <th>{{ trans('labels.backend.blogs.table.privacy') }}</th>
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
                            {{-- <th>
                                {!! Form::select('status', $status, null, ["class" => "search-input-select form-control", "data-column" => 2, "placeholder" => trans('labels.backend.blogs.table.all')]) !!}
                            </th> --}}
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection

@section('after-scripts')
    {{-- For DataTables --}}
    {{ Html::script(mix('js/dataTable.js')) }}
	<script>

            (function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var dataTable = $('#blogs-table').dataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route("admin.deletedblogs.get") }}',
                        type: 'post',
                        data: {trashed: true},
                    },
                    columns: [
                    {data: 'name', name: '{{config('module.blogs.table')}}.name'},
                    {data: 'publish_datetime', name: '{{config('module.blogs.table')}}.publish_datetime'},
                    {data: 'status', name: '{{config('module.blogs.table')}}.status'},
                    {data: 'created_by', name: '{{config('module.blogs.table')}}.created_by'},
                    {data: 'Email', name: 'email'},
                    {data: 'shares', name: 'shares'},
                    {data: 'created_at', name: '{{config('module.blogs.table')}}.created_at'},
                    {data: 'privacy', name: 'privacy'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                    order: [[0, "asc"]],
                    searchDelay: 500,
                    dom: 'lBfrtip',
                    buttons: {
                        buttons: [
                            { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                            { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                            { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                            { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }},
                            { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6 ]  }}
                        ]
                    }
                });
    
                Backend.DataTableSearch.init(dataTable);

                Backend.UserDeleted.selectors.Areyousure = "{{ trans('strings.backend.general.are_you_sure') }}";
                Backend.UserDeleted.selectors.delete_user_confirm = "{{ trans('strings.backend.access.users.delete_user_confirm') }}";
                Backend.UserDeleted.selectors.continue = "{{ trans('strings.backend.general.continue') }}";
                Backend.UserDeleted.selectors.cancel ="{{ trans('buttons.general.cancel') }}";
                Backend.UserDeleted.selectors.restore_user_confirm ="{{ trans('strings.backend.access.users.restore_user_confirm') }}";
            
            })();

            
     
        window.onload = function(){
            
            Backend.UserDeleted.windowloadhandler();
        }
          
	</script>
@endsection
