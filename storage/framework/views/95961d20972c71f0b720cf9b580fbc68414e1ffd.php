<!DOCTYPE html>
<html lang="en">

<?php $__env->startSection('header'); ?>

<?php echo $__env->yieldSection(); ?>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<script src="<?php echo e(asset('js/jquery-1.11.1.min.js')); ?>"></script>

<script type="text/javascript">
	$(function () {
	    $.ajaxSetup({
	        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	    });
	});
</script>

<body>
    <!-- Navbar -->
    <?php $__env->startSection('navbar'); ?>

    <?php echo $__env->yieldSection(); ?>
    

    
    <?php echo $__env->yieldContent('content'); ?>
    

    <?php $__env->startSection('footer'); ?>
        <?php echo $__env->make('layout.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldSection(); ?>



   </body>

</html>