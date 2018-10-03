@extends('admin.layout.master')

@section('title', __('Add Workspace'))

@section('module', __('Add Workspace'))

@section('content')
<div class="m-portlet">
    <div class="p-3">
        @forelse($errors->all() as $error)
            @include('admin.components.alert', ['type' => 'danger', 'message' => $error])
        @endforeach
    </div>
    <!--begin::Form-->
    {!! Form::open([
        'route' => 'workspaces.store', 
        'method' => 'POST', 
        'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator',
        'files' => true
    ]) !!}

        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                {!! Form::label(null, __('Workspace Name'), ['class' => 'col-lg-2 col-form-label']) !!}
                <div class="col-lg-6">
                    {!! Form::text('name', null, ['class' => 'form-control m-input', 'placeholder' => ('Workspace Name')]) !!}
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
                <img class="w-50" id="image-display">
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
