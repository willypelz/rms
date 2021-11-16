@extends('layout.template-new')
@section('content')
    <div class="container-fluid shr-auth">
        <div class="h-100 row justify-content-center align-items-center">

            <section class="col-xs-10 col-md-4">

                <div class="text-center">
                    <img src="{{ getEnvData('APP_LOGO',null,request()->clientId) }}" class="shr-auth-logo">
                </div>

                <h4 class="my-4 dark-blue-text font-weight-bold">Enter your email to reset your password</h4>

                <form action="" method="POST">
                        @include('layout.alerts')

                    <div class="form-group shr-form-group">
                        <label class="shr-input-label">Your email address</label>
                        <div class="shr-input-group">
                            <img src="{{ asset('homepage/images/icon-envelope-alt.svg') }}" class="shr-input-group-addon">
                            <input required="" name="email" type="email" class="shr-input">
                        </div>
                    </div>

                    <button class="btn btn-block shr-auth-form-button" type="submit" > Send Forgot Password Link </button>
                </form>
            </section>

        </div>
    </div>

@endsection
