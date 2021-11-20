@extends('layout.template-default')


@section('content')
    @php
        $user_role = getCurrentLoggedInUserRole();
        $is_super_admin = auth()->user()->is_super_admin;
    @endphp

    @include('job.includes.interview-head')

    <div class="">
        <br>
        
        <div class="container">
        
            <div class="panel h-80vh" style="">
                <br>
                <a style="text-decoration:none" href="{{ route('interview-note-templates') }}">  <span style="margin:15px"><i class="fa fa-arrow-left"></i> Go Back</a></span>
               
                <br><br>
                
                <div class="row">
                
                    <div class="col-sm-6 col-sm-offset-2">

                        <h3 class="no-margin">
                            <span style="font-size: 14px; letter-spacing: 2px; text-transform: uppercase">{{$interview_note_options->count()}} Options under </span>
                            <br>
                            <b>{{ $interview_template->name }}</b>
                        </h3>

                    </div>
                    @if((isset($user_role) && !is_null($user_role) && in_array($user_role->name, ['admin'])) || $is_super_admin)
                    <div class="col-sm-2 text-right">
                        <a href="{{ route('interview-note-option-create', ['interview_template_id' => $interview_template_id]) }}"
                           class="btn btn-info">Add new</a>
                    </div>
                    @endif

                    <div class="col-sm-8 col-sm-offset-2">
                        @include('layout.alerts')
                        <div class="alert-success" id="msg"></div>
                        <div class="">
                            <hr>
                        </div>
                        <div class="sortable">
                        @forelse( $interview_note_options as $interview_note_option )
                            <div id="{{ $interview_note_option->id }}" class="sorting">
                                <div class="panel panel-default">

                                    <div class="panel-heading">
                                        <a target="_blank" href="#!">
                                            <b class="h4">{{ $interview_note_option->name }}</b>
                                        </a>

                                        &nbsp;

                                        <span class="label label-warning text-uppercase"
                                              style="">{{ $interview_note_option->type }}</span>
                                        @if((isset($user_role) && !is_null($user_role) && in_array($user_role->name, ['admin'])) || $is_super_admin)
                                        
                                        <a href="javascript:;" onclick="event.preventDefault(); confirm('Are you sure you want to delete this option?') ? document.getElementById('{{ 'interview_note_option_id'. $interview_note_option->id }}').submit() : false"                                           class="pull-right btn" style="margin-top: -5px;"><i
                                                    class="fa fa-lg fa-trash"></i> Delete</a>
                                        <a href="{{ route('interview-note-option-edit', ['interview_template_id' => $interview_template_id,'id' => $interview_note_option->id ]) }}"
                                        class="pull-right btn" style="margin-top: -5px;"><i
                                                    class="fa fa-lg fa-pencil"></i> Edit</a>
                                        <form id="{{'interview_note_option_id'. $interview_note_option->id}}" action="{{route('interview-note-option-delete')}}" method="post" >
                                                @csrf
                                                <input type="hidden" name="interview_note_option_id" value="{{$interview_note_option->id}}" id="">
                                        </form>
                                        
                                        @endif

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
                                            creating one </p>
                                        <p>
                                            @if((isset($user_role) && !is_null($user_role) && in_array($user_role->name, ['admin'])) || $is_super_admin)
                                            <a href="{{ route('interview-note-option-create', ['interview_template_id' => $interview_template_id]) }}"
                                               class="btn btn-info">Add an option</a>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                        </div>

                        <div class="text-right">
                            @if((isset($user_role) && !is_null($user_role) && in_array($user_role->name, ['admin'])) || $is_super_admin)
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
    <script>
    $(function(){
        $(".sortable").sortable({
            stop: function() {
                let data = $.map($(this).find('.sorting'), function(x) {
                    return id = x.id;
                });
                $.ajax({
                    url: "{{ route('interview-note-option-sort')}}",
                    type: "GET",
                    dataType: 'json',
                    data: {
                        ids: data,
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $.growl.notice({message: response.message});
                        }else{
                            $.growl.error({message: 'Reordering failed'});
                        }
                    },
                })
            }
        });
    })
    </script>


@endsection
