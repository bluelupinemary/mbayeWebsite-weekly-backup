@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.jobseekerprofiles.management'))

@section('page-header')
    <h1>{{ trans('labels.backend.jobseekerprofiles.management') }}</h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.jobseekerprofiles.management') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.jobseeker.partials.jobseeker-header-buttons')
            </div>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive data-table-wrapper">
                <table id="jobseekers-table" class="table table-condensed table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>{{ trans('labels.backend.jobseekerprofiles.table.email') }}</th>
                            <th>{{ trans('labels.backend.jobseekerprofiles.table.mobile') }}</th>
                            <th>{{ trans('labels.backend.jobseekerprofiles.table.country') }}</th>
                            <th>{{ trans('labels.backend.jobseekerprofiles.table.state') }}</th>
                            <th>{{ trans('labels.backend.jobseekerprofiles.table.city') }}</th>
                            <th>{{ trans('labels.backend.jobseekerprofiles.table.email') }}</th>
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

            var dataTable = $('#jobseekers-table').dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("admin.jobseekers.get") }}',
                    type: 'post',
                    data: {trashed: false},
                },
                columns: [
                    {data: 'secondary_email', name: '{{config('module.job_seeker_profiles.table')}}.secondary_email'},
                    {data: 'secondary_mobile_number', name: '{{config('module.job_seeker_profiles.table')}}.secondary_mobile_number'},
                    {data: 'present_country', name: '{{config('module.job_seeker_profiles.table')}}.present_country'},
                    {data: 'state', name: '{{config('module.job_seeker_profiles.table')}}.state'},
                    {data: 'present_city', name: '{{config('module.job_seeker_profiles.table')}}.present_city'},
                    {data: 'profession_name', name: '{{config('module.professions.table')}}.profession_name'},
                    {data: 'actions', name: 'actions', searchable: false, sortable: false}
                ],
                order: [[1, "asc"]],
                searchDelay: 500,
                dom: 'lBfrtip',
                buttons: {
                    buttons: [
                        { extend: 'copy', className: 'copyButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4,5,6 ]  }},
                        { extend: 'csv', className: 'csvButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4,5,6]  }},
                        { extend: 'excel', className: 'excelButton',  exportOptions: {columns: [0, 1, 2, 3, 4,5,6]  }},
                        { extend: 'pdf', className: 'pdfButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4,5,6]  }},
                        { extend: 'print', className: 'printButton',  exportOptions: {columns: [ 0, 1, 2, 3, 4,5,6]  }}
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