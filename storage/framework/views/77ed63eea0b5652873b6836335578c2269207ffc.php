<?php $__env->startSection('header'); ?>
	<?php echo $__env->make('layout.includes.header-user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('navbar'); ?>
	<?php echo $__env->make('layout.includes.navbar-user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>