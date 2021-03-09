@extends ('backend.layouts.app')
@section('before-styles')
<style>
    .table-education tbody tr th{
        width:25%;
    }
    .table-overview tbody tr th{
        width:25%;
    }
    .table-charref tbody tr th{
        width:25%;
    }
    .table-workexp tbody tr th{
        width:25%;
    }
</style>
@endsection
@section ('title', trans('labels.backend.jobseekerprofiles.management') . ' | ' . trans('labels.backend.blogs.view'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.jobseekerprofiles.management') }}
        <small>{{ trans('labels.backend.jobseekerprofiles.view') }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.jobseekerprofiles.view') }}</h3>

            <div class="box-tools pull-right">
                @include('backend.jobseeker.partials.jobseeker-header-buttons')
            </div><!--box-tools pull-right-->
        </div><!-- /.box-header -->

        <div class="box-body">
            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#overview" aria-controls="overview" role="tab" data-toggle="tab">{{ trans('labels.backend.access.users.tabs.titles.overview') }}</a>
                    </li>

                    <li role="presentation">
                        <a href="#education" aria-controls="education" role="tab" data-toggle="tab">Education</a>
                    </li>

                    <li role="presentation">
                        <a href="#workexp" aria-controls="workexp" role="tab" data-toggle="tab">Work Experience</a>
                    </li>

                    <li role="presentation">
                        <a href="#charref" aria-controls="charref" role="tab" data-toggle="tab">Character Reference</a>
                    </li>
                </ul>

                <div class="tab-content">

                    <div role="tabpanel" class="tab-pane mt-30 active" id="overview">
                        @include('backend.jobseeker.partials.overview')
                    </div><!--tab overview profile-->

                    <div role="tabpanel" class="tab-pane mt-30" id="education">
                        @include('backend.jobseeker.partials.education')
                    </div><!--tab panel history-->

                    <div role="tabpanel" class="tab-pane mt-30" id="workexp">
                        @include('backend.jobseeker.partials.workexp')
                    </div><!--tab panel Work Experience-->

                    <div role="tabpanel" class="tab-pane mt-30" id="charref">
                        @include('backend.jobseeker.partials.charref')
                    </div><!--tab panel Character Reference-->

                </div><!--tab content-->

            </div><!--tab panel-->
        </div><!-- /.box-body -->
    </div><!--box-->
@endsection