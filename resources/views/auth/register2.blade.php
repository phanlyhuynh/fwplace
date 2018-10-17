<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>@lang('auth.register')</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <script src="{{ asset('js/webfont.js') }}"></script>

    @include('admin.assets.css')

    <link rel="stylesheet" href="{{ asset('bower_components/metro-asset/vendors/base/my-custom.css') }}">
    <link rel="shortcut icon" href="{{ asset(config('site.static') . 'favicon.png') }}" />
</head>
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1 login-bg" id="m_login">
            <div class="m-grid__item m-grid__item--fluid m-login__wrapper w-100">
                <div class="m-login__container">
                    <div class="m-login__logo">
                        <a href="#">
                            {!! Html::image(config('site.static') . 'framgia-logo.png') !!}
                        </a>
                    </div>
                    <div class="m-login__signin">
                        <div class="m-login__head">
                            <h3 class="m-login__title">@lang('auth.member')</h3>
                        </div>
                        <br><br>
                        {!! Form::open(['url' => '/register', 'method' => 'POST', 'class' => 'm-form m-form--fit m-form--label-align-right']) !!}
                        <div class="m-portlet__body">
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('Full Name'), null, ['class' => 'col-2 col-form-label']) !!}
                                <div class="col-10">
                                    {!! Form::text('name', null, ['class' => 'form-control m-input', 'placeholder' => __('Enter full Name')]) !!}
                                    {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('Email'), null, ['class' => 'col-2 col-form-label']) !!}
                                <div class="col-10">
                                    {!! Form::email('email', null, ['class' => 'form-control m-input', 'placeholder' => __('Enter Email')]) !!}     
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('Password'), null, ['class' => 'col-2 col-form-label']) !!}
                                <div class="col-10">
                                    {!! Form::password('password', ['class' => 'form-control m-input', 'placeholder' => __('Enter Password')]) !!}
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('Program'), null, ['class' => 'col-2 col-form-label']) !!}
                                <div class="col-10">
                                    {!! Form::select('program_id', $programs, null, ['class' => 'form-control m-input']) !!}
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('Position'), null, ['class' => 'col-2 col-form-label']) !!}
                                <div class="col-10">
                                    {!! Form::select('position_id', $positions, null, ['class' => 'form-control m-input']) !!}
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                {!! Form::label(__('Workspace'), null, ['class' => 'col-2 col-form-label']) !!}
                                <div class="col-10">
                                    {!! Form::select('workspace_id', $workspaces, null, ['class' => 'form-control m-input']) !!}
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-login__form-action">
                                {!! Form::submit(__('Register'), ['class' => 'btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.assets.js')

</body>
</html>
