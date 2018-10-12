@extends('admin.layout.master')
@section('title', __('Register Work Schedules') )
@section('module', __('Register Work Schedules'))
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet">
                <div class="m-portlet__body">
                    <div class="m-section">
                        <div class="m-section__content">
                            {!! Form::open(['url' => route('workschedule', ['id' => Auth::user()->id ] ), 'method' => 'post' , 'id' => 'add_form' , 'enctype' => 'multipart/form-data']) !!}
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>@lang('Day')</th>
                                        <th>@lang('Day of Week')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dates as $day)
                                        <tr @isset($day['weekend']) class="bg-secondary text-dark" @endisset>
                                            <th scope="row">{{ $day['format'] }}</th>
                                            <td>{{ $day['day'] }}</td>
                                            <td>
                                                @if(!isset($day['weekend']))
                                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                                    {!! Form::select('shift[' . $day['date']  .  ']', [config('site.shift.off') => __('Off'), config('site.shift.all') => __('All day'), config('site.shift.morning') => __('Morning'), config('site.shift.afternoon') => __('Afternoon') ], $data[$day['date']] ?? null, ['class' => 'form-control']) !!}
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="m-form m-form--fit m-form--label-align-right">
                                {!! Form::submit(__('Save') . '!', ['class' => 'btn m-btn--pill    btn-primary btn-lg m-btn m-btn--custom']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
