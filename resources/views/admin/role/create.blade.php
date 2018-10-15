@extends('admin.layout.master')
@section('title', trans('Create new Role'))
@section('module', trans('Role'))
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet m-portlet--space">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                {{ trans('Create new Role') }}
                            </h3>
                        </div>
                    </div>
                </div>
                {!! Form::open(['url' => 'admin/roles', 'method' => 'POST', 'class' => 'm-form']) !!}
                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
                        {!! Form::label(trans('Role')) !!}
                        {!! Form::text('name', null, ['class' => 'form-control m-input', 'placeholder' => trans('Role')]) !!}
                        {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                    </div>
                    <div class="form-group m-form__group">
                        {!! Form::label(trans('Display Name')) !!}
                        {!! Form::text('display_name', null, ['class' => 'form-control m-input', 'placeholder' => trans('Display Name')]) !!}
                        {!! $errors->first('display_name', '<p class="text-danger">:message</p>') !!}
                    </div>
                    <div class="form-group m-form__group">
                        {!! Form::label(trans('Description')) !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control m-input', 'placeholder' => trans('Description')]) !!}
                        {!! $errors->first('description', '<p class="text-danger">:message</p>') !!}
                    </div>
                    <div class="form-group m-form__group">
                        {!! Form::label(trans('Permission')) !!}
                        {!! Form::select('permission_id[]', $permissions, null, ['class' => 'form-control m-input', 'id' => 'exampleSelect2', 'multiple' => true]) !!}
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions--solid">
                            <div class="row">
                                <div class="col-lg-6">
                                    {!! Form::submit(trans('Save'), ['class' => 'btn btn-primary']) !!}
                                    <a href="{{ url('admin/roles') }}" class="btn btn-secondary">{{ trans('Cancel') }}</a>
                                </div>
                                <div class="col-lg-6 m--align-right">
                                    {!! Form::reset(trans('Reset'), ['class' => 'btn btn-danger']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection