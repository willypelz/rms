<!DOCTYPE html>
<html lang="en">

<?php $__env->startSection('header'); ?>

<?php echo $__env->yieldSection(); ?>


<body>
    <!-- Navbar -->
    <?php $__env->startSection('navbar'); ?>

    <?php echo $__env->yieldSection(); ?>
    

    
    <?php echo $__env->yieldContent('content'); ?>
    

    <?php $__env->startSection('footer'); ?>
        <?php echo $__env->make('layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->yieldSection(); ?>



    </body>

</html>