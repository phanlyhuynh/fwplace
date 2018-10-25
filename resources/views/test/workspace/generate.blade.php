@extends('admin.layout.master')

@section('title', __('Add Workspace'))

@section('module', __('Add Workspace'))

@section('content')
<div class="m-portlet pl-5 py-5">
    <div class="workspace">
        <div class="form-workspace">
            {!! Form::open(['url' => route('save_location', ['id' => $id]), 'method' => 'POST']) !!}
                <p id="list-seat"></p>
                {!! Form::hidden('seats', null, ['id' => 'seats']) !!}
                {!! Form::text('name', null, ['placeholder' => __('Name')]) !!}
                {!! Form::color('color', null, ['placeholder' => __('Color')]) !!}
                {!! Form::submit(__('Save'), ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>
        {!! Form::button(__('Add location'), ['class' => 'btn btn-success', 'id' => 'show']) !!}
        <div class="all_seat">
            @foreach($renderSeat as $row)
                <div class="row">
                    @foreach($row as $seat)
                        <div class="seat @if ($seat === null) disabled @endif" id="{{ $seat }}">
                            {{ $seat ?? 'X'}}
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/generate.js') }}"></script>
@endsection
