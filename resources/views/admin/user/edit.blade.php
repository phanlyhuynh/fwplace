@extends('admin.layout.master')
@section('title', trans('User'))
@section('module')
    <div class="mr-auto">
        <h3 class="m-subheader__title m-subheader__title--separator">{{ trans('User') }}</h3>
        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
            <li class="m-nav__item m-nav__item--home">
                <a href="{{ url('admin') }}" class="m-nav__link m-nav__link--icon">
                    <i class="m-nav__link-icon la la-home"></i>
                </a>
            </li>
            <li class="m-nav__separator">-</li>
            <li class="m-nav__item">
                <a href="{{ url('admin/users') }}" class="m-nav__link">
                    <span class="m-nav__link-text">{{ trans('User') }}</span>
                </a>
            </li>
            <li class="m-nav__separator">-</li>
            <li class="m-nav__item">
                <span class="m-nav__link-text">{{ trans('Edit User') }}</span>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="m-portlet" data-select2-id="5">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{ trans('Edit User') }}
                    </h3>
                </div>
            </div>
        </div>
        {!! Form::model($user, ['url' => 'admin/users/' . $user->id, 'method' => 'PATCH', 'class' => 'm-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed', 'files' => true]) !!}
        {!! Form::hidden('id', $user->id) !!}
        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    {!! Form::label(trans('Full Name')) !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control m-input', 'placeholder' => trans('Enter full Name')]) !!}
                    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                    <span class="m-form__help">{{ trans('Please enter Full Name') }}</span>
                </div>
                <div class="col-lg-6">
                    {!! Form::label(trans('Email')) !!}
                    {!! Form::email('email', null, ['class' => 'form-control m-input', 'placeholder' => trans('Enter Email')]) !!}
                    {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                    <span class="m-form__help">{{ trans('Please enter Email') }}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    {!! Form::label(trans('Program')) !!}
                    <div class="m-input-icon m-input-icon--right">
                        {!! Form::select('program_id', $programs, null, ['class' => 'form-control m-input']) !!}
                    </div>
                    <span class="m-form__help">{{ trans('Please select Program') }}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    {!! Form::label(trans('Position')) !!}
                    <div class="m-input-icon m-input-icon--right">
                        {!! Form::select('position_id', $positions, null, ['class' => 'form-control m-input']) !!}
                    </div>
                    <span class="m-form__help">{{ trans('Please select Position') }}</span>
                </div>
                <div class="col-lg-6">
                    {!! Form::label(trans('Workspace')) !!}
                    <div class="m-input-icon m-input-icon--right">
                        {!! Form::select('workspace_id', $workspaces, null, ['class' => 'form-control m-input']) !!}
                    </div>
                    <span class="m-form__help">{{ trans('Please select Workspace') }}</span>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <div class="col-lg-6">
                    {!! Form::label(trans('Avatar')) !!}
                    <div class="custom-file">
                        {!! Form::file('avatar', ['class' => 'custom-file-input', 'id' => 'input-display']) !!}
                        {!! Form::label(trans('Choose file'), null, ['class' => 'custom-file-label']) !!}
                        {!! $errors->first('avatar', '<p class="text-danger">:message</p>') !!}
                    </div>
                    <img src="" alt="" id="image-display" class="w-50">
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
            <div class="m-form__actions m-form__actions--solid">
                <div class="row">
                    <div class="col-lg-6">
                        {!! Form::submit(trans('Save'), ['class' => 'btn btn-primary']) !!}
                        <a href="{{ url('admin/users') }}" class="btn btn-secondary">{{ trans('Cancel') }}</a>
                    </div>
                    <div class="col-lg-6 m--align-right">
                        {!! Form::reset(trans('Reset'), ['class' => 'btn btn-danger']) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
