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
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name')}}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="summernote" class="form-control" required>
                                        {{ old('description')}}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="type">Type <span class="text-danger">*</span></label>
                                    <select id="type" name="type" class="form-control" onchange="hideWeight(this.value)" required>
                                        <option value="">--select one--</option>
                                        <option  {{ old('type') == "text" ? 'selected': '' }} value="text" >Text</option>
                                        <option  {{ old('type') == "rating" ? 'selected':'' }} value="rating" >Rating</option>
                                        <option  {{ old('type') == "checkbox" ? 'selected':'' }} value="checkbox" >Checkbox</option>
                                        <option  {{ old('type') == "dropdown" ? 'selected':'' }} value="dropdown" >Dropdown</option>
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
                                        <label for="check">Options </label> 
                                    </div>
                                    <div class="col-xs-6" id="new_chq"> 
                                        <div  class="form-inline" style="margin-bottom:10px">
                                        <a href="javascript:void(0)" class="add btn"><i class="fa fa-plus"></i></a>
                                        <a href="javascript:void(0)" class="remove btn" id="add-btn-check" style="display:none"><i class="fa fa-trash"></i></a>
                                        </div>
                                        <input type="text" class="form-control check" name="check[0]" required>
                                        <input type="hidden" value="1" id="total_chq">
                                    </div>
                                </div>
                                <div class="form-group row" id="dropdownDiv" style="display:none">
                                    <div class="col-xs-12">
                                        <label for="drop">Options</label>
                                    </div>
                                    <div class="col-xs-6" id="new_drop"> 
                                        <div  class="form-inline" style="margin-bottom:10px">
                                        <a href="javascript:void(0)" class="add btn"><i class="fa fa-plus"></i></a>
                                        <a href="javascript:void(0)" class="remove btn" id="add-btn" style="display:none"><i class="fa fa-trash"></i></a>
                                        </div>
                                        <input type="text" class="form-control drop" name="drop[0]" required>
                                        <input type="hidden" value="1" id="total_drop">
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

            hideWeight($('#type').val());
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
        $('.add').on('click', add);
        $('.remove').on('click', remove);
        var btn = document.getElementById('add-btn');
        var btnCheck = document.getElementById('add-btn-check');

        function add() {
            if($('#type').val() == 'checkbox'){
                var new_chq_no = parseInt($('#total_chq').val()) + 1;
                tchecks = $('.check').length;
                var new_input = "<input type='text' style='margin-top:10px' class='form-control check' id='new_" + new_chq_no + "' name='check["+ tchecks + "]' required>";
                $('#new_chq').append(new_input);
                $('#total_chq').val(new_chq_no);
                btnCheck.style = 'block';

            }else if($('#type').val() == 'dropdown'){
                var new_chq_no = parseInt($('#total_drop').val()) + 1;
                tdrops = $('.drop').length;
                console.log(tdrops);
                var new_input = "<input type='text' style='margin-top:10px' class='form-control drop' id='new_" + new_chq_no + "' name='drop["+ tdrops + "]' required>";
                $('#new_drop').append(new_input);
                $('#total_drop').val(new_chq_no);
                btn.style = 'block';
            }
            
        }

        function remove() {
            if($('#type').val() == 'checkbox'){
                var last_chq_no = $('#total_chq').val();
                if (last_chq_no > 1) {
                    $('#new_' + last_chq_no).remove();
                    $('#total_chq').val(last_chq_no - 1);

                    if(last_chq_no == 2){
                        btnCheck.style.display = "none";
                    }
                }
            }

            if($('#type').val() == 'dropdown'){
                var last_chq_no = $('#total_drop').val();
                if (last_chq_no > 1) {
                    $('#new_' + last_chq_no).remove();
                    $('#total_drop').val(last_chq_no - 1);
                    
                    if(last_chq_no == 2){
                        btn.style.display = "none";
                    }
                }
                
                
            }
            
        }
        
    </script>

    <script>
        var  weightDiv = document.getElementById('weightDiv');
        var  checkDiv = document.getElementById('checkDiv');
        var  dropdownDiv = document.getElementById('dropdownDiv');
        var  weightMax = document.getElementById('weight_max');
        var  weightMin = document.getElementById('weight_min');
        var  check =  document.getElementsByClassName('check');
        var  drop =  document.getElementsByClassName('drop');
        var i ;

        function hideWeight(value) {
            if(value == 'rating'){
                weightDiv.style.display = 'block';
                checkDiv.style.display = 'none';
                dropdownDiv.style.display = 'none';
                for(i = 0; i < check.length; ++i){
                    check ? check[i].removeAttribute("required"):false;
                };
                for(i = 0; i < drop.length; ++i){
                    drop ? drop[i].removeAttribute("required"):false;
                };
                weightMin.setAttribute("required", "");
                weightMax.setAttribute("required", "");
            }else if(value == 'checkbox'){
                checkDiv.style.display = 'block';
                weightDiv.style.display = 'none';
                dropdownDiv.style.display = 'none';
                for(i = 0; i < check.length; ++i){
                    check[i].setAttribute("required", "");
                }
                for(i = 0; i < drop.length; ++i){
                    drop ? drop[i].removeAttribute("required"):false;
                }
                weightMin ? weightMin.removeAttribute("required"):false;
                weightMax ? weightMax.removeAttribute("required"):false;
            }else if(value == 'dropdown'){
                dropdownDiv.style.display = 'block';
                weightDiv.style.display = 'none';
                checkDiv.style.display = 'none';
                for(i = 0; i < drop.length; ++i){
                    drop[i].setAttribute("required", "");
                }
                for(i = 0; i < check.length; ++i){
                    check ? check[i].removeAttribute("required"):false;
                }
                weightMin ? weightMin.removeAttribute("required") : false;
                weightMax ? weightMax.removeAttribute("required") : false;
            }else{
                weightDiv.style.display = 'none';
                checkDiv.style.display = 'none';
                dropdownDiv.style.display = 'none';
                for(i = 0; i < check.length; ++i){
                    check ? check[i].removeAttribute("required"):false;
                }
                for(i = 0; i < drop.length; ++i){
                    drop ? drop[i].removeAttribute("required"):false;
                }
                weightMin ? weightMin.removeAttribute("required") : false;
                weightMax ? weightMax.removeAttribute("required") : false; 
            }
        }
    </script>


@endsection
