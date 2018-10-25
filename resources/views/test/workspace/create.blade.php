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
    {!! Form::open(['url' => route('test.save'), 'method' => 'POST']) !!}
        <p id="list-seat"></p>
        {!! Form::hidden('seats', null, ['id' => 'seats']) !!}
        {!! Form::text('name', null, ['placeholder' => __('Name')]) !!}
        {!! Form::number('total_seat', null, ['placeholder' => __('Total Seat')]) !!}
        {!! Form::number('seat_per_row', null, ['placeholder' => __('Seat Per Row')]) !!}
        {!! Form::submit(__('Save'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
</div>
@endsection
