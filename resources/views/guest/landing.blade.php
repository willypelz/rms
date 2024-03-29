@extends('layout.template-new')
@section('content')

    <div class="container-fluid shr-auth">

        <div class="row">

            <section class="col shr-auth-form">
                <a class="shr-auth-form-toggle" style=" margin-left: 85%; margin-top: -20px;width: 150px; text-decoration:none;" href="{{url('/login')}}">Admin Portal</a>
                   
                <img src="{{ getEnvData('APP_LOGO', null, request()->clientId) }}" class="shr-auth-logo">

                <div class="shr-auth-form-inner">
                    <h2 class="dark-blue-text font-weight-bold">Welcome candidate</h2>
                    <p>We are an equal opportunity employer. All stages of the employment process will be based on
                        merit, competence, performance and business needs.</p>

                    <div class="shr-auth-form-toggle">
                        <a href="" class="toggle-button active">Log in to your account</a>
                        <a href="{{ route('candidate-register') }}" class="toggle-button">Create an account</a>
                    </div>

                    @include('layout.alerts')

                    <form action="" method="POST">
                        <div class="form-group shr-form-group">
                            <label class="shr-input-label">Your email address</label>
                            <div class="shr-input-group">
                                <img src="{{ asset('homepage/images/icon-envelope-alt.svg') }}"
                                     class="shr-input-group-addon">
                                <input type="email" name="email" class="shr-input" placeholder="Enter your email">
                            </div>
                        </div>

                        <div class="form-group shr-form-group">
                            <label class="shr-input-label">Your password</label>
                            <div class="shr-input-group">
                                <img src="{{ asset('homepage/images/icon-lock-alt.svg') }}"
                                     class="shr-input-group-addon">
                                <input name="password" type="password" class="shr-input" placeholder="Enter a password">
                            </div>
                            <a href="{{ route('candidate-forgot') }}" class="my-1">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn btn-block shr-auth-form-button">Log in to your account</button>
                    </form>
                </div>

                <div class="mt-5">
                    <small>
                        &copy; {{date('Y')}} All Rights Reserved.
                        Read our <a href="https://seamlesshr.com/privacy-security/" target="_blank">privacy policy</a>
                    </small>
                </div>

            </section>

            <section class="col shr-auth-jobs">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('homepage/images/icon-jobs.svg') }}">
                    <h4 class="dark-blue-text font-weight-bold ml-3"> Jobs you may be interested in</h4>
                </div>
                @forelse($jobs as $job)
                    <div class="job-card">
                        <a href="{{ route('job-view', [$job->id, $job->slug]) }}"><h5
                                    class="dark-blue-text font-weight-bold font-16">{{ $job->title }}</h5></a>
                        <p class="mb-2 job-card-content"> {{ $job->summary }} </p>
                        <div class="d-flex align-items-center">
                            <span class="d-flex align-items-center">
                                <img src="{{ asset('homepage/images/icon-clock-three.svg') }}" class="mr-1">
                                Expiry
                            </span>
                            <div class="shr-job-badge">{{ \Carbon\Carbon::parse($job->expiry_date)->toFormattedDateString() }}</div>
                        </div>
                    </div>

                @empty

                    <div class="job-card">
                        <div class="py-4 text-center">
                            <img src="{{ asset('homepage/images/icon-briefcase.svg') }}" class="mr-1 my-2">
                            <h5 class="font-16 mb-3">No job listings</h5>
                        </div>
                    </div>

                @endforelse


                <p class="text-center dark-blue-text font-weight-bold">To see more job postings, <a
                            href="{{ url('register') }}">create an account </a></p>
            </section>
        </div>
    </div>

@endsection
