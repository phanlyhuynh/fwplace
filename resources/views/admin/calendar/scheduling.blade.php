@extends('admin.layout.master')

@section('title', __('Workspaces'))

@section('module', __('Workspaces List'))

@section('content')
<div id="fieldChooser" tabIndex="1" class="w-100 row m-list-search">
    <div class="col-xl-6">
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            @lang('Users')
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="m_widget2_tab1_content">
                        <div class="m-widget2 m-list-search__results" id="sourceFields">
                            @foreach ($users as $user)
                            <div class="m-list-search__result-item">
                                <span class="m-list-search__result-item-pic">
                                    <img class="m--img-rounded" src="{{ $user->avatarUser }}" title="">
                                </span>
                                <span class="m-list-search__result-item-text">{{ $user->name }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            @lang('Location')
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body m-list-search__results" id="destinationFields">

            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('bower_components/fieldChooser/demo/stylesheets/jquery-ui.css') }}">
@endsection

@section('js')
    <script src="{{ asset('bower_components/fieldChooser/demo/scripts/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('bower_components/fieldChooser/demo/scripts/jquery-ui.js') }}"></script>
    <script src="{{ asset('bower_components/fieldChooser/fieldChooser.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var $sourceFields = $("#sourceFields");
            var $destinationFields = $("#destinationFields");
            var $chooser = $("#fieldChooser").fieldChooser(sourceFields, destinationFields);
        });
    </script>
@endsection
