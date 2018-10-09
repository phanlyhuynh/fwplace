@extends('admin.layout.master')

@section('title', __('Work Schedule'))

@section('module', __('Number of Employees'))

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
                                {{ $workspace->name }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div id="loading" class="text-center">
                        {!! Html::image(asset(config('site.static') . 'loading.gif'), null) !!}
                    </div>
                    <div id="m_calendar" data-url="{{ route('schedule.workplace.get_data', ['id' => $workspace->id]) }}"  data-one="{{ route('schedule.workplace.get_one_date', ['id' => $workspace->id]) }}"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Detail')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm m-table m-table--head-bg-brand">
                    <tbody>
                        <thead class="thead-inverse">
                            <tr>
                                <th colspan="2" class="text-center">
                                    @lang('Number of Employees') <span id="clicked_date"></span>
                                </th>
                            </tr>
                        </thead>
                        <tr>
                            <td>@lang('Off')</td>
                            <td id="area0"></td>
                        </tr>
                        <tr>
                            <td>@lang('Fulltime')</td>
                            <td id="area1"></td>
                        </tr>
                        <tr>
                            <td>@lang('Morning')</td>
                            <td id="area2"></td>
                        </tr>
                        <tr>
                            <td>@lang('Afternoon')</td>
                            <td id="area3"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/location.js') }}"></script>
@endsection
