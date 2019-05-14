@extends('layout.template-default')


@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

    @include('job.includes.interview-head')
    @php
        $user_role = getCurrentLoggedInUserRole();
    @endphp
    <section class="">
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2">
                    <a href="{{ route('interview-note-options', ['interview_template_id' => $interview_template_id]) }}" class=""><i class="fa fa-chevron-left"></i> Back to options</a>

                    @include('layout.alerts')
                </div>

                <div class="col-sm-8 col-sm-offset-2"><br>

                    <form action="{{ route('interview-note-option-edit', ['interview_template_id' => $interview_template_id,'id' => $interview_note_option->id ]) }}" method="POST">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="no-margin"><b>{{ $interview_template->name }}:</b> Edit {{ ucwords( $interview_note_option->name ) }}</h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ @$interview_note_option->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="summernote" class="form-control" required>
                                        {{ @$interview_note_option->description }}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select name="type" class="form-control" onchange="hideWeight(this)" id="type" required>
                                        <option value="">--select one--</option>
                                        <option value="text" @if( $interview_note_option->type == 'text' ) selected="selected" @endif >Text</option>
                                        <option value="rating" @if( $interview_note_option->type == 'rating' ) selected="selected" @endif>Rating</option>
                                    </select>
                                </div>

                                <div class="form-group" id="weightDiv">
                                    <label for="weight">Weight</label>
                                    <input type="text" name="weight" class="form-control" value="{{ @$interview_note_option->weight }}" id="weight" required>
                                </div>
                            </div>


                            <div class="panel-footer text-right">
                                <button class="btn btn-primary" @if($user_role->name != 'admin') disabled @endif>Save option</button>
                            </div>
                        </div>

                    </form>




                </div>


            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote();

            if($('#type').val() == "text"){
              $('#weight').val('');
              document.getElementById('weightDiv').style.display = 'none';
              document.getElementById('weight').removeAttribute("required");
            }


        });

        function hideWeight(e) {
          if(e.value == 'rating'){
            document.getElementById('weightDiv').style.display = 'block';
            document.getElementById('weight').setAttribute("required", "");
          }else{
            $('#weight').val('');
            document.getElementById('weightDiv').style.display = 'none';
            document.getElementById('weight').removeAttribute("required");
          }
        }
    </script>


@endsection
