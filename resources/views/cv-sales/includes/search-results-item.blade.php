@if( $result['response']['numFound'] > 0 )
                      
  @foreach( @$result['response']['docs'] as $cv )
<li class="row">
      <span class="col-md-2 col-sm-3">
          <a class="" href="my-cv.html">
              <img class="media-object job-team-img" width="100%" src="{{ ( @$cv['display_picture'] ) ? $cv['display_picture'] : asset('img/avatar-cv.jpg') }}" alt="">
          </a>
      </span>

      <span class="col-md-10 col-sm-9">
              <h4 class="text-muted">
              <a href="my-cv.html">{{ ucwords( $cv['first_name']. " " . $cv['last_name'] ) }}</a>
                  <span class="small">
                  
                  @if(@$cv['dob'])
                    . {{ \App\Libraries\Utilities::getAge($cv['dob']) }}
                  
                  @endif
                  <!--<span class="label label-primary">INSIDIFY</span>-->
              </h4>
              <span> {{ @$cv['tagline'] }}</span>

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
                    <a href="cv.html" class="btn btn-line btn-sm" data-toggle="modal" data-target="#showCv[data-user='{{ @$cv['id'] }}']">Preview CV</a>

                    <span class="purchase-action">
                          <a href="" class="btn btn-success btn-sm btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Purchase CV for N500</a>
                        <button class="btn btn-line btn-sm btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                  </span>

                </p>
              </div>
      </span>

</li><hr>
@include('cv-sales.includes.cv-preview')
@endforeach

@else
  <li class="row">
    <div class="text-center text-muted">
    <i class="fa fa-frown-o fa-3x"></i>
      <h3>Not Found. Please Search again.</h3>
    </div>
  </li>
@endif