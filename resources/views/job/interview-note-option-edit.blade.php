@extends('layout.template-default')


@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

    @include('job.includes.interview-head')
    @php
        $user_role = getCurrentLoggedInUserRole();
        $is_super_admin = auth()->user()->is_super_admin;
    @endphp
    <section class="">
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2">
                    <a href="{{ route('interview-note-options', ['interview_template_id' => $interview_template_id]) }}" class=""><i class="fa fa-chevron-left"></i> Back to options</a>

                    @include('layout.alerts')
                </div>

                <div class="col-sm-8 col-sm-offset-2"><br>

                    <form onsubmit="validate(event)" action="{{ route('interview-note-option-edit', ['interview_template_id' => $interview_template_id,'id' => $interview_note_option->id ]) }}" method="POST">
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

                                <div class="form-group row" id="weightDiv">
                                    <div class="col-xs-12">
                                        <label for="weight">Weight</label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="number" min="0" placeholder="1" name="weight[0]" value="{{ @$interview_note_option->weight_min }}" class="form-control" id="weight_min" required>
                                    </div>
                                    <div class="col-xs-2 text-center">
                                        <label for="weight">To</label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="number" min="1" placeholder="100" name="weight[1]" value="{{ @$interview_note_option->weight_max }}" class="form-control " id="weight_max" required>
                                    </div>
                                </div>
                            </div>


                            <div class="panel-footer text-right">
                                <button class="btn btn-primary" @if((isset($user_role) && !is_null($user_role) && !in_array($user_role->name, ['admin'])) || !$is_super_admin) disabled @endif>Save option</button>
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

            const validate = (e)=>{
                if ( document.getElementById("weight_min").value > document.getElementById("weight_max").value ) {
                    e.preventDefault();
                    alertBox("error", "weight min must be less than weight max")
                    return false;
                }  
            }   

            const alertBox = (status, msg)=>{
                $("#"+status).text(msg)
                $("#"+status).show()
                setTimeout(function(){$("#error").hide();}, 10000);
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
