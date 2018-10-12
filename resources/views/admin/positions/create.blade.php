@extends('admin.layout.master')
@section('title', __('Create'))
@section('module', __('Position'))
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
                                {{ __('Create new Position') }}
                            </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->
                {!! Form::open(['url' => 'admin/positions', 'method' => 'POST', 'class' => 'm-form']) !!}
                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
                        {!! Form::label('Position Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control m-input', 'placeholder' => 'Position']) !!}
                        {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                    </div>
                    <div class="form-group m-form__group">
                        {!! Form::label('Type') !!}
                        {!! Form::select('is_fulltime', [0 => __('Partime'), 1 => __('Fulltime')], null, ['class' => 'form-control m-input']) !!}
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--right">
                        <div class="row">
                            <div class="col m--align-left">
                                {!! Form::submit('Submit', ['class' => 'btn btn-brand']) !!}
                                <a href="{{ url('admin/positions') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                            <div class="col m--align-right">
                                {!! Form::reset('Reset', ['class' => 'btn btn-danger']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <!--end::Form-->

            </div>
        </div>
    </div>
@endsection
