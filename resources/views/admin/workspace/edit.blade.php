@extends('admin.layout.master')

@section('title', __('Edit Workspace'))

@section('module', __('Edit Workspace'))

@section('content')
<div class="m-portlet pt-2">
        @forelse($errors->all() as $error)
            @include('admin.components.alert', ['type' => 'danger m-3', 'message' => $error])
        @endforeach
    <!--begin::Form-->
    {!! Form::open([
        'route' => ['workspaces.update', $workspace->id], 
        'method' => 'PUT', 
        'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator',
        'files' => true
    ]) !!}

        <div class="m-portlet__body">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            {{ $workspace->name }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="form-group m-form__group row">
                {!! Form::label(null, __('Workspace Name'), ['class' => 'col-lg-2 col-form-label']) !!}
                <div class="col-lg-6">
                    {!! Form::text('name', $workspace->name, ['class' => 'form-control m-input', 'placeholder' => ('Workspace Name')]) !!}
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-lg-2 col-form-label">@lang('Workspace Photo')</label>
                <div class="col-lg-6">
                    <div class="custom-file">
                        {!! Form::file('image', ['class' => 'custom-file-input', 'id' => 'input-display']) !!}
                        <label class="custom-file-label" for="input-display">@lang('Choose photo')</label>
                    </div>
                </div>
            </div>
            <div class="text-center py-2">
                <img src="{{ $workspace->photo }}" class="w-50" id="image-display">
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-6">
                        {!! Form::submit(__('Save'), ['class' => 'btn btn-success']) !!}
                        {!! Form::button(__('Reset'), ['type' => 'reset', 'class' => 'btn btn-secondary']) !!}
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

    <!--end::Form-->
</div>
@endsection
