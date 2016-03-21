
<?php if(Auth::check()): ?>

	<?php echo $__env->make('layout.template-user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php else: ?>

	<?php echo $__env->make('layout.template-guest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php endif; ?>