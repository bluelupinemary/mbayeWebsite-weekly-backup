@extends ('backend.layouts.app')

@section ('title', 'Company Management')

@section('page-header')
    <h1>Company Management</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Company Management</h3>

            <div class="box-tools pull-right">
                @include('backend.companyprofile.partials.company-header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="company-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Owner Name</th>
                            <th>Company Email</th>
                            <th>Contact No</th>
                            <th>Industry Name</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Address</th>
                            <th>{{ trans('labels.general.actions') }}</th>
                        </tr>
                    </thead>
                    {{-- <thead class="transparent-bg"> --}}
                        {{-- <tr>
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
                                {!! Form::select('tags', $tags, null, ["class" => "search-input-select form-control", "data-column" => 4, "placeholder" => trans('labels.backend.blogs.table.all')]) !!}
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr> --}}
                    {{-- </thead> --}}
                </table>
            </div><!--table-responsive-->
        </div><!-- /.box-body -->
    </div><!--box-->

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('history.backend.recent_history') }}</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div><!-- /.box tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            {!! history()->renderType('Blog') !!}
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

            var dataTable = $('#company-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.company.get") }}',
                    type: 'post',
                    data: {trashed: false},
                },
                columns: [
                    {data: 'company_name', name: '{{config('module.company_profiles.table')}}.company_name'},
                    {data: 'company_Owner', name: '{{config('module.company_profiles.table')}}.owner_id'},
                    {data: 'company_email', name: '{{config('module.company_profiles.table')}}.company_email'},
                    {data: 'company_phone_number', name: '{{config('module.company_profiles.table')}}.company_phone_number'},
                    {data: 'Industry_name', name: '{{config('module.company_profiles.table')}}.industry_id'},
                    {data: 'state', name: '{{config('module.company_profiles.table')}}.state'},
                    {data: 'city', name: '{{config('module.company_profiles.table')}}.city'},
                    {data: 'country', name: '{{config('module.company_profiles.table')}}.country'},
                    {data: 'address', name: '{{config('module.company_profiles.table')}}.address'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[1, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4,5,6,7,8,9,10,11 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4,5,6,7,8,9,10,11]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [0, 1, 2, 3, 4,5,6,7,8,9,10,11]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4,5,6,7,8,9,10,11]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4,5,6,7,8,9,10,11]  }}
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