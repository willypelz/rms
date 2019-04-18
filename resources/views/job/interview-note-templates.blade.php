@extends('layout.template-default')


@section('content')
    @php
        $user_role = getCurrentLoggedInUserRole();
    @endphp

    @include('job.includes.interview-head')
    <div class="h-80vh">
        <br>

        <div class="container">
            <div class="row">

                <div class="col-sm-12"><br>

                    <!-- <h4>Interview Templates</h4> -->

                    <div class="row">

                        @forelse( $interview_note_templates as $interview_note_template )
                            <div class="col-xs-4">
                                <div class="job-block">
                                    <div class="panel panel-default interview-panel no-border">
                                        <div class="panel-body">

                                            <div class="">

                                                <h4 class="no-margin panel-title"
                                                    title="{{ $interview_note_template->name }}">
                                                    <b>{{ $interview_note_template->name }}</b></h4>
                                                <hr>

                                                <div class="text-muted panel-desc"
                                                     title="{!! $interview_note_template->description !!}">
                                                    {!! $interview_note_template->description !!}
                                                </div>

                                                <hr>

                                                <div>


                                                    <div class="btn-group">
                                                        <a href="{{ route('interview-note-options', ['id' => $interview_note_template->id ]) }}"
                                                           class="btn btn-line " style="">Options <span
                                                                    class="badge badge-danger text-white">{{ $interview_note_template->options->count()  }}</span>

                                                        </a>
                                                        @if($user_role->name == 'admin')
                                                        <a href="{{ route('interview-note-option-create', ['interview_template_id' => $interview_note_template->id]) }}" class="btn btn-line" style="padding: 9px ;"><i
                                                                    class="fa fa-plus no-margin fa-lg"></i></a>
                                                        @endif
                                                    </div>

                                                    @if($user_role->name == 'admin')

                                                    <a href="{{ route('interview-note-template-edit', ['id' => $interview_note_template->id ]) }}"
                                                       class=" btn pull-right" style=""><i
                                                                class="fa fa-lg no-margin fa-pencil"></i></a>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="col-xs-12">
                                    <div class="panel panel-default panel-empty">
                                        <div class="panel-body text-center text-muted">
                                            <div>
                                                <i class="fa fa-5x fa-folder-open"></i>
                                                <br>
                                                <p class="lead">You have not created any template. <br> Start by
                                                    creating a one
                                                </p>
                                                @if($user_role->name == 'admin')
                                                <p>
                                                    <a href="{{ route('interview-note-template-create') }}"
                                                       class="btn btn-primary">Create a template</a>
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforelse


                    </div>

                </div>


            </div>
        </div>
        <br>
    </div>


@endsection
n