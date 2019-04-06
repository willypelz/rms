@extends('layout.template-default')


@section('content')
    @php
        $user_role = getCurrentLoggedInUserRole();
    @endphp

    @include('job.includes.interview-head')

    <div class="">
        <br>
        <div class="container">
            <div class="panel h-80vh" style="">
                <br><br>
                <div class="row">

                    <div class="col-sm-6 col-sm-offset-2">

                        <h3 class="no-margin">
                            <span style="font-size: 14px; letter-spacing: 2px; text-transform: uppercase">{{$interview_note_options->count()}} Options under </span>
                            <br>
                            <b>{{ $interview_template->name }}</b>
                        </h3>

                    </div>
                    @if($user_role->name == 'admin')
                    <div class="col-sm-2 text-right">
                        <a href="{{ route('interview-note-option-create', ['interview_template_id' => $interview_template_id]) }}"
                           class="btn btn-info">Add new</a>
                    </div>
                    @endif

                    <div class="col-sm-8 col-sm-offset-2">

                        <div class="">
                            <hr>
                        </div>

                        @forelse( $interview_note_options as $interview_note_option )
                            <div class="">
                                <div class="panel panel-default">

                                    <div class="panel-heading">
                                        <a target="_blank" href="#!">
                                            <b class="h4">{{ $interview_note_option->name }}</b>
                                        </a>

                                        &nbsp;

                                        <span class="label label-warning text-uppercase"
                                              style="">{{ $interview_note_option->type }}</span>
                                           class="pull-right btn" style="margin-top: -5px;"><i
                                                    class="fa fa-lg fa-pencil"></i> Edit</a>

                                    </div>

                                    <div class="panel-body">

                                        <div class="">

                                            <div class="text-muted">
                                                {!! $interview_note_option->description !!}
                                            </div>
                                            <br>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div class="panel panel-default panel-empty">
                                <div class="panel-body text-center text-muted">
                                    <div>
                                        <i class="fa fa-5x fa-list"></i>
                                        <br><br>
                                        <p class="lead">You have not created any options under this template. Start by
                                            creating a one </p>
                                        <p>
                                            @if($user_role->name == 'admin')
                                            <a href="{{ route('interview-note-option-create', ['interview_template_id' => $interview_template_id]) }}"
                                               class="btn btn-info">Add an option</a>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforelse


                        <div class="text-right">
                            @if($user_role->name == 'admin')
                            <a href="{{ route('interview-note-option-create', ['interview_template_id' => $interview_template_id]) }}"
                               class="btn btn-info">Add new</a>
                            @endif
                        </div>

                    </div>


                </div>
                <br>
            </div>
        </div>
    </div>


@endsection
