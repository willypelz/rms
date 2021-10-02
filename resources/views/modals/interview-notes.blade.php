{!! @$applicant_badge !!}              
<style type="text/css">
  .br-theme-bars-movie .br-widget .br-current-rating{ width: 100% !important; }
  .form-group {
    margin-bottom: 30px;
}
</style>
<form role="form" class="form-signin" method="POST" id="interview-note-form" action="" style="height: 300px;overflow: scroll;">
    {!! csrf_field() !!}
    
    <input type="hidden" name="id" id="id" value="{{ $interview_template_id }}">
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
                    <p class="text-center" style="font-size: 17px;font-weight:500">
                    {{ $option->weight_min }} to {{ $option->weight_max }} 
                    </p>
                  </div>
                  
                  <div class="col-sm-5">
                    <div class="row">
                      <div class="col-sm-8">
                        <input type="number" min="{{$option->weight_min}}" max="{{$option->weight_max}}" name="option_{{ $option->id }}" id="option_{{ $option->id }}" class="form-control weight" required>
                      </div>
                    </div>
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

          @foreach( @$interview_note_options as $option )

            @if( $option->type == "checkbox" )
              <div class="form-group">
                  <div class="col-sm-7">
                    <div style="font-size:18px; font-weight:bold;">
                    {!! $option->header !!}
                    </div>
                    
                    <label for="" style="font-size: 17px;">{!! $option->name !!} <span class="text-danger">*</span></label>
                    <p>
                    {!! $option->description !!}
                    </p>
                  </div>

                  
                  <div class="col-sm-5">
                  @php $options = json_decode($option->check_box, true) @endphp
                  @foreach($options as $key => $check)
                    <div class="form-check form-check-inline">
                      <input class="form-check-input checks" type="checkbox" id="check_{{ $check.$key }}" name="option_check_{{ $option->id }}" value="{{ $check }}">
                      <label class="form-check-label" for="check_{{ $check.$key }}">{{ $check}}</label>
                    </div>
                  @endforeach

                  </div>
                  
              <div class="clearfix"></div>
              </div>
            @endif

          @endforeach

          @foreach( @$interview_note_options as $option )

            @if( $option->type == "dropdown" )
              <div class="form-group">
                  <div class="col-sm-7">
                    <div style="font-size:18px; font-weight:bold;">
                    {!! $option->header !!}
                    </div>
                    
                    <label for="" style="font-size: 17px;">{!! $option->name !!} <span class="text-danger">*</span></label>
                    <p>
                    {!! $option->description !!}
                    </p>
                  </div>

                  
                  <div class="col-sm-5">
                    <label for="option_{{ $option->id }}">Options</label>
                    <select name="option_{{ $option->id }}" class="form-control drop" id="option_{{ $option->id }}" required>
                        <option value="none">--select one--</option>
                        @php $options = json_decode($option->dropdown, true) @endphp
                        @foreach($options as $key => $drop)
                        <option value="{{$drop}}">{{$drop}}</option>
                        @endforeach
                    </select>
                    <span style="display:none" id="error">
                         <small style="color:red">select an option<small>
                    </span>
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
          radios = JSON.stringify($('body .weight').serializeObject());
          texts = JSON.stringify($('body  #interview-note-form textarea').serializeObject());
          checks = JSON.stringify($('body .checks').serializeObject());
          drop = JSON.stringify($('body .drop').serializeObject());
          app_id = {{ $app_id }};
          interview_template_id = {{ $interview_template_id }};
          interviewer_id ={{ Auth::user()->id }};
          
      $.post("{{ route('save-interview-note') }}", { radios : radios, checks: checks, texts : texts, drop: drop,app_id:app_id,interviewer_id:interviewer_id, id : interview_template_id } ,function(data){

          $( '#viewModal' ).modal('toggle');
          $.growl.notice({ message: "You have interviewed " + $field.closest('.modal-body').find('.media-heading a').text() });
              sh.reloadStatus();
          });
        // console.log( JSON.stringify($(this).serializeObject()) );
    });
 });
 </script>
       


  