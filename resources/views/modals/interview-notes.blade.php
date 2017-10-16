{!! @$applicant_badge !!}              
<style type="text/css">
  .br-theme-bars-movie .br-widget .br-current-rating{ width: 100% !important; }
  .form-group {
    margin-bottom: 30px;
}
</style>
<form role="form" class="form-signin" method="POST" id="interview-note-form" action="" style="height: 300px;overflow: scroll;">
    {!! csrf_field() !!}
    
    <div class="row">
        <div class="col-sm-12">  

        <div class="form-group">
                  <div class="col-sm-5">
                    <label for="" style="font-size: 17px;color: #18598a;">Parameter</label>
                  </div>

                  <div class="col-sm-2 text-center">
                    <label for="" style="font-size: 17px;color: #18598a;">Weight</label>
                    
                  </div>
                  
                  <div class="col-sm-5">
                    <label for="" style="font-size: 17px;color: #18598a;">Score</label>
                  </div>
                  
              <div class="clearfix"></div>
              </div>

          @foreach( @$interview_note_options as $option )

            @if( $option->type == "rating" )
              <div class="form-group">
                  <div class="col-sm-5">
                    <label for="" style="font-size: 17px;">{{ $option->name }} <span class="text-danger">*</span></label>
                    <p>
                      {!! $option->description !!}
                    </p>
                  </div>

                  <div class="col-sm-2">
                    <p class="text-center">
                    {{ $option->weight }}
                    </p>
                  </div>
                  
                  <div class="col-sm-5">
                    <select id="rating" name="option_{{ $option->id }}" id="option_{{ $option->id }}" required>
                      <option value></option>
                      <option value="1" @if( @$interview_note[$option->id] == 1) selected="selected" @endif>Very Poor</option>
                      <option value="2" @if( @$interview_note[$option->id] == 2) selected="selected" @endif>Poor</option>
                      <option value="3" @if( @$interview_note[$option->id] == 3) selected="selected" @endif>Fair</option>
                      <option value="4" @if( @$interview_note[$option->id] == 4) selected="selected" @endif>Good</option>
                      <option value="5" @if( @$interview_note[$option->id] == 5) selected="selected" @endif>Very Good</option>
                    </select>
                    <!-- <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_appearance" id="general_appearance" value="1" > 1 </label>
                    <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_appearance" id="general_appearance" value="2" > 2 </label>
                    <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_appearance" id="general_appearance" value="3" > 3 </label>
                    <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_appearance" id="general_appearance" value="4" > 4 </label>
                    <label class="" style="padding: 0px 10px;  font-size: 17px;"><input type="radio" class="form-control" style="height:auto;" name="general_appearance" id="general_appearance" value="5" > 5 </label> -->
                  </div>
                  
              <div class="clearfix"></div>
              </div>
            @endif

          @endforeach


             
            <div class="form-group">
                <hr>
                

            </div>

            @foreach( @$interview_note_options as $option )

            @if( $option->type == "text" )
              <div class="form-group">
                  <div class="col-sm-12">
                    <div style="font-size:18px; font-weight:bold;">
                    {!! $option->header !!}
                    </div>
                    
                    <label for="" style="font-size: 17px;">{!! $option->name !!} <span class="text-danger">*</span></label>
                    <p>
                    {!! $option->description !!}
                    </p>
                  </div>

                  
                  <div class="col-sm-12">
                    <textarea  class="form-control"  name="option_{{ $option->id }}" id="option_{{ $option->id }}" @if($readonly) "disabled" = "disabled" readonly @endif>{{ @$interview_note[$option->id] }}</textarea>
                  </div>
                  
              <div class="clearfix"></div>
              </div>
            @endif

          @endforeach
            
            
            
             
           
        </div>

  

    </div>

    <div class="row"><br>
        
        @if( $readonly )

        @else
          <div class="col-sm-10 col-sm-offset-1 col-md-12 col-sm-offset-0">
              <button type="submit" class="btn btn-success btn-block">Save </button>
          </div>
        @endif

        

    </div>
</form>

<div class="clearfix"></div>

<script src="{{ asset('js/jquery.barrating.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/rating-themes/bars-movie.css') }}">

@if( @$interview_note )
  <script type="text/javascript">
   $(function() {
      $('body #rating').barrating({
        theme: 'bars-movie',
        readonly:true
      });
   });
</script>
@else
  <script type="text/javascript">
   $(function() {
      $('body #rating').barrating({
        theme: 'bars-movie'
      });
   });
</script>
@endif

<script type="text/javascript">
 $(document).ready(function(){
  
  $.fn.serializeObject = function()
  {
      var o = {};
      var a = this.serializeArray();
      $.each(a, function() {
          if (o[this.name] !== undefined) {
              if (!o[this.name].push) {
                  o[this.name] = [o[this.name]];
              }
              o[this.name].push(this.value || '');
          } else {
              o[this.name] = this.value || '';
          }
      });
      return o;
  };

  $('body #interview-note-form').on('submit',function(e){
       e.preventDefault();
      // var data = {
      //        job_id: '{{ $appl->job->id }}',
      //        cv_id :  "{{ $cv_id }}",
      //        location:  $('#interview-location').val(),
      //        date:  $('#interview-time').val(),
      //        message:  $('#interview-message').val()
      //      };
          $field = $(this);
          radios = JSON.stringify($('body  #interview-note-form select').serializeObject());
          texts = JSON.stringify($('body  #interview-note-form textarea').serializeObject());
          app_id = {{ $app_id }};
          interviewer_id ={{ Auth::user()->id }};
      $.post("{{ route('save-interview-note') }}", { radios : radios, texts : texts, app_id:app_id,interviewer_id:interviewer_id } ,function(data){

          $( '#viewModal' ).modal('toggle');
          $.growl.notice({ message: "You have interviewed " + $field.closest('.modal-body').find('.media-heading a').text() });
              sh.reloadStatus();
          });
        // console.log( JSON.stringify($(this).serializeObject()) );
    });
 });
 </script>
       


  