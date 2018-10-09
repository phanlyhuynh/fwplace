@extends('admin.layout.master')

@section('title', trans('User Timesheet'))

@section('module', trans('User Timesheet'))

@section('content')
    <div class="m-portlet">
        <div class="m-portlet__body">
            <div class="m-section">
                <div class="m-section__content">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-map-location"></i>
                            </span>
                                <h3 class="m-portlet__head-text">
                                    {{ $user->name }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div id="loading_user" class="text-center">
                            {!! Html::image(asset(config('site.static') . 'loading.gif'), null) !!}
                        </div>
                        <div id="m_calendar_user" data-url="{{ url('admin/schedule/users/' . $user->id . '/get') }}"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/usertimesheet.js') }}"></script>
@endsection
