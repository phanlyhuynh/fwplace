@extends('admin.layout.master')
@section('title', trans('Role'))
@section('module', trans('Role'))
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
                                    <th>{{ trans('Name') }}</th>
                                    <th>{{ trans('Description') }}</th>
                                    <th>
                                        <a href="{{ url('admin/roles/create') }}" class="btn m-btn--pill m-btn--air btn-secondary table-middle " data-toggle="m-tooltip" data-placement="left" data-original-title="{{ trans('Add new') }}">
                                            <i class="flaticon-add"></i>
                                        </a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($roles))
                                    @foreach($roles as $key => $role)
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $role->display_name }}</td>
                                            <td>{{ $role->description }}</td>
                                            <td>
                                                <a href="{{ url('admin/roles/' . $role->id . '/edit') }}" class="btn btn-warning m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" data-toggle="m-tooltip" data-placement="left" data-original-title="{{ trans('Edit') }}">
                                                    <i class="flaticon-edit-1"></i>
                                                </a>
                                                {!! Form::open(['url' => 'admin/roles/' . $role->id, 'method' => 'DELETE', 'class' => 'd-inline']) !!}
                                                {!! Form::button('<i class="flaticon-cancel"></i>', ['type' => 'submit', 'class' => 'btn btn-danger m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill delete', 'data-toggle' => 'm-tooltip', 'data-placement' => 'right', 'data-original-title' => trans('Delete')]) !!}
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
