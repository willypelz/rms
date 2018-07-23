@extends('layout.template-default')


@section('content')



<section class="">
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center">
                    <h3>Interview Note Options</h3>
                    <a href="{{ route('interview-note-option-create') }}" class="btn btn-info">Add new</a><br>
                    <!-- <p class="text-muted">Africa's fastest growing network of professionals</p> -->
                </div>

                <div class="col-sm-8 col-sm-offset-2">

                    @foreach( $interview_note_options as $interview_note_option )
                    <div class="col-xs-12 job-block">
                        <div class="panel panel-default b-db">
                            <div class="panel-body no-pad">

                                <div class="title-job pull-left" style="width:100%">

                                    <big><a target="_blank" href="#!"><b>{{ $interview_note_option->name }}</b> <span class="label label-warning">{{ $interview_note_option->type }}</span></a></big>

                                    <a href="{{ route('interview-note-option-edit', ['id' => $interview_note_option->id ]) }}" class="pull-right btn btn-success" style="margin-top: -10px;">Edit</a>
                                    <hr>
                                    <small class="text-muted">
                                        {!! $interview_note_option->description !!}
                                     </small><br>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach




                </div>


            </div>
        </div>
</section>


@endsection
