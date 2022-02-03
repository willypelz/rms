@extends('layout.template-new')
@section('content')
    <div class="container-fluid shr-auth">
        <div class="h-100 row justify-content-center align-items-center">

            <section class="col-xs-10 col-md-4 text-center">

                <img src="{{ asset('homepage/images/icon-check-mark.svg') }}" class="mt-5">

                <h4 class="my-4 dark-blue-text font-weight-bold">A password reset link has been sent to your email</h4>

                <a href="{{ route('candidate-login') }}" class="btn btn-block shr-auth-form-button">Go to login page</a>
            </section>

        </div>
    </div>

@endsection
