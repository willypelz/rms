<div class="panel-group">
                    <div class="panel panel-default tweak panel-dash">
                        <div class="panel-heading">
                            <h3 class="text-brandon text-light no-margin applicant-name">{{ $appl->cv->last_name.' '.$appl->cv->first_name }}</h3>
                        </div>
                        <div class="panel-collapse">
                            <div class="row">
                              <div class="panel-body no-padding">
                                  <div class=" border-bottom-thin">
                                      <div class="col-xs-4">
                                          <div class="img-fixer" style="padding-left:5px">
                                            <img src="{{ default_picture( $appl->cv ) }}" class="img-responsive">
                                          </div>
                                      </div>
                                      <div class="col-xs-8">
                                          <p>
                                            <span>Mettaliods Industries</span><br/>
                                            <span>{{ $appl->cv->location }}</span><br/><br/>
                                            <span><i class="fa fa-clock-o"></i> Applied: {{ date('D. d M, Y') }}</span>
                                          </p>
                                      </div>
                                      <div class="clearfix"></div><br/>
                                  </div>
                                  <br/>
                              
                                  <div class="col-xs-12">
                                      <p class="text-muted">
                                          <span class="fa-stack">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-phone fa-stack-1x fa-inverse"></i>
                                          </span> {{ $appl->cv->phone }}
                                          <br/>
                                          <span class="fa-stack">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                          </span> {{ $appl->cv->email }}
                                          <br/>
                                          <span class="fa-stack">
                                            <i class="fa fa-circle fa-stack-2x"></i>
                                            <i class="fa fa-arrow-up fa-stack-1x fa-inverse"></i>
                                          </span> {{ str_replace('ago', 'old', human_time($appl->cv->date_of_birth, 1)) }}
                                      </p>
                                      <!--<hr class=" border-bottom-thin">-->  <br>
                                      <div class="btn-group btn-block" role="group" aria-label="...">
                                          <button type="button" class="btn btn-line" title="Share">
                                              <i class="fa fa-share-alt"></i>
                                          </button>
                                          <button type="button" class="btn btn-line" title="Send Message">
                                              <i class="fa fa-envelope-o"></i>
                                          </button>
                                          <button type="button" class="btn btn-line" title="Add Coment">
                                          <i class="fa fa-comment-o"></i>
                                          </button>
                                          <button type="button" class="btn btn-line" title="Enlist">
                                              <i class="fa fa-file-text-o"></i>
                                          </button>
                                          <button type="button" class="btn btn-line" title="Assess Applicant">
                                              <i class="fa fa-question-circle"></i>
                                          </button>
                              
                                          <div class="btn-group btn-group-last" role="group" style="">
                                              <button type="button" title="More Options" class="btn btn-line btn-block dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <!--<i class="fa fa-ellipsis-v"></i>-->
                                                  <!--&nbsp;-->
                                                  <span class="caret"></span>
                                              </button>
                                              <ul class="dropdown-menu">
                                                  <li><a href="#">Interview</a></li>
                                                  <li><a href="#">Assign to new Job</a></li>
                                                  <li><a href="#">Reject</a></li>
                                                  <li><a href="#">Background Check</a></li>
                                                  <li><a href="#">Medicals</a></li>
                                                  <li role="separator" class="divider"></li>
                                                  <li><a href="#">Download Dossier</a></li>
                                                  <li><a href="#">Make Interview Notes</a></li>
                                              </ul>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            </div>
                        </div>

                       <!-- <div class="baser-L" title="Previous Applicant">
                            <h3 class="line1"><span class="glyphicon glyphicon-arrow-left"></span></h3>
                        </div>

                        <div class="baser-R" title="Next Applicant">
                            <h3 class="line1"><span class="glyphicon glyphicon-arrow-right"></span></h3>
                        </div> -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">Job Team</h4>
                        </div>

                        <div class="panel-collapse">
                            <div class="panel-body row">
                                <div class="col-xs-3">
                                  <a class="" href="#">
                                      <img class="media-object img-responsive" src="http://dummyimage.com/300x300/ccc/fff.jpg&text=EO" alt="">
                                  </a>
                                </div>
                                <div class="col-xs-8">
                                    <h5 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                    </h5>
                                    <p>Job Administrator</p>
                                    <small>
                                <span class="">
                                        <a href="#" class="">Change Role</a>
                                        &nbsp;
                                        |
                                        &nbsp;
                                        <a href="#" class="">Remove</a>
                                    </span>
                                    </small>

                                </div>
                            </div>

                            <div class="panel-body row">
                                <div class="col-xs-3">
                                  <a class="" href="#">
                                      <img class="media-object img-responsive" src="http://dummyimage.com/300x300/ccc/fff.jpg&text=EO" alt="">
                                  </a>
                                </div>
                                <div class="col-xs-8">
                                    <h5 class="media-heading text-muted"><a href="">Ernest Ojeh</a>
                                    </h5>
                                    <p>Job Administrator</p>
                                    <small>
                                <span class="">
                                        <a href="#" class="">Change Role</a>
                                        &nbsp;
                                        |
                                        &nbsp;
                                        <a href="#" class="">Remove</a>
                                    </span>
                                    </small>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>