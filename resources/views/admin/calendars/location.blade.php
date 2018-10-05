@extends('admin.layout.master')

@section('title', __('Working Schedule'))

@section('module', __('Working Schedule'))

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
                                {{ $location->name }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div id="m_calendar" data-url="{{ route('calendars.location.get_data', ['id' => $location->id]) }}"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/location.js') }}"></script>
@endsection
