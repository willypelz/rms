@extends('layout.template-default')


@section('content')
    @php
        $user_role = getCurrentLoggedInUserRole();
        $is_super_admin = auth()->user()->is_super_admin;
    @endphp

    @include('job.includes.interview-head')
    <div class="h-80vh">
        <br>

        <div class="container">
            <div class="row">

                <div class="col-sm-12"><br>
                    @include('layout.alerts')
                    <!-- <h4>Interview Templates</h4> -->
                    @include('layout.confirm-dialog')
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
                                                     >
                                                    {!! $interview_note_template->description !!}
                                                </div>

                                                <hr>

                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <div class="btn-group">
                                                            <a href="{{ route('interview-note-options', $interview_note_template->id ) }}"
                                                               class="btn btn-line " style="">Options <span
                                                                        class="badge badge-danger text-white">{{ $interview_note_template->options->count()  }}</span>
    
                                                            </a>
                                                            @if((isset($user_role) && !is_null($user_role) && in_array($user_role->name, ['admin'])) || $is_super_admin)
                                                            <a href="{{ route('interview-note-option-create', ['interview_template_id' => $interview_note_template->id]) }}" class="btn btn-line" style="padding: 6px ;"><i
                                                                        class="fa fa-plus no-margin fa-lg"></i></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                   

                                                    @if((isset($user_role) && !is_null($user_role) && in_array($user_role->name, ['admin'])) || $is_super_admin)
                                                    
                                                    <div class="col-xs-6" >
                                                        <a href="javascript:;"   onclick="remove('{{$interview_note_template->name}}', '{{'interview_note_template_id'. $interview_note_template->id}}')"
                                                            class=" btn text-danger pull-right" style=""><i
                                                                     class="fa fa-lg no-margin fa-trash" data-toggle="tooltip" data-placement="top" title="Delete this template?"></i>
                                                                    </a>
    
                                                        <form id="{{'interview_note_template_id'. $interview_note_template->id}}" action="{{route('interview-note-template-delete')}}" method="post" >
                                                            @csrf
                                                            <input type="hidden" name="interview_note_template_id" value="{{$interview_note_template->id}}" id="">
                                                        </form>
                                                        
                                                        <a href="{{ route('interview-note-template-duplicate', ['id' => $interview_note_template->id ]) }}"
                                                                class=" btn text-info pull-right" style=""
                                                                onclick="event.preventDefault(); duplicate('{{$interview_note_template->name}}', '{{ route('interview-note-template-duplicate', ['id' => $interview_note_template->id ]) }}')"><i class="fa fa-lg no-margin fa-copy" 
                                                                data-toggle="tooltip" data-placement="top" title="Duplicate this template?"></i></a>
    
                                                        <a href="{{ route('interview-note-template-edit', ['id' => $interview_note_template->id ]) }}"
                                                        class=" btn text-success pull-right" style=""><i
                                                                    class="fa fa-lg no-margin fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit this template?"></i></a>
                                                    </div>
                                                    
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
                                                    creating one
                                                </p>
                                                @if((isset($user_role) && !is_null($user_role) && in_array($user_role->name, ['admin'])) || $is_super_admin)
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
<script>
            $(function () {

                $('[data-toggle="tooltip"]').tooltip()

            })
</script>

@endsection