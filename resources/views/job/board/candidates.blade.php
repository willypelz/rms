@extends('layout.template-user')

@section('content')

                    @include('job.board.jobBoard-header')
            
   {{-- dd($result) --}}
   <style type="text/css">
  .see-more{display: none;}
  .see-more-shown{ display: block; }
  .pagination .page{ padding: 0px !important; }
</style>
            @if($job['status'] != 'DELETED')
            <script src="http://malsup.github.com/jquery.form.js"></script> 
<script src="{{ asset('js/jquery.twbsPagination.min.js') }}"></script>
<script src="{{ asset('js/jquery.jscroll.min.js') }}"></script>
            
            <div class="row">

                <div class="col-sm-12">
                    <div class="page no-bod-rad" id="job-dash-content">
                        <div class="row">


                            @include('job.board.job-board-tabs')
                        <div class="tab-content">

                        <div class="row">                           
                        <!-- applicant -->
                            <div class="col-xs-8 ">
                            <div class="row">
                                <div class="col-xs-12">
                                    

                                    @include('job.board.includes.applicant-status')

                                    <br>
                                

                                    <small class="text-muted result-label" id="showing"></small>

                                   <div class="">
                                        <label class="select-all pull-right">Select All
                                           <input type="checkbox">
                                       </label>
                                   </div>
                               
                                </div>

                                <div id="h_act-on" class="col-xs-12 app-action" style="display:none;">
                                    <div>
                                        <div class="btn-group select-action" id="mass-action">
                                            <a class="btn btn-default status-1" data-action="SHORTLISTED" data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Shortlist?" data-view="{{ route('modal-shortlist') }}" data-app-id="" data-cv="" data-type="normal">Shortlist All</a>
                                            <a class="btn btn-default status-1" type="button" data-action="ASSESSED"  data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Test" data-view="{{ route('modal-assess') }}" data-app-id="" data-cv="" data-type="wide">Test All</a>
                                            <a class="btn btn-default status-1" type="button" data-action="INTERVIEWED"  data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Schedule an interview for" data-view="{{ route('modal-interview') }}" data-app-id="" data-cv="" data-type="normal">Interview All</a>
                                            <a class="btn btn-default status-1" type="button" data-action="HIRED"  data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Hire" data-view="{{ route('modal-hire') }}" data-app-id="" data-cv="" data-type="normal">Hire All</a>
                                            <a class="btn btn-default status-1" type="button" data-action="REJECTED"  data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Reject?" data-view="{{ route('modal-reject') }}" data-app-id="" data-cv="" data-type="normal">Reject All</a>
                                            <a class="btn btn-default status-1" type="button" data-action="PENDING" data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Do you want to return to all?" data-view="{{ route('modal-return-to-all') }}" data-app-id="" data-cv="" data-type="normal" style="display:none;" >Return All</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            
                            <div class="search-results scroll">

                              @include('job.board.includes.applicant-results-item')
                              
                              <!--a href="{{ route('job-candidates-infinite', [$jobID, $start ]) }}" class="nextPageLoad">load next page</a-->
                            </div>

                            <br style="clear:both" />
                            <small class="text-muted result-label" id="showing"></small>
                            <br style="clear:both" />

                            <ul id="pagination" class="pagination-sm"></ul>

                            

                            <!--a class="btn btn-line btn-block load" href="">
                                <span class="glyphicon glyphicon-repeat"></span>&nbsp; Load more</a-->
                        </div>

                        <!-- Filter -->

                        <div class="col-sm-4">
                            <div class="well well-cart animated slideInUp collapse fixer" id="collapseWellCart">
                                <div class="row">
                                    <div class="col-md-3 hidden-xs hidden-sm small text-light text-muted">Cart<br>
                                          <i class="fa fa-shopping-cart fa-3x"></i>
                                        
                                    </div>
                                    <div class="col-md-4 col-xs-3 col-sm-3 small text-left text-muted text-light"> Items<br>
                                        <span id="item-count">
                                                <span style="display: inline-block;" class="bounceInDown fa-2x">0</span>
                                        </span>
                                    </div>
                                    <div class="col-md-5 col-xs-9 col-sm-9 small text-right text-muted text-light"> Cost<br>
                                        <span class="pull-right fa-2x">
                                            ₦ 
                                            <span id="price-total">0</span> 
                                        </span>
                                    </div>
                                </div><hr>
                                <div class="row">
                                    <div class="col-xs-6"><a class="btn btn-block btn-danger btn-sm btn-cart-checkout" data-target="#myInvoice" data-toggle="modal" target="_blank" href="#"> Checkout »</a></div>
                                    <div class="col-xs-6"><button class="btn btn-block btn-line btn-sm btn-cart-clear text-muted"><i class="fa fa-close"></i> Clear</button></div>
                                </div>
                            </div>
                          <div id="search-filters">
                                @include('cv-sales.includes.search-filters')
                            </div>

                            </div> <!--/col-sm-3-->
                        </div>
                    
                        </div>
                        </div>

                    </div>
                    <!--/tab-content-->

                </div>
            </div>
            @else
              @include('job.board.includes.job-deleted')
            @endif
        </div>
    </section>

<div class="separator separator-small"><br></div>

<script type="text/javascript">
    var folders = [];
    var filters = [];
    var status_filter = "";
    var total_candidates = "{{ $result['response']['numFound'] }}";
    var keyword = "";
    var age_range = exp_years_range = null;
    var last_text_filter = "";

    String.prototype.capitalize = function() {
        return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
    }

    function searchKeyword(){

            var filter = 'text' + ':"' + $(search_keyword).val() + '"';
            var key = $(search_keyword).val();

            var index = $.inArray( last_text_filter, filters );
            // console.log( filter + "---" + index );
            if( index == -1 )
            {
              //Does not exist before, skip
            }
            else
            {
                filters.splice(index, 1);
            }

            last_text_filter = filter;

            filters.push( filter );

            $('.search-results').html('{!! preloader() !!}');
            scrollTo('.job-progress-xs');
            $('.result-label').html('');
            $('#pagination').hide();
            $.get("{{ route('job-candidates', $jobID) }}", {search_query: $('#search_query').val(), filter_query : filters },function(data){
                //console.log(response);
                // var response = JSON.parse(data);
                // console.log(data.search_results);
                $('.search-results').html(data.search_results);
                $('#search-filters').html(data.search_filters);
                $('.result-label').html(data.showing);
                $('#pagination').show();
                $('#search_keyword').val(key);

                $.each(filters, function(index,value){
                    
                    var arr = value.split(':');
                    
                    $('.filter-div input[type=checkbox]' + '[data-field=' + arr[0] + ']' + '[data-value=' + arr[1] + ']' ).attr('checked',true);
                });
            });

            return false;
        }


    $('body').on('keydown', '#search_keyword',function(){
            if(event.which == 13) 
            {
                searchKeyword();

            }
        });

        
    $(document).ready(function(){
        
        // $('.infinite-scroll').jscroll({
        //     loadingHtml: 'Loading...',
        //     padding: 20,
        //     nextSelector: 'a.jscroll-next:last',
        //     contentSelector: 'li'
        // });
        
        // $(".scroll").jscroll({ 
        //     nextSelector: ".nextPageLoad",
        //     callback: function(){
        //         console.log("shit");
        //     }
        // });

        $.fn.setMyFolders = function(cv_folders)
        {
          var html = "" ;
          $.each(folders,function(index,value){

              if(cv_folders.indexOf( value.id.toString() ) >= 0)
              {
                active = ' &nbsp; <i class="fa fa-check"></i> ';
              }
              else
              {
                active = "";
              }
              html += '<li id="folder-item" data-ref="' + value.id + '" ><a href="#"><i class="fa fa-folder-o"></i> ' + value.name + active + '</a></li>';
          });
          return html;
        }

        $.fn.getMyFolders = function()
        {
          $.post("{{ url('cv/get-my-folders') }}",function(data){
                // console.log(data);
                folders = data.folders;
                $('body #folder-item').remove();
                $('body #folders').each(function(index,value){
                    cv_folders = $(this).attr('data-folders').split(':');
                    $(this).prepend($(this).setMyFolders(cv_folders));
                })
          });
        }

        

        // $(document).getMyFolders();

        

        $(document).on('change', '.filter-div input[type=checkbox]', function(){
            // console.log("changed");

            var filter = $(this).attr('data-field') + ':"' + $(this).attr('data-value') + '"';

            var index = $.inArray( filter, filters );
            // console.log( filter + "---" + index );
            if( index == -1 )
            {
              filters.push( filter );
            }
            else
            {
                filters.splice(index, 1);
            }

            $(this).performFilter();
        });

        $.fn.performFilter = function(){    
            $('.search-results').html('{!! preloader() !!}');
            scrollTo('.job-progress-xs');
            $('.result-label').html('');
            $('#pagination').hide();
            $.get("{{ route('job-candidates', $jobID) }}", {search_query: $('#search_query').val(), filter_query : filters,age: age_range, exp_years : exp_years_range  },function(data){
                //console.log(response);
                // var response = JSON.parse(data);
                // console.log(data.search_results);
                $('.search-results').html(data.search_results);
                $('#search-filters').html(data.search_filters);
                $('.result-label').html(data.showing);
                $('#pagination').show();

                $.each(filters, function(index,value){
                    
                    var arr = value.split(':');
                    
                    $('.filter-div input[type=checkbox]' + '[data-field=' + arr[0] + ']' + '[data-value=' + arr[1] + ']' ).attr('checked',true);
                });
            });
        }



        $(document).on('click','.read-more-show', function(){
            // console.log($(this).text() );
            // $(this).prev().find('.see-more').show();
            $(this).closest('div').prev().find('.see-more').toggleClass('see-more-shown');

            var text = ( $(this).text() == 'See More' ) ? 'See Less' : 'See More';
            $(this).text(text);
        });

        // $(document).on('click', '#showCvBtn', function(){ 
        //   var this_one = $(this);
        //     $.post("{{ url('cv/get_cv_preview') }}",function(data){
        //        $( this_one.attr('data-target') ).html(data);
        //     });
        // });

        /*$('body').on('click', '#add_folder_btn',function(){
            var input = $(this).parent().parent().parent().find('#add_folder');
            input.show();
        });*/
        
        $('#newFolder').on('shown.bs.modal', function () {
            $('#add_folder').focus();
        })

        $('body').on('keydown', '#add_folder',function(){
            if(event.which == 13) 
            {
                $(this).createFolder();

            }
        });

        $('body #createFolderBtn').click(function(){
          $(this).createFolder();
        });

        $.fn.createFolder = function()
        {
              $field = $('body #add_folder');

              $field.attr('disabled','disabled');

              $('#newFolder #message').html('<div class”text-center”>Creating...</div>');

                $.post("{{ url('cv/add-folder') }}", {name: $field.val(),type: 'saved' },function(data){
                    if(data == true)
                    {
                      // $field.val("").hide();
                      $(this).getMyFolders();
                      $('#newFolder #message').html('<div class="alert alert-success">Folder added successfully</div>');
                      $('#newFolder').modal('toggle');
                      
                    }

                    else
                    {
                      $field.val("").hide();
                      // $field.after('<p>'+ data +'</p>');
                      $('#loginModal #mssg').text(data);
                      $('.signin').trigger('click');
                    }
                    
                });
        }

        $('body').on('click','#folder-item',function(){

            $field = $(this);
            
            $.post("{{ url('cv/save-to-folder') }}", {folder_id: $field.attr( 'data-ref' ),cv_id: $(this).closest('#folders').attr('data-cv') },function(data){
                    if(data == true)
                    {
                      $field.addClass( 'active' );

                       $field.closest('.description').append('<div id="notification"><div class="clearfix"></div><div class="alert alert-success">Added to folder successfully</div></div>');
                        window.setTimeout(function() {
                            $field.closest('.description').find('#notification').fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove(); 
                            });
                        }, 5000);
                    }
                    
                });

        });

        $('body').on('click', '#status_filters a', function(){

            status_filter = $(this).attr('data-value');

            $('#status_filters li').removeClass('active');
            $(this).closest('li').addClass('active');



            $(this).reloadResult();
            
        });

        

        $.fn.reloadResult = function(){
            if( status_filter == "ALL" )
            {
                status_filter = "";
                $('#mass-action a').show();
                $('#mass-action a[data-action="PENDING"').hide();
            }
            
            

            $('.search-results').html('{!! preloader() !!}');
            scrollTo('.job-progress-xs');
            $('.result-label').html('');
            $('#pagination').hide();
            $.get("{{ route('job-candidates', $jobID) }}", {search_query: $('#search_query').val(), filter_query : filters, status : status_filter },function(data){
                //console.log(response);
                // var response = JSON.parse(data);
                // console.log(data.search_results);
                $('.result-label').html(data.showing);
                $('#pagination').show();
                $('.search-results').html(data.search_results);
                $('#search-filters').html(data.search_filters);

                $(document).getShowing();

                $('#mass-action a').show();

                $('#mass-action a[data-action="' + status_filter + '"').hide();
                
            });
        }

        $.fn.getShowing = function(){
            count = $('.search-results .comment.media').length;
            status_page = "";
            if(status_filter == "")
            {
                status_page = 'All';
            }
            else
            {
                status_page = status_filter.capitalize();
            }
            // console.log( status_filter );
            $('.result-label').text( 'Showing 1 - ' + count + ' of ' + total_candidates + ' ' + status_page + ' applicants' );
        }

        $(document).getShowing();


        if(window.location.hash) {
            status_filter = window.location.hash.replace('#','');

            $('#status_filters li').removeClass('active');
            $('#status_filters li a[data-value="' + status_filter + '"').closest('li').addClass('active');

            $('body').reloadResult();
        } 

        $.fn.fixDetailsforBulkActions = function(){
            $field = $(this);
            var cv_ids =$(".search-results .comment.media").map(function(i,v){
                        if( $(this).find('.media-body-check').is(':checked') )
                        {
                            return [ $(this).data("cv")  ];
                        }
                       

                    }).get();

            var app_ids =$(".search-results .comment.media").map(function(i,v){
                        if( $(this).find('.media-body-check').is(':checked') )
                        {
                            return [ $(this).data("app-id")  ];
                        }
                       

                    }).get();


            console.log(  )
            $('#mass-action a').attr('data-cv',cv_ids);
            $('#mass-action a').attr('data-app-id',app_ids);
        }

        $('.select-all input[type=checkbox]').on('click',function(){

            if( $(this).prop('checked') )
            {
                $('.search-results .media-body input[type=checkbox]').prop('checked', true);
                $('#h_act-on').fadeIn();
            }
            else
            {
                $('.search-results .media-body input[type=checkbox]').prop('checked', false);
                $('#h_act-on').fadeOut();
            }

            $(this).fixDetailsforBulkActions();
        });

        $('body').on('click','.check-applicant',function(){

            if( $(this).prop('checked') )
            {
                if( $('body .check-applicant').length == $('body .check-applicant:checked').map(function() { return this.value; }).get().length )
                {
                    $('.select-all input[type=checkbox]').prop('checked', true);
                }
                $('#h_act-on').fadeIn();
            }
            else
            {
                if( $('body .check-applicant').length != $('body .check-applicant:checked').map(function() { return this.value; }).get().length )
                {
                    $('.select-all input[type=checkbox]').prop('checked', false);
                }

                if( $('body .check-applicant:checked').map(function() { return this.value; }).get().length == 0 )
                {
                    $('#h_act-on').fadeOut();
                }
                
            }
            $(this).fixDetailsforBulkActions();
        });

        $('#mass-action button').on('click',function(){
            // cvs = $('.search-results .comment.media').prop('data-cv');
            $field = $(this);
            var cv_ids = $field.data('cv');
            var app_ids = $field.data('app-id');

            // $.post("{{ route('mass-action') }}", {job_id: '{{ $jobID }}',cv_ids :  cv_ids,status: $field.data('action') },function(data){
               
                    
            //         if(status_filter == "" || status_filter == "All")
            //         {

            //         }
            //         else
            //         {
            //             $('body .check-applicant:checked').map(function() { return this }).closest('.comment.media').remove();
            //         }
                    
                    
            //         $('.select-all input[type=checkbox]').prop('checked', false);
            //         $('.search-results .media-body input[type=checkbox]').prop('checked', false);
            //         $('#h_act-on').fadeOut();
            //         $(document).getAllStatus();

            //         $.growl.notice({ message: "You have " + $field.data('action').toLowerCase() + " " + cv_ids.length + " applicant(s) " });
                    
            //         //$('#status_filters a[data-value="' + $field.data('action') + '"]').trigger('click');
            //     });

            console.log(cv_ids,app_ids);
        });
        
        
        
        $.fn.getAllStatus = function(){

            $.get("{{ route('get-all-applicant-status') }}", {job_id: "{{ $jobID }}"},function(data){
                $('body #status_filters').replaceWith(data);
            });
        }

        sh.reloadStatus = function(){
            $.get("{{ route('get-all-applicant-status') }}", {job_id: "{{ $jobID }}"},function(data){
                $('body #status_filters').replaceWith(data);
            });
        }
       

        $('body').on('click', '#clearAllFilters', function(){

            filters = [];
            $('.filter-div input[type=checkbox]' ).prop('checked',false);

            $('#search_keyword').val("");
            age_range = "1, 200";

            $('.search-results').html('{!! preloader() !!}');
            scrollTo('.job-progress-xs');
            $('.result-label').html('');
            $('#pagination').hide();
            $.get("{{ route('job-candidates', $jobID) }}", {search_query: $('#search_query').val(), filter_query : filters, status : status_filter },function(data){
                //console.log(response);
                // var response = JSON.parse(data);
                // console.log(data.search_results);
                $('.result-label').html(data.showing);
                $('#pagination').show();
                $('.search-results').html(data.search_results);
                $('#search-filters').html(data.search_filters);

                $(document).getShowing();
            });
            
        });

    });
</script>




@endsection