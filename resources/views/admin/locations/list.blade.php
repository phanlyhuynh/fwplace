@extends('admin.layout.master')

@section('title', __('Locations'))

@section('module', __('Locations List'))

@section('content')
<div class="m-portlet">
    <div class="m-portlet__body">
        <div class="m-section">
            <div class="m-section__content">
                {!! Form::open(['route' => 'locations.index', 'class' => 'row mb-3', 'method' => 'GET']) !!}
                <div class="form-group m-form__group col-md-5">
                    {!! Form::label(null, __('Workspace'), []) !!}
                    {!! Form::select('workspace_id', array_merge([__('All')], $workspaces), request('workspace_id'), ['class' => 'form-control m-input m-input--square']) !!}
                </div>
                <div class="form-group m-form__group col-md-5">
                    {!! Form::label(null, __('Location Name'), []) !!}
                    {!! Form::text('name', request('name'), ['class' => 'form-control m-input m-input--square', 'placeholder' => __('Location Name')]) !!}
                </div>
                <div class="col-md-2 pt-2">
                    {!! Form::submit(__('Apply'), ['class' => 'btn btn-brand mt-4']) !!}
                </div>
                {!! Form::close() !!}
                <table class="table m-table m-table--head-bg-success table-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('Location Photo')</th>
                            <th>@lang('Location Name')</th>
                            <th>@lang('Total Seat')</th>
                            <th>@lang('Workspace')</th>
                            <th>
                                <a href="{{ route('locations.create') }}" class="btn m-btn--pill m-btn--air btn-secondary" data-toggle="m-tooltip" data-placement="left" data-original-title="@lang('Add Location')">
                                    <i class="flaticon-add"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locations as $location)
                            <tr>
                                <th scope="row">{{ $location->id }}</th>
                                <td class="w-25">
                                    <img src="{{ $location->photo }}" alt=""  class="w-100">
                                </td>
                                <td><h5>{{ $location->name }}</h5></td>
                                <td>
                                    {{ $location->total_seat }}
                                </td>
                                <td>
                                    <button type="button" class="btn m-btn--pill    btn-primary btn-sm m-btn m-btn--custom">
                                        {{ $location->workspace->name }}
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ route('locations.edit', ['id' => $location->id]) }}" class="btn btn-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" data-toggle="m-tooltip" data-placement="left" data-original-title="@lang('Edit Location')">
                                        <i class="flaticon-edit-1"></i>
                                    </a>
                                    {!! Form::open(['route' => ['locations.destroy', $location->id], 
                                        'class' => 'd-inline',
                                        'method' => 'DELETE'
                                    ]) !!}
                                        {!! Form::button('<i class="flaticon-cancel"></i>', [
                                            'class' => 'delete btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill',
                                            'type' => 'submit',
                                            'message' => __('Delete this item?')
                                        ]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @empty
                            @include('admin.components.alert', ['type' => 'warning', 'message' => __('Have no data!')])
                        @endforelse
                    </tbody>
                </table>
                {{ $locations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
