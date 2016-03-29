<?php $__env->startSection('content'); ?>
<section class="s-div text-white">
        <div class="container">

            <div class="row">
                <!-- <div class="col-xs-10">
                    <h3>26 Jobs</h3>
                </div> -->
                <div class="col-xs-2"><br>
                    <a href="<?php echo e(route('post-job')); ?>" class="btn btn-success btn- btn-block"><i class="fa fa-plus"></i> Post a New  Job</a>
                </div>
                <div class="col-xs-2"><br>
                    <a href="<?php echo e(url('cv/search-results')); ?>" class="btn btn-success btn- btn-block dropdown">&plus;<i class="fa fa-user"></i> Add Candidate</a>
                </div>
                <div class="col-xs-2"><br>
                    <a href="<?php echo e(url('jobs/create')); ?>" class="btn btn-success btn- btn-block"><i class="fa fa-bar-chart"></i> View Statistics</a>
                </div>
                <div class="col-xs-6"><br>
                    <a href="create-job.php" class="btn btn-line btn- pull-right transparent"><i class="fa fa-cog no-margin fa-inverse"></i></a>
                </div>
            </div>

        </div>
    </section>
<div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 hidden">

                        <div class=" btn-group-justified btn-dash" role="group" aria-label="...">
                          <div class="btn-group" role="group">
                            <a href="<?php echo e(route('post-job')); ?>" type="button" class="btn btn-line text-capitalize in">
                            <span class="fa-lg"><i class="fa fa-tachometer"></i>
                            <span class="hidden-xs"> Post a New Job</span><br></span>
                            <small class="text-muted hidden-xs">Notifications & Statistics </small>
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="addCan-job.php" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-briefcase"></i>
                            <span class="hidden-xs"> Add Candidate</span><br></span>
                            <small class="text-muted hidden-xs">Jobs you have created</small>
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="stat.php" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-file-text"></i>
                            <span class="hidden-xs"> View Statistics</span><br></span>
                            <small class="text-muted hidden-xs">Resumes / CVs</small>
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="setting.php" type="button" class="btn btn-line text-capitalize text-muted">
                            <span class="fa-lg"><i class="fa fa-cog"></i>
                            <span class="hidden-xs"> Settings</span><br></span>
                            <small class="text-muted hidden-xs">Edit your settings</small>
                            </a>
                          </div>
                        </div>
                    </div>
                    <div class="col-xs-9">

                    <div class="page no-rad-btn">


                        <div class="row">
                            <div class="col-sm-7">
                                <h3>
                                    <br>Google for Jobs</h3>
                                <p>Insidify.com works like Google for jobs, collating job openings from ALL major Nigerian job sites, company career pages, newspapers and classifieds, so that you can search for all Nigerian jobs from one place!</p>
                                <p><a href="" class="btn btn-primary radius">Find a job now &nbsp; <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </p>
                            </div>

                            <div class="col-sm-5">
                                <!-- <p><img src="img/brws.png"></p> -->
                            </div>
                        </div>


                    </div>
                    <!--/tab-content-->

                </div>
                <div class="col-xs-3">
                    <div class="page no-rad-btn">
                        Section2
                    </div>
                </div>
            </div>
        </div>
    </section>

<div class="separator separator-small"></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.template-user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>