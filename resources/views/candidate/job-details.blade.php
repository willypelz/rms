<section class="job-head blue no-margin">
  <div class="">
    <div class="row">
      
      <div class="col-sm-8 col-sm-offset-2 text-center">
        <small class="text-brandon l-sp-5 text-uppercase">job details</small>
        
        <h2 class="job-title">
        {{ ucfirst( $job['title'] ) }}
        </h2>
        <hr>
        <ul class="list-inline text-white">
          <!--<li><strong>Company:</strong>&nbsp; JobAcess</li>-->
          <li>
          <strong>&nbsp;Posted:</strong>&nbsp; {{ date('D. j M, Y', strtotime($job['created_at'])) }}</li>
          <li>
          <strong>&nbsp;Expires:</strong>&nbsp; <?php echo date('d, M Y', strtotime($job['expiry_date'])) ?></li>
        </ul>
      </div>
      <div class="clearfix"></div>
      
    </div>
  </div>
  
</section>


<div class="row">
  
  <div class="col-sm-12">
    <div class="page no-bod-rad">
      <div class="row">
        <div class=" job-cta">

          <div class="col-sm-4">
            <a role="presentation" href="#sec-job-list" aria-controls="sec-job-list" role="tab" data-toggle="tab"  class="btn">&laquo; Back to List
            </a>

          </div>
          <div class="col-sm-4">
            <a href="{{ url('job/apply/'.$job['id'].'/'.str_slug($job['title']) ) }}" class="btn btn-success btn-block" id="loginToApply" disabled="disabled">Login to Apply for Job
            </a>
          </div>
          <!-- <div class="col-sm-5">
            <span style='color:red' id='saveMailboxResponse'></span>
            
            <div class="btn-group btn-group-justified">
              <div class="btn-group">
                <a href="" onclick="SavetoMailbox(); return false;" id="saveTomyMailbox" class="btn btn-line"> Save <span class="">to mailbox</span></a>
              </div>
              <div class="btn-group">
                <a href="" class="btn btn-line" data-toggle="modal" data-target="#myModal"> Send<span class=""> to friend</span></a>
              </div>
            </div>
            
          </div> -->
          <div class="col-sm-4 pull-right">
            
            <p class="pull-right no-margin">
              Share on &nbsp;
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ url($company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x text-"></i>
                  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                </span>
              </a>
              
              <a href="https://twitter.com/home?status={{ url($company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x text-"></i>
                  <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
              
              <a href="https://plus.google.com/share?url={{ url($company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                <span class="fa-stack fa-lg">
                  <i class="fa fa-circle fa-stack-2x text-"></i>
                  <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </p>
          </div>
          <div class="clearfix"></div>
        </div>


        <div class="tab-content">
          
          <div class="row">
            
            <div class="col-sm-8">
              <!--                                            <h6 class="text-info text-brandon text-uppercase l-sp-5 no-margin">Job details</h6>-->
              <!--                                            <br>-->
              <div class="row">
                <div class="col-xs-6 col-sm-3">
                  <small class="text-muted">Job Type</small>
                  <br>
                  <i class="flaticon-online-job-search"></i>
                  <h5 class="text-uppercase text-brandon">{{ $job['job_type'] }}</h5>
                </div>
                <div class="col-xs-6 col-sm-4">
                  <small class="text-muted">Location</small>
                  <br>
                  <i class="flaticon-money"></i>
                  <h5 class="text-uppercase text-brandon">{{ $job['location'] }}</h5>
                </div>
                <div class="col-xs-12 col-sm-5">
                  <small class="text-muted">Specialization(s)</small>
                  <br>
                  <i class="flaticon-diploma-1"></i>
                  <h5 class="text-uppercase text-brandon">
                  <?php $specs = array_pluck( $job->specializations->toArray(), 'name' ); ?>
                  {{ implode( ', ', $specs ) }}
                  </h5>
                </div>
                
                <div class="col-xs-12">
                  <hr><h6 class="text-info text-brandon text-uppercase l-sp-5 no-margin">Job Description</h6><hr>
                  {!!html_entity_decode( ucfirst( $job['details'] ) )!!}
                </div>
                <!-- <div class="col-xs-12">
                  <hr><h6 class="text-info text-brandon text-uppercase l-sp-5 no-margin">Qualifications</h6><hr>
                  {!!html_entity_decode( ucfirst( $job['experience'] ) )!!}
                </div> -->
              </div>
              <div class="row">
                <div class="col-xs-12"><hr></div>
                <div class="col-sm-5">
                  <a href="{{ url('job/apply/'.$job['id'].'/'.str_slug($job['title']) ) }}" class="btn btn-success" id="loginToApply" disabled="disabled">Login to Apply for Job</a>
                </div>
                <div class="separator separator-small"></div>
              </div>
            </div>
            
            <div class="col-sm-4">
              <h6 class="text-brandon text-uppercase l-sp-5 no-margin">company details</h6><br>
              <p class="text-muted">{{ $company->name }}</p>
              <p><img src="{{ $company->logo }}" alt="" width="60%"></p><br>
              <p class="small text-muted">{{ $company->about }}</p>
              <p><i class="fa fa-map-marker"></i> {{ $company->address }}</p>
              <!--p>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4448.570052456479!2d3.3791209324273184!3d6.618898622434336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b93a899b7c9b7%3A0x8630de71dbc44ffd!2sMagodo+GRA+Phase+II%2C+Lagos!5e0!3m2!1sen!2sng!4v1457754339276" frameborder="0" width="100%" height="200px" allowfullscreen></iframe>
            </p-->
            <p>
              <i class="fa fa-envelope"></i> {{ $company->email }}  <br>
              <i class="fa fa-globe"></i> {{ $company->website }}
            </p>
          </div>
          <div class="clearfix"></div>
        </div>
        
      </div>


    </div>

  </div>
</div>
</div>