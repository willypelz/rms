<?php if( $result['response']['numFound'] > 0 ): ?>
                      
  <?php foreach( @$result['response']['docs'] as $cv ): ?>
  <?php echo e(\App\Libraries\Utilities::cv($cv['cv_file'])); ?>

<li class="row">
      <span class="col-md-2 col-sm-3">
          <a class="" href="my-cv.html">

              <img class="media-object job-team-img" width="100%" src="<?php echo e(( @$cv['display_picture'] ) ? $cv['display_picture'] : asset('img/avatar-cv.jpg')); ?>" alt="">
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
                    <ul class="dropdown-menu" id="folders" data-cv="<?php echo e(@$cv['id']); ?>">
                      

                      <li role="separator" class="divider"></li>

                      <li>
                          <a href="#" id="add_folder_btn" ><i class="fa fa-plus"></i> Create new</a>
                      </li>


                    </ul>

                    <input type="text" style="display:none;" id="add_folder" />
                  </div>
                    <a href="cv.html" class="btn btn-line btn-sm" id='showCvBtn' data-toggle="modal" data-target="#showCv[data-user='<?php echo e(@$cv['id']); ?>']">Preview CV</a>

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
<div class="modal fade no-border" id="showCv" data-user="<?php echo e(@$cv['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="cvViewModalLabel" aria-hidden="false">
</div>
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

<ul id="pagination-demo" class="pagination-sm"></ul>

<script type="text/javascript">
  $(document).ready(function(){
       $('#pagination-demo').twbsPagination({
        totalPages: 35,
        visiblePages: 7,
        onPageClick: function (event, page) {
            $('#page-content').text('Page ' + page);
        }
    });
  });
</script>

<?php else: ?>
  <li class="row">
    <div class="text-center text-muted">
    <i class="fa fa-frown-o fa-3x"></i>
      <h3>Not Found. Please Search again.</h3>
    </div>
  </li>
<?php endif; ?>