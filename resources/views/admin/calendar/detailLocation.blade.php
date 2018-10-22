@extends('admin.layout.master')

@section('title', __('Work Schedule'))

@section('module', __('Detail') . ' ' . $date)

@section('content')
<div class="m-portlet">
    <div class="m-portlet__body">
        <div class="m-section">
            <div class="m-section__content">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-map-location"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                {{ $location->name }}
                                -
                                @lang('Total Seat:', ['total' => $location->total_seat])
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    {!! Form::open(['class' => 'row mb-3', 'method' => 'GET']) !!}
                    <div class="col-md-4 offset-md-2">
                        {!! Form::select('shift', config('site.shift_filter'), request('shift'), ['class' => 'form-control m-input m-input--square', 'id' => 'program']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::select('program_id', $programs, request('program_id'), ['class' => 'form-control m-input m-input--square', 'id' => 'program']) !!}
                    </div>
                    <div class="col-md-2">
                        {!! Form::submit(__('Apply'), ['class' => 'btn btn-brand w-100']) !!}
                    </div>
                    {!! Form::close() !!}
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">
                                <table class="table m-table m-table--head-bg-success">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('Email') }}</th>
                                            <th>{{ trans('Program') }}</th>
                                            <th>{{ trans('Position') }}</th>
                                            <th>{{ trans('Type') }}</th>
                                            <th>{{ trans('Role') }}</th>
                                            <th>{{ trans('Shift') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($data->count() > 0)
                                            @foreach($data as $key => $user)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1" tabindex="0">
                                                    <div class="m-card-user m-card-user--sm">
                                                        <div class="m-card-user__pic">
                                                            <div class="m-card-user__no-photo m--bg-fill-danger">
                                                                <span>
                                                                    {!! Html::image($user->avatarUser) !!}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="m-card-user__details">
                                                            <span class="m-card-user__name"><a href="{{ url('admin/schedule/users/' . $user->id) }}">{{ $user->name }}</a></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->program->name }}</td>
                                                <td>{{ $user->position->name }}</td>
                                                @if($user->position->is_fulltime == config('site.partime'))
                                                    <td>{{ __('Partime') }}</td>
                                                @else
                                                    <td>{{ __('Fulltime') }}</td>
                                                @endif
                                                @if ($user->role == config('site.permission.trainee'))
                                                    <td>{{ trans('Trainee') }}</td>
                                                @elseif ($user->role == config('site.permission.trainer'))
                                                    <td>{{ trans('Trainer') }}</td>
                                                @else
                                                    <td>{{ trans('Admin') }}</td>
                                                @endif
                                                <td>
                                                    <span class="btn btn-primary">{{ $user->getShiftByDate($date) }}</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            @include('admin.components.alert', ['type' => 'warning', 'message' => __('Have no data!')])
                                        @endif
                                    </tbody>
                                </table>
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
