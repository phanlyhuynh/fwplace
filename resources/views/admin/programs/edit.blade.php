@extends('admin.layout.master')
@section('title', __('Edit Programs') )
@section('module', __('Edit Programs'))
@section('content')
<div class="m-portlet">
    <div class="m-portlet m-portlet--space p-4">
            <!--begin::Form-->
            {!! Form::open(['route' => ['programs.update', $pro->id ] , 'method' => 'patch' , 'id' => 'add_form' , 'enctype' => 'multipart/form-data']) !!}
            <div class="m-form m-form--fit m-form--label-align-right">
                {!! Form::label('name', __('Name Program')) !!}
                {!! Form::text('name', $pro->name, ['class' => 'form-control m-input m-input--air']) !!}
                {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
            </div>
            <br>
            <div class="m-form m-form--fit m-form--label-align-right">
                {!! Form::submit(__('Update') . '!', ['class' => 'btn m-btn--pill m-btn m-btn--gradient-from-success m-btn--gradient-to-accent']) !!}
            </div>
            {!! Form::close() !!}
            <!--end::Form-->
        </div>
    </div>
</div>
@endsection
