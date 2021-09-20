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

                    <form onsubmit="validate(event)" id="note_option_form" action="{{ route('interview-note-option-create', ['interview_template_id' => $interview_template_id]) }}" method="POST">
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
                                        <option value="checkbox" >Checkbox</option>
                                        <option value="dropdown" >Dropdown</option>
                                    </select>
                                </div>

                                <div class="form-group row" id="weightDiv" style="display:none">
                                    <div class="col-xs-12">
                                        <label for="weight">Weight</label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="number" min="0" placeholder="1" name="weight[0]" class="form-control" id="weight_min" required>
                                    </div>
                                    <div class="col-xs-2 text-center">
                                        <label for="weight">To</label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="number" min="1" placeholder="100" name="weight[1]" class="form-control " id="weight_max" required>
                                    </div>
                                </div>
                                <div class="form-group row" id="checkDiv" style="display:none">
                                    <div class="col-xs-12">
                                        <label for="check">Checkbox</label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="text"  placeholder="input required values" name="check" class="form-control " id="check" required>
                                        <small><span style="color:red">seperate each checkbox values with commas.</span></small>
                                    </div>
                                </div>
                                <div class="form-group row" id="dropdownDiv" style="display:none">
                                    <div class="col-xs-12">
                                        <label for="drop">Dropdown</label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="text"  placeholder="input required dropdown values" name="drop" class="form-control " id="drop" required>
                                        <small><span style="color:red">seperate each dropdown values with commas.</span></small>
                                    </div>
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
        });

        const validate = (e)=>{
            if ( parseInt(document.getElementById("weight_min").value) > parseInt(document.getElementById("weight_max").value)) {
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
    </script>

    <script>
    function hideWeight(e) {
      if(e.value == 'rating'){
        document.getElementById('checkDiv').style.display = 'none';
        document.getElementById('weightDiv').style.display = 'block';
        document.getElementById('weight_min').setAttribute("required", "");
        document.getElementById('weight_max').setAttribute("required", "");
      }else if(e.value =='checkbox'){
        document.getElementById('weightDiv').style.display = 'none';
        document.getElementById('checkDiv').style.display = 'block';
        document.getElementById('check').setAttribute("required", "");
        document.getElementById('drop') ? document.getElementById('drop').removeAttribute("required", "") : false;
        document.getElementById('weight_min') ? document.getElementById('weight_min').removeAttribute("required") : false;
        document.getElementById('weight_max') ? document.getElementById('weight_max').removeAttribute("required") : false;
      }else if(e.value =='dropdown'){
        document.getElementById('dropdownDiv').style.display = 'block';
        document.getElementById('weightDiv').style.display = 'none';
        document.getElementById('checkDiv').style.display = 'none';
        document.getElementById('drop').setAttribute("required", "");
        document.getElementById('check') ? document.getElementById('check').removeAttribute("required", "") : false;
        document.getElementById('weight_min') ? document.getElementById('weight_min').removeAttribute("required") : false;
        document.getElementById('weight_max') ? document.getElementById('weight_max').removeAttribute("required") : false;
      }else{
        document.getElementById('weightDiv').style.display = 'none';
        document.getElementById('checkDiv').style.display = 'none';
        document.getElementById('dropdownDiv').style.display = 'none';
        document.getElementById('weight_min') ? document.getElementById('weight_min').removeAttribute("required") : false;
        document.getElementById('weight_max') ? document.getElementById('weight_max').removeAttribute("required") : false;
        document.getElementById('check') ? document.getElementById('check').removeAttribute("required") : false;
        document.getElementById('drop') ? document.getElementById('drop').removeAttribute("required", "") : false;
      }
    }
    </script>


@endsection
