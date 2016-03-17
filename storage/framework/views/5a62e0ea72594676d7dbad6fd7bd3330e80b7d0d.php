<?php $__env->startSection('navbar'); ?>
    
<?php echo $__env->yieldSection(); ?>

<?php $__env->startSection('content'); ?>
<section>
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center">
                    <h2>Seamless Hiring</h2>
                    <p class="text-muted">Africa's fastest growing network of professionals</p>
                </div>

                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

                    <div class="white padbox rounded">


                        <form role="form" class="form-signup" method="POST" action="<?php echo e(url('/register')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <a id="social" class="btn btn-social btn-linkedin btn-block"> <i class="fa fa-linkedin"></i> Sign up with Linkedin</a>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <a id="social" class="btn btn-social btn-facebook btn-block"> <i class="fa fa-facebook"></i> Sign up with Facebook</a>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                            <fieldset><legend>or use the form below</legend></fieldset><br>

                                <div class="col-sm-6">
                                    <div class="form-group<?php echo e($errors->has('first_name') ? ' has-error' : ''); ?>">
                                        <label for="">First name</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="first_name" value="<?php echo e(old('first_name')); ?>">
                                        <?php if($errors->has('first_name')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('first_name')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group<?php echo e($errors->has('last_name') ? ' has-error' : ''); ?>">
                                        <label for="">Last name</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="last_name" value="<?php echo e(old('last_name')); ?>">
                                        <?php if($errors->has('last_name')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('last_name')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            <div class="col-sm-12">
                                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                    <label for="">Your Email</label>
                                    <input type="email" class="form-control" id="" placeholder="" name="email" value="<?php echo e(old('email')); ?>">
                                    <?php if($errors->has('email')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                    <label for="">Create your Password</label>
                                    <input type="password" class="form-control" id="" placeholder="" name="password">

                                    <?php if($errors->has('password')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                                    <label for="">Re-type Password</label>
                                    <input type="password" class="form-control" id="" placeholder="" name="password_confirmation">
                                    <?php if($errors->has('password_confirmation')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            </div>

                            <div class="row">
                                <span class="hidden-xs"><br></span>
                                <div class="col-sm-6 text-muted">
                                    By clicking "Sign Up", you agree with our <a href="#">Terms & Conditions</a>
                                <span class="visible-xs"><br></span>
                                </div>

                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-success btn-block">Proceed &raquo;</button>
                                </div>

                                <div class="col-sm-12">
                                    <hr>
                                </div>

                                <div class="col-xs-12 text-center">
                                    <p>Already registered? <a href="<?php echo e(url('log-in')); ?>">Sign In Here</a></p>
                                </div>

                            </div>
                        </form>

                    </div>
                    <!--/tab-content-->

                </div>

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
        
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.template-default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>