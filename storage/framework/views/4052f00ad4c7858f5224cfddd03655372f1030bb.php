<?php $__env->startSection('header'); ?>
	<?php echo $__env->make('layout.includes.header-user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldSection(); ?>

<?php $__env->startSection('navbar'); ?>
	<?php echo $__env->make('layout.includes.navbar-user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldSection(); ?>

<?php echo $__env->make('layout.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>