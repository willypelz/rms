 <section class="no-pad" >
    <div class="container" >
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
                        
                        



                        @if($job['status'] == 'ACTIVE')
                        <div id="status-box" class="label label-success" style="">Job is active</div>
                        @elseif($job['status'] == 'DRAFT')
                        <div id="status-box"  class="label label-warning" style="">Job is in Draft</div> 
                        @elseif($job['status'] == 'SUSPENDED')
                        <div id="status-box"  class="label label-danger" style="">Job is suspended</div> 
                        @else
                        <div id="status-box" class="label label-danger" style="">Job has expired</div> <!-- <small>To change</small> -->
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
                                <a href="#" target="_blank" type="button" class="btn-sm btn btn-info status"><i class="fa fa-send"></i> &nbsp; Preview</a>
                            </div>
                            <div  class="btn-group" role="group">
                                <a href="{{ route('edit-job', [$job['id']] ) }}" type="button" class="btn-sm btn btn-info status"><i class="fa fa-pencil"></i> &nbsp; Edit Details</a>
                            </div>
                            <div class="btn-group" role="group">
                                
                                @if($job['status'] == 'ACTIVE')
                                    <a href="" id="statusBtn"  type="button" class="btn-sm btn btn-danger status" onclick="UnPublish(1); return false;" ><i class="fa fa-ban"></i> &nbsp; Unpublish Job</a>
                                @elseif($job['status'] == 'DRAFT')
                                    <a href="" id="statusBtn" type="button" class="btn-sm btn btn-success status" onclick="Publish(2); return false;" ><i class="fa fa-ban"></i> &nbsp; Publish Job</a>
                                @elseif($job['status'] == 'SUSPENDED')
                                    <a href="" id="statusBtn" type="button" class="btn-sm btn btn-success status" onclick="Publish(2); return false;" ><i class="fa fa-ban"></i> &nbsp; Publish Job</a>
                                @else
                                    <a disabled href="" id="statusBtn"  type="button" class="btn-sm btn btn-danger status" onclick="UnPublish(1); return false;" ><i class="fa fa-ban"></i> &nbsp; Unpublish Job</a>
                                @endif

                            </div>
                        </div>
                
                
                    </div>
                
                
                    </div>
                </div>
            </section>



<script>

    function Publish(id){
        console.log(id)
        $('#statusBtn').text('Please wait... ')

        var url = "{{ route('job-status') }}"

        $.ajax
            ({
                type: "POST",
                url: url,
                data: ({ rnd : Math.random() * 100000,  job_id:"{{ $job['id'] }}" , status:'ACTIVE'}),
                success: function(response){
                     // $('#statusBtn').hide()
                     $('#statusBtn').text('Un Publish').attr('onclick', 'UnPublish(1); return false')
                     $('#status-box').text('Job is active').removeClass('label-danger').addClass('label-success')

                }
            });

    }

    function UnPublish(id){
        $('#statusBtn').text('Please wait... ')

        console.log('unpublish')

        var url = "{{ route('job-status') }}"

        $.ajax
            ({
                type: "POST",
                url: url,
                data: ({ rnd : Math.random() * 100000,  job_id:"{{ $job['id'] }}", status:'SUSPENDED'}),
                success: function(response){
                    
                     $('#statusBtn').text('Publish').attr('onclick', 'Publish(1); return false')
                     $('#status-box').text('Job is suspended').removeClass('label-success').addClass('label-danger')

                }
        });

    }
    
</script>


