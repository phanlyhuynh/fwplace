@extends('admin.layout.master')

@section('title', __('Workspaces'))

@section('module', __('Workspaces List'))

@section('content')
<div class="m-portlet">
    <div class="m-portlet__body">
        <div class="m-section">
            <div class="m-section__content">
                <table class="table m-table m-table--head-bg-success table-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('Workspace Photo')</th>
                            <th>@lang('Workspace Name')</th>
                            <th>@lang('Total Seat')</th>
                            <th>
                                <a href="{{ route('workspaces.create') }}" class="btn m-btn--pill m-btn--air btn-secondary" data-toggle="m-tooltip" data-placement="left" data-original-title="@lang('Add Workspace')">
                                    <i class="flaticon-add"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($workspaces as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td class="w-50">
                                <img src="{{ $item->photo }}" alt=""  class="w-75">
                            </td>
                            <td><h5>{{ $item->name }}</h5></td>
                            <td><h5>{{ $item->total_seat }}</h5></td>
                            <td>
                                <a href="{{ route('workspaces.edit', ['id' => $item->id]) }}" class="btn btn-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" data-toggle="m-tooltip" data-placement="left" data-original-title="@lang('Edit Workspace')">
                                    <i class="flaticon-edit-1"></i>
                                </a>
                                {!! Form::open(['route' => ['workspaces.destroy', $item->id], 
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
            </div>
        </div>
    </div>
</div>
@endsection
