@extends('core/base::layouts.base')
@section('page')
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat"
                 style="background-image: url('{{ asset('vendor/core/media/bg/bg-3.jpg')  }}');">
                @yield('content')
            </div>
        </div>
        <!--end::Login-->
    </div>
@endsection
