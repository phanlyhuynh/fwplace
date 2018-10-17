@extends('admin.layout.master')
@section('title', __('User'))
@section('module')
    <div class="mr-auto">
        <h3 class="m-subheader__title m-subheader__title--separator">{{ __('Employee') }}</h3>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ __('Employee List') }}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="{{ url('admin/users/create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-plus"></i>
                                        <span>{{ __('New User') }}</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    {!! Form::open(['url' => 'admin/users', 'method' => 'GET', 'class' => 'm-form m-form--fit m--margin-bottom-20']) !!}
                        <div class="row m--margin-bottom-20">
                            <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                                {!! Form::label(__('Employee Name')) !!}
                                {!! Form::text('name', request('name'), ['class' => 'form-control m-input', 'placeholder' => __('Employee Name'), 'data-col-index' => 0]) !!}
                            </div>
                            <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                                {!! Form::label(__('Program')) !!}
                                {!! Form::select('program_id', $programs, request('program_id'), ['class' => 'form-control m-input', 'data-col-index' => 2]) !!}
                            </div>
                            <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                                {!! Form::label(__('Workspace')) !!}
                                {!! Form::select('workspace_id', $workspaces, request('workspace_id'), ['class' => 'form-control m-input', 'data-col-index' => 2]) !!}
                            </div>
                        </div>
                        <div class="row m--margin-bottom-20">
                            <div class="col-lg-3 m--margin-bottom-10-tablet-and-mobile">
                                {!! Form::label(__('Position')) !!}
                                {!! Form::select('position_id', $positions, request('position_id'), ['class' => 'form-control m-input', 'data-col-index' => 7]) !!}
                            </div>
                        </div>
                        <div class="m-separator m-separator--md m-separator--dashed"></div>
                        <div class="row">
                            <div class="col-lg-12">
                                {!! Form::button('<i class="la la-search"><span></span></i>', ['type' => 'submit', 'class' => 'btn btn-brand m-btn m-btn--icon', 'id' => 'm_search']) !!}
                                {!! Form::button('<i class="la la-close"></i>', ['type' => 'reset', 'class' => 'btn btn-secondary m-btn m-btn--icon', 'id' => 'm_reset']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">
                            <table class="table m-table m-table--head-bg-success">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('Email') }}</th>
                                    <th>{{ trans('Program') }}</th>
                                    <th>{{ trans('Position') }}</th>
                                    <th>{{ trans('Workspace') }}</th>
                                    <th>{{ trans('Type') }}</th>
                                    <th>{{ trans('Role') }}</th>
                                    <th>{{ trans('status') }}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if(isset($users))
                                        @foreach($users as $key => $user)
                                            @if (Auth::user()->role == config('site.permission.admin') || $user->role != config('site.permission.admin'))
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
                                                <td>{{ $user->workspace->name }}</td>
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
                                                @if ($user->status == config('site.disable'))
                                                    <td>
                                                        <span class="btn m-btn--pill btn-danger active">{{ __('Disabled') }}</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="btn m-btn--pill btn-primary active">{{ __('Active') }}</span>
                                                    </td>
                                                @endif
                                                <td>
                                                    <a href="{{ url('admin/users/' . $user->id . '/edit') }}" class="btn btn-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" data-toggle="m-tooltip" data-placement="left" data-original-title="{{ __('Edit') }}">
                                                        <i class="flaticon-edit-1"></i>
                                                    </a>
                                                    @if (Auth::user()->role == config('site.permission.admin'))
                                                        {!! Form::open(['url' => 'admin/users/' . $user->id, 'method' => 'DELETE', 'class' => 'd-inline']) !!}
                                                        {!! Form::button('<i class="flaticon-cancel"></i>', ['type' => 'submit', 'class' => 'btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill delete', 'data-toggle' => 'm-tooltip', 'data-placement' => 'right', 'data-original-title' => __('Delete')]) !!}
                                                        {!! Form::close() !!}
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $users->links() }}
                    </div>
                    <!--end::Section-->
                </div>
            </div>
        </div>
    </div>
@endsection
