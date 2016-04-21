<div class="row">
      <div class="col-xs-7 scroll-450">
          <div class="">
              
              
                  <div class="panel panel-default">
                      
                            <div class="panel-heading">
                                <h3 class="panel-title">Options</h3>
                            </div>

                        
                          @if(count($products) > 0)
                              @foreach($products as $product)

                            <div class="panel-body" data-id="{{ $product->id }}">

                                <div class="row">
                                    <div class="media small">
                                        <div class="col-xs-9">
                                            <div class="media-left pull-left" style="padding-right: 20px;">
                                                <a href="#">
                                                    <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ $product->provider->logo }}" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading">{{ $product->name }}</h5>
                                                {{ $product->summary }} 
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <p>₦{{ $product->cost }} </p>
                                            <button class="btn btn-sm btn-success" id="request-btn" data-amount="{{ $product->cost }}"  data-title="{{ $product->name  }}"  data-id="{{ $product->id  }}" data-owner="{{ $product->ats_provider_id  }}">
                                                Request
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                          @endif
                        </div>
                  
          </div>
      </div>
      <div class="col-xs-5">
          <h5>Selected Applicant</h5>
         <div class="scroll-150">
          <div class="alert alert-info alert-dismissible c-alert" role="alert">
              {!! @$applicant_badge !!}  
          </div>
          
          </div>

          <!--<a class="btn btn-xs pull-right">-->
              <!--<i class="fa fa-plus fa-lg"></i> Add Applicant-->
          <!--</a>-->
          <div class="clearfix"></div>
          <hr>
          <div>
              <h5>Your Cart</h5>
              <table class="table table-condensed" >
                  <thead>
                  <tr>
                      <th>Your Selection</th>
                      <th>Cost (₦)</th>
                      <th></th>
                  </tr>
                  </thead>
                  <tbody id="cart-preview">
                  
                  </tbody><thead>
                  <tr>
                      <th>Total</th>
                      <th id="cart-total">0</th>
                      <th> &nbsp; </th>
                  </tr>
                  </thead>
                  
              </table>
              @if(!@$test_available)
                <a class="btn btn-danger pull-right">Proceed to Checkout &nbsp;<i class="fa fa-external-link"></i></a>
              @endif
              <!--<a class="btn btn-sm pull-left btn-line">Clear Selection &nbsp;<i class="fa fa-refresh"></i></a>-->
              <div class="clearfix"></div>
              <hr>
          </div>
        

          @if(@$test_available)
          <form>
              <h5>Test Details</h5>
              <div class="form-group">
                  <!--<label>Location</label>-->
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                      <input type="text" required class="form-control" id="test-location" aria-describedby="" placeholder="Location">
                  </div>
                  <!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
                  <!--<span id="inputGroupSuccess1Status" class="sr-only">(success)</span>-->
              </div>
              <div class="form-group">
                  <!--<label>Location</label>-->
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="date" required class="datepicker form-control" id="test-start" aria-describedby="" placeholder="Open Date">
                  </div>
              </div>
              <div class="form-group">
                  <!--<label>Location</label>-->
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="date" required class="datepicker form-control" id="test-end" aria-describedby="" placeholder="Close Date">
                  </div>
              </div>
              <input type="button" class="btn btn-success pull-right" id="request-test" value="Request Test">
              <div class="clearfix"></div>
          </form>
          <!--<hr>-->
          <!--<a class="btn btn-primary btn-block">Check for another Applicant</a>-->
          @endif
      </div>
  </div>




  <script type="text/javascript">

    $(document).ready(function(){

        $('body #request-btn').on('click', function(){
          $('#cart-preview').append('<tr data-id="' + $(this).data('id') +'" data-owner="' + $(this).data('owner') +'"><td id="name">' + $(this).data('title') +'</td><td id="amount">' + $(this).data('amount') +'</td><td class="text-right"><a href="javascript://" id="delete-request"><i class="fa fa-times-circle text-danger"></i> </a></td></tr>');
          $(this).calculateCartTotal();
          $(this).closest('.panel-body').fadeOut();
        });
        
        $('body').on('click','#delete-request',function(){
            console.log( $('.panel-body[data-id="' + $(this).closest('tr').data('id') + '"]') );
            $('.panel-body[data-id="' + $(this).closest('tr').data('id') + '"]').fadeIn();
            $(this).closest('tr').remove();
            $(this).calculateCartTotal();
        });

        $.fn.calculateCartTotal = function(){
          var total = 0;
          $('#cart-preview #amount').each(function( index ) {
              total += parseInt( $( this ).text() );
          });

            $('#cart-total').text(  total  );



            
        }
        
        $('#request-test').on('click', function(){

            var tests = [];

            $('#cart-preview tr').each(function( index ) {
                // $.extend(tests,{
                //     id: $(this).data('id'),
                //     name: $(this).find('#name').text()
                // });
                tests.push({
                    id: $(this).data('id'),
                    name: $(this).find('#name').text(),
                    owner: $(this).data('owner'),
                });
            });

            var data = {
                location : $('#test-location').val(),
                start_time : $('#test-start').val(),
                end_time : $('#test-end').val(),
                job_application_id: "{{ $app_id }}",
                cv_id: "{{ $cv_id }}",
                job_id: "{{ $appl->job->id }}",
                tests : tests
                // test_id: 
                // test_name: 
                // test_owner:
            };

            $.post('{{ route("request-test") }}', data, function(){
                $( '#viewModal' ).modal('toggle');
            });

            console.log(data);
        });

    });

  </script>

  <!-- <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script> -->