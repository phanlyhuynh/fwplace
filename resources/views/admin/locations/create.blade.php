@extends('admin.layout.master')

@section('title', __('Add Location'))

@section('module', __('Add Location'))

@section('content')
<div class="m-portlet">
    <div class="p-3">
        @forelse($errors->all() as $error)
            @include('admin.components.alert', ['type' => 'danger', 'message' => $error])
        @endforeach
    </div>
    <!--begin::Form-->
    {!! Form::open([
        'route' => 'locations.store', 
        'method' => 'POST', 
        'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator',
        'files' => true
    ]) !!}

        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                {!! Form::label(null, __('Location Name'), ['class' => 'col-lg-2 col-form-label']) !!}
                <span class="text-danger">*</span>
                <div class="col-lg-6">
                    {!! Form::text('name', null, ['class' => 'form-control m-input', 'placeholder' => ('Location Name')]) !!}
                    <span class="m-form__help">{{ trans('Please enter name') }}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                {!! Form::label(null, __('Total Seat'), ['class' => 'col-lg-2 col-form-label']) !!}
                <span class="text-danger">*</span>
                <div class="col-lg-6">
                    {!! Form::number('total_seat', null, ['class' => 'form-control m-input', 'placeholder' => ('Total Seat'), 'min' => 1]) !!}
                    <span class="m-form__help">{{ trans('Please enter total seat') }}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                {!! Form::label('workspace', __('Workspace'), ['class' => 'col-lg-2 col-form-label']) !!}
                <span class="text-danger">*</span>
                <div class="col-lg-6">
                    {!! Form::select('workspace_id', $workspaces, null, ['class' => 'form-control m-input m-input--square', 'id' => 'workspace']) !!}
                    <span class="m-form__help">{{ trans('Please select workspace') }}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-lg-2 col-form-label">@lang('Location Photo')</label>
                <div class="col-lg-6">
                    <div class="custom-file">
                        {!! Form::file('image', ['class' => 'custom-file-input', 'id' => 'input-display']) !!}
                        <label class="custom-file-label" for="input-display">@lang('Choose photo')</label>
                    </div>
                </div>
            </div>
            <div class="text-center py-2">
                {!! Html::image(asset(config('site.default-image')), null, ['id' => 'image-display', 'class' => 'w-50']) !!}
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
