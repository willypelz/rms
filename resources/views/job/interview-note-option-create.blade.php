@extends('layout.template-default')


@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

    @include('job.includes.interview-head')
    <section class="">
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2">
                    <a href="{{ route('interview-note-options', ['interview_template_id' => $interview_template_id]) }}" class=""><i class="fa fa-chevron-left"></i> Back</a>
                    @include('layout.alerts')
                </div>

                <div class="col-sm-8 col-sm-offset-2"><br>

                    <form action="{{ route('interview-note-option-create', ['interview_template_id' => $interview_template_id]) }}" method="POST">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="no-margin">Add option to <b>{{ $interview_template->name }}</b></h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="summernote" class="form-control" required>

                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select name="type" class="form-control" onchange="hideWeight(this)" required>
                                        <option value="">--select one--</option>
                                        <option value="text" >Text</option>
                                        <option value="rating" >Rating</option>
                                    </select>
                                </div>

                                <div class="form-group" id="weightDiv" style="display:none">
                                    <label for="weight">Weight</label>
                                    <input type="number" name="weight" class="form-control" id="weight" required>
                                </div>
                            </div>


                            <div class="panel-footer text-right">
                                <button class="btn btn-primary">Save option</button>
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
            // console.log("plppp");
        });
    </script>

    <script>
    function hideWeight(e) {
      if(e.value == 'rating'){
        document.getElementById('weightDiv').style.display = 'block';
        document.getElementById('weight').setAttribute("required", "");
      }else{
        document.getElementById('weightDiv').style.display = 'none';
        document.getElementById('weight').removeAttribute("required");
      }
    }
    </script>


@endsection
