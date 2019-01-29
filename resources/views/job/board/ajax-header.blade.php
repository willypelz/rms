
<section class="job-head blue" id="jobHead">
            <div class="" >
                <div class="row">
                
                    <div class="col-xs-7">
                
                        <h2 class="job-title">
                            <a href="#">
                                {{ $job['title'] }}
                            </a>
                        </h2>
                        <hr>
                        <ul class="list-inline text-white">
                            <!--<li><strong>Company:</strong>&nbsp; JobAcess</li>-->
                            <!-- <li>
                                <a href="create-job.php" class="btn btn-line btn-sm"><i class="fa fa-eye"></i> View Job</a>
                            </li> -->
                            <!-- <li>
                                <a href="create-job.php" class="btn btn-danger btn-sm"><i class="fa fa-pencil"></i> Edit Job</a>
                            </li> -->
                            <li>
                                <strong>&nbsp;Posted:</strong>&nbsp;<?php echo date('d, M Y', strtotime($job['created_at'])) ?></li>
                            <li>
                                <strong>&nbsp;Expires:</strong>&nbsp; 21 Jun, 2014</li>
                        </ul>
                        
                        @if($job['published'] == 1)
                        <div class="label label-success" style="">Job is active</div>
                        @else 
                        <div class="label label-warning" style="">Job is warning</div> 
                        <div class="label label-danger" style="">Job is in danger</div> <!-- <small>To change</small> -->
                        @endif
                        <!-- <div class="badge badge-job badge-job-active">
                            <small class="">
                                <span class="glyphicon glyphicon-ok"></span>
                                &nbsp; Job is active
                            </small>
                        </div> -->
                    </div>
                
                    <div class="col-xs-5 job-progress-xs">
                
                
                        <ul class="pagination pull-right job-progress">
                            <li><a href="#">New</a>
                            </li>
                            <li><a href="#">In Review</a>
                            </li>
                            <li><a href="#" class="active">Interview</a>
                            </li>
                            <li><a href="#">Assessed</a>
                            </li>
                            <li><a href="#">Filled</a>
                            </li>
                        </ul>
                
                        <!-- Select Job Status -->
                
                        <div class="btn-group btn-group-justified" role="group">
                            <div  class="btn-group" role="group">
                                <a href="job.php" target="_blank" type="button" class="btn-sm btn btn-info status"><i class="fa fa-send"></i> &nbsp; Advertise</a>
                            </div>
                            <div  class="btn-group" role="group">
                                <a href="{{ route('edit-job', [$job['id']] ) }}" type="button" class="btn-sm btn btn-info status"><i class="fa fa-pencil"></i> &nbsp; Edit Details</a>
                            </div>
                            <div class="btn-group" role="group">
                                @if($job['published'] == 1)
                                    <a href="" id="statusBtn"  type="button" class="btn-sm btn btn-danger status" onclick="Publish(1); return false;" ><i class="fa fa-ban"></i> &nbsp; Unpublish Job</a>
                                @else
                                    <a href="" id="statusBtn" type="button" class="btn-sm btn btn-danger status" onclick="Publish(2); return false;" ><i class="fa fa-ban"></i> &nbsp; Publish Job</a>
                                @endif
                            </div>
                        </div>
                
                
                    </div>
                
                
                        </div>
            </div>
</section>

