@extends('layout.template-default')

@section('content')
<style type="text/css">
  .see-more{display: none;}
  .see-more-shown{ display: block; }
  .pagination .page{ padding: 0px !important; }
</style>

            <script src="{{ secure_asset('js/jquery.form.js') }}"></script> 
<script src="{{ asset('js/jquery.twbsPagination.min.js') }}"></script>

    <section class="s-div dark">
        <div class="container">


    <div class="row">
        
        <div class="col-xs-8"><br>
          <span class="h4 text-green-light text-brandon"> <i class="fa fa-folder"></i> Purchased CV <span class="text-white"> ({{ $result['response']['numFound'] }} Candidates)</span></span>

          &nbsp;

          <!-- <a data-toggle="modal" data-target="#addCandidateModal" id="modalButton" href="#addCandidateModal" class="btn btn-line" ><i class="fa fa-plus"></i> Buy new CV &nbsp;</a> -->

          <div class="clearfix"></div>

        </div>
        

      <div class="col-xs-4 ">
        <form id="form-cv-search" action="{{ url('cv/search') }}" class="form-group collapse"><br>
          <div class="form-lg">
            <div class="col-xs-10">
              <div class="row"><input placeholder="e.g Accountant, Lagos" value="" class="form-control input-lg input-talent" type="text" name="search_query"></div>
            </div>
            <div class="col-xs-2">
              <div class="row">
                <button type="submit" class="btn btn-lg btn-block btn-success btn-talent">
                <!-- Find <span class="hidden-sm hidden-xs">Candidates</span>  -->
                <i class="fa fa-search fa-lg"></i>
                </button>
              </div>
            </div>
          </div>
          <a href="#form-cv-search" data-toggle="collapse" aria-expanded="false" aria-controls="form-cv-search" class="pull-right" style=""><i class="fa fa-close fa-inverse"></i></a>
        </form><br>
        <a href="#form-cv-search" data-toggle="collapse" aria-expanded="false" aria-controls="form-cv-search" class="btn btn-success pull-right"><i class="fa fa-search-plus"></i> Find New Candidate</a>
      </div>

    </div>


        </div>
    </section>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-md-12">

                    <div class="content rounded ">

                    <!-- <div class="row">
                      <div class="well well-sm pushup-sm no-shadow">       

                        <div class="col-xs-6"> 
                      <span class="text-brandon"><i class="fa fa-folder"></i> Folders &nbsp;</span>                 
                            

                        </div>
                        <div class="col-xs-6">
                        <form action="" class="form-inline pull-right">
                          <input type="text" class="form-control" placeholder="Search entire saved candidates" name="search_query" id="search_query" style="width:350px">
                        </form>                      
                        </div> 
                          <div class="clearfix"></div>
                      </div>
                    </div> -->

        <div class="row">



            <div class="col-sm-8">

                  <div class="" id="search-results">

                    <ul class="search-results">
                            
                            @include('cv-sales.includes.search-results-item')

                    </ul>

              </div> <!--/tab-content-->

            </div>
            <!-- End of col-9 -->

            <div class="col-sm-4">
              @if($many== 0)
                <div id="collapseWellCart" class="well well-cart animated slideInUp collapse">
                @else
                <div id="collapseWellCart" class="well well-cart animated slideInUp">
                @endif
                    <div class="row">
                        <div class="col-md-3 hidden-xs hidden-sm small text-light text-muted">Cart<br>
                              <i class="fa fa-shopping-cart fa-3x"></i>
                        </div>
                        <div class="col-md-4 col-xs-3 col-sm-3 small text-left text-muted text-light"> Items<br>
                            <span id="item-count">
                                  @if(empty($items))
                                    <span class="bounceInDown fa-2x" style="display: inline-block;">0</span>
                                  @else  
                                    <span class="bounceInDown fa-2x" style="display: inline-block;">{{ $many }}</span>
                                  @endif
                            </span>
                        </div>
                        <div class="col-md-5 col-xs-9 col-sm-9 small text-right text-muted text-light"> Cost<br>
                            <span class="pull-right fa-2x">
                                &#8358; 
                                  @if(empty($items))
                                    <span id="price-total" >0</span> 
                                  @else
                                    <span id="price-total" >{{ $many * 500 }}</span> 
                                    @endif
                            </span>
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-xs-6"><a id="checkout" href="#" target="_blank" data-toggle="modal" data-target="#myInvoice" class="btn btn-block btn-danger btn-sm btn-cart-checkout"> Checkout &raquo;</a></div>
                        <div class="col-xs-6"><button id="clearCart" class="btn btn-block btn-line btn-sm btn-cart-clear text-muted"><i class="fa fa-close"></i> Clear</button></div>
                    </div>
                </div>
                <div id="search-filters">
                    @include('cv-sales.includes.search-filters')
                </div>
                

            </div> <!--/col-sm-4-->

                            </div> <!--/col-sm-3-->
                        </div>

                    </div>

                </div>

                

            </div>
        </div>
    </section>


    <script type="text/javascript">
    var folders = [];
    var filters = [];

    $(document).ready(function(){
        

        $.fn.setMyFolders = function(cv_folders)
        {
          var html = "" ;
          var names = [];
          $.each(folders,function(index,value){

              if(cv_folders.indexOf( value.id.toString() ) >= 0)
              {
                active = ' &nbsp; <i class="fa fa-check"></i> ';
                names.push( value.name );
              }
              else
              {
                active = "";
              }
              html += '<li id="folder-item" data-ref="' + value.id + '" ><a href="#"><i class="fa fa-folder-o"></i> ' + value.name + active + '</a></li>';

          });
          return { 'html' : html , 'names' : names.join(', ') };
        }

        $.fn.getMyFolders = function()
        {
          $.post("{{ url('cv/get-my-folders') }}",function(data){
                // console.log(data);
                folders = data.folders;
                $('body #folder-item').remove();
                $('body #folders').each(function(index,value){
                    cv_folders = $(this).attr('data-folders').split(':');
                    
                    folder_response = $(this).setMyFolders(cv_folders);
                    $(this).closest('.description').find('#saved_folders_view').html('<i class="fa fa-folder"></i> Saved to ' + folder_response.names);
                    $(this).prepend(folder_response.html);
                })
          });
        }

        

        $(document).getMyFolders();

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

            $('.search-results').html("Loading");
            $.get("{{ url('cv/purchased') }}", {search_query: $('#search_query').val(), filter_query : filters },function(data){
                //console.log(response);
                // var response = JSON.parse(data);
                // console.log(data.search_results);
                $('.search-results').html(data.search_results);
                $('#search-filters').html(data.search_filters);
                $(document).getMyFolders();
                $.each(filters, function(index,value){
                    
                    var arr = value.split(':');
                    
                    $('.filter-div input[type=checkbox]' + '[data-field=' + arr[0] + ']' + '[data-value=' + arr[1] + ']' ).attr('checked',true);
                });
            });
        });

        $(document).on('change', '#search_query', function(){
            // console.log("changed");

           $('.search-results').html("Loading");
            $.get("{{ url('cv/purchased') }}", {search_query: $('#search_query').val(), filter_query : filters },function(data){
                //console.log(response);
                // var response = JSON.parse(data);
                // console.log(data.search_results);
                $('.search-results').html(data.search_results);
                $('#search-filters').html(data.search_filters);
                $(document).getMyFolders();
                
            });
        });

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

    });
</script>



<div class="modal fade" tabindex="-1" id="newFolder" role="dialog" aria-labelledby="newFolder">
      <div class="modal-dialog">
        <div class="modal-content">

            <h3 class="text-center">Create new folder</h3>


        <section class="no-pad" id='ContentAREA'>
                <div class="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="content rounded">
                                <div id="message"></div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="add_folder" placeholder="" name="email">
                                    
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    
                                  </div>
                                  <div class="clearfix"></div>
                              <div class="pull-right">
                                  <a href="javascript://" id="createFolderBtn" class="btn btn-success pull-right">Create</a>
                                  <div class="separator separator-small"></div>
                              </div>
        
                            </div>
                        </div>
                    </div>
                </div>
         </section>
        </div>
      </div>
    </div>
@endsection