<?php $__env->startSection('content'); ?>

    <script src="<?php echo e(asset('js/jquery-1.11.1.min.js')); ?>"></script>

<section class="s-div dark">
        <div class="container">

            <div class="row">
                <div class="col-md-6 hidden-sm hidden-xs">
                    <div class=""><br>
                        <h4 class="text-white push-down text-uppercase text-brandon"> <i class="fa fa-street-view"></i> Talent Pool</h4>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <form action="cv-search.php" class="form-group"><br>
                       <div class="form-lg">
                         <div class="col-xs-10">
                           <div class="row"><input placeholder="Find something you want" value="Frontend Developer" class="form-control input-lg input-talent" type="text"></div>
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



            <div class="col-sm-8">

                  <div class="" id="search-results">

                    <ul class="search-results">

                      <?php if( $result['response']['numFound'] > 0 ): ?>
                      
                      <?php foreach( $result['response']['docs'] as $cv ): ?>

                        <li class="row">
                              <span class="col-md-2 col-sm-3">
                                  <a class="" href="my-cv.html">
                                      <img class="media-object job-team-img" width="100%" src="<?php echo e(( $cv['display_picture'] ) ? $cv['display_picture'] : asset('img/avatar-cv.jpg')); ?>" alt="">
                                  </a>
                              </span>

                              <span class="col-md-10 col-sm-9">
                                      <h4 class="text-muted">
                                      <a href="my-cv.html"><?php echo e(ucwords( $cv['first_name']. " " . $cv['last_name'] )); ?></a>
                                          <span class="small">
                                          
                                          <?php if(@$cv['dob']): ?>
                                            . <?php echo e(\App\Libraries\Utilities::getAge($cv['dob'])); ?>

                                          
                                          <?php endif; ?>
                                          <!--<span class="label label-primary">INSIDIFY</span>-->
                                      </h4>
                                      <span> <?php echo e(@$cv['tagline']); ?></span>

                                      <div class="description">
                                          <p class="sub-box excerpt-p text-muted hidden"><i>bodied security men and women needed in a hotel. Must be smart and able to work in a corporate environment</i></p>
                                          <br>
                                        <p class="">
                                              <!-- Single button -->
                                          <div class="btn-group">
                                            <button type="button" class="btn btn-line btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              Save into Folder &nbsp; <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                              <li><a href="#"><i class="fa fa-folder-o"></i> Devlopers</a></li>
                                              <li><a href="#"><i class="fa fa-folder-o"></i> Medicals</a></li>
                                              <li><a href="#"><i class="fa fa-folder-o"></i> Fashion</a></li>

                                              <li role="separator" class="divider"></li>

                                              <li>
                                                  <a href="#"><i class="fa fa-plus"></i> Create new</a>
                                              </li>
                                            </ul>
                                          </div>
                                            <a href="cv.html" class="btn btn-line btn-sm" data-toggle="modal" data-target="#cvViewModal">Preview CV</a>

                                            <span class="purchase-action">
                                                  <?php 
                                                    if($ids != null)
                                                      $in_cart = in_array($cv['id'], $ids);
                                                    else
                                                      $in_cart = "";
                                                  ?>
                                                  
                                                  <?php if($in_cart): ?>
                                                    <button id="cartRemove<?php echo e($cv['id']); ?>" class="btn btn-line btn-sm btn-cv-discard" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                  <?php else: ?>


                                                  <a href="" id="cartAdd<?php echo e($cv['id']); ?>" class="btn btn-success btn-sm btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Purchase CV for N500</a>
                                                <button id="cartRemove<?php echo e($cv['id']); ?>" class="btn btn-line btn-sm btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                                                <?php endif; ?>
                                          </span>

                                        </p>
                                      </div>
                              </span>

                        </li><hr>
                          

                          <script>
                              $(document).ready(function(){

                                  var id = "<?php echo e($cv['id']); ?>";
                                  var url = "<?php echo e(route('cart')); ?>"
                                  
                                  $("#cartAdd"+id).click(function(){
                                      // console.log(url)
                                      $.ajax
                                      ({
                                        type: "POST",
                                        url: url,
                                        data: ({ rnd : Math.random() * 100000, cv_id: id, type:'add', name:"<?php echo e($cv['first_name']. " " . $cv['last_name']); ?>", 'qty':1, 'price':500, "_token":"<?php echo e(csrf_token()); ?>"}),
                                        success: function(response){
                                          
                                          console.log(response);
                                          
                                        }
                                    });

                                  });


                                  $("#cartRemove"+id).click(function(){
                                      // console.log(url)
                                      $.ajax
                                      ({
                                        type: "POST",
                                        url: url,
                                        data: ({ rnd : Math.random() * 100000, cv_id: id, type:'remove', "_token":"<?php echo e(csrf_token()); ?>"}),
                                        success: function(response){
                                          
                                          console.log(response);
                                          
                                        }
                                    });

                                  });

                                  $("#clearCart").click(function(){
                                      // console.log(url)
                                      $.ajax
                                      ({
                                        type: "POST",
                                        url: url,
                                        data: ({ rnd : Math.random() * 100000, cv_id: id, type:'clear', "_token":"<?php echo e(csrf_token()); ?>"}),
                                        success: function(response){
                                          
                                          console.log(response);
                                          
                                        }
                                    });

                                  });


                              })

                          </script>

                        <?php endforeach; ?>

                      <?php else: ?>
                        <li class="row">
                          <div class="text-center text-muted">
                          <i class="fa fa-frown-o fa-3x"></i>
                            <h3>Not Found. Please Search again.</h3>
                          </div>
                        </li>
                      <?php endif; ?>
                      
                    </ul>

              </div> <!--/tab-content-->

            </div>
            <!-- End of col-9 -->

            <div class="col-sm-4">
               
                <?php if(empty($items)): ?>
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
                




              <!-- <div class="panel-group" id="accordion"> -->
              <div class="panel-group filter-div" id="accordion">


                  <div class="panel panel-default" style="border-width: 3px">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          Filter Result here
                        </a>
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="pull-right"><img src="<?php echo e(asset('img/up.png')); ?>"></a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                          <p class="border-bottom-thin text-muted">Gender<i class="glyphicon glyphicon-user pull-right"></i></p>
                          <div class="checkbox-inline">
                              <label class="normal"><input type="checkbox" class=""> Male</label> <br>
                              <label class="normal"><input type="checkbox" class=""> Female</label> <br>
                          </div>

                          <p>--</p>

                        <p class="border-bottom-thin text-muted">Location<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
                          <div class="checkbox-inline">
                              <label class="normal"><input type="checkbox" class=""> Lagos</label> <br>
                              <label class="normal"><input type="checkbox" class=""> Abuja</label> <br>
                              <label class="normal"><input type="checkbox" class=""> Ife City</label> <br>
                          </div>
                          <!-- <div><small class="">&nbsp; <a href="" class="">See More</a></small></div> -->

                <div><a href="#" class="more-link read-more-show hide"><small>See More</small></a>
                    <div class="read-more-content checkbox-inline">
                        <label class="normal">
                            <input type="checkbox" class="">Lagos</label>
                        <br>
                        <label class="normal">
                            <input type="checkbox" class="">Abuja</label>
                        <br>
                        <label class="normal">
                            <input type="checkbox" class="">Ife City</label>
                        <br>
                        <a href="#" class="less-link read-more-hide hide"><small>Less</small></a>
                    </div>
                </div>


                          <p>--</p>

                        <p class="border-bottom-thin text-muted">Company<i class="glyphicon glyphicon-briefcase pull-right"></i></p>
                          <div class="checkbox-inline">
                              <label class="normal"><input type="checkbox" class=""> Administrator</label> <br>
                              <label class="normal"><input type="checkbox" class=""> Creative Director</label> <br>
                              <label class="normal"><input type="checkbox" class=""> Head Officer</label> <br>
                          </div>
                          <div><small class="">&nbsp; <a href="">See More</a></small></div>

                
                          <p>--</p>

                          <p class="border-bottom-thin text-muted">Job Type<i class="glyphicon glyphicon-paperclip pull-right"></i></p>
                          <div class="checkbox-inline">
                              <label class="normal"><input type="checkbox" class=""> Corporate</label> <br>
                              <label class="normal"><input type="checkbox" class=""> Assistant</label> <br>
                              <label class="normal"><input type="checkbox" class=""> Officer</label> <br>
                          </div>
                          <div><small class="">&nbsp; <a href="">See More</a></small></div>
                
                          <p>--</p>
                          <p class="border-bottom-thin text-muted">Age Group<i class="glyphicon glyphicon-pushpin pull-right"></i></p>

                      </div>
                    </div>
                  </div>
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

        </div>
      </div>
    </div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.template-user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>