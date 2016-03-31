<?php $__env->startSection('content'); ?>
<style type="text/css">
  .see-more{display: none;}
  .see-more-shown{ display: block; }
  .pagination .page{ padding: 0px !important; }
</style>

            <script src="http://malsup.github.com/jquery.form.js"></script> 
<script src="<?php echo e(asset('js/jquery.twbsPagination.min.js')); ?>"></script>
<section class="s-div dark">
        <div class="container">

            <div class="row">
                <div class="col-md-6 hidden-sm hidden-xs">
                    <div class=""><br>
                        <h4 class="text-white push-down text-uppercase text-brandon"> <i class="fa fa-street-view"></i> Search Results</h4>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <form action="<?php echo e(url('cv/search')); ?>" class="form-group" method="POST"><br>
                      <?php echo csrf_field(); ?>

                       <div class="form-lg">
                         <div class="col-xs-10">
                           <div class="row"><input placeholder="Find something you want" name="search_query" id="search_query" value="<?php echo e($search_query); ?>" class="form-control input-lg input-talent" type="text"></div>
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
                    </form>

                </div>
            </div>

        </div>
    </section>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-md-12">

                    <div class="content rounded ">

        <div class="row">
<?php /* file_get_contents("http://127.0.0.1:5000/extract?file_name=".( "http://files.insidify.com/uploads/cv/adeigbe_musibau_2015.doc" ) ) */ ?>


            <div class="col-sm-8">

                  <div class="" id="search-results">

                    <ul class="search-results">
                      

                       <?php echo $__env->make('cv-sales.includes.search-results-item', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                      
                      
                    </ul>
                
              </div> <!--/tab-content-->

            </div>
            <!-- End of col-9 -->

            <div class="col-sm-4">
                <?php if($many== 0): ?>
                <div id="collapseWellCart" class="well well-cart animated slideInUp collapse">
                <?php else: ?>
                <div id="collapseWellCart" class="well well-cart animated slideInUp">
                <?php endif; ?>
                    <div class="row">
                        <div class="col-md-3 hidden-xs hidden-sm small text-light text-muted">Cart<br>
                              <i class="fa fa-shopping-cart fa-3x"></i>
                        </div>
                        <div class="col-md-4 col-xs-3 col-sm-3 small text-left text-muted text-light"> Items<br>
                            <span id="item-count">
                                  <?php if(empty($items)): ?>
                                    <span class="bounceInDown fa-2x" style="display: inline-block;">0</span>
                                  <?php else: ?>  
                                    <span class="bounceInDown fa-2x" style="display: inline-block;"><?php echo e($many); ?></span>
                                  <?php endif; ?>
                            </span>
                        </div>
                        <div class="col-md-5 col-xs-9 col-sm-9 small text-right text-muted text-light"> Cost<br>
                            <span class="pull-right fa-2x">
                                &#8358; 
                                  <?php if(empty($items)): ?>
                                    <span id="price-total" >0</span> 
                                  <?php else: ?>
                                    <span id="price-total" ><?php echo e($many * 500); ?></span> 
                                    <?php endif; ?>
                            </span>
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-xs-6"><a id="checkout" href="#" target="_blank" data-toggle="modal" data-target="#myInvoice" class="btn btn-block btn-danger btn-sm btn-cart-checkout"> Checkout &raquo;</a></div>
                        <div class="col-xs-6"><button id="clearCart" class="btn btn-block btn-line btn-sm btn-cart-clear text-muted"><i class="fa fa-close"></i> Clear</button></div>
                    </div>
                </div>
                <div id="search-filters">
                    <?php echo $__env->make('cv-sales.includes.search-filters', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
                

            </div> <!--/col-sm-4-->

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group text-right">
                        <a data-toggle="modal" data-target="#myInvoice" href="#" target="_blank" type="submit" class="btn btn-danger disabled btn-cart-checkout">Proceed to payment &raquo;</a>
                    </div>
                </div>
            </div>

        </div>

    </div>

                

            </div>
        </div>
    </section>




<div class="modal fade" tabindex="-1" id="myInvoice" role="dialog" aria-labelledby="myInvoice">
  <div class="modal-dialog">
    <div class="modal-content">

        <h3 class="text-center">Confirm your order</h3>


              <div id="invoice-res">
                
              </div>
       

          <script>

                           var url = "<?php echo e(route('ajax_cart')); ?>";

                 $("#contentArea").html('<img src="<?php echo e(asset("img/wheel.gif")); ?>" width="100px" /> please wait...');
                              
                                $("#checkout").click(function(){
                                      // console.log(url)
                                      $.ajax
                                      ({
                                        type: "POST",
                                        url: url,
                                        data: ({ rnd : Math.random() * 100000, "_token":"<?php echo e(csrf_token()); ?>"}),
                                        success: function(response){
                                          
                                          // console.log(response);
                                          $('#invoice-res').html(response)
                                          
                                        }
                                    });

                                  });

          </script>


      <script>

                       var url = "<?php echo e(route('ajax_cart')); ?>";

                        $("#contentArea").html('<img src="<?php echo e(asset("img/wheel.gif")); ?>" width="100px" /> please wait...');
                          
                            $("#checkout").click(function(){
                                  // console.log(url)
                                  $.ajax
                                  ({
                                    type: "POST",
                                    url: url,
                                    data: ({ rnd : Math.random() * 100000, "_token":"<?php echo e(csrf_token()); ?>"}),
                                    success: function(response){
                                      
                                      // console.log(response);
                                      $('#invoice-res').html(response)
                                      
                                    }
                                });

                              });

      </script>

    </div>
  </div>
</div>

<script type="text/javascript">
    var folders = [];
    $(document).ready(function(){
        filters = [];

        $.fn.setMyFolders = function()
        {
          var html = "" ;
          $.each(folders,function(index,value){
              html += '<li id="folder-item" data-ref="' + value.id + '"><a href="#"><i class="fa fa-folder-o"></i> ' + value.name + '</a></li>';
          });
          return html;
        }

        $.fn.getMyFolders = function()
        {
          $.post("<?php echo e(url('cv/get-my-folders')); ?>",function(data){
                // console.log(data);
                folders = data.folders;
                $('body #folder-item').remove();
                $('body #folders').each(function(index,value){
                    $(this).prepend($(this).setMyFolders());
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
            $.post("<?php echo e(url('cv/search')); ?>", {search_query: $('#search_query').val(), filter_query : filters },function(data){
                //console.log(response);
                // var response = JSON.parse(data);
                // console.log(data.search_results);
                $('.search-results').html(data.search_results);
                $('#search-filters').html(data.search_filters);

                $.each(filters, function(index,value){
                    
                    var arr = value.split(':');
                    
                    $('.filter-div input[type=checkbox]' + '[data-field=' + arr[0] + ']' + '[data-value=' + arr[1] + ']' ).attr('checked',true);
                });
            });
        });

        $(document).on('click','.read-more-show', function(){
            // console.log($(this).text() );
            // $(this).prev().find('.see-more').show();
            $(this).closest('div').prev().find('.see-more').toggleClass('see-more-shown');

            var text = ( $(this).text() == 'See More' ) ? 'See Less' : 'See More';
            $(this).text(text);
        });

        $(document).on('click', '#showCvBtn', function(){ 
          var this_one = $(this);
            $.post("<?php echo e(url('cv/get_cv_preview')); ?>",function(data){
               $( this_one.attr('data-target') ).html(data);
            });
        });

        $('body').on('click', '#add_folder_btn',function(){
            var input = $(this).parent().parent().parent().find('#add_folder');
            input.show();
        });


        $('body').on('keydown', '#add_folder',function(){
            if(event.which == 13) 
            {
                $field = $(this);
                $.post("<?php echo e(url('cv/add-folder')); ?>", {name: $field.val() },function(data){
                    if(data == true)
                    {
                      $field.val("").hide();
                      $(this).getMyFolders();
                    }
                    
                });

            }
        });

        $('body').on('click','#folder-item',function(){

            $field = $(this);
            
            $.post("<?php echo e(url('cv/save-to-folder')); ?>", {folder_id: $field.attr( 'data-ref' ),item_id: $(this).closest('#folders').attr('data-cv'), item_type: 'saved', },function(data){
                    if(data == true)
                    {
                      $field.addClass( 'active' );
                    }
                    
                });

        });

    });
</script>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.template-default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>