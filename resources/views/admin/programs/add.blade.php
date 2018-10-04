@extends('admin.layout.master')
@section('title', trans('Add Programs') )
@section('module', trans('Create New Programs'))
@section('content')
<div class="m-portlet">
    <div class="m-portlet m-portlet--space p-4">
        <!--begin::Form-->
        {!! Form::open(['route' => 'programs.store' , 'method' => 'post' , 'id' => 'add_form' , 'enctype' => 'multipart/form-data']) !!}
        <div class="m-form m-form--fit m-form--label-align-right">
            {!! Form::label('name', trans('Name Program')) !!}
            {!! Form::text('name', '', ['class' => 'form-control m-input m-input--air']) !!}
            {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
        </div>
        <br>
        <div class="m-form m-form--fit m-form--label-align-right">
            {!! Form::submit(trans('Add') . '!', ['class' => 'btn m-btn--pill m-btn m-btn--gradient-from-primary m-btn--gradient-to-info']) !!}
        </div>
        {!! Form::close() !!}
        <!--end::Form-->
    </div>
</div>
@endsection
