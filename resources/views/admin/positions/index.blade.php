@extends('admin.layout.master')
@section('title', __('Position'))
@section('module', __('Position'))
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__body">
                    <!--begin::Section-->
                    <div class="m-section">
                        <div class="m-section__content">
                            <table class="table m-table m-table--head-bg-success">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Position') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>
                                        <a href="{{ url('admin/positions/create') }}" class="btn m-btn--pill m-btn--air btn-secondary table-middle " data-toggle="m-tooltip" data-placement="left" data-original-title="{{ __('Add new') }}">
                                            <i class="flaticon-add"></i>
                                        </a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($positions))
                                    @foreach($positions as $key => $position)
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $position->name }}</td>
                                            @if($position->is_fulltime == 0)
                                                <td>{{ __('Parttime') }}</td>
                                            @else
                                                <td>{{ __('Fulltime') }}</td>
                                            @endif
                                            <td>
                                                <a href="{{ url('admin/positions/' . $position->id . '/edit') }}" class="btn btn-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" data-toggle="m-tooltip" data-placement="left" data-original-title="{{ __('Edit') }}">
                                                    <i class="flaticon-edit-1"></i>
                                                </a>
                                                {!! Form::open(['url' => 'admin/positions/' . $position->id, 'method' => 'DELETE', 'class' => 'd-inline']) !!}
                                                {!! Form::button('<i class="flaticon-cancel"></i>', ['type' => 'submit', 'class' => 'btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill delete', 'data-toggle' => 'm-tooltip', 'data-placement' => 'right', 'data-original-title' => __('Delete')]) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
            </div>
        </div>
    </div>
@endsection
