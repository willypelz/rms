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
                                    <select name="type" class="form-control" onchange="hideWeight(this.value)" id="type" required>
                                        <option value="">--select one--</option>
                                        <option value="text" @if( $interview_note_option->type == 'text' ) selected="selected" @endif >Text</option>
                                        <option value="rating" @if( $interview_note_option->type == 'rating' ) selected="selected" @endif>Rating</option>
                                        <option value="checkbox" @if( $interview_note_option->type == 'checkbox' ) selected="selected" @endif>Checkbox</option>
                                        <option value="dropdown" @if( $interview_note_option->type == 'dropdown' ) selected="selected" @endif>Dropdown</option>
                                    </select>
                                </div>

                                <div class="form-group row" id="weightDiv" style="display:none">
                                    <div class="col-xs-12">
                                        <label for="weight">Weight Range</label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="number" placeholder="1" name="weight[0]" value="{{ @$interview_note_option->weight_min }}" class="form-control" id="weight_min" >
                                    </div>
                                    <div class="col-xs-2 text-center">
                                        <label for="weight">To</label>
                                    </div>
                                    <div class="col-xs-5">
                                        <input type="number" placeholder="100" name="weight[1]" value="{{ @$interview_note_option->weight_max }}" class="form-control " id="weight_max">
                                    </div>
                                </div>
                                <div class="form-group row" id="checkDiv" style="display:none">
                                    <div class="col-xs-12">
                                        <label for="check">Options </label> 
                                    </div>
                                    <div class="col-xs-6" id="new_chq"> 
                                        <div  class="form-inline" style="margin-bottom:10px">
                                        <a href="javascript:void(0)" class="add btn"><i class="fa fa-plus"></i></a>
                                        <a href="javascript:void(0)" class="remove btn"><i class="fa fa-trash"></i></a>
                                        </div>
                                        @if($interview_note_option->check_box)
                                        @php $check = json_decode($interview_note_option->check_box, true) @endphp
                                        @foreach($check as $key => $data)
                                        <input type="text" @if($key > 0) style="margin-top:10px" @endif class="form-control check" value="{{ $data }}" name="check[{{$key}}]" required>
                                        @endforeach
                                        @else
                                        <input type="text" class="form-control check" name="check[0]" required>
                                        @endif
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
                                        <a href="javascript:void(0)" class="remove btn"><i class="fa fa-trash"></i></a>
                                        </div>
                                        @if($interview_note_option->dropdown)
                                        @php $check = json_decode($interview_note_option->dropdown, true) @endphp
                                        @foreach($check as $key => $data)
                                        <input type="text" @if($key > 0) style="margin-top:10px" @endif class="form-control drop" value="{{ $data }}" name="drop[{{$key}}]" required>
                                        @endforeach
                                        @else
                                        <input type="text" class="form-control drop" id="drop" name="drop[0]" required>
                                        @endif
                                        <input type="hidden" value="1" id="total_drop">
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

            hideWeight($('#type').val());

            const validate = (e)=>{
                if (  parseInt(document.getElementById("weight_min").value) > parseInt(document.getElementById("weight_max").value) ) {
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

        function setAttributes(el, attrs) {
            for(var key in attrs) {
                el.setAttribute(key, attrs[key]);
            }
        }

        function removeAttributes(el, attrs) {
            for(var key in attrs) {
                el.removeAttribute(key, attrs[key]);
            }
        }
        
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
            setAttributes(weightMax,{"required":"","min":1,});
            setAttributes(weightMin,{"required": "", "min":0});
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
            weightMin ? removeAttributes(weightMin,{"required":"","min":0}):false;
            weightMax ? removeAttributes(weightMax,{"required":"","min":1}):false;

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
            weightMin ? removeAttributes(weightMin,{"required":"","min":0}):false;
            weightMax ? removeAttributes(weightMax,{"required":"","min":1}):false;
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
            weightMin ? removeAttributes(weightMin,{"required":"","min":0}):false;
            weightMax ? removeAttributes(weightMax,{"required":"","min":1}):false; 
          }
        
        }

        $('.add').on('click', add);
        $('.remove').on('click', remove);

        function add() {
            if($('#type').val() == 'checkbox'){
                var new_chq_no = parseInt($('#total_chq').val()) + 1;
                tchecks = $('.check').length;
                var new_input = "<input type='text' style='margin-top:10px' class='form-control check' id='new_" + new_chq_no + "' name='check["+ tchecks + "]'>";
                $('#new_chq').append(new_input);
                $('#total_chq').val(new_chq_no);

            }else if($('#type').val() == 'dropdown'){
                var new_chq_no = parseInt($('#total_drop').val()) + 1;
                tdrops = $('.drop').length;
                var new_input = "<input type='text' style='margin-top:10px' class='form-control drop' id='new_" + new_chq_no + "' name='drop["+ tdrops + "]'>";
                $('#new_drop').append(new_input);
                $('#total_drop').val(new_chq_no);
            }
            
        }

        function remove() {
            if($('#type').val() == 'checkbox'){
                var last_chq_no = $('#total_chq').val();
                if (last_chq_no > 1) {
                    $('#new_' + last_chq_no).remove();
                    $('#total_chq').val(last_chq_no - 1);
                }
            }

            if($('#type').val() == 'dropdown'){
                var last_chq_no = $('#total_drop').val();
                if (last_chq_no > 1) {
                    $('#new_' + last_chq_no).remove();
                    $('#total_drop').val(last_chq_no - 1);
                }
            }
            
        }

    </script>


@endsection
