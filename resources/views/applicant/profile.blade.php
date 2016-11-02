@extends('layout.template-user')

@section('content')

    <style type="text/css">
        #cv-content .container{ width: 100% !important; }
        #cv-content .view, #cv-content .row{ width: 100% !important; padding: 0 !important; margin: 0px !important; }
        .close{ display: none; }
    </style>

    @include('applicant.includes.job-title-bar')

    <section class="no-pad applicant">

      <div class="container">
        
        @include('applicant.includes.pagination')
        
        <div class="row">
            <div class="col-xs-4">
                
              @include('applicant.includes.badge')  

            </div>


                <div class="col-xs-8">
                    
                    @include('applicant.includes.nav')

                     



                    <div class="tab-content" id="cv-content">

                    {!! preloader() !!}
                        

                    </div>
                    <!--/tab-content-->

                </div>

            </div>

        @include('applicant.includes.pagination')

        </div>
    </section>

<div class="separator separator-small"></div>


<script type="text/javascript">
   $(document).ready(function(){
        $.ajax
              ({
                  type: "POST",
                  url: "{{ route('cv-preview') }}",
                  data: ({ rnd : Math.random() * 100000, cv_id:{{ $appl->cv->id }}, is_applicant:true, is_embedded:true, appl_id:{{ $appl->id }} }),
                  success: function(response){
                    $("#cv-content").html(response);
                       
                  }
              });
   });     
</script>

@endsection