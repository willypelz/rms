@extends('layout.template-user')

@section('navbar')
@show()

@section('content')


<section class="no-pad">
    <div class="container">
        <h2 class="text-center">Applicant Email Preview</h2>
        {!! $invite_email !!}
        <hr>
        <h2 class="text-center">Interviewer Email Preview</h2>
        {!! $interviewer_email !!}
    </div>
</section>

<div class="separator separator-small"><br></div>
@endsection