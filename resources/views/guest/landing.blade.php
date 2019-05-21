@extends('layout.template-new')
@section('content')

  <div class="container-fluid shr-auth">

        <div class="row">

            <section class="col shr-auth-form">

                <img src="{{ env('APP_LOGO') }}" class="shr-auth-logo">

                <div class="shr-auth-form-inner">
                    <h2 class="dark-blue-text font-weight-bold">Welcome candidate</h2>
                    <p>We are equal opportunity employer. All aspects of employment will be based on merit, competence, performance, and business needs.</p>
                    <h4 class="mt-4 dark-blue-text font-weight-bold">Access our candidate portal</h4>

                    <div class="shr-auth-form-toggle">
                        <a href="" class="toggle-button active">Log in to your account</a>
                        <a href="{{ route('candidate-register') }}" class="toggle-button">Create an account</a>
                    </div>

                    <p class="my-2 dark-blue-text font-16">Log in to get access into your account.</p>

                      @include('layout.alerts')

                    <form action="" method="POST">
                        <div class="form-group shr-form-group">
                            <label class="shr-input-label">Your email address</label>
                            <div class="shr-input-group">
                                <img src="{{ asset('homepage/images/icon-envelope-alt.svg') }}" class="shr-input-group-addon">
                                <input type="email" name="email" class="shr-input" placeholder="Enter your email">
                            </div>
                        </div>

                        <div class="form-group shr-form-group">
                            <label class="shr-input-label">Your password</label>
                            <div class="shr-input-group">
                                <img src="{{ asset('homepage/images/icon-lock-alt.svg') }}" class="shr-input-group-addon">
                                <input name="password" type="password" class="shr-input" placeholder="Enter a password">
                            </div>
                            <a href="{{ route('candidate-forgot') }}" class="my-1">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn btn-block shr-auth-form-button">Log in to your account</button>
                    </form>
                </div>

            </section>

            <section class="col shr-auth-jobs">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('homepage/images/icon-jobs.svg') }}">
                    <h4 class="dark-blue-text font-weight-bold ml-3">Job’s you might be interested in</h4>
                </div>



                @foreach($jobs as $job)
                <div class="job-card">
                    <h5 class="dark-blue-text font-weight-bold font-16"> 
                        <a href="{{ route('job-view', [$job->id, $job->slug]) }}">  {{ $job->title }}  </a> </h5>
                    <p class="mb-2 job-card-content"> {{ @$job->summary }} </p>
                    <div class="d-flex align-items-center">
                        <span class="d-flex align-items-center">
                            <img src="{{ asset('homepage/images/icon-clock-three.svg') }}" class="mr-1">
                            Expiry
                        </span>
                        <div class="shr-job-badge">{{ \Carbon\Carbon::parse($job->expiry_date)->toFormattedDateString() }}</div>
                    </div>
                </div>
                @endforeach

                <p class="text-center dark-blue-text font-weight-bold">To see more job postings, <a href="{{ url('register') }}">create an account </a> </p>
            </section>
        </div>
    </div>

@endsection
