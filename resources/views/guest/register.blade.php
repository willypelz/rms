@extends('layout.template-new')
<style type="text/css">
    .help-block{
        color:red;
    }
</style>
@section('content')

  <div class="container-fluid shr-auth">
        <div class="row">

            <section class="col shr-auth-form">
                <img src="{{ getEnvData('APP_LOGO',null,request()->clientId) }}" class="shr-auth-logo">
                <h2 class="dark-blue-text font-weight-bold">Welcome candidate</h2>
                <p>We are an equal opportunity employer. All stages of the employment process will be based on merit, competence, performance and business needs.</p>

                <div class="shr-auth-form-toggle">
                        <a href="{{ route('candidate-login') }}" class="toggle-button">Log in to your account</a>
                        <a href="" class="toggle-button active">Create an account</a>
                </div>

                <form action="{{ route('candidate-register') }}" method="POST">
                        @include('layout.alerts')

                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }} shr-form-group">
                        <label class="shr-input-label">Firstname</label>
                        <div class="shr-input-group">
                            <img src="{{ asset('homepage/images/icon-user.svg') }}" class="shr-input-group-addon">
                            <input name="first_name" type="text" class="shr-input" placeholder="Enter your first name" value="{{ old('first_name') }}">

                        </div>
                        @if ($errors->has('first_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }} shr-form-group">
                        <label class="shr-input-label">Last name</label>
                        <div class="shr-input-group">
                            <img src="{{ asset('homepage/images/icon-user.svg') }}" class="shr-input-group-addon">
                            <input type="text" name="last_name" class="shr-input" placeholder="Enter your last name">
                        </div>
                        @if ($errors->has('last_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} shr-form-group">
                        <label class="shr-input-label">Email</label>
                        <div class="shr-input-group">
                            <img src="{{ asset('homepage/images/icon-envelope-alt.svg') }}" class="shr-input-group-addon">
                            <input type="email" name="email" class="shr-input" placeholder="Enter your email">

                        </div>
                        @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                    </div>


                    <div class="form-group shr-form-group">
                        <label class="shr-input-label">Enter password</label>
                        <div class="shr-input-group">
                            <img src="{{ asset('homepage/images/icon-lock-alt.svg') }}" class="shr-input-group-addon">
                            <input type="password" name="password" class="shr-input" placeholder="Enter a password">

                        </div>
                        @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                    </div>

                    <div class="my-4 leading-sm">
                        <small class="text-muted font-weight-light">
                            By clicking on create your account, you agree to our <a href="//seamlesshr.com/terms">terms</a> and
                            <a href="https://seamlesshr.com/privacy-security/" target="_blank">privacy policy.</a>
                        </small>
                    </div>

                    <button type="submit" class="btn btn-block shr-auth-form-button">Create your account</button>

                    <div class="mt-5">
                        <small>
                            &copy; {{date('Y')}} All Rights Reserved.
                            Read our <a href="https://seamlesshr.com/privacy-security/" target="_blank">privacy policy</a>
                        </small>
                    </div>
                </form>
            </section>

           <section class="col shr-auth-jobs">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('homepage/images/icon-jobs.svg') }}">
                    <h4 class="dark-blue-text font-weight-bold ml-3">Job’s you might be interested in</h4>
                </div>


               @forelse($jobs as $job)

                   <div class="job-card">
                       <a href="{{ route('job-view', [$job->id, $job->slug]) }}"><h5 class="dark-blue-text font-weight-bold font-16">{{ $job->title }}</h5></a>
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

                <p class="text-center dark-blue-text font-weight-bold">To see more job postings, create an account</p>
            </section>
        </div>
    </div>

@endsection
