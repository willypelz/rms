@extends('layout.template-user')

@section('content')



  <div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                   
<!--
                    <h4 class="no-margin text-center text-brandon text-uppercase l-sp-5">
                        @if(!empty($job))   
                            Job Creation
                        @else
                            Upload CVs to Your Talent Pool
                        @endif    
                    </h4><br>
-->
                    <div class="page">
                          <div class="btn-group btn-group-justified hidden" role="group" aria-label="...">
                          
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-line text-capitalize"><i class="fa fa-send"></i>
                            &nbsp; <span class="hidden-xs">Job Promotion</span></button>
                          </div>
                          <div class="btn-group" role="group">
                            <button class="btn disabled text-capitalize text-muted"><i class="fa fa-plus"></i>
                            &nbsp; <span class="hidden-xs">Add candidates</span></button>
                          </div>
                        </div>
                        <!-- <hr> -->
                        <div> 
                        
                        @if(!empty($job))    
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                          <div class="btn-group" role="group">
                            <a href="create-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-file-text-o"></i>
                            &nbsp; <span class="hidden-xs">1. job details</span></a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="advertise-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-send"></i>
                            &nbsp; <span class="hidden-xs">2. advertise</span></a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="share-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-share-alt"></i>
                            &nbsp; <span class="hidden-xs">3. sharing</span></a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="addCan-job.php" type="button" class="btn btn-primary text-capitalize text-muted"><i class="fa fa-search-plus"></i>
                            &nbsp; <span class="hidden-xs">4. add candidates</span></a>
                          </div>
                        </div>
                        @endif
                        
                        @include('job.includes.add-candidate-inc')

                    </div>
                    <!--/tab-content-->

                </div>
            </div>
        </div>
    </section>

    

<div class="separator separator-small"></div>

    

@endsection