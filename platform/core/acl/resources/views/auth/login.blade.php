@extends('core/acl::layouts.master')
@section('content')
    <div class="login-form text-center p-7 position-relative overflow-hidden">
        <!--begin::Login Header-->
        <div class="d-flex flex-center mb-15">
            <a href="#">
                <img src="{{ asset('vendor/core/media/logos/logo-letter-13.png') }}" class="max-h-75px" alt=""/>
            </a>
        </div>
        <!--end::Login Header-->
        <!--begin::Login Sign in form-->
        <div class="login-signin">
            <div class="mb-20">

                <h3>{{ __('core/acl::auth.login_title') }}</h3>
                <div class="text-muted font-weight-bold">
                    {{ apply_filters('login_detail', '') }}
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <p @if($loop->last) class="mb-0" @endif>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('login') }}" class="form" id="kt_login_signin_form" method="POST">
                @csrf
                <div class="form-group mb-5">
                    <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Email"
                           name="email" autocomplete="off"/>
                </div>
                <div class="form-group mb-5">
                    <input class="form-control h-auto form-control-solid py-4 px-8" type="password"
                           placeholder="Password" name="password"/>
                </div>
                <button id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4">
                    {{ __('core/acl::auth.login') }}
                </button>
            </form>
        </div>
        <!--end::Login Sign in form-->
    </div>
@endsection
