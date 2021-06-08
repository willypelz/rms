@extends('layout.template-user')

@section('content')

    @include('applicant.includes.job-title-bar')

    <section class="no-pad applicant">
        <div class="container">

            @include('applicant.includes.pagination')

            <div class="row">
                <div class="col-xs-4">

                    @include('applicant.includes.badge')

                </div>


                <div class="col-xs-8">


                    @include('applicant.includes.nav')

                    <div class="tab-content" id="">

                        <div class="row">
                            <div class="col-xs-12">
                                <a href="{{ route('applicant-activities',  $appl->id) }}" class="btn"><i
                                            class="fa fa-bars"></i> &nbsp; Feeds</a>
                                <!-- <a href="background-check" class="btn"><i class="fa fa-commenting-o"></i> &nbsp; Comments</a> -->
                                <a href="{{ route('applicant-notes',  $appl->id) }}" class="btn btn-line"><i
                                            class="fa fa-file-text-o"></i> &nbsp; Interview Notes</a>

                                <hr>
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-xs-12">
                                <div class="clearfix">
                                    <hr>
                                </div>


                                <ul class="list-group list-notify">

                                    @if( count($interview_note_categories) > 0 )
                                        @foreach( $interview_note_categories as $template_name => $interview_notes )
                                            <h3 style="padding:10px;">{{ $template_name }}</h3>

                                            <?php $interview_notes_groups = $interview_notes->groupBy('interview_note_option_id');?>
                                            {{-- {{dd( $interview_notes_groups)}} --}}

                                            @foreach( $interview_notes_groups as $key => $interview_notes_group )
                                                <li class="list-group-item" role="candidate-comments">

                                                    <span class="fa-stack fa-lg i-notify">
                                                        <i class="fa fa-circle fa-stack-2x text-warning"></i>
                                                        <i class="fa fa-file-text-o fa-stack-1x fa-inverse"></i>
                                                    </span>
                                                    <div data-toggle="collapse" data-target="#question-{{$key}}" style="cursor: pointer;">
                                                        <div class="clearfix">
                                                            <h4 class="pull-left">{{ $interview_notes_group->first()->interview_note_option->name  }}</h4>
                                                            {{-- @if($interview_notes_group->first()->interview_note_option->type == "rating")
                                                                <h2 class="pull-right" style="margin-top: 5px;">{{ round( $interview_notes_group->sum('value') / $interview_notes_group->count() , 2 ) }}
                                                                    / {{ $interview_notes_group->first()->interview_note_option->weight }}</h2>
                                                            @endif --}}
                                                        </div>
                                                    </div>
                                                    <hr>


                                                    <div id="question-{{$key}}" class="commenter collapse ">

                                                        <div class="">
                                                            @if($interview_notes_group->first()->interview_note_option->type == "rating")

                                                                <table class="table table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Interviewer</th>
                                                                        <th>Date Interviewed</th>
                                                                        <th>Score</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach( $interview_notes_group as $interview_note )
                                                                        <tr>
                                                                            <td>{{ $interview_note->interviewer->name }}</td>
                                                                            <td>{{ date('D, j-n-Y, h:i A', strtotime( $interview_note->created_at ))  }}</td>
                                                                            <td>{{ $interview_note->value }}
                                                                                / {{ $interview_note->interview_note_option->weight_max }}</td>
                                                                        </tr>
                                                                    @endforeach

                                                                    <tr>
                                                                        <td></td>
                                                                        <td><strong>Total</strong></td>
                                                                        <td>{{ round( $interview_notes_group->sum('value') / $interview_notes_group->count() , 2 ) }}
                                                                            / {{ $interview_notes_group->first()->interview_note_option->weight_max }}</td>
                                                                    </tr>

                                                                    </tbody>
                                                                </table>


                                                            @elseif($interview_notes_group->first()->interview_note_option->type == "text")

                                                                @foreach( $interview_notes_group as $interview_note )
                                                                    <blockquote class="h5">
                                                                        <span role="comment-body text-muted">
                                                                            <strong>{{ $interview_note->interviewer->name }}</strong><br>
                                                                            {{ $interview_note->value }}
                                                                        </span>
                                                                    </blockquote>
                                                                @endforeach

                                                            @endif

                                                        </div>
                                                    </div>
                                                    {{--<button class="btn btn-success btn-block "--}}
                                                    {{--title="Interview Note by {{ $interview_note->interviewer->name }}"--}}
                                                    {{--data-toggle="modal" data-target="#viewModal"--}}
                                                    {{--id="modalButton" href="#viewModal"--}}
                                                    {{--data-title="Interview Note by {{ $interview_note->interviewer->name }}"--}}
                                                    {{--data-view="{{ route('modal-interview-notes',['interview_id'=>$interview_note, 'readonly'=>true , 'interviewed_by' => $interview_note->interviewed_by]) }}"--}}
                                                    {{--data-app-id="{{ $appl->id }}"--}}
                                                    {{--data-cv="{{ $appl->cv->id }}" data-type="wide">--}}
                                                    {{--View Note--}}
                                                    {{--</button>--}}


                                                </li>
                                            @endforeach



                                        @endforeach
                                    @else

                                        <div>
                                            <span>This candidate has not been interviewed</span>
                                        </div>

                                    @endif

                                </ul>


                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <!--/tab-content-->

                    </div>
                    <!--/tab-content-->

                </div>

            </div>

            @include('applicant.includes.pagination')

        </div>
    </section>

    <div class="separator separator-small"></div>



@endsection
