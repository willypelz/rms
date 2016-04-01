<div class="navbar navbar-fixed-top navbar-out no-margin fold transparent" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>"><i class="fa fa-skype"></i>&nbsp; Seamless Hiring</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a class="" href="features.php">Features</a>
                </li>

                <li>
                    <a class="" href="<?php echo e(url('about')); ?>">About</a>
                </li>
                <li>
                    <a class="" href="<?php echo e(url('cv/search-results')); ?>">Find Resumes &nbsp;<i class="fa fa-search"> </i></a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#SignupModal">SIGN UP</a>
                </li>
                <li>
                    <a class="signin" href="#" data-toggle="modal" data-target="#loginModal">LOG IN</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</div>