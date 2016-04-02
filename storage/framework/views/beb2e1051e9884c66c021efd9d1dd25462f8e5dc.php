<?php $__env->startSection('navbar'); ?>
    
<?php echo $__env->yieldSection(); ?>

<?php $__env->startSection('content'); ?>

<script src="<?php echo e(asset('js/jquery.slugify.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>

<script type="text/javascript" charset="utf-8">
            $().ready(function () {
                $('.slug').slugify('#company_name');
            
                var pigLatin = function(str) {
                    return str.replace(/(\w*)([aeiou]\w*)/g, "$2$1ay");
                }
            
                $('#pig_latin').slugify('#company_name', {
                        slugFunc: function(str, originalFunc) { return pigLatin(originalFunc(str)); } 
                    }
                );
            
            }); 
</script>

<style type="text/css">
    .error{
        color:red;
    }
</style>

<section>
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center">
                    <h2>Seamless Hiring</h2>
                    <p class="text-muted">Africa's fastest growing network of professionals</p>
                </div>

                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

                    <div class="white padbox rounded">


                        <!-- <form role="form" class="form-signup" method="POST" action="<?php echo e(route('registration')); ?>" type='file'> -->
                              <?php echo Form::open(array('route'=>'registration','method'=>'POST', 'id'=>'SignUPform', 'files'=>true, 'class'=>'form-signup', 'role'=>'form')); ?>


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
                                        <input type="text" class="form-control" id="" placeholder="" name="first_name" value="<?php echo e(old('first_name')); ?>" required>
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
                                        <input type="text" class="form-control" id="" placeholder="" name="last_name" value="<?php echo e(old('last_name')); ?>" required>
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
                                    <input type="email" class="form-control" id="" placeholder="" name="email" value="<?php echo e(old('email')); ?>" required>
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
                                    <input type="password" class="form-control" id="password" placeholder="" name="password" required>

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
                                    <input type="password" class="form-control" id="confirm_password" placeholder="" name="confirm_password">
                                    <?php if($errors->has('password_confirmation')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <hr>
                            <br>
                            <legend>Company Information</legend>
                            <br>
                            

                                <div class="col-sm-12">
                                    <div class="form-group<?php echo e($errors->has('company_name') ? ' has-error' : ''); ?>">
                                        <label for="">Company name</label>
                                        <input type="text" class="form-control" id="company_name" placeholder="" name="company_name" value="<?php echo e(old('company_name')); ?>" required>
                                        <?php if($errors->has('company_name')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('company_name')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group<?php echo e($errors->has('slug') ? ' has-error' : ''); ?>">
                                        <label for="">Slug</label>
                                        <input type="text" class="form-control slug" id="" placeholder="" name="slug" value="<?php echo e(old('slug')); ?>" required>
                                        <?php if($errors->has('slug')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('slug')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group<?php echo e($errors->has('company_email') ? ' has-error' : ''); ?>">
                                        <label for="">Company Email</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="company_email" value="<?php echo e(old('company_email')); ?>" required>
                                        <?php if($errors->has('company_email')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('company_email')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                                        <label for="">Phone</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="phone" value="<?php echo e(old('phone')); ?>" required>
                                        <?php if($errors->has('phone')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('phone')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                 <div class="col-sm-6">
                                    <div class="form-group<?php echo e($errors->has('website') ? ' has-error' : ''); ?>">
                                        <label for="">Website</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="website" value="<?php echo e(old('website')); ?>" required>
                                        <?php if($errors->has('website')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('website')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                

                                 <div class="col-sm-12">
                                    <div class="form-group<?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
                                        <label for="">Address</label>
                                        <textarea name="address" class="form-control" id="" cols="30" rows="10" required></textarea>
                                        <?php if($errors->has('address')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('address')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                 <div class="col-sm-12">
                                    <div class="form-group<?php echo e($errors->has('about_company') ? ' has-error' : ''); ?>">
                                        <label for="">About Company</label>
                                        <textarea name="about_company" class="form-control" id="" cols="30" rows="10" required></textarea>
                                        <?php if($errors->has('about_company')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('about_company')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group<?php echo e($errors->has('about_company') ? ' has-error' : ''); ?>">
                                        <label for="">Company Logo</label>
                                <?php  echo Form::file('logo'); ?>
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
                                    <button type="submit" class="btn btn-success btn-block">Sign Up &raquo;</button>
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

    <script>
        $("#SignUPform").validate({
            rules:{
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
        
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.template-default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>